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
        display: flex;
        justify-content: center;
        align-items: center;
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
        gap: 0.5rem;
        padding: 0.5rem 0;
        flex-shrink: 0;
        margin-left: 10px;
    }

    .navbar-collapse {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-left: 10px;
        margin-right: 10px;
    }

    .navbar-nav.me-auto {
        justify-content: center;
        max-width: none;
    }

    .navbar-nav .nav-item {
        margin: 0;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 0.75rem 1.25rem !important;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        min-height: 44px;
        text-align: center;
        white-space: nowrap;
        font-size: 0.95rem;
        min-width: 100px;
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

    /* User Menu */
    .user-dropdown .nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        min-height: 44px;
        min-width: 120px;
    }

    /* Navbar Toggler */
    .navbar-toggler {
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.5rem;
        margin-left: auto;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
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
        /* Прибрано зайві відступи */
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

        .search-input {
            width: 180px;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.9rem;
            min-width: 80px;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }

    @media (max-width: 768px) {
        .navbar {
            padding: 0.5rem 1rem;
            flex-direction: column;
        }

        .navbar .container-fluid {
            flex-direction: column;
            width: 100%;
        }

        .navbar-brand {
            margin-bottom: 1rem;
        }

        .navbar-collapse {
            width: 100%;
            justify-content: center;
        }

        .search-form {
            margin: 1rem 0;
            width: 100%;
            justify-content: center;
        }

        .search-input {
            width: 250px;
        }

        .navbar-nav {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
        }

        .navbar-nav.me-auto {
            margin-bottom: 1rem;
        }

        .navbar-nav .nav-item {
            width: 100%;
        }

        .navbar-nav .nav-link {
            padding: 0.75rem 1rem !important;
            border-radius: 0.375rem;
            margin: 0.125rem 0;
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .navbar {
            padding: 0.5rem;
        }

        .navbar-brand {
            font-size: 1.25rem;
        }

        .search-input {
            width: 200px;
        }

        .navbar-nav .nav-link {
            font-size: 0.9rem;
        }
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i><?= htmlspecialchars($_SESSION['user_name'] ?? 'Користувач') ?>
                            </a>
                            <ul class="dropdown-menu">
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

    <!-- Initialize CSRF token for AJAX -->
    <script>
        if (typeof SportStore !== 'undefined') {
            SportStore.csrfToken = '<?= $_SESSION['csrf_token'] ?? '' ?>';
        }
    </script>
</body>

</html>