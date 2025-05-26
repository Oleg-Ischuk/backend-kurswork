<?php
// controllers/CartController.php
class CartController extends Controller {
    
    public function show() {
        $cartItems = Cart::getItems();
        $cartTotal = Cart::getTotal();
        
        $data = [
            'title' => 'Кошик',
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal,
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('cart/index', $data);
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
        }
        
        // Перевірка CSRF токену для AJAX запитів
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }
        
        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 1);
        
        if ($productId <= 0 || $quantity <= 0) {
            $this->json(['success' => false, 'message' => 'Невірні дані']);
        }
        
        // Перевіряємо чи існує товар
        $productModel = new Product();
        $product = $productModel->find($productId);
        
        if (!$product) {
            $this->json(['success' => false, 'message' => 'Товар не знайдено']);
        }
        
        // Перевіряємо наявність на складі
        $currentCart = Cart::get();
        $currentQuantity = $currentCart[$productId] ?? 0;
        $newQuantity = $currentQuantity + $quantity;
        
        if ($newQuantity > $product['stock']) {
            $this->json(['success' => false, 'message' => 'Недостатньо товару на складі']);
        }
        
        // Додаємо до кошика
        Cart::add($productId, $quantity);
        
        $this->json([
            'success' => true, 
            'message' => 'Товар додано до кошика',
            'cartCount' => Cart::getCount()
        ]);
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/cart');
        }
        
        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 0);
        
        if ($productId <= 0) {
            $_SESSION['error'] = 'Невірні дані';
            $this->redirect('/cart');
        }
        
        if ($quantity > 0) {
            // Перевіряємо наявність на складі
            $productModel = new Product();
            $product = $productModel->find($productId);
            
            if ($product && $quantity <= $product['stock']) {
                Cart::update($productId, $quantity);
                $_SESSION['success'] = 'Кошик оновлено';
            } else {
                $_SESSION['error'] = 'Недостатньо товару на складі';
            }
        } else {
            Cart::remove($productId);
            $_SESSION['success'] = 'Товар видалено з кошика';
        }
        
        $this->redirect('/cart');
    }
    
    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }
        
        $productId = (int)($_POST['product_id'] ?? 0);
        
        if ($productId <= 0) {
            $this->json(['success' => false, 'message' => 'Невірні дані']);
        }
        
        Cart::remove($productId);
        
        $this->json([
            'success' => true, 
            'message' => 'Товар видалено з кошика',
            'cartCount' => Cart::getCount(),
            'cartTotal' => Cart::getTotal()
        ]);
    }
}
?>