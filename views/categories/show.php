<style>
.category-container {
    padding: 2rem 0;
}

.category-header {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    color: white;
    padding: 2.5rem;
    border-radius: 0.5rem;
    margin-bottom: 2rem;
}

.category-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.category-description {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    opacity: 0.9;
}

.category-count {
    opacity: 0.75;
    font-size: 0.95rem;
}

.filters-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
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

.filters-body {
    padding: 1.5rem;
}

.filter-group {
    margin-bottom: 1.5rem;
}

.filter-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
    color: #2d3748;
}

.form-control, .form-select {
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-control:focus, .form-select:focus {
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

.subcategories-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-top: 1.5rem;
}

.subcategories-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.subcategory-list {
    padding: 0;
    margin: 0;
}

.subcategory-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 1.5rem;
    color: #2d3748;
    text-decoration: none;
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.2s;
}

.subcategory-item:hover {
    background: #f8f9fa;
    color: #0d6efd;
}

.subcategory-item:last-child {
    border-bottom: none;
}

.subcategory-count {
    background: #0d6efd;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 1rem;
    font-size: 0.75rem;
}

.products-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.products-title {
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
    border-radius: 0.5rem;
    overflow: hidden;
    transition: all 0.2s;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.product-image-container {
    position: relative;
    overflow: hidden;
}

.product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.2s;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 500;
    margin: 0.5rem;
}

.discount-badge {
    background: #dc3545;
    color: white;
    top: 0;
    right: 0;
}

.stock-badge {
    top: 0;
    left: 0;
}

.stock-badge.out {
    background: #6c757d;
    color: white;
}

.stock-badge.low {
    background: #ffc107;
    color: #000;
}

.product-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2d3748;
}

.product-description {
    color: #718096;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    flex: 1;
}

.product-brand {
    color: #718096;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.product-rating {
    margin-bottom: 1rem;
}

.rating-stars {
    color: #ffc107;
    margin-right: 0.5rem;
}

.rating-count {
    color: #718096;
    font-size: 0.875rem;
}

.product-price {
    margin-bottom: 1rem;
}

.original-price {
    text-decoration: line-through;
    color: #718096;
    margin-right: 0.5rem;
}

.current-price {
    font-weight: 600;
    color: #0d6efd;
    font-size: 1.25rem;
}

.product-actions {
    display: grid;
    gap: 0.5rem;
}

.product-btn {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.view-btn {
    background: transparent;
    color: #0d6efd;
    border: 1px solid #0d6efd;
}

.view-btn:hover {
    background: #0d6efd;
    color: white;
}

.add-to-cart-btn {
    background: #0d6efd;
    color: white;
    border: none;
}

.add-to-cart-btn:hover {
    background: #0b5ed7;
}

.out-of-stock-btn {
    background: #6c757d;
    color: white;
    border: none;
    cursor: not-allowed;
}

.pagination-container {
    margin-top: 2rem;
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 0.25rem;
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
}
</style>

<div class="container category-container">

    <!-- Category Header -->
    <div class="category-header">
        <h1 class="category-title"><?= htmlspecialchars($category['name']) ?></h1>
        <?php if ($category['description']): ?>
        <p class="category-description"><?= htmlspecialchars($category['description']) ?></p>
        <?php endif; ?>
        <div class="category-count"><?= count($products) ?> товарів у категорії</div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="filters-card">
                <div class="filters-header">
                    <i class="fas fa-filter"></i>
                    <h5>Фільтри</h5>
                </div>
                <div class="filters-body">
                    <form method="GET" action="<?= url('category/' . $category['id']) ?>" id="filterForm">
                        <!-- Search -->
                        <div class="filter-group">
                            <label for="search" class="filter-label">Пошук</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="<?= htmlspecialchars($search) ?>" placeholder="Назва товару...">
                        </div>

                        <!-- Brand Filter -->
                        <?php if (!empty($brands)): ?>
                        <div class="filter-group">
                            <label for="brand" class="filter-label">Бренд</label>
                            <select class="form-select" id="brand" name="brand">
                                <option value="">Всі бренди</option>
                                <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand['id'] ?>" <?= $selectedBrand == $brand['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($brand['name']) ?> (<?= $brand['product_count'] ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>

                        <!-- Price Range -->
                        <div class="filter-group">
                            <label class="filter-label">Ціна (₴)</label>
                            <div class="price-range">
                                <input type="number" class="form-control" name="min_price" 
                                       placeholder="Від" value="<?= $minPrice ?: '' ?>" min="0">
                                <input type="number" class="form-control" name="max_price" 
                                       placeholder="До" value="<?= $maxPrice ?: '' ?>" min="0">
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div class="filter-group">
                            <label class="filter-label">Мінімальний рейтинг</label>
                            <select class="form-select" name="min_rating">
                                <option value="">Будь-який</option>
                                <option value="4" <?= $minRating == 4 ? 'selected' : '' ?>>4+ зірки</option>
                                <option value="3" <?= $minRating == 3 ? 'selected' : '' ?>>3+ зірки</option>
                                <option value="2" <?= $minRating == 2 ? 'selected' : '' ?>>2+ зірки</option>
                            </select>
                        </div>

                        <div class="filter-buttons">
                            <button type="submit" class="apply-filters-btn">
                                <i class="fas fa-search"></i>Застосувати
                            </button>
                            <a href="<?= url('category/' . $category['id']) ?>" class="clear-filters-btn">
                                <i class="fas fa-times"></i>Очистити
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Subcategories -->
            <?php if (!empty($subcategories)): ?>
            <div class="subcategories-card">
                <div class="subcategories-header">
                    <i class="fas fa-list"></i>
                    <h5>Підкategorії</h5>
                </div>
                <div class="subcategory-list">
                    <?php foreach ($subcategories as $subcategory): ?>
                    <a href="<?= url('category/' . $subcategory['id']) ?>" class="subcategory-item">
                        <?= htmlspecialchars($subcategory['name']) ?>
                        <span class="subcategory-count"><?= $subcategory['product_count'] ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Products -->
        <div class="col-lg-9">
            <!-- Header -->
            <div class="products-header">
                <h3 class="products-title">Товари</h3>
                <div class="products-controls">
                    <span class="products-count">Знайдено: <?= count($products) ?> товарів</span>
                    <select class="sort-select" id="sortSelect">
                        <option value="name_asc">За назвою (А-Я)</option>
                        <option value="name_desc">За назвою (Я-А)</option>
                        <option value="price_asc">За ціною (зростання)</option>
                        <option value="price_desc">За ціною (спадання)</option>
                        <option value="rating_desc">За рейтингом</option>
                        <option value="newest">Спочатку нові</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
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
                        
                        <!-- Brand -->
                        <div class="product-brand">Бренд: <?= htmlspecialchars($product['brand_name']) ?></div>
                        
                        <!-- Rating -->
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
                        
                        <!-- Price -->
                        <div class="product-price">
                            <?php if ($product['discount'] > 0): ?>
                                <?php $discountedPrice = $product['price'] * (1 - $product['discount'] / 100); ?>
                                <span class="original-price"><?= number_format($product['price'], 2) ?> ₴</span>
                                <span class="current-price"><?= number_format($discountedPrice, 2) ?> ₴</span>
                            <?php else: ?>
                                <span class="current-price"><?= number_format($product['price'], 2) ?> ₴</span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Actions -->
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

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <nav aria-label="Навігація по сторінках" class="pagination-container">
                <ul class="pagination">
                    <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= url('category/' . $category['id'] . '?page=' . ($currentPage - 1)) ?>">Попередня</a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="<?= url('category/' . $category['id'] . '?page=' . $i) ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= url('category/' . $category['id'] . '?page=' . ($currentPage + 1)) ?>">Наступна</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>

            <?php else: ?>
            <!-- No products found -->
            <div class="empty-state">
                <i class="fas fa-search empty-state-icon"></i>
                <h4>Товари не знайдені</h4>
                <p>У цій категорії поки немає товарів або вони не відповідають вашим фільтрам</p>
                <a href="<?= url('category/' . $category['id']) ?>" class="empty-state-btn">Очистити фільтри</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// CSRF token for AJAX requests
window.csrfToken = '<?= $csrf_token ?? '' ?>';

// Sort functionality
document.getElementById('sortSelect').addEventListener('change', function() {
    const sortValue = this.value;
    const [sortBy, sortOrder] = sortValue.split('_');
    
    // Get current products
    const productsGrid = document.getElementById('productsGrid');
    const productCards = Array.from(productsGrid.children);
    
    // Sort products
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
            case 'newest':
                // For newest, we would need data attributes with dates
                return 0; // Keep original order for now
        }
        
        if (sortOrder === 'asc') {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });
    
    // Re-append sorted elements
    productCards.forEach(card => productsGrid.appendChild(card));
});
</script>