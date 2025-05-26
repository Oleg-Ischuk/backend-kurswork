<?php
// controllers/HomeController.php
class HomeController extends Controller {
    
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();
        
        // Отримуємо популярні товари
        $popularProducts = $productModel->getPopularProducts(8);
        
        // Отримуємо нові товари
        $newProducts = $productModel->getNewProducts(8);
        
        // Отримуємо категорії з кількістю товарів
        $categories = $categoryModel->getCategoriesWithProductCount();
        
        $data = [
            'title' => 'Головна сторінка - Спортивний магазин',
            'popularProducts' => $popularProducts,
            'newProducts' => $newProducts,
            'categories' => $categories
        ];
        
        $this->view('home/index', $data);
    }
}
?>