<style>
    .products-container {
        padding: 2rem 0;
    }

    .filters-card {
        width: 100%;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin: 10px
    }

    .filters-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #dee2e6;
        border-radius: 0.5rem 0.5rem 0 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filters-header h5 {
        margin: 0;
        font-weight: 600;
        color: #2d3748;
    }

    .filters-body {
        padding: 1.5rem;
    }

    .filter-group {
        margin-bottom: 1rem;
    }

    .filter-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: #2d3748;
    }

    .form-control,
    .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        outline: none;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .price-range {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }

    .filter-buttons {
        display: grid;
        gap: 0.5rem;
    }

    .apply-filters-btn {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .apply-filters-btn:hover {
        background: #0b5ed7;
    }

    .clear-filters-btn {
        background: transparent;
        color: #6c757d;
        border: 1px solid #6c757d;
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .clear-filters-btn:hover {
        background: #6c757d;
        color: white;
    }

    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .products-title {
        font-size: 2rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .products-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .products-count {
        color: #718096;
        font-size: 0.95rem;
    }

    .sort-select {
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        min-width: 200px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .product-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .product-card:hover {
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        transform: translateY(-8px);
        border-color: #0d6efd;
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 1rem 1rem 0 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .product-image {
        width: 100%;
        height: 260px;
        object-fit: contain;
        padding: 1rem;
        transition: all 0.3s ease;
        background: white;
        border-radius: 0.5rem;
        margin: 0.5rem;
        mix-blend-mode: multiply;
        filter: brightness(1.1) contrast(1);
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    /* Градієнтний фон для карток */
    .product-image-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg,
                rgba(13, 110, 253, 0.05) 0%,
                rgba(220, 53, 69, 0.05) 100%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-image-container::before {
        opacity: 1;
    }

    /* Покращені бейджі */
    .product-badge {
        position: absolute;
        padding: 0.4rem 0.8rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 1rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .discount-badge {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        top: 0;
        right: 0;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .stock-badge {
        top: 0;
        left: 0;
    }

    .stock-badge.out {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
    }

    .stock-badge.low {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #000;
    }

    /* Покращений вигляд body картки */
    .product-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        background: linear-gradient(180deg, white 0%, #fafafa 100%);
    }

    .product-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #1a202c;
        line-height: 1.4;
        transition: color 0.2s ease;
    }

    .product-card:hover .product-title {
        color: #0d6efd;
    }

    .product-description {
        color: #718096;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        flex: 1;
        line-height: 1.5;
    }

    /* Покращений рейтинг */
    .product-rating {
        margin-bottom: 1rem;
        text-align: center;
        padding: 0.5rem;
        background: rgba(255, 193, 7, 0.1);
        border-radius: 0.5rem;
    }

    .rating-stars {
        color: #ffc107;
        margin-right: 0.5rem;
        font-size: 1.1rem;
        text-shadow: 0 1px 3px rgba(255, 193, 7, 0.3);
    }

    .rating-count {
        color: #6c757d;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Покращена ціна */
    .product-price {
        margin-bottom: 1.5rem;
        padding: 0.75rem;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 0.75rem;
        text-align: center;
    }

    .original-price {
        text-decoration: line-through;
        color: #6c757d;
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .current-price {
        font-weight: 800;
        color: #0d6efd;
        font-size: 1.4rem;
        text-shadow: 0 2px 4px rgba(13, 110, 253, 0.1);
    }

    /* Покращені кнопки */
    .product-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .product-btn {
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .view-btn {
        background: linear-gradient(135deg, transparent, rgba(13, 110, 253, 0.1));
        color: #0d6efd;
        border: 2px solid #0d6efd;
    }

    .view-btn:hover {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
    }

    .add-to-cart-btn {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(13, 110, 253, 0.4);
    }

    .out-of-stock-btn {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: none;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .pagination-container {
        margin-top: 2rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.25rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        list-style: none;
    }

    .page-link {
        padding: 0.5rem 0.75rem;
        color: #0d6efd;
        text-decoration: none;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }

    .page-link:hover {
        background: #e9ecef;
    }

    .page-item.active .page-link {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 0;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1.5rem;
    }

    .empty-state h4 {
        color: #2d3748;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #718096;
        margin-bottom: 2rem;
    }

    .empty-state-btn {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .empty-state-btn:hover {
        background: #0b5ed7;
        color: white;
    }

    @media (max-width: 768px) {
        .products-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .products-controls {
            flex-direction: column;
            gap: 0.5rem;
        }

        .sort-select {
            min-width: auto;
        }

        .price-range {
            grid-template-columns: 1fr;
        }

        .product-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container products-container">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="filters-card">
                <div class="filters-header">
                    <i class="fas fa-filter"></i>
                    <h5>Фільтри</h5>
                </div>
                <div class="filters-body">
                    <form method="GET" action="<?= url('products') ?>" id="filterForm">
                        <div class="filter-group">
                            <label for="search" class="filter-label">Пошук</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="<?= htmlspecialchars($search) ?>" placeholder="Назва товару...">
                        </div>

                        <div class="filter-group">
                            <label for="category" class="filter-label">Категорія</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Всі категорії</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= $selectedCategory == $category['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="brand" class="filter-label">Бренд</label>
                            <select class="form-select" id="brand" name="brand">
                                <option value="">Всі бренди</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= $brand['id'] ?>" <?= $selectedBrand == $brand['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($brand['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Ціна (₴)</label>
                            <div class="price-range">
                                <input type="number" class="form-control" name="min_price"
                                    placeholder="Від" value="<?= $minPrice ?: '' ?>" min="0">
                                <input type="number" class="form-control" name="max_price"
                                    placeholder="До" value="<?= $maxPrice ?: '' ?>" min="0">
                            </div>
                        </div>

                        <div class="filter-buttons">
                            <button type="submit" class="apply-filters-btn">
                                <i class="fas fa-search"></i>Застосувати
                            </button>
                            <a href="<?= url('products') ?>" class="clear-filters-btn">
                                <i class="fas fa-times"></i>Очистити
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="products-header">
                <h2 class="products-title">Каталог товарів</h2>
                <div class="products-controls">
                    <span class="products-count">Знайдено: <?= count($products) ?> товарів</span>
                    <select class="sort-select" id="sortSelect">
                        <option value="name_asc">За назвою (А-Я)</option>
                        <option value="name_desc">За назвою (Я-А)</option>
                        <option value="price_asc">За ціною (зростання)</option>
                        <option value="price_desc">За ціною (спадання)</option>
                        <option value="rating_desc">За рейтингом</option>
                    </select>
                </div>
            </div>

            <?php if (!empty($products)): ?>
                <div class="products-grid" id="productsGrid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="product-image-container">
                                <img src="<?= url($product['main_image'] ?? 'assets/images/no-image.jpg') ?>"
                                    class="product-image" alt="<?= htmlspecialchars($product['name']) ?>">

                                <?php if ($product['discount'] > 0): ?>
                                    <span class="product-badge discount-badge">-<?= $product['discount'] ?>%</span>
                                <?php endif; ?>

                                <?php if ($product['stock'] == 0): ?>
                                    <span class="product-badge stock-badge out">Немає в наявності</span>
                                <?php elseif ($product['stock'] < 5): ?>
                                    <span class="product-badge stock-badge low">Залишилось мало</span>
                                <?php endif; ?>
                            </div>

                            <div class="product-body">
                                <h5 class="product-title"><?= htmlspecialchars($product['name']) ?></h5>
                                <p class="product-description">
                                    <?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...
                                </p>

                                <?php if ($product['avg_rating']): ?>
                                    <div class="product-rating">
                                        <span class="rating-stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= round($product['avg_rating']) ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="rating-count">(<?= $product['reviews_count'] ?> відгуків)</span>
                                    </div>
                                <?php endif; ?>

                                <div class="product-price">
                                    <?php if ($product['discount'] > 0): ?>
                                        <?php $discountedPrice = $product['price'] * (1 - $product['discount'] / 100); ?>
                                        <span class="original-price"><?= number_format($product['price'], 2) ?> ₴</span>
                                        <span class="current-price"><?= number_format($discountedPrice, 2) ?> ₴</span>
                                    <?php else: ?>
                                        <span class="current-price"><?= number_format($product['price'], 2) ?> ₴</span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-actions">
                                    <a href="<?= url('product/' . $product['id']) ?>" class="product-btn view-btn">
                                        <i class="fas fa-eye"></i>Детальніше
                                    </a>
                                    <?php if ($product['stock'] > 0): ?>
                                        <button class="product-btn add-to-cart-btn" data-product-id="<?= $product['id'] ?>">
                                            <i class="fas fa-cart-plus"></i>До кошика
                                        </button>
                                    <?php else: ?>
                                        <button class="product-btn out-of-stock-btn" disabled>
                                            <i class="fas fa-times"></i>Немає в наявності
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Навігація по сторінках" class="pagination-container">
                        <ul class="pagination">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= url('products?page=' . ($currentPage - 1)) ?>">Попередня</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= url('products?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= url('products?page=' . ($currentPage + 1)) ?>">Наступна</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-search empty-state-icon"></i>
                    <h4>Товари не знайдені</h4>
                    <p>Спробуйте змінити параметри пошуку або фільтри</p>
                    <a href="<?= url('products') ?>" class="empty-state-btn">Переглянути всі товари</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    window.csrfToken = '<?= $csrf_token ?? '' ?>';

    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortValue = this.value;
        const [sortBy, sortOrder] = sortValue.split('_');

        const productsGrid = document.getElementById('productsGrid');
        const productCards = Array.from(productsGrid.children);

        productCards.sort((a, b) => {
            let aValue, bValue;

            switch (sortBy) {
                case 'name':
                    aValue = a.querySelector('.product-title').textContent.trim();
                    bValue = b.querySelector('.product-title').textContent.trim();
                    break;
                case 'price':
                    aValue = parseFloat(a.querySelector('.current-price').textContent.replace(/[^\d.]/g, ''));
                    bValue = parseFloat(b.querySelector('.current-price').textContent.replace(/[^\d.]/g, ''));
                    break;
                case 'rating':
                    const aStars = a.querySelectorAll('.fa-star:not(.fa-star-o)').length;
                    const bStars = b.querySelectorAll('.fa-star:not(.fa-star-o)').length;
                    aValue = aStars;
                    bValue = bStars;
                    break;
            }

            if (sortOrder === 'asc') {
                return aValue > bValue ? 1 : -1;
            } else {
                return aValue < bValue ? 1 : -1;
            }
        });

        productCards.forEach(card => productsGrid.appendChild(card));
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                addToCart(productId);
            });
        });
    });

    function addToCart(productId) {
        const button = document.querySelector(`[data-product-id="${productId}"]`);
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Додаємо...';
        button.disabled = true;

        fetch('<?= url("cart/add") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${productId}&quantity=1&csrf_token=${window.csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.innerHTML = '<i class="fas fa-check"></i>Додано!';
                    button.style.background = '#28a745';

                    updateCartCounter();

                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.style.background = '';
                        button.disabled = false;
                    }, 2000);

                    showNotification('success', 'Товар додано до кошика!');
                } else {
                    throw new Error(data.message || 'Помилка додавання товару');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.innerHTML = originalText;
                button.disabled = false;
                showNotification('error', 'Помилка: ' + error.message);
            });
    }

    function updateCartCounter() {
        const cartCounter = document.querySelector('.cart-counter');
        if (cartCounter) {
            fetch('<?= url("cart/count") ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.count !== undefined) {
                        cartCounter.textContent = data.count;
                        cartCounter.style.display = data.count > 0 ? 'inline' : 'none';
                    }
                });
        }
    }

    function showNotification(type, message) {
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(n => n.remove());

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        color: white;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;

        notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
        ${message}
        <button onclick="this.parentElement.remove()" style="background:none;border:none;color:white;margin-left:1rem;cursor:pointer;">&times;</button>
    `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        setTimeout(() => {
            if (notification.parentNode) {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }
</script>