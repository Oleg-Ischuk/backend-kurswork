<?php
// controllers/AdminBrandController.php
class AdminBrandController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index()
    {
        $brandModel = new Brand();
        $brands = $brandModel->getBrandsWithProductCount();

        $data = [
            'title' => 'Управління брендами',
            'brands' => $brands,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/brands/index', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/brands');
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/brands');
        }

        $name = $this->clean($_POST['name'] ?? '');

        if (empty($name)) {
            $_SESSION['error'] = 'Введіть назву бренду';
            $this->redirect('/admin/brands');
        }

        $brandModel = new Brand();

        // Перевіряємо чи існує бренд з такою назвою
        if ($brandModel->nameExists($name)) {
            $_SESSION['error'] = 'Бренд з такою назвою вже існує';
            $this->redirect('/admin/brands');
        }

        $result = $brandModel->create(['name' => $name]);

        if ($result) {
            $_SESSION['success'] = 'Бренд додано';
        } else {
            $_SESSION['error'] = 'Помилка при додаванні бренду';
        }

        $this->redirect('/admin/brands');
    }

    public function update($id = null)
    {
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
        $brandId = $_POST['brand_id'] ?? $id;
        $name = $this->clean($_POST['name'] ?? '');

        if (empty($name)) {
            $this->json(['success' => false, 'message' => 'Введіть назву бренду']);
            return;
        }

        if (empty($brandId)) {
            $this->json(['success' => false, 'message' => 'ID бренду не вказано']);
            return;
        }

        $brandModel = new Brand();
        $brand = $brandModel->find($brandId);

        if (!$brand) {
            $this->json(['success' => false, 'message' => 'Бренд не знайдено']);
            return;
        }

        // Перевіряємо чи існує бренд з такою назвою (крім поточного)
        if ($brandModel->nameExists($name, $brandId)) {
            $this->json(['success' => false, 'message' => 'Бренд з такою назвою вже існує']);
            return;
        }

        $result = $brandModel->update($brandId, ['name' => $name]);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Бренд успішно оновлено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при оновленні бренду']);
        }
    }

    public function delete($id = null)
    {
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
        $brandId = $_POST['brand_id'] ?? $id;

        if (empty($brandId)) {
            $this->json(['success' => false, 'message' => 'ID бренду не вказано']);
            return;
        }

        $brandModel = new Brand();
        $brand = $brandModel->find($brandId);

        if (!$brand) {
            $this->json(['success' => false, 'message' => 'Бренд не знайдено']);
            return;
        }

        // Перевіряємо чи є товари цього бренду
        $productModel = new Product();
        $productsCount = $productModel->count('brand_id = ?', [$brandId]);

        if ($productsCount > 0) {
            $this->json(['success' => false, 'message' => 'Неможливо видалити бренд, який містить товари (' . $productsCount . ' товарів)']);
            return;
        }

        $result = $brandModel->delete($brandId);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Бренд успішно видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні бренду']);
        }
    }
}
