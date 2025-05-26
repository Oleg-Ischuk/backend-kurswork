<?php
// controllers/ProductController.php
class ProductController extends Controller {
    
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();
        $brandModel = new Brand();
        
        // Отримуємо параметри фільтрації
        $search = $this->clean($_GET['search'] ?? '');
        $categoryId = (int)($_GET['category'] ?? 0);
        $brandId = (int)($_GET['brand'] ?? 0);
        $minPrice = (float)($_GET['min_price'] ?? 0);
        $maxPrice = (float)($_GET['max_price'] ?? 0);
        $page = (int)($_GET['page'] ?? 1);
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        // Пошук товарів
        if ($search || $categoryId || $brandId || $minPrice || $maxPrice) {
            $products = $productModel->searchProducts($search, $categoryId ?: null, $brandId ?: null, $minPrice ?: null, $maxPrice ?: null);
        } else {
            $products = $productModel->getProductsWithDetails($limit, $offset);
        }
        
        // Отримуємо категорії та бренди для фільтрів
        $categories = $categoryModel->findAll();
        $brands = $brandModel->findAll();
        
        // Підраховуємо загальну кількість товарів для пагінації
        $totalProducts = $productModel->count();
        $totalPages = ceil($totalProducts / $limit);
        
        $data = [
            'title' => 'Каталог товарів',
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'search' => $search,
            'selectedCategory' => $categoryId,
            'selectedBrand' => $brandId,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];
        
        $this->view('products/index', $data);
    }
    
    public function show($id) {
        $productModel = new Product();
        $reviewModel = new Review();
        
        $product = $productModel->getProductWithDetails($id);
        
        if (!$product) {
            http_response_code(404);
            echo "Товар не знайдено";
            return;
        }
        
        // Отримуємо зображення товару
        $images = $productModel->getProductImages($id);
        
        // Отримуємо атрибути товару
        $attributes = $productModel->getProductAttributes($id);
        
        // Отримуємо відгуки
        $reviews = $reviewModel->getProductReviews($id, 10);
        $reviewStats = $reviewModel->getReviewStats($id);
        
        // Перевіряємо чи може користувач залишити відгук
        $canReview = false;
        $userReview = null;
        if (isset($_SESSION['user_id'])) {
            $canReview = $reviewModel->canUserReview($_SESSION['user_id'], $id);
            $userReview = $reviewModel->getUserReview($_SESSION['user_id'], $id);
        }
        
        // Схожі товари
        $relatedProducts = $productModel->getProductsByCategory($product['category_id'], 4);
        // Видаляємо поточний товар зі схожих
        $relatedProducts = array_filter($relatedProducts, function($p) use ($id) {
            return $p['id'] != $id;
        });
        
        $data = [
            'title' => $product['name'],
            'product' => $product,
            'images' => $images,
            'attributes' => $attributes,
            'reviews' => $reviews,
            'reviewStats' => $reviewStats,
            'canReview' => $canReview,
            'userReview' => $userReview,
            'relatedProducts' => $relatedProducts,
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('products/show', $data);
    }
}
?>