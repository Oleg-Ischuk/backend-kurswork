<?php
// controllers/AdminController.php
class AdminController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }
    
    public function dashboard() {
        $orderModel = new Order();
        
        // Тільки останні замовлення - без статистики
        $recentOrders = $orderModel->getOrdersWithDetails(5);
        
        $data = [
            'title' => 'Адмін панель',
            'recentOrders' => $recentOrders
        ];
        
        $this->view('admin/dashboard', $data);
    }
}
?>