<?php
// controllers/AdminCategoryController.php
class AdminCategoryController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }
    
    public function index() {
        $categoryModel = new Category();
        $categories = $categoryModel->getCategoriesWithProductCount();
        
        $data = [
            'title' => 'Управління категоріями',
            'categories' => $categories,
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('admin/categories/index', $data);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/categories');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/categories');
        }
        
        $name = $this->clean($_POST['name'] ?? '');
        
        if (empty($name)) {
            $_SESSION['error'] = 'Введіть назву категорії';
            $this->redirect('/admin/categories');
        }
        
        $categoryModel = new Category();
        
        // Перевіряємо чи існує категорія з такою назвою
        if ($categoryModel->nameExists($name)) {
            $_SESSION['error'] = 'Категорія з такою назвою вже існує';
            $this->redirect('/admin/categories');
        }
        
        $result = $categoryModel->create(['name' => $name]);
        
        if ($result) {
            $_SESSION['success'] = 'Категорію додано';
        } else {
            $_SESSION['error'] = 'Помилка при додаванні категорії';
        }
        
        $this->redirect('/admin/categories');
    }
    
    // ✅ ВИПРАВЛЕНИЙ МЕТОД UPDATE
    public function update($id) {
        // Для AJAX запитів повертаємо JSON
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Невірний метод запиту']);
            return;
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
            return;
        }
        
        // Отримуємо ID з POST даних (як відправляється з форми)
        $categoryId = $_POST['category_id'] ?? $id;
        $name = $this->clean($_POST['name'] ?? '');
        
        if (empty($name)) {
            $this->json(['success' => false, 'message' => 'Введіть назву категорії']);
            return;
        }
        
        if (empty($categoryId)) {
            $this->json(['success' => false, 'message' => 'ID категорії не вказано']);
            return;
        }
        
        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        
        if (!$category) {
            $this->json(['success' => false, 'message' => 'Категорію не знайдено']);
            return;
        }
        
        // Перевіряємо чи існує категорія з такою назвою (крім поточної)
        if ($categoryModel->nameExists($name, $categoryId)) {
            $this->json(['success' => false, 'message' => 'Категорія з такою назвою вже існує']);
            return;
        }
        
        $result = $categoryModel->update($categoryId, ['name' => $name]);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Категорію успішно оновлено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при оновленні категорії']);
        }
    }
    
    // ✅ ВИПРАВЛЕНИЙ МЕТОД DELETE
    public function delete($id = null) {
        // Для AJAX запитів повертаємо JSON
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Невірний метод запиту']);
            return;
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
            return;
        }
        
        // Отримуємо ID з POST даних
        $categoryId = $_POST['category_id'] ?? $id;
        
        if (empty($categoryId)) {
            $this->json(['success' => false, 'message' => 'ID категорії не вказано']);
            return;
        }
        
        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        
        if (!$category) {
            $this->json(['success' => false, 'message' => 'Категорію не знайдено']);
            return;
        }
        
        // Перевіряємо чи є товари в цій категорії
        $productModel = new Product();
        $productsCount = $productModel->count('category_id = ?', [$categoryId]);
        
        if ($productsCount > 0) {
            $this->json(['success' => false, 'message' => 'Неможливо видалити категорію, яка містить товари (' . $productsCount . ' товарів)']);
            return;
        }
        
        $result = $categoryModel->delete($categoryId);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Категорію успішно видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні категорії']);
        }
    }
}
?>