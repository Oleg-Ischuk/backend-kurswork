<?php
// controllers/AdminOrderController.php
class AdminOrderController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index()
    {
        $orderModel = new Order();

        $page = (int)($_GET['page'] ?? 1);
        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';
        $dateFrom = $_GET['date_from'] ?? '';
        $dateTo = $_GET['date_to'] ?? '';
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // ✅ ВИПРАВЛЕНИЙ SQL-ЗАПИТ З ПРАВИЛЬНИМИ ПОЛЯМИ
        $whereConditions = [];
        $params = [];

        if ($status) {
            $whereConditions[] = "o.status = ?";
            $params[] = $status;
        }

        if ($search) {
            $whereConditions[] = "(o.id LIKE ? OR CONCAT(u.first_name, ' ', u.last_name) LIKE ? OR u.email LIKE ?)";
            $searchParam = "%{$search}%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        if ($dateFrom) {
            $whereConditions[] = "DATE(o.created_at) >= ?";
            $params[] = $dateFrom;
        }

        if ($dateTo) {
            $whereConditions[] = "DATE(o.created_at) <= ?";
            $params[] = $dateTo;
        }

        $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

        // Отримуємо замовлення з правильними назвами полів
        $sql = "SELECT o.id,
                       o.total_price as total_amount,
                       o.status,
                       o.created_at,
                       CONCAT(u.first_name, ' ', u.last_name) as customer_name,
                       u.email as customer_email,
                       COUNT(oi.id) as items_count,
                       SUM(oi.quantity) as total_items
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN order_items oi ON o.id = oi.order_id
                {$whereClause}
                GROUP BY o.id, o.total_price, o.status, o.created_at, u.first_name, u.last_name, u.email
                ORDER BY o.created_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        $orders = $orderModel->query($sql, $params);

        // ✅ ДОДАЄМО ТОВАРИ ДО КОЖНОГО ЗАМОВЛЕННЯ
        foreach ($orders as &$order) {
            $itemsSql = "SELECT oi.*, 
                                p.name as product_name,
                                pi.image_url as product_image
                         FROM order_items oi
                         LEFT JOIN products p ON oi.product_id = p.id
                         LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                         WHERE oi.order_id = ?
                         LIMIT 3"; // Обмежуємо для адмін-панелі

            $order['items'] = $orderModel->query($itemsSql, [$order['id']]);
        }

        // Підрахунок загальної кількості
        $countSql = "SELECT COUNT(DISTINCT o.id)
                     FROM orders o
                     LEFT JOIN users u ON o.user_id = u.id
                     LEFT JOIN order_items oi ON o.id = oi.order_id
                     {$whereClause}";

        $totalOrders = $orderModel->queryOne($countSql, $params)['COUNT(DISTINCT o.id)'] ?? 0;
        $totalPages = ceil($totalOrders / $limit);

        $data = [
            'title' => 'Управління замовленнями',
            'orders' => $orders,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'selectedStatus' => $status,
            'search' => $search,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/orders/index', $data);
    }

    public function show($id)
    {
        $orderModel = new Order();
        $order = $orderModel->getOrderWithItems($id);

        if (!$order) {
            $_SESSION['error'] = 'Замовлення не знайдено';
            $this->redirect('/admin/orders');
        }

        $data = [
            'title' => 'Замовлення #' . $id,
            'order' => $order,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/orders/show', $data);
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ОНОВЛЕННЯ СТАТУСУ ЧЕРЕЗ AJAX
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Невірний метод запиту']);
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }

        $orderId = (int)($_POST['order_id'] ?? 0);
        $status = $_POST['status'] ?? '';

        if ($orderId <= 0) {
            $this->json(['success' => false, 'message' => 'Невірний ID замовлення']);
        }

        $orderModel = new Order();
        $order = $orderModel->find($orderId);

        if (!$order) {
            $this->json(['success' => false, 'message' => 'Замовлення не знайдено']);
        }

        $result = $orderModel->updateStatus($orderId, $status);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Статус замовлення оновлено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при оновленні статусу']);
        }
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД ВИДАЛЕННЯ
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Невірний метод запиту']);
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }

        $orderId = (int)($_POST['order_id'] ?? 0);

        if ($orderId <= 0) {
            $this->json(['success' => false, 'message' => 'Невірний ID замовлення']);
        }

        $orderModel = new Order();
        $order = $orderModel->find($orderId);

        if (!$order) {
            $this->json(['success' => false, 'message' => 'Замовлення не знайдено']);
        }

        // Використовуємо метод deleteOrder з Order моделі
        $result = $orderModel->deleteOrder($orderId);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Замовлення видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні']);
        }
    }
    public function print($id)
    {
        $orderModel = new Order();
        $order = $orderModel->getOrderWithItems($id);

        if (!$order) {
            http_response_code(404);
            echo "Замовлення не знайдено";
            return;
        }

        // Отримуємо інформацію про клієнта
        $userModel = new User();
        $customer = $userModel->find($order['user_id']);

        $data = [
            'title' => 'Друк замовлення #' . $id,
            'order' => $order,
            'customer' => $customer
        ];

        $this->view('admin/orders/print', $data);
    }
}
