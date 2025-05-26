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
    
    public function update($id) {
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
        $category = $categoryModel->find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Категорію не знайдено';
            $this->redirect('/admin/categories');
        }
        
        // Перевіряємо чи існує категорія з такою назвою (крім поточної)
        if ($categoryModel->nameExists($name, $id)) {
            $_SESSION['error'] = 'Категорія з такою назвою вже існує';
            $this->redirect('/admin/categories');
        }
        
        $result = $categoryModel->update($id, ['name' => $name]);
        
        if ($result) {
            $_SESSION['success'] = 'Категорію оновлено';
        } else {
            $_SESSION['error'] = 'Помилка при оновленні категорії';
        }
        
        $this->redirect('/admin/categories');
    }
    
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/categories');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }
        
        $categoryModel = new Category();
        $category = $categoryModel->find($id);
        
        if (!$category) {
            $this->json(['success' => false, 'message' => 'Категорію не знайдено']);
        }
        
        // Перевіряємо чи є товари в цій категорії
        $productModel = new Product();
        $productsCount = $productModel->count('category_id = ?', [$id]);
        
        if ($productsCount > 0) {
            $this->json(['success' => false, 'message' => 'Неможливо видалити категорію, яка містить товари']);
        }
        
        $result = $categoryModel->delete($id);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Категорію видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні']);
        }
    }
}
?>