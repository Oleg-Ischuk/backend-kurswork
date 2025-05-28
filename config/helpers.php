<?php
// config/helpers.php - Глобальні допоміжні функції

if (!function_exists('url')) {
    function url($path = '')
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);
        $baseUrl = $protocol . '://' . $host . ($basePath === '/' ? '' : $basePath);
        return $baseUrl . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    function asset($path)
    {
        return url($path);
    }
}

// ✅ НОВА ФУНКЦІЯ ДЛЯ ПРАВИЛЬНОГО ВІДОБРАЖЕННЯ ЗОБРАЖЕНЬ
if (!function_exists('imageUrl')) {
    function imageUrl($imagePath = '')
    {
        if (empty($imagePath)) {
            return url('assets/images/no-image.jpg'); // fallback зображення
        }

        // Якщо це повний URL (http/https), повертаємо як є
        if (strpos($imagePath, 'http') === 0) {
            return $imagePath;
        }

        // Якщо шлях починається з /, повертаємо як є
        if (strpos($imagePath, '/') === 0) {
            return $imagePath;
        }

        // Для зображень з uploads/ - формуємо правильний URL
        return url($imagePath);
    }
}

// ✅ ФУНКЦІЯ ДЛЯ ПЕРЕВІРКИ ІСНУВАННЯ ЗОБРАЖЕННЯ
if (!function_exists('imageExists')) {
    function imageExists($imagePath)
    {
        if (empty($imagePath)) {
            return false;
        }

        // Повний шлях до файлу на сервері
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($imagePath, '/');
        return file_exists($fullPath);
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('old')) {
    function old($key, $default = '')
    {
        return $_SESSION['old'][$key] ?? $default;
    }
}

if (!function_exists('session_flash')) {
    function session_flash($key, $default = null)
    {
        $value = $_SESSION[$key] ?? $default;
        unset($_SESSION[$key]);
        return $value;
    }
}
