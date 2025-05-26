<?php
// core/Controller.php
class Controller {
    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    protected function view($template, $data = []) {
        // Extract data to variables
        extract($data);
        
        // Get categories for navigation (global data)
        if (!isset($categories)) {
            $categoryModel = new Category();
            $categories = $categoryModel->getAll();
        }
        
        // Generate CSRF token
        if (!isset($csrf_token)) {
            $csrf_token = $this->generateCsrfToken();
        }
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        require_once "views/{$template}.php";
        
        // Get the content
        $content = ob_get_clean();
        
        // Include the layout
        require_once 'views/layouts/main.php';
    }
    
    protected function viewAdmin($template, $data = []) {
        // For admin views without layout
        extract($data);
        
        // Generate CSRF token
        if (!isset($csrf_token)) {
            $csrf_token = $this->generateCsrfToken();
        }
        
        // Start output buffering
        ob_start();
        
        // Include the admin view file
        require_once "admin/{$template}.php";
        
        // Get the content
        $content = ob_get_clean();
        
        // Include admin layout if exists, otherwise just output content
        if (file_exists('admin/layout.php')) {
            require_once 'admin/layout.php';
        } else {
            echo $content;
        }
    }
    
    protected function json($data) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    protected function redirect($url) {
        $baseUrl = $this->getBaseUrl();
        header("Location: " . $baseUrl . $url);
        exit;
    }
    
    protected function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);
        return $protocol . '://' . $host . ($basePath === '/' ? '' : $basePath);
    }
    
    protected function url($path = '') {
        return $this->getBaseUrl() . '/' . ltrim($path, '/');
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }
    
    protected function requireAdmin() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            echo "Доступ заборонено";
            exit;
        }
    }
    
    protected function clean($data) {
        if (is_array($data)) {
            return array_map([$this, 'clean'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    protected function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    protected function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    protected function validateCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    protected function uploadImage($file, $directory = 'products') {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }
        
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        if ($file['size'] > $maxSize) {
            return false;
        }
        
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedTypes)) {
            return false;
        }
        
        $filename = uniqid() . '.' . $extension;
        $uploadPath = "uploads/{$directory}/";
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        $fullPath = $uploadPath . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            return $fullPath;
        }
        
        return false;
    }
}
?>