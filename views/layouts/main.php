<style>
    /* Global Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #2d3748;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%) !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 0.75rem 2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .navbar .container-fluid {
        max-width: 100%;
        padding: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: white !important;
        display: flex;
        align-items: center;
        margin-left: 10px;
        gap: 0.5rem;
        padding: 0.5rem 0;
        flex-shrink: 0;
    }

    .navbar-collapse {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-grow: 1;
        margin-left: 2rem;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-nav.me-auto {
        justify-content: flex-start;
    }

    .navbar-nav .nav-item {
        margin: 0;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 10px;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        min-height: 44px;
        text-align: center;
        white-space: nowrap;
        font-size: 0.85rem;
        margin-right: 20px;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link:focus {
        color: white !important;
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-1px);
    }

    .navbar-nav .nav-link.active {
        color: white !important;
        background: rgba(255, 255, 255, 0.2);
    }

    .navbar-nav .nav-link i {
        font-size: 1rem;
        width: 16px;
        text-align: center;
    }

    /* Search Form */
    .search-form {
        display: flex;
        margin: 0 1rem;
        flex-shrink: 0;
    }

    .search-input-group {
        display: flex;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background: white;
        margin-left: 5px;
        margin-right: 5px;
    }

    .search-input {
        border: none;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        width: 250px;
        outline: none;
        background: transparent;
    }

    .search-input::placeholder {
        color: #6c757d;
    }

    .search-btn {
        background: #0d6efd;
        border: none;
        color: white;
        padding: 0.75rem 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-btn:hover {
        background: #0b5ed7;
    }

    /* Right Side Menu */
    .navbar-nav:last-child {
        flex-shrink: 0;
        justify-content: flex-end;
        gap: 0.25rem;
    }

    /* Cart Badge */
    .cart-link {
        position: relative;
        color: rgba(255, 255, 255, 0.9) !important;
        font-size: 1.1rem;
        padding: 0.75rem 1rem !important;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        min-width: 60px;
    }

    .cart-badge {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        min-width: 1.25rem;
        height: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    /* User Menu and Dropdown Fixes */
    .user-dropdown {
        position: relative;
    }

    .user-dropdown .nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        min-height: 44px;
        min-width: 120px;
    }

    /* Dropdown Menu Fixes */
    .dropdown-menu {
        position: absolute;
        z-index: 1050;
        min-width: 200px;
        max-width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: white;

        /* Вирівнювання по правому краю */
        right: 0 !important;
        left: auto !important;
        top: 100%;
        margin-top: 0.125rem;

        /* Запобігання виходу за межі екрану */
        transform: none;
    }

    .dropdown-menu .dropdown-item {
        padding: 0.75rem 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #2d3748;
        transition: all 0.2s ease;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    .dropdown-menu .dropdown-item i {
        width: 16px;
        text-align: center;
    }

    /* Анімація для dropdown */
    .dropdown-menu.show {
        display: block;
        animation: fadeIn 0.2s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Navbar Toggler */
    .navbar-toggler {
        margin-right: 5px;
        padding: 0.5rem;
        margin-left: 1rem;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Flash Messages */
    .flash-container {
        margin-top: 1rem;
        padding: 0 2rem;
    }

    .flash-alert {
        border-radius: 0.5rem;
        border: none;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .flash-alert.alert-success {
        background: #d1e7dd;
        color: #0f5132;
    }

    .flash-alert.alert-danger {
        background: #f8d7da;
        color: #842029;
    }

    .flash-alert.alert-info {
        background: #d1ecf1;
        color: #055160;
    }

    main {
        min-height: calc(100vh - 200px);
        padding-top: 0;
    }

    /* Footer */
    .footer {
        background: #2d3748;
        color: white;
        padding: 3rem 0 1rem;
        margin-top: 3rem;
    }

    .footer-brand {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-description {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .footer-social {
        display: flex;
        gap: 1rem;
    }

    .footer-social a {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.25rem;
        transition: color 0.2s;
    }

    .footer-social a:hover {
        color: white;
    }

    .footer-contact {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.8;
    }

    .footer-contact p {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-section-title {
        color: white;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 2rem;
        padding-top: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-copyright {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .navbar {
            padding: 0.75rem 1.5rem;
        }

        .search-input {
            width: 200px;
        }

        .navbar-nav .nav-link {
            padding: 0.75rem 1rem !important;
            min-width: 90px;
        }
    }

    @media (max-width: 992px) {
        .navbar {
            padding: 0.75rem 1rem;
        }

        /* Колапс меню стає активним */
        .navbar-collapse {
            margin-left: 0;
            margin-top: 1rem;
            width: 100%;
        }

        .navbar-collapse.show {
            display: block !important;
        }

        .navbar-collapse:not(.show) {
            display: none !important;
        }

        .navbar .container-fluid {
            flex-wrap: wrap;
        }

        .navbar-brand {
            flex-grow: 1;
        }

        /* ГОЛОВНА та ТОВАРИ в одному рядку */
        .navbar-nav.me-auto {
            flex-direction: row !important;
            width: 100%;
            justify-content: space-around;
            margin-bottom: 1rem;
            gap: 1rem;
        }

        .navbar-nav.me-auto .nav-item {
            flex: 1;
            max-width: 180px;
        }

        .navbar-nav.me-auto .nav-link {
            padding: 0.75rem 1rem !important;
            border-radius: 0.375rem;
            width: 100%;
            justify-content: center;
            text-align: center;
            min-width: auto;
            font-size: 0.95rem;
        }

        /* ПОШУК на окремому рівні */
        .search-form {
            width: 100%;
            margin: 1rem 0;
            justify-content: center;
            order: 2;
        }

        .search-input-group {
            width: 100%;
            max-width: 500px;
        }

        .search-input {
            width: 100%;
            flex: 1;
        }

        /* КОШИК, УВІЙТИ, РЕЄСТРАЦІЯ в одному рядку */
        .navbar-nav:last-child {
            justify-content: space-around;
            flex-direction: row !important;
            width: 100%;
            gap: 1rem;
            order: 3;
        }

        .navbar-nav:last-child .nav-item {
            flex: 1;
            max-width: 150px;
        }

        .cart-link,
        .navbar-nav:last-child .nav-link {
            min-width: auto;
            width: 100%;
            justify-content: center;
            padding: 0.75rem 1rem !important;
            font-size: 0.95rem;
        }

        .user-dropdown .nav-link {
            min-width: auto;
            width: 100%;
            justify-content: center;
        }

        /* Dropdown меню для планшетів */
        .dropdown-menu {
            position: absolute !important;
            right: 0 !important;
            left: auto !important;
            transform: none !important;
            width: auto;
            min-width: 200px;
            max-width: 280px;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }

    /* ПОКРАЩЕНА ПЛАНШЕТНА ТА МОБІЛЬНА АДАПТАЦІЯ */
    @media (max-width: 768px) {
        .navbar {
            padding: 0.75rem 1rem;
        }

        /* Колапс меню стає активним */
        .navbar-collapse {
            margin-left: 0;
            margin-top: 1rem;
            width: 100%;
        }

        .navbar-collapse.show {
            display: block !important;
        }

        .navbar-collapse:not(.show) {
            display: none !important;
        }

        .navbar .container-fluid {
            flex-wrap: wrap;
        }

        .navbar-brand {
            flex-grow: 1;
        }

        /* ГОЛОВНА та ТОВАРИ в одному рядку */
        .navbar-nav.me-auto {
            flex-direction: row !important;
            width: 100%;
            justify-content: space-around;
            margin-bottom: 1rem;
            gap: 1rem;
        }

        .navbar-nav.me-auto .nav-item {
            flex: 1;
            max-width: 150px;
        }

        .navbar-nav.me-auto .nav-link {
            padding: 0.75rem 0.5rem !important;
            border-radius: 0.375rem;
            width: 100%;
            justify-content: center;
            text-align: center;
            min-width: auto;
            font-size: 0.9rem;
        }

        /* ПОШУК на окремому рівні */
        .search-form {
            width: 100%;
            margin: 1rem 0;
            justify-content: center;
            order: 2;
        }

        .search-input-group {
            width: 100%;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            flex: 1;
        }

        /* КОШИК, УВІЙТИ, РЕЄСТРАЦІЯ в одному рядку */
        .navbar-nav:last-child {
            justify-content: space-around;
            flex-direction: row !important;
            width: 100%;
            gap: 1rem;
            order: 3;
        }

        .navbar-nav:last-child .nav-item {
            flex: 1;
            max-width: 120px;
        }

        .cart-link,
        .navbar-nav:last-child .nav-link {
            min-width: auto;
            width: 100%;
            justify-content: center;
            padding: 0.75rem 0.5rem !important;
            font-size: 0.9rem;
        }

        .user-dropdown .nav-link {
            min-width: auto;
            width: 100%;
            justify-content: center;
        }

        /* Dropdown меню для мобільних */
        .dropdown-menu {
            position: fixed !important;
            right: 10px !important;
            left: auto !important;
            top: auto !important;
            transform: none !important;
            width: calc(100vw - 20px);
            max-width: 280px;
            margin-top: 0.5rem;
            z-index: 1060;
        }
    }

    @media (max-width: 576px) {
        .navbar-nav:last-child {
            justify-content: center;
            flex-direction: column !important;
            width: 100%;
            gap: 0.5rem;
            order: 3;
        }

        .navbar-nav:last-child .nav-item {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .navbar-nav:last-child .nav-link {
            font-size: 0.85rem;
            padding: 0.6rem 0.8rem !important;
            width: 100%;
            justify-content: center;
        }

        /* Dropdown для дуже маленьких екранів */
        .dropdown-menu {
            position: fixed !important;
            right: 10px !important;
            left: 10px !important;
            top: auto !important;
            transform: none !important;
            width: calc(100vw - 20px);
            max-width: none;
            margin-top: 0.5rem;
            z-index: 1060;
        }
    }

    /* Додаткові стилі для забезпечення правильної роботи Bootstrap collapse */
    .navbar-collapse.collapse:not(.show) {
        display: none;
    }

    .navbar-collapse.collapsing {
        height: 0;
        overflow: hidden;
        transition: height 0.35s ease;
    }

    .navbar-collapse.collapse.show {
        display: block;
    }

    /* Виправлення для dropdown-toggle стрілки */
    .navbar-nav .dropdown-toggle::after {
        margin-left: 0.5rem;
        vertical-align: middle;
    }

    /* Забезпечення що dropdown не перекриває інші елементи */
    .dropdown-menu[data-bs-popper] {
        right: 0;
        left: auto;
    }
</style>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) . ' - ' : '' ?>SportStore</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Animate.css for animations -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <meta name="description" content="<?= isset($description) ? htmlspecialchars($description) : 'Найкращі спортивні товари для активного життя' ?>">
    <meta name="keywords" content="спорт, товари, магазин, спортивне обладнання">

</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= url() ?>">
                <i class="fas fa-dumbbell"></i>SportStore
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url() ?>">
                            <i class="fas fa-home"></i>Головна
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('products') ?>">
                            <i class="fas fa-shopping-bag"></i>Товари
                        </a>
                    </li>
                </ul>

                <!-- Search -->
                <form class="search-form" method="GET" action="<?= url('products') ?>">
                    <div class="search-input-group">
                        <input class="search-input" type="search" name="search" placeholder="Пошук товарів..."
                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button class="search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- User Menu -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link cart-link" href="<?= url('cart') ?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge" id="cartCount">
                                <?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?>
                            </span>
                        </a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown user-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i><?= htmlspecialchars($_SESSION['user_name'] ?? 'Користувач') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= url('orders') ?>"><i class="fas fa-box me-2"></i>Мої замовлення</a></li>
                                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= url('admin') ?>"><i class="fas fa-cog me-2"></i>Адмін панель</a></li>
                                <?php endif; ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Вийти</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('login') ?>">
                                <i class="fas fa-sign-in-alt"></i>Увійти
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('register') ?>">
                                <i class="fas fa-user-plus"></i>Реєстрація
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-container">
            <div class="flash-alert alert-<?= $_SESSION['flash_type'] ?? 'info' ?> alert-dismissible fade show" role="alert">
                <i class="fas fa-<?= $_SESSION['flash_type'] === 'success' ? 'check-circle' : ($_SESSION['flash_type'] === 'error' ? 'exclamation-circle' : 'info-circle') ?>"></i>
                <?= htmlspecialchars($_SESSION['flash_message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
    endif;
    ?>

    <!-- Main Content -->
    <main>
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-brand">
                        <i class="fas fa-dumbbell"></i>SportStore
                    </h5>
                    <p class="footer-description">
                        Найкращі спортивні товари для активного життя.
                        Якість, надійність та доступні ціни.
                    </p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-telegram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <h6 class="footer-section-title">Контакти</h6>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i>м. Житомир, вул. Спортивна, 123</p>
                        <p><i class="fas fa-phone"></i>+38 (044) 123-45-67</p>
                        <p><i class="fas fa-envelope"></i>info@sportstore.ua</p>
                        <p><i class="fas fa-clock"></i>Пн-Пт: 9:00-18:00, Сб-Нд: 10:00-16:00</p>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; <?= date('Y') ?> SportStore. Всі права захищені.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?= asset('assets/js/main.js') ?>"></script>

    <!-- Dropdown Position Fix Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Функція для автоматичного позиціонування dropdown
            function adjustDropdownPosition() {
                const dropdownElements = document.querySelectorAll('[data-bs-toggle="dropdown"]');

                dropdownElements.forEach(function(element) {
                    element.addEventListener('shown.bs.dropdown', function() {
                        const menu = this.nextElementSibling;
                        if (menu && menu.classList.contains('dropdown-menu')) {
                            adjustSingleDropdown(menu, this);
                        }
                    });
                });
            }

            function adjustSingleDropdown(menu, toggle) {
                const rect = toggle.getBoundingClientRect();
                const menuRect = menu.getBoundingClientRect();
                const viewportWidth = window.innerWidth;
                const viewportHeight = window.innerHeight;

                // Перевірка для мобільних пристроїв
                if (window.innerWidth <= 768) {
                    // На мобільних пристроях позиціонуємо dropdown по центру або по правому краю
                    if (viewportWidth < 400) {
                        menu.style.left = '10px';
                        menu.style.right = '10px';
                        menu.style.width = 'calc(100vw - 20px)';
                    } else {
                        menu.style.right = '10px';
                        menu.style.left = 'auto';
                        menu.style.width = 'auto';
                        menu.style.maxWidth = '280px';
                    }
                    return;
                }

                // Для десктопних версій
                if (rect.right + menuRect.width > viewportWidth) {
                    menu.style.right = '0';
                    menu.style.left = 'auto';
                } else {
                    menu.style.left = '0';
                    menu.style.right = 'auto';
                }

                // Перевірка чи виходить dropdown за нижню межу екрану
                if (rect.bottom + menuRect.height > viewportHeight) {
                    menu.style.top = 'auto';
                    menu.style.bottom = '100%';
                    menu.style.marginBottom = '0.125rem';
                    menu.style.marginTop = '0';
                } else {
                    menu.style.top = '100%';
                    menu.style.bottom = 'auto';
                    menu.style.marginTop = '0.125rem';
                    menu.style.marginBottom = '0';
                }
            }

            // Ініціалізація
            adjustDropdownPosition();

            // Переналаштування при зміні розміру вікна
            window.addEventListener('resize', function() {
                setTimeout(adjustDropdownPosition, 100);
            });

            // Переналаштування при зміні орієнтації на мобільних пристроях
            window.addEventListener('orientationchange', function() {
                setTimeout(adjustDropdownPosition, 200);
            });
        });
    </script>

    <!-- Initialize CSRF token for AJAX -->
    <script>
        if (typeof SportStore !== 'undefined') {
            SportStore.csrfToken = '<?= $_SESSION['csrf_token'] ?? '' ?>';
        }
    </script>
</body>

</html>