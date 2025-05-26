<?php
// controllers/OrderController.php
class OrderController extends Controller {
    
    public function create() {
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
    
    public function index() {
        $this->requireAuth();
        
        $userModel = new User();
        $orders = $userModel->getUserOrders($_SESSION['user_id']);
        
        $data = [
            'title' => 'Мої замовлення',
            'orders' => $orders
        ];
        
        $this->view('orders/index', $data);
    }
    
    public function show($id) {
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
            'order' => $order
        ];
        
        $this->view('orders/show', $data);
    }
}
?>