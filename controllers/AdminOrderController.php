<?php
// controllers/AdminOrderController.php
class AdminOrderController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }
    
    public function index() {
        $orderModel = new Order();
        
        $page = (int)($_GET['page'] ?? 1);
        $status = $_GET['status'] ?? '';
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        // Фільтрація за статусом
        if ($status) {
            $orders = $orderModel->query(
                "SELECT o.*, u.first_name, u.last_name, u.email,
                        COUNT(oi.id) as items_count,
                        SUM(oi.quantity) as total_items
                 FROM orders o
                 LEFT JOIN users u ON o.user_id = u.id
                 LEFT JOIN order_items oi ON o.id = oi.order_id
                 WHERE o.status = ?
                 GROUP BY o.id
                 ORDER BY o.created_at DESC
                 LIMIT {$limit} OFFSET {$offset}",
                [$status]
            );
            $totalOrders = $orderModel->count('status = ?', [$status]);
        } else {
            $orders = $orderModel->getOrdersWithDetails($limit, $offset);
            $totalOrders = $orderModel->count();
        }
        
        $totalPages = ceil($totalOrders / $limit);
        
        $data = [
            'title' => 'Управління замовленнями',
            'orders' => $orders,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'selectedStatus' => $status,
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('admin/orders/index', $data);
    }
    
    public function show($id) {
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
    
    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/orders');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/orders/' . $id);
        }
        
        $status = $_POST['status'] ?? '';
        
        $orderModel = new Order();
        $order = $orderModel->find($id);
        
        if (!$order) {
            $_SESSION['error'] = 'Замовлення не знайдено';
            $this->redirect('/admin/orders');
        }
        
        $result = $orderModel->updateStatus($id, $status);
        
        if ($result) {
            $_SESSION['success'] = 'Статус замовлення оновлено';
        } else {
            $_SESSION['error'] = 'Помилка при оновленні статусу';
        }
        
        $this->redirect('/admin/orders/' . $id);
    }
    
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/orders');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }
        
        $orderModel = new Order();
        $order = $orderModel->find($id);
        
        if (!$order) {
            $this->json(['success' => false, 'message' => 'Замовлення не знайдено']);
        }
        
        $result = $orderModel->delete($id);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Замовлення видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні']);
        }
    }
}
?>