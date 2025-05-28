<?php
// controllers/AdminUserController.php
class AdminUserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index()
    {
        $userModel = new User();

        $page = (int)($_GET['page'] ?? 1);
        $role = $_GET['role'] ?? '';
        $search = $_GET['search'] ?? '';
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Пошук та фільтрація
        $whereConditions = [];
        $params = [];

        if ($role) {
            $whereConditions[] = "role = ?";
            $params[] = $role;
        }

        if ($search) {
            $whereConditions[] = "(first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $searchParam = "%{$search}%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        $whereClause = '';
        if (!empty($whereConditions)) {
            $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
        }

        $sql = "SELECT id, first_name, last_name, email, role, created_at 
                FROM users 
                {$whereClause}
                ORDER BY id ASC
                LIMIT {$limit} OFFSET {$offset}";

        $users = $userModel->query($sql, $params);

        // Підрахунок загальної кількості
        $countSql = "SELECT COUNT(*) as count FROM users {$whereClause}";
        $countResult = $userModel->query($countSql, $params);
        $totalUsers = $countResult[0]['count'];

        $totalPages = ceil($totalUsers / $limit);

        $data = [
            'title' => 'Управління користувачами',
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'selectedRole' => $role,
            'search' => $search,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/users/index', $data);
    }

    public function show($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            $_SESSION['error'] = 'Користувача не знайдено';
            $this->redirect('/admin/users');
        }

        // Отримуємо замовлення користувача
        $orders = $userModel->getUserOrders($id);

        $data = [
            'title' => 'Користувач: ' . $user['first_name'] . ' ' . $user['last_name'],
            'user' => $user,
            'orders' => $orders,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('admin/users/show', $data);
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ СТВОРЕННЯ КОРИСТУВАЧА
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/users');
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/users');
        }

        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'role' => $_POST['role'] ?? 'user'
        ];

        // Валідація
        $errors = [];

        if (empty($data['first_name'])) {
            $errors[] = 'Поле "Ім\'я" обов\'язкове';
        }

        if (empty($data['last_name'])) {
            $errors[] = 'Поле "Прізвище" обов\'язкове';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Введіть коректну email адресу';
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            $errors[] = 'Пароль повинен містити мінімум 6 символів';
        }

        if (!in_array($data['role'], ['user', 'admin'])) {
            $errors[] = 'Невірна роль';
        }

        $userModel = new User();

        // Перевірка на існування email
        if ($userModel->emailExists($data['email'])) {
            $errors[] = 'Користувач з таким email вже існує';
        }

        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $this->redirect('/admin/users');
        }

        $result = $userModel->createUser($data);

        if ($result) {
            $_SESSION['success'] = 'Користувача успішно створено';
        } else {
            $_SESSION['error'] = 'Помилка при створенні користувача';
        }

        $this->redirect('/admin/users');
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД ДЛЯ ОНОВЛЕННЯ КОРИСТУВАЧА
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Неправильний метод запиту']);
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }

        $userId = (int)($_POST['user_id'] ?? 0);

        if (!$userId) {
            $this->json(['success' => false, 'message' => 'Невірний ID користувача']);
        }

        $userModel = new User();
        $user = $userModel->find($userId);

        if (!$user) {
            $this->json(['success' => false, 'message' => 'Користувача не знайдено']);
        }

        // Не дозволяємо змінювати свої дані
        if ($userId == $_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Ви не можете редагувати свій профіль через адмін панель']);
        }

        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'role' => $_POST['role'] ?? 'user'
        ];

        // Додаємо пароль тільки якщо він вказаний
        if (!empty($_POST['password'])) {
            if (strlen($_POST['password']) < 6) {
                $this->json(['success' => false, 'message' => 'Пароль повинен містити мінімум 6 символів']);
            }
            $data['password'] = $_POST['password'];
        }

        // Валідація
        $errors = [];

        if (empty($data['first_name'])) {
            $errors[] = 'Поле "Ім\'я" обов\'язкове';
        }

        if (empty($data['last_name'])) {
            $errors[] = 'Поле "Прізвище" обов\'язкове';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Введіть коректну email адресу';
        }

        if (!in_array($data['role'], ['user', 'admin'])) {
            $errors[] = 'Невірна роль';
        }

        // Перевірка на існування email (крім поточного користувача)
        $existingUser = $userModel->findWhere('email', $data['email']);
        if ($existingUser && $existingUser['id'] != $userId) {
            $errors[] = 'Користувач з таким email вже існує';
        }

        if (!empty($errors)) {
            $this->json(['success' => false, 'message' => implode('<br>', $errors)]);
        }

        $result = $userModel->updateProfile($userId, $data);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Користувача успішно оновлено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при оновленні користувача']);
        }
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД ДЛЯ ВИДАЛЕННЯ КОРИСТУВАЧА
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Неправильний метод запиту']);
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }

        $userId = (int)($_POST['user_id'] ?? 0);

        if (!$userId) {
            $this->json(['success' => false, 'message' => 'Невірний ID користувача']);
        }

        // Не дозволяємо видаляти самого себе
        if ($userId == $_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Ви не можете видалити себе']);
        }

        $userModel = new User();
        $user = $userModel->find($userId);

        if (!$user) {
            $this->json(['success' => false, 'message' => 'Користувача не знайдено']);
        }

        $result = $userModel->delete($userId);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Користувача успішно видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні користувача']);
        }
    }

    // ✅ ЗАЛИШАЄМО СТАРИЙ МЕТОД ДЛЯ ЗМІНИ РОЛІ (для сумісності)
    public function updateRole($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/users');
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/admin/users/' . $id);
        }

        $role = $_POST['role'] ?? '';

        if (!in_array($role, ['user', 'admin'])) {
            $_SESSION['error'] = 'Невірна роль';
            $this->redirect('/admin/users/' . $id);
        }

        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            $_SESSION['error'] = 'Користувача не знайдено';
            $this->redirect('/admin/users');
        }

        // Не дозволяємо змінювати роль самому собі
        if ($id == $_SESSION['user_id']) {
            $_SESSION['error'] = 'Ви не можете змінити свою роль';
            $this->redirect('/admin/users/' . $id);
        }

        $result = $userModel->update($id, ['role' => $role]);

        if ($result) {
            $_SESSION['success'] = 'Роль користувача оновлено';
        } else {
            $_SESSION['error'] = 'Помилка при оновленні ролі';
        }

        $this->redirect('/admin/users/' . $id);
    }
}
