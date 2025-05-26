<?php
// controllers/CategoryController.php
class CategoryController extends Controller {
    
    public function show($id) {
        $categoryModel = new Category();
        $productModel = new Product();
        
        $category = $categoryModel->find($id);
        
        if (!$category) {
            http_response_code(404);
            echo "Категорія не знайдена";
            return;
        }
        
        // Отримуємо товари категорії
        $page = (int)($_GET['page'] ?? 1);
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        $products = $productModel->getProductsByCategory($id);
        
        // Пагінація
        $totalProducts = count($products);
        $totalPages = ceil($totalProducts / $limit);
        $products = array_slice($products, $offset, $limit);
        
        $data = [
            'title' => $category['name'],
            'category' => $category,
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];
        
        $this->view('categories/show', $data);
    }
}
?>