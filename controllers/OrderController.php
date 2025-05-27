<?php
// controllers/OrderController.php
class OrderController extends Controller
{

    public function create()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/cart');
        }

        $address = $this->clean($_POST['address'] ?? '');
        $city = $this->clean($_POST['city'] ?? '');
        $postalCode = $this->clean($_POST['postal_code'] ?? '');

        // Валідація
        if (empty($address) || empty($city) || empty($postalCode)) {
            $_SESSION['error'] = 'Заповніть всі поля адреси доставки';
            $this->redirect('/cart');
        }

        $cartItems = Cart::get();

        if (empty($cartItems)) {
            $_SESSION['error'] = 'Кошик порожній';
            $this->redirect('/cart');
        }

        $orderModel = new Order();
        $orderId = $orderModel->createOrder($_SESSION['user_id'], $cartItems, $address, $city, $postalCode);

        if ($orderId) {
            Cart::clear();
            $_SESSION['success'] = 'Замовлення успішно створено! Номер замовлення: #' . $orderId;
            $this->redirect('/orders');
        } else {
            $_SESSION['error'] = 'Помилка при створенні замовлення';
            $this->redirect('/cart');
        }
    }

    public function index()
    {
        $this->requireAuth();

        $userModel = new User();
        $orders = $userModel->getUserOrders($_SESSION['user_id']);

        $data = [
            'title' => 'Мої замовлення',
            'orders' => $orders
        ];

        $this->view('orders/index', $data);
    }

    public function show($id)
    {
        $this->requireAuth();

        $orderModel = new Order();
        $order = $orderModel->getOrderWithItems($id);

        if (!$order || $order['user_id'] != $_SESSION['user_id']) {
            http_response_code(404);
            echo "Замовлення не знайдено";
            return;
        }

        $data = [
            'title' => 'Замовлення #' . $id,
            'order' => $order,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('orders/show', $data);
    }

    // ✅ МЕТОД ДЛЯ СКАСУВАННЯ ЗАМОВЛЕННЯ
    public function cancel()
    {
        $this->requireAuth();

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

        // Перевіряємо, чи замовлення належить поточному користувачу
        if ($order['user_id'] != $_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Доступ заборонено']);
        }

        // Перевіряємо, чи можна скасувати замовлення
        if (!in_array($order['status'], ['pending', 'processing'])) {
            $this->json(['success' => false, 'message' => 'Це замовлення неможливо скасувати']);
        }

        // Скасовуємо замовлення
        $result = $orderModel->updateStatus($orderId, 'cancelled');

        if ($result) {
            // Повертаємо товари на склад
            $this->restoreStock($orderId);

            $this->json(['success' => true, 'message' => 'Замовлення успішно скасовано']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при скасуванні замовлення']);
        }
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ВИДАЛЕННЯ ОДНОГО ЗАМОВЛЕННЯ
    public function delete()
    {
        $this->requireAuth();

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

        // Перевіряємо, чи замовлення належить поточному користувачу
        if ($order['user_id'] != $_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Доступ заборонено']);
        }

        // Можна видаляти тільки завершені замовлення
        if (!in_array($order['status'], ['delivered', 'cancelled'])) {
            $this->json(['success' => false, 'message' => 'Можна видаляти тільки доставлені або скасовані замовлення']);
        }

        // Видаляємо замовлення
        $result = $orderModel->deleteOrder($orderId);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Замовлення видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні замовлення']);
        }
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ОЧИЩЕННЯ ВСІХ ЗАВЕРШЕНИХ ЗАМОВЛЕНЬ
    public function clearCompleted()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Невірний метод запиту']);
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }

        $orderModel = new Order();
        $result = $orderModel->deleteCompletedOrders($_SESSION['user_id']);

        if ($result !== false) {
            $this->json([
                'success' => true,
                'message' => 'Завершені замовлення очищено',
                'count' => $result
            ]);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при очищенні замовлень']);
        }
    }

    // ✅ ДОПОМІЖНИЙ МЕТОД ДЛЯ ПОВЕРНЕННЯ ТОВАРІВ НА СКЛАД
    private function restoreStock($orderId)
    {
        $orderModel = new Order();
        $productModel = new Product();

        // Отримуємо товари замовлення
        $sql = "SELECT product_id, quantity FROM order_items WHERE order_id = ?";
        $items = $orderModel->query($sql, [$orderId]);

        // Повертаємо товари на склад
        foreach ($items as $item) {
            $productModel->increaseStock($item['product_id'], $item['quantity']);
        }
    }
}
