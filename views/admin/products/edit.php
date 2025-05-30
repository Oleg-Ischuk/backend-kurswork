<style>
    .edit-product-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .edit-product-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .edit-product-subtitle {
        opacity: 0.9;
        font-size: 1rem;
    }

    .form-section {
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .form-control,
    .form-select {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.75rem;
        transition: all 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    /* ✅ ПОКРАЩЕНІ СТИЛІ ДЛЯ ЗОБРАЖЕНЬ */
    .current-images {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .image-item {
        position: relative;
        border: 2px solid #e2e8f0;
        border-radius: 1rem;
        overflow: hidden;
        background: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .image-item:hover {
        border-color: #667eea;
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.2);
    }

    .image-item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .image-item:hover img {
        transform: scale(1.05);
    }

    .image-item .image-placeholder {
        width: 100%;
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        font-size: 2.5rem;
    }

    .image-actions {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        display: flex;
        gap: 0.5rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-item:hover .image-actions {
        opacity: 1;
    }

    .image-action-btn {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .image-action-btn.main {
        background: rgba(25, 135, 84, 0.9);
        color: white;
    }

    .image-action-btn.main:hover {
        background: #198754;
        transform: scale(1.2);
    }

    .image-action-btn.delete {
        background: rgba(220, 53, 69, 0.9);
        color: white;
    }

    .image-action-btn.delete:hover {
        background: #dc3545;
        transform: scale(1.2);
    }

    .main-badge {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        background: linear-gradient(135deg, #198754, #20c997);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(25, 135, 84, 0.3);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .new-image-section {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border: 2px dashed #dee2e6;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .new-image-section:hover {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
    }

    .form-control[type="file"] {
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .form-control[type="file"]:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

    .alert {
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    .alert-success {
        background-color: #d1e7dd;
        border: 1px solid #badbcc;
        color: #0f5132;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c2c7;
        color: #721c24;
    }

    @media (max-width: 768px) {
        .current-images {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem;
        }

        .image-item img,
        .image-item .image-placeholder {
            height: 120px;
        }

        .image-actions {
            opacity: 1;
            /* Завжди показувати на мобільних */
        }
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="edit-product-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="edit-product-title">
                    <i class="fas fa-edit me-2"></i>
                    Редагувати товар
                </div>
                <div class="edit-product-subtitle">
                    ID: <?= $product['id'] ?> | <?= htmlspecialchars($product['name']) ?>
                </div>
            </div>
            <a href="<?= url('admin/products') ?>" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i>Назад до списку
            </a>
        </div>
    </div>

    <!-- Alerts -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            <?= $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= url('admin/products/' . $product['id'] . '/update') ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

        <!-- Basic Information -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                Основна інформація
            </h3>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-box me-1"></i>Назва товару *
                    </label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">
                        <i class="fas fa-money-bill me-1"></i>Ціна *
                    </label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        value="<?= $product['price'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">
                    <i class="fas fa-align-left me-1"></i>Опис
                </label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
        </div>

        <!-- Categories and Stock -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-tags"></i>
                Категорія та склад
            </h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">
                        <i class="fas fa-tag me-1"></i>Категорія *
                    </label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">Оберіть категорію</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
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
                                <option value="<?= $brand['id'] ?>" <?= $product['brand_id'] == $brand['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($brand['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">
                        <i class="fas fa-warehouse me-1"></i>Кількість на складі *
                    </label>
                    <input type="number" class="form-control" id="stock" name="stock"
                        value="<?= $product['stock'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="discount" class="form-label">
                        <i class="fas fa-percentage me-1"></i>Знижка (%)
                    </label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount"
                        value="<?= $product['discount'] ?>" min="0" max="100">
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-images"></i>
                Зображення товару
            </h3>

            <?php if (!empty($images)): ?>
                <div class="current-images">
                    <?php foreach ($images as $image): ?>
                        <div class="image-item" data-image-id="<?= $image['id'] ?>">
                            <?php if (imageExists($image['image_url'])): ?>
                                <img src="<?= imageUrl($image['image_url']) ?>" alt="Product image">
                            <?php else: ?>
                                <div class="image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>

                            <div class="image-actions">
                                <?php if (!$image['is_main']): ?>
                                    <button type="button" class="image-action-btn main"
                                        onclick="setMainImage(<?= $image['id'] ?>)"
                                        title="Зробити головним">
                                        <i class="fas fa-star"></i>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="image-action-btn delete"
                                    onclick="deleteImage(<?= $image['id'] ?>)"
                                    title="Видалити">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <?php if ($image['is_main']): ?>
                                <div class="main-badge">
                                    <i class="fas fa-star me-1"></i>Головне
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="new-image-section">
                <label for="new_image" class="form-label">
                    <i class="fas fa-plus me-2"></i>Додати нове зображення
                </label>
                <input type="file" class="form-control" id="new_image" name="image" accept="image/*">
                <div class="form-text mt-2">
                    <i class="fas fa-info-circle me-1"></i>
                    Підтримувані формати: JPG, PNG, GIF, WebP. Максимальний розмір: 5MB
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-section">
            <div class="d-flex justify-content-between">
                <a href="<?= url('admin/products') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>Скасувати
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i>Зберегти зміни
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function setMainImage(imageId) {
        if (!confirm('Зробити це зображення головним?')) {
            return;
        }

        fetch('<?= url("admin/products/set-main-image") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `image_id=${imageId}&product_id=<?= $product['id'] ?>&csrf_token=<?= $csrf_token ?>`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Помилка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Помилка при встановленні головного зображення');
            });
    }

    function deleteImage(imageId) {
        if (!confirm('Ви впевнені, що хочете видалити це зображення?')) {
            return;
        }

        fetch('<?= url("admin/products/delete-image") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `image_id=${imageId}&csrf_token=<?= $csrf_token ?>`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`[data-image-id="${imageId}"]`).remove();
                } else {
                    alert('Помилка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Помилка при видаленні зображення');
            });
    }
</script>