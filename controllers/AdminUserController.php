<?php
// controllers/AdminUserController.php
class AdminUserController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }
    
    public function index() {
        $userModel = new User();
        
        $page = (int)($_GET['page'] ?? 1);
        $role = $_GET['role'] ?? '';
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        // Фільтрація за роллю
        if ($role) {
            $users = $userModel->query(
                "SELECT id, first_name, last_name, email, role, created_at 
                 FROM users 
                 WHERE role = ? 
                 ORDER BY created_at DESC 
                 LIMIT {$limit} OFFSET {$offset}",
                [$role]
            );
            $totalUsers = $userModel->count('role = ?', [$role]);
        } else {
            $users = $userModel->getAllUsers($limit, $offset);
            $totalUsers = $userModel->count();
        }
        
        $totalPages = ceil($totalUsers / $limit);
        
        $data = [
            'title' => 'Управління користувачами',
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'selectedRole' => $role,
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('admin/users/index', $data);
    }
    
    public function show($id) {
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
    
    public function updateRole($id) {
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
    
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/users');
        }
        
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->json(['success' => false, 'message' => 'Невірний токен безпеки']);
        }
        
        // Не дозволяємо видаляти самого себе
        if ($id == $_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Ви не можете видалити себе']);
        }
        
        $userModel = new User();
        $user = $userModel->find($id);
        
        if (!$user) {
            $this->json(['success' => false, 'message' => 'Користувача не знайдено']);
        }
        
        $result = $userModel->delete($id);
        
        if ($result) {
            $this->json(['success' => true, 'message' => 'Користувача видалено']);
        } else {
            $this->json(['success' => false, 'message' => 'Помилка при видаленні']);
        }
    }
}
?>