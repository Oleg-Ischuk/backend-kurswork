<?php
// index.php - Головний файл з роутингом
session_start();

// Підключення до БД
require_once 'config/database.php';

// Підключення допоміжних функцій
require_once 'config/helpers.php';

// Автозавантажувач класів
spl_autoload_register(function ($class) {
    $paths = [
        'core/',
        'models/',
        'controllers/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});

// Отримуємо поточний шлях
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Видаляємо назву папки проекту з шляху
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = dirname($scriptName);
if ($basePath !== '/' && strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

// Якщо шлях порожний, встановлюємо головну сторінку
if (empty($path) || $path === '/') {
    $path = '/';
}

// Роутинг
try {
    switch (true) {
        // Головна сторінка
        case $path === '/':
            $controller = new HomeController();
            $controller->index();
            break;

        // Авторизація
        case $path === '/login':
            $controller = new AuthController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->login();
            } else {
                $controller->loginForm();
            }
            break;

        case $path === '/register':
            $controller = new AuthController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->register();
            } else {
                $controller->registerForm();
            }
            break;

        case $path === '/logout':
            $controller = new AuthController();
            $controller->logout();
            break;

        // Товари
        case $path === '/products':
            $controller = new ProductController();
            $controller->index();
            break;

        case preg_match('/^\/product\/(\d+)$/', $path, $matches):
            $controller = new ProductController();
            $controller->show($matches[1]);
            break;

        // Категорії
        case preg_match('/^\/category\/(\d+)$/', $path, $matches):
            $controller = new CategoryController();
            $controller->show($matches[1]);
            break;

        // Кошик
        case $path === '/cart':
            $controller = new CartController();
            $controller->show();
            break;

        case $path === '/cart/add':
            $controller = new CartController();
            $controller->add();
            break;

        case $path === '/cart/update':
            $controller = new CartController();
            $controller->update();
            break;

        case $path === '/cart/remove':
            $controller = new CartController();
            $controller->remove();
            break;

        // Замовлення
        case $path === '/orders':
            $controller = new OrderController();
            $controller->index();
            break;

        case $path === '/checkout':
            $controller = new OrderController();
            $controller->create();
            break;

        // Скасування замовлення
        case $path === '/order/cancel':
            $controller = new OrderController();
            $controller->cancel();
            break;

        // Видалення одного замовлення
        case $path === '/order/delete':
            $controller = new OrderController();
            $controller->delete();
            break;

        // Очищення завершених замовлень
        case $path === '/orders/clear-completed':
            $controller = new OrderController();
            $controller->clearCompleted();
            break;

        case preg_match('/^\/order\/(\d+)$/', $path, $matches):
            $controller = new OrderController();
            $controller->show($matches[1]);
            break;

        // Відгуки
        case $path === '/review/add':
            $controller = new ReviewController();
            $controller->add();
            break;

        case $path === '/review/update':
            $controller = new ReviewController();
            $controller->update();
            break;

        case $path === '/review/delete':
            $controller = new ReviewController();
            $controller->delete();
            break;

        // Адмін панель
        case $path === '/admin':
            $controller = new AdminController();
            $controller->dashboard();
            break;

        // Адмін - товари
        case $path === '/admin/products':
            $controller = new AdminProductController();
            $controller->index();
            break;

        case $path === '/admin/products/create':
            $controller = new AdminProductController();
            $controller->create();
            break;

        case $path === '/admin/products/store':
            $controller = new AdminProductController();
            $controller->store();
            break;

        // Маршрут для видалення товарів
        case $path === '/admin/products/delete' && $_SERVER['REQUEST_METHOD'] === 'POST':
            $controller = new AdminProductController();
            $controller->delete();
            break;

        case preg_match('/^\/admin\/products\/(\d+)\/edit$/', $path, $matches):
            $controller = new AdminProductController();
            $controller->edit($matches[1]);
            break;

        case preg_match('/^\/admin\/products\/(\d+)\/update$/', $path, $matches):
            $controller = new AdminProductController();
            $controller->update($matches[1]);
            break;

        // Адмін - категорії
        case $path === '/admin/categories':
            $controller = new AdminCategoryController();
            $controller->index();
            break;

        case $path === '/admin/categories/store':
            $controller = new AdminCategoryController();
            $controller->store();
            break;

        // Оновлення категорії
        case $path === '/admin/categories/update' && $_SERVER['REQUEST_METHOD'] === 'POST':
            $controller = new AdminCategoryController();
            $controller->update(null);
            break;

        // Видалення категорії
        case $path === '/admin/categories/delete' && $_SERVER['REQUEST_METHOD'] === 'POST':
            $controller = new AdminCategoryController();
            $controller->delete(null);
            break;

        // Адмін - замовлення
        case $path === '/admin/orders':
            $controller = new AdminOrderController();
            $controller->index();
            break;

        case preg_match('/^\/admin\/orders\/(\d+)$/', $path, $matches):
            $controller = new AdminOrderController();
            $controller->show($matches[1]);
            break;

        case $path === '/admin/orders/update-status':
            $controller = new AdminOrderController();
            $controller->updateStatus();
            break;

        case $path === '/admin/orders/delete':
            $controller = new AdminOrderController();
            $controller->delete();
            break;

        // Адмін - користувачі
        case $path === '/admin/users':
            $controller = new AdminUserController();
            $controller->index();
            break;

        // Створення користувача
        case $path === '/admin/users/store' && $_SERVER['REQUEST_METHOD'] === 'POST':
            $controller = new AdminUserController();
            $controller->store();
            break;

        // Оновлення користувача
        case $path === '/admin/users/update' && $_SERVER['REQUEST_METHOD'] === 'POST':
            $controller = new AdminUserController();
            $controller->update();
            break;

        // Видалення користувача
        case $path === '/admin/users/delete' && $_SERVER['REQUEST_METHOD'] === 'POST':
            $controller = new AdminUserController();
            $controller->delete();
            break;

        // Перегляд конкретного користувача
        case preg_match('/^\/admin\/users\/(\d+)$/', $path, $matches):
            $controller = new AdminUserController();
            $controller->show($matches[1]);
            break;

        // Зміна ролі користувача (для сумісності)
        case preg_match('/^\/admin\/users\/(\d+)\/role$/', $path, $matches):
            $controller = new AdminUserController();
            $controller->updateRole($matches[1]);
            break;

        // API маршрути
        case $path === '/api/search':
            $controller = new ApiController();
            $controller->search();
            break;

        case $path === '/api/filter':
            $controller = new ApiController();
            $controller->filter();
            break;

        case preg_match('/^\/api\/product\/(\d+)$/', $path, $matches):
            $controller = new ApiController();
            $controller->getProduct($matches[1]);
            break;

        case $path === '/api/cart':
            $controller = new ApiController();
            $controller->getCartInfo();
            break;

        case $path === '/api/stats':
            $controller = new ApiController();
            $controller->getStats();
            break;

        // 404 - Сторінка не знайдена
        default:
            http_response_code(404);
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Сторінка не знайдена</title>
                <meta charset='utf-8'>
                <style>
                    body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                    h1 { color: #e74c3c; }
                </style>
            </head>
            <body>
                <h1>404 - Сторінка не знайдена</h1>
                <p>Вибачте, запитувана сторінка не існує.</p>
                <a href='/backend-kurswork'>Повернутися на головну</a>
            </body>
            </html>";
            break;
    }
} catch (Exception $e) {
    // Обробка помилок
    http_response_code(500);
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Помилка сервера</title>
        <meta charset='utf-8'>
        <style>
            body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
            h1 { color: #e74c3c; }
        </style>
    </head>
    <body>
        <h1>500 - Внутрішня помилка сервера</h1>
        <p>Вибачте, сталася помилка. Спробуйте пізніше.</p>
        <a href='/backend-kurswork'>Повернутися на головну</a>
    </body>
    </html>";
}
