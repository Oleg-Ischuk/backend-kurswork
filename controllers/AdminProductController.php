<?php
// controllers/AdminProductController.php
class AdminProductController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index()
    {
        $productModel = new Product();
        $categoryModel = new Category();
        $brandModel = new Brand();

        $page = (int)($_GET['page'] ?? 1);
        $limit = 6;
        $offset = ($page - 1) * $limit;

        // Отримуємо параметри фільтрації
        $search = $_GET['search'] ?? '';
        $selectedCategory = $_GET['category'] ?? '';
        $selectedBrand = $_GET['brand'] ?? '';

        $products = $productModel->getProductsWithDetails($limit, $offset);
        $totalProducts = $productModel->count();
        $totalPages = ceil($totalProducts / $limit);

        // ✅ ОТРИМУЄМО КАТЕГОРІЇ ТА БРЕНДИ З ВІДЛАДКОЮ
        try {
            $categories = $categoryModel->getAll();
            $brands = $brandModel->getAll();

            // Відладка - можна видалити після перевірки
            error_log("Categories count: " . count($categories));
            error_log("Brands count: " . count($brands));
        } catch (Exception $e) {
            error_log("Error getting categories/brands: " . $e->getMessage());
            $categories = [];
            $brands = [];
        }

        $data = [
            'title' => 'Управління товарами',
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'search' => $search,
            'selectedCategory' => $selectedCategory,
            'selectedBrand' => $selectedBrand,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/products/index', $data);
    }

    public function create()
    {
        $categoryModel = new Category();
        $brandModel = new Brand();

        try {
            $categories = $categoryModel->getAll();
            $brands = $brandModel->getAll();
        } catch (Exception $e) {
            error_log("Error in create method: " . $e->getMessage());
            $categories = [];
            $brands = [];
        }

        $data = [
            'title' => 'Додати товар',
            'categories' => $categories,
            'brands' => $brands,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/products/create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/products');
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/products/create');
        }

        $name = $this->clean($_POST['name'] ?? '');
        $description = $this->clean($_POST['description'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $stock = (int)($_POST['stock'] ?? 0);
        $categoryId = (int)($_POST['category_id'] ?? 0);
        $brandId = (int)($_POST['brand_id'] ?? 0);
        $discount = (float)($_POST['discount'] ?? 0);

        // Валідація
        $errors = [];
        if (empty($name)) $errors[] = 'Введіть назву товару';
        if ($price <= 0) $errors[] = 'Введіть коректну ціну';
        if ($stock < 0) $errors[] = 'Кількість не може бути від\'ємною';
        if ($categoryId <= 0) $errors[] = 'Оберіть категорію';

        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $this->redirect('/admin/products/create');
        }

        $productModel = new Product();

        $productData = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $categoryId,
            'brand_id' => $brandId ?: null,
            'discount' => $discount
        ];

        $productId = $productModel->create($productData);

        if ($productId) {
            // Завантажуємо зображення
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image'], 'products');
                if ($imagePath) {
                    $productModel->addProductImage($productId, $imagePath, true);
                }
            }

            $_SESSION['success'] = 'Товар успішно додано';
            $this->redirect('/admin/products');
        } else {
            $_SESSION['error'] = 'Помилка при додаванні товару';
            $this->redirect('/admin/products/create');
        }
    }

    public function edit($id)
    {
        $productModel = new Product();
        $categoryModel = new Category();
        $brandModel = new Brand();

        $product = $productModel->find($id);

        if (!$product) {
            $_SESSION['error'] = 'Товар не знайдено';
            $this->redirect('/admin/products');
        }

        $images = $productModel->getProductImages($id);

        try {
            $categories = $categoryModel->getAll();
            $brands = $brandModel->getAll();
        } catch (Exception $e) {
            error_log("Error in edit method: " . $e->getMessage());
            $categories = [];
            $brands = [];
        }

        $data = [
            'title' => 'Редагувати товар',
            'product' => $product,
            'images' => $images,
            'categories' => $categories,
            'brands' => $brands,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/products/edit', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/products');
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/products/' . $id . '/edit');
        }

        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            $_SESSION['error'] = 'Товар не знайдено';
            $this->redirect('/admin/products');
        }

        $name = $this->clean($_POST['name'] ?? '');
        $description = $this->clean($_POST['description'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $stock = (int)($_POST['stock'] ?? 0);
        $categoryId = (int)($_POST['category_id'] ?? 0);
        $brandId = (int)($_POST['brand_id'] ?? 0);
        $discount = (float)($_POST['discount'] ?? 0);

        // Валідація
        $errors = [];
        if (empty($name)) $errors[] = 'Введіть назву товару';
        if ($price <= 0) $errors[] = 'Введіть коректну ціну';
        if ($stock < 0) $errors[] = 'Кількість не може бути від\'ємною';
        if ($categoryId <= 0) $errors[] = 'Оберіть категорію';

        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $this->redirect('/admin/products/' . $id . '/edit');
        }

        $productData = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $categoryId,
            'brand_id' => $brandId ?: null,
            'discount' => $discount
        ];

        $result = $productModel->update($id, $productData);

        if ($result) {
            // Завантажуємо нові зображення
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image'], 'products');
                if ($imagePath) {
                    $productModel->addProductImage($id, $imagePath, true);
                }
            }

            $_SESSION['success'] = 'Товар оновлено';
            $this->redirect('/admin/products');
        } else {
            $_SESSION['error'] = 'Помилка при оновленні товару';
            $this->redirect('/admin/products/' . $id . '/edit');
        }
    }

    public function delete()
    {
        // Перевіряємо CSRF токен
        if (!isset($_POST['csrf_token']) || !$this->validateCsrfToken($_POST['csrf_token'])) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Недійсний CSRF токен']);
            return;
        }

        // Перевіряємо чи це AJAX запит
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Недійсний запит']);
            return;
        }

        $productId = $_POST['product_id'] ?? null;

        if (!$productId || !is_numeric($productId)) {
            echo json_encode(['success' => false, 'message' => 'Невірний ID товару']);
            return;
        }

        try {
            $productModel = new Product();

            // Перевіряємо чи існує товар
            $product = $productModel->find($productId);
            if (!$product) {
                echo json_encode(['success' => false, 'message' => 'Товар не знайдено']);
                return;
            }

            // Видаляємо зображення товару
            $images = $productModel->getProductImages($productId);
            foreach ($images as $image) {
                if (!empty($image['image_url']) && file_exists($image['image_url'])) {
                    unlink($image['image_url']);
                }
            }

            // Видаляємо товар з бази даних
            $result = $productModel->delete($productId);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Товар успішно видалено']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Помилка при видаленні товару']);
            }
        } catch (Exception $e) {
            error_log("Error deleting product: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Внутрішня помилка сервера']);
        }
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ВСТАНОВЛЕННЯ ГОЛОВНОГО ЗОБРАЖЕННЯ
    public function setMainImage()
    {
        if (!isset($_POST['csrf_token']) || !$this->validateCsrfToken($_POST['csrf_token'])) {
            echo json_encode(['success' => false, 'message' => 'Недійсний CSRF токен']);
            return;
        }

        $imageId = (int)($_POST['image_id'] ?? 0);
        $productId = (int)($_POST['product_id'] ?? 0);

        if (!$imageId || !$productId) {
            echo json_encode(['success' => false, 'message' => 'Невірні параметри']);
            return;
        }

        $productModel = new Product();
        $result = $productModel->setMainImage($imageId, $productId);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Головне зображення встановлено']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Помилка при встановленні головного зображення']);
        }
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ВИДАЛЕННЯ ЗОБРАЖЕННЯ
    public function deleteImage()
    {
        if (!isset($_POST['csrf_token']) || !$this->validateCsrfToken($_POST['csrf_token'])) {
            echo json_encode(['success' => false, 'message' => 'Недійсний CSRF токен']);
            return;
        }

        $imageId = (int)($_POST['image_id'] ?? 0);

        if (!$imageId) {
            echo json_encode(['success' => false, 'message' => 'Невірний ID зображення']);
            return;
        }

        $productModel = new Product();
        $result = $productModel->deleteImage($imageId);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Зображення видалено']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Помилка при видаленні зображення']);
        }
    }

    private function uploadProductImages($productId, $files)
    {
        $productModel = new Product();

        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                ];

                $imagePath = $this->uploadImage($file, 'products');

                if ($imagePath) {
                    $isMain = ($i === 0); // Перше зображення робимо головним
                    $productModel->addProductImage($productId, $imagePath, $isMain);
                }
            }
        }
    }
}
