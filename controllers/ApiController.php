<?php
// controllers/ApiController.php
class ApiController extends Controller
{

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Метод не дозволений']);
        }

        $query = $this->clean($_POST['query'] ?? '');

        if (strlen($query) < 2) {
            $this->json(['success' => false, 'message' => 'Запит занадто короткий']);
        }

        $productModel = new Product();
        $products = $productModel->searchProducts($query, null, null, null, null);

        // Обмежуємо результати для швидкості
        $products = array_slice($products, 0, 10);

        // Форматуємо результати
        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['main_image'] ?? 'uploads/no-image.jpg',
                'url' => $this->url('product/' . $product['id'])
            ];
        }

        $this->json(['success' => true, 'products' => $results]);
    }

    public function filter()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Метод не дозволений']);
        }

        $categoryId = (int)($_POST['category_id'] ?? 0);
        $brandId = (int)($_POST['brand_id'] ?? 0);
        $minPrice = (float)($_POST['min_price'] ?? 0);
        $maxPrice = (float)($_POST['max_price'] ?? 0);
        $sortBy = $_POST['sort_by'] ?? 'name';
        $sortOrder = $_POST['sort_order'] ?? 'ASC';

        $productModel = new Product();
        $products = $productModel->searchProducts(
            '',
            $categoryId ?: null,
            $brandId ?: null,
            $minPrice ?: null,
            $maxPrice ?: null
        );

        // Сортування
        switch ($sortBy) {
            case 'price':
                usort($products, function ($a, $b) use ($sortOrder) {
                    return $sortOrder === 'ASC' ? $a['price'] <=> $b['price'] : $b['price'] <=> $a['price'];
                });
                break;
            case 'rating':
                usort($products, function ($a, $b) use ($sortOrder) {
                    $ratingA = $a['avg_rating'] ?? 0;
                    $ratingB = $b['avg_rating'] ?? 0;
                    return $sortOrder === 'ASC' ? $ratingA <=> $ratingB : $ratingB <=> $ratingA;
                });
                break;
            default:
                usort($products, function ($a, $b) use ($sortOrder) {
                    return $sortOrder === 'ASC' ? strcmp($a['name'], $b['name']) : strcmp($b['name'], $a['name']);
                });
        }

        $this->json(['success' => true, 'products' => $products]);
    }

    public function getProduct($id)
    {
        $productModel = new Product();
        $product = $productModel->getProductWithDetails($id);

        if (!$product) {
            $this->json(['success' => false, 'message' => 'Товар не знайдено']);
        }

        // Отримуємо зображення
        $images = $productModel->getProductImages($id);
        $product['images'] = $images;

        $this->json(['success' => true, 'product' => $product]);
    }

    public function getCartInfo()
    {
        $cartItems = Cart::getItems();
        $cartCount = Cart::getCount();
        $cartTotal = Cart::getTotal();

        $this->json([
            'success' => true,
            'items' => $cartItems,
            'count' => $cartCount,
            'total' => $cartTotal
        ]);
    }

    public function getStats()
    {
        $this->requireAdmin();

        $orderModel = new Order();
        $productModel = new Product();
        $userModel = new User();

        // Статистика за останні 30 днів
        $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));

        $recentOrders = $orderModel->query(
            "SELECT COUNT(*) as count, SUM(total_price) as revenue 
             FROM orders 
             WHERE created_at >= ?",
            [$thirtyDaysAgo]
        )[0];

        $newUsers = $userModel->query(
            "SELECT COUNT(*) as count 
             FROM users 
             WHERE created_at >= ?",
            [$thirtyDaysAgo]
        )[0];

        $topProducts = $productModel->query(
            "SELECT p.name, SUM(oi.quantity) as sold
             FROM products p
             JOIN order_items oi ON p.id = oi.product_id
             JOIN orders o ON oi.order_id = o.id
             WHERE o.created_at >= ?
             GROUP BY p.id
             ORDER BY sold DESC
             LIMIT 5",
            [$thirtyDaysAgo]
        );

        $this->json([
            'success' => true,
            'stats' => [
                'recent_orders' => $recentOrders,
                'new_users' => $newUsers,
                'top_products' => $topProducts
            ]
        ]);
    }
}
