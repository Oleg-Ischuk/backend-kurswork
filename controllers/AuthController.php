<?php
// controllers/AuthController.php
class AuthController extends Controller {
    
    public function loginForm() {
        // Якщо користувач вже авторизований, перенаправляємо
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }
        
        $data = [
            'title' => 'Вхід до системи',
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('auth/login', $data);
    }
    
    public function login() {
        // Перевірка CSRF токену
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/login');
        }
        
        $email = $this->clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Валідація
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Заповніть всі поля';
            $_SESSION['old_email'] = $email;
            $this->redirect('/login');
        }
        
        $userModel = new User();
        $user = $userModel->checkLogin($email, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['success'] = 'Ласкаво просимо, ' . $user['first_name'] . '!';
            
            // Перенаправляємо адміна в адмін панель
            if ($user['role'] === 'admin') {
                $this->redirect('/admin');
            } else {
                $this->redirect('/');
            }
        } else {
            $_SESSION['error'] = 'Невірний email або пароль';
            $_SESSION['old_email'] = $email;
            $this->redirect('/login');
        }
    }
    
    public function registerForm() {
        // Якщо користувач вже авторизований, перенаправляємо
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }
        
        $data = [
            'title' => 'Реєстрація',
            'csrf_token' => $this->generateCsrfToken()
        ];
        
        $this->view('auth/register', $data);
    }
    
    public function register() {
        // Перевірка CSRF токену
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['error'] = 'Невірний токен безпеки';
            $this->redirect('/register');
        }
        
        $firstName = $this->clean($_POST['first_name'] ?? '');
        $lastName = $this->clean($_POST['last_name'] ?? '');
        $email = $this->clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Зберігаємо старі дані для форми
        $_SESSION['old_first_name'] = $firstName;
        $_SESSION['old_last_name'] = $lastName;
        $_SESSION['old_email'] = $email;
        
        // Валідація
        $errors = [];
        
        if (empty($firstName)) $errors[] = 'Введіть ім\'я';
        if (empty($lastName)) $errors[] = 'Введіть прізвище';
        if (empty($email)) $errors[] = 'Введіть email';
        if (!$this->isValidEmail($email)) $errors[] = 'Невірний формат email';
        if (empty($password)) $errors[] = 'Введіть пароль';
        if (strlen($password) < 6) $errors[] = 'Пароль повинен містити мінімум 6 символів';
        if ($password !== $confirmPassword) $errors[] = 'Паролі не співпадають';
        
        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $this->redirect('/register');
        }
        
        $userModel = new User();
        
        // Перевіряємо чи існує email
        if ($userModel->emailExists($email)) {
            $_SESSION['error'] = 'Користувач з таким email вже існує';
            $this->redirect('/register');
        }
        
        // Створюємо користувача
        $userData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password
        ];
        
        $userId = $userModel->createUser($userData);
        
        if ($userId) {
            // Очищаємо старі дані
            unset($_SESSION['old_first_name'], $_SESSION['old_last_name'], $_SESSION['old_email']);
            
            // Автоматично авторизуємо користувача
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_role'] = 'user';
            $_SESSION['user_name'] = $firstName . ' ' . $lastName;
            $_SESSION['success'] = 'Реєстрація успішна! Ласкаво просимо, ' . $firstName . '!';
            $this->redirect('/');
        } else {
            $_SESSION['error'] = 'Помилка при реєстрації. Спробуйте ще раз.';
            $this->redirect('/register');
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/');
    }
}
?>