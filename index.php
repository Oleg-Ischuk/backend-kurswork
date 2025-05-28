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
    <html lang='uk'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>404 - Сторінка не знайдена</title>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                position: relative;
            }
            
            /* Анімовані частинки */
            .particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }
            
            .particle {
                position: absolute;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }
            
            .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-delay: 0s; }
            .particle:nth-child(2) { width: 120px; height: 120px; left: 70%; animation-delay: 1s; }
            .particle:nth-child(3) { width: 60px; height: 60px; left: 40%; animation-delay: 2s; }
            .particle:nth-child(4) { width: 100px; height: 100px; left: 90%; animation-delay: 3s; }
            .particle:nth-child(5) { width: 40px; height: 40px; left: 20%; animation-delay: 4s; }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(180deg); }
            }
            
            .error-container {
                text-align: center;
                color: white;
                z-index: 10;
                position: relative;
                max-width: 600px;
                padding: 2rem;
            }
            
            .error-code {
                font-size: 8rem;
                font-weight: 900;
                line-height: 1;
                margin-bottom: 1rem;
                background: linear-gradient(45deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3);
                background-size: 400% 400%;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: gradientShift 3s ease infinite;
                text-shadow: 0 0 50px rgba(255, 255, 255, 0.5);
            }
            
            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            
            .error-title {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }
            
            .error-subtitle {
                font-size: 1.2rem;
                margin-bottom: 2rem;
                opacity: 0.9;
                line-height: 1.6;
            }
            
            .error-icon {
                font-size: 4rem;
                margin-bottom: 2rem;
                animation: bounce 2s infinite;
            }
            
            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
                40% { transform: translateY(-10px); }
                60% { transform: translateY(-5px); }
            }
            
            .action-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 2rem;
            }
            
            .btn {
                padding: 1rem 2rem;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 1rem;
                border: 2px solid transparent;
            }
            
            .btn-primary {
                background: linear-gradient(45deg, #ff6b6b, #feca57);
                color: white;
                box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
            }
            
            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
            }
            
            .btn-secondary {
                background: transparent;
                color: white;
                border: 2px solid rgba(255, 255, 255, 0.5);
                backdrop-filter: blur(10px);
            }
            
            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.1);
                border-color: white;
                transform: translateY(-3px);
            }
            
            .suggestions {
                margin-top: 3rem;
                padding: 2rem;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .suggestions h3 {
                margin-bottom: 1rem;
                font-size: 1.3rem;
            }
            
            .suggestions ul {
                list-style: none;
                text-align: left;
            }
            
            .suggestions li {
                padding: 0.5rem 0;
                opacity: 0.9;
            }
            
            .suggestions li:before {
                content: '🔍 ';
                margin-right: 0.5rem;
            }
            
            @media (max-width: 768px) {
                .error-code { font-size: 5rem; }
                .error-title { font-size: 2rem; }
                .error-subtitle { font-size: 1rem; }
                .action-buttons { flex-direction: column; align-items: center; }
                .btn { width: 250px; justify-content: center; }
            }
        </style>
    </head>
    <body>
        <div class='particles'>
            <div class='particle'></div>
            <div class='particle'></div>
            <div class='particle'></div>
            <div class='particle'></div>
            <div class='particle'></div>
        </div>
        
        <div class='error-container'>
            <div class='error-icon'>
                <i class='fas fa-search'></i>
            </div>
            <div class='error-code'>404</div>
            <h1 class='error-title'>Упс! Сторінка не знайдена</h1>
            <p class='error-subtitle'>
                Схоже, ви заблукали в цифровому космосі. Сторінка, яку ви шукаєте, 
                можливо, була перенесена, видалена або ніколи не існувала.
            </p>
            
            <div class='action-buttons'>
                <a href='/backend-kurswork' class='btn btn-primary'>
                    <i class='fas fa-home'></i>
                    На головну
                </a>
                <a href='javascript:history.back()' class='btn btn-secondary'>
                    <i class='fas fa-arrow-left'></i>
                    Назад
                </a>
            </div>
            
            <div class='suggestions'>
                <h3>💡 Що можна спробувати:</h3>
                <ul>
                    <li>Перевірте правильність введеної адреси</li>
                    <li>Скористайтеся пошуком по сайту</li>
                    <li>Перейдіть до каталогу товарів</li>
                    <li>Зв'яжіться з нашою службою підтримки</li>
                </ul>
            </div>
        </div>
    </body>
    </html>";
            break;
    }
} catch (Exception $e) {
    // Обробка помилок
    http_response_code(500);
    echo "<!DOCTYPE html>
    <html lang='uk'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>500 - Помилка сервера</title>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                position: relative;
            }
            
            /* Анімовані хвилі помилок */
            .error-waves {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
                animation: errorPulse 4s ease-in-out infinite;
            }
            
            @keyframes errorPulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.8; transform: scale(1.05); }
            }
            
            .error-container {
                text-align: center;
                color: white;
                z-index: 10;
                position: relative;
                max-width: 700px;
                padding: 2rem;
            }
            
            .error-code {
                font-size: 8rem;
                font-weight: 900;
                line-height: 1;
                margin-bottom: 1rem;
                text-shadow: 0 0 30px rgba(255, 255, 255, 0.8);
                animation: glitch 2s infinite;
            }
            
            @keyframes glitch {
                0%, 90%, 100% { transform: translate(0); }
                20% { transform: translate(-2px, 2px); }
                40% { transform: translate(-2px, -2px); }
                60% { transform: translate(2px, 2px); }
                80% { transform: translate(2px, -2px); }
            }
            
            .error-title {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
            
            .error-subtitle {
                font-size: 1.2rem;
                margin-bottom: 2rem;
                opacity: 0.9;
                line-height: 1.6;
            }
            
            .error-icon {
                font-size: 4rem;
                margin-bottom: 2rem;
                animation: shake 1s infinite;
                color: #fff;
            }
            
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
            
            .action-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 2rem;
            }
            
            .btn {
                padding: 1rem 2rem;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 1rem;
                border: 2px solid transparent;
            }
            
            .btn-primary {
                background: linear-gradient(45deg, #f39c12, #e67e22);
                color: white;
                box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
            }
            
            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(243, 156, 18, 0.6);
            }
            
            .btn-secondary {
                background: transparent;
                color: white;
                border: 2px solid rgba(255, 255, 255, 0.5);
                backdrop-filter: blur(10px);
            }
            
            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.1);
                border-color: white;
                transform: translateY(-3px);
            }
            
            .loading-bar {
                width: 100%;
                height: 4px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 2px;
                margin: 2rem 0;
                overflow: hidden;
            }
            
            .loading-progress {
                height: 100%;
                background: linear-gradient(90deg, #f39c12, #e67e22);
                border-radius: 2px;
                animation: loading 3s ease-in-out infinite;
            }
            
            @keyframes loading {
                0% { width: 0%; }
                50% { width: 70%; }
                100% { width: 100%; }
            }
            
            @media (max-width: 768px) {
                .error-code { font-size: 5rem; }
                .error-title { font-size: 2rem; }
                .error-subtitle { font-size: 1rem; }
                .action-buttons { flex-direction: column; align-items: center; }
                .btn { width: 250px; justify-content: center; }
            }
        </style>
    </head>
    <body>
        <div class='error-waves'></div>
        
        <div class='error-container'>
            <div class='error-icon'>
                <i class='fas fa-exclamation-triangle'></i>
            </div>
            <div class='error-code'>500</div>
            <h1 class='error-title'>Внутрішня помилка сервера</h1>
            <p class='error-subtitle'>
                Вибачте! Щось пішло не так на нашому сервері. Наша команда розробників 
                вже отримала сповіщення і працює над виправленням проблеми.
            </p>
            
            <div class='loading-bar'>
                <div class='loading-progress'></div>
            </div>
            
            <div class='action-buttons'>
                <a href='/backend-kurswork' class='btn btn-primary'>
                    <i class='fas fa-home'></i>
                    На головну
                </a>
                <a href='javascript:location.reload()' class='btn btn-secondary'>
                    <i class='fas fa-redo'></i>
                    Оновити сторінку
                </a>
            </div>
        </div>
    </body>
    </html>";
}
