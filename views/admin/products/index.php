<style>
    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .add-product-btn {
        background-color: #198754;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .add-product-btn:hover {
        background-color: #157347;
        transform: translateY(-1px);
    }

    .filters-card {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        margin-bottom: 1.5rem;
    }

    .filter-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 2fr;
        gap: 1rem;
        align-items: end;
        padding: 1rem;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .products-table {
        background: white;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        overflow: hidden;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* ✅ ПОКРАЩЕНІ СТИЛІ ДЛЯ ЗОБРАЖЕНЬ */
    .product-image {
        width: 150px;
        height: 150px;
        border-radius: 0.5rem;
        object-fit: contain;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        mix-blend-mode: multiply;
        filter: brightness(1.1) contrast(1);
    }

    .product-image:hover {
        transform: scale(1.1);
        border-color: #667eea;
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
    }

    .product-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 0.5rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 2px solid #e2e8f0;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .product-placeholder:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
    }

    .product-details {
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #2d3748;
    }

    .product-id {
        color: #6c757d;
        font-size: 0.875rem;
    }

    /* ✅ ВИПРАВЛЕНЕ ВІДОБРАЖЕННЯ ЦІН */
    .price-info {
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .price-current {
        font-weight: 600;
        color: #198754;
        font-size: 1.1rem;
    }

    .price-old {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .discount-badge {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        margin-top: 0.25rem;
        display: inline-block;
        width: fit-content;
    }

    .stock-info {
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .stock-count {
        font-weight: 600;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .stock-high {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .stock-medium {
        background-color: #fff3cd;
        color: #664d03;
    }

    .stock-low {
        background-color: #f8d7da;
        color: #721c24;
    }

    .category-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: #e7f3ff;
        color: #0066cc;
    }

    .brand-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: #f0f0f0;
        color: #333;
    }

    .action-buttons {
        display: flex;
        gap: 0.375rem;
        justify-content: center;
    }

    .action-btn {
        padding: 0.375rem 0.75rem;
        border: 1px solid;
        border-radius: 0.375rem;
        background: transparent;
        cursor: pointer;
        font-size: 0.875rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .action-btn.view {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .action-btn.view:hover {
        background-color: #0d6efd;
        color: white;
    }

    .action-btn.edit {
        border-color: #fd7e14;
        color: #fd7e14;
    }

    .action-btn.edit:hover {
        background-color: #fd7e14;
        color: white;
    }

    .action-btn.delete {
        border-color: #dc3545;
        color: #dc3545;
    }

    .action-btn.delete:hover {
        background-color: #dc3545;
        color: white;
    }

    .pagination-container {
        margin-top: 1.5rem;
    }

    .pagination {
        justify-content: center;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 0;
    }

    .empty-state i {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .modal-form .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .modal-form .form-control,
    .modal-form .form-select {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.75rem;
        transition: all 0.2s;
    }

    .modal-form .form-control:focus,
    .modal-form .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        padding: 1rem;
        border-radius: 0.5rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .notification.success {
        background-color: #198754;
    }

    .notification.error {
        background-color: #dc3545;
    }

    .notification .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0;
        margin-left: 1rem;
    }

    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
        padding: 1rem 0.75rem;
    }

    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    .btn-outline-primary {
        border: 2px solid #667eea;
        color: #667eea;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-outline-primary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .filter-form {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
</style>

<div class="container-fluid py-4">
    <div class="products-header">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= url('admin') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i>Назад до панелі
            </a>
            <h2><i class="fas fa-box me-2"></i>Управління товарами</h2>
        </div>
        <button class="add-product-btn" data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="fas fa-plus"></i>Додати товар
        </button>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <div class="card-body">
            <form method="GET" action="<?= url('admin/products') ?>" class="filter-form">
                <div>
                    <label for="search" class="form-label">Пошук</label>
                    <input type="text" class="form-control" id="search" name="search"
                        value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Назва товару">
                </div>
                <div>
                    <label for="category" class="form-label">Категорія</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Всі категорії</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= ($selectedCategory ?? '') == $category['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label for="brand" class="form-label">Бренд</label>
                    <select class="form-select" id="brand" name="brand">
                        <option value="">Всі бренди</option>
                        <?php if (!empty($brands)): ?>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand['id'] ?>" <?= ($selectedBrand ?? '') == $brand['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($brand['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Фільтрувати
                    </button>
                    <a href="<?= url('admin/products') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Очистити
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table -->
    <div class="products-table">
        <div class="card-body">
            <?php if (!empty($products)): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Товар</th>
                                <th>Ціна</th>
                                <th>Склад</th>
                                <th>Категорія</th>
                                <th>Бренд</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr id="product-row-<?= $product['id'] ?>">
                                    <td><strong><?= $product['id'] ?></strong></td>
                                    <td>
                                        <div class="product-info">
                                            <?php if (!empty($product['main_image'])): ?>
                                                <img src="<?= imageUrl($product['main_image']) ?>"
                                                    alt="<?= htmlspecialchars($product['name']) ?>"
                                                    class="product-image">
                                            <?php else: ?>
                                                <div class="product-placeholder">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-details">
                                                <div class="product-name"><?= htmlspecialchars($product['name']) ?></div>
                                                <div class="product-id">ID: <?= $product['id'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- ✅ ВИПРАВЛЕНЕ ВІДОБРАЖЕННЯ ЦІН ЗІ ЗНИЖКОЮ -->
                                        <div class="price-info">
                                            <?php if ($product['discount'] > 0): ?>
                                                <?php $discountedPrice = $product['price'] * (1 - $product['discount'] / 100); ?>
                                                <div class="price-old"><?= number_format($product['price'], 2) ?> ₴</div>
                                                <div class="price-current"><?= number_format($discountedPrice, 2) ?> ₴</div>
                                                <div class="discount-badge">-<?= $product['discount'] ?>%</div>
                                            <?php else: ?>
                                                <div class="price-current"><?= number_format($product['price'], 2) ?> ₴</div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="stock-info">
                                            <?php
                                            $stock = $product['stock'] ?? 0;
                                            $stockClass = $stock > 20 ? 'stock-high' : ($stock > 5 ? 'stock-medium' : 'stock-low');
                                            ?>
                                            <span class="stock-count <?= $stockClass ?>">
                                                <?= $stock ?> шт.
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="category-badge">
                                            <i class="fas fa-tag me-1"></i>
                                            <?= htmlspecialchars($product['category_name'] ?? 'Без категорії') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="brand-badge">
                                            <i class="fas fa-copyright me-1"></i>
                                            <?= htmlspecialchars($product['brand_name'] ?? 'Без бренду') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" onclick="viewProduct(<?= $product['id'] ?>)" title="Переглянути">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="action-btn edit" onclick="editProduct(<?= $product['id'] ?>)" title="Редагувати">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="action-btn delete" onclick="deleteProduct(<?= $product['id'] ?>)" title="Видалити">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Навігація по сторінках" class="pagination-container">
                        <ul class="pagination">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= url('admin/products?page=' . ($currentPage - 1)) ?>">Попередня</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= url('admin/products?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= url('admin/products?page=' . ($currentPage + 1)) ?>">Наступна</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h4>Товари не знайдені</h4>
                    <p class="text-muted">Поки що немає доданих товарів</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>
                    Додати товар
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('admin/products/store') ?>" class="modal-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-box me-1"></i>Назва товару *
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-money-bill me-1"></i>Ціна *
                            </label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i>Опис
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">
                                <i class="fas fa-tag me-1"></i>Категорія *
                            </label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Оберіть категорію</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand_id" class="form-label">
                                <i class="fas fa-copyright me-1"></i>Бренд
                            </label>
                            <select class="form-select" id="brand_id" name="brand_id">
                                <option value="">Оберіть бренд</option>
                                <?php if (!empty($brands)): ?>
                                    <?php foreach ($brands as $brand): ?>
                                        <option value="<?= $brand['id'] ?>">
                                            <?= htmlspecialchars($brand['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="stock" class="form-label">
                                <i class="fas fa-warehouse me-1"></i>Кількість на складі *
                            </label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="discount" class="form-label">
                                <i class="fas fa-percentage me-1"></i>Знижка (%)
                            </label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="discount" name="discount" placeholder="0-100">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-image me-1"></i>Зображення товару
                            </label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Скасувати
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Створити товар
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // CSRF token for requests
    window.csrfToken = '<?= $csrf_token ?? '' ?>';

    function viewProduct(productId) {
        window.open('<?= url("product/") ?>' + productId, '_blank');
    }

    function editProduct(productId) {
        window.location.href = '<?= url("admin/products/") ?>' + productId + '/edit';
    }

    function deleteProduct(productId) {
        if (!confirm('Ви впевнені, що хочете видалити цей товар? Цю дію неможливо скасувати.')) {
            return;
        }

        const button = document.querySelector(`button[onclick="deleteProduct(${productId})"]`);
        const originalText = button.innerHTML;

        // Показуємо індикатор завантаження
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;

        fetch('<?= url("admin/products/delete") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${productId}&csrf_token=${window.csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Видаляємо рядок з таблиці
                    const row = document.getElementById(`product-row-${productId}`);
                    if (row) {
                        row.style.transition = 'opacity 0.3s';
                        row.style.opacity = '0';
                        setTimeout(() => {
                            row.remove();
                        }, 300);
                    }

                    showNotification('success', 'Товар успішно видалено!');
                } else {
                    throw new Error(data.message || 'Помилка видалення товару');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.innerHTML = originalText;
                button.disabled = false;
                showNotification('error', 'Помилка: ' + error.message);
            });
    }

    function showNotification(type, message) {
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(n => n.remove());

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
        <span><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}</span>
        <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
    `;

        document.body.appendChild(notification);

        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
</script>