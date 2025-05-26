<style>
.create-product-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.back-btn {
    background: transparent;
    border: 1px solid #6c757d;
    color: #6c757d;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.back-btn:hover {
    background-color: #6c757d;
    color: white;
}

.form-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
}

.form-card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 1rem 1.5rem;
    border-radius: 0.375rem 0.375rem 0 0;
}

.form-card-header h5 {
    margin: 0;
    font-weight: 600;
}

.form-card-body {
    padding: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control, .form-select {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    font-size: 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.image-preview-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.image-preview-card {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    overflow: hidden;
}

.image-preview-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.image-preview-body {
    padding: 0.5rem;
    text-align: center;
    background-color: #f8f9fa;
}

.attribute-row {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 0.5rem;
    align-items: center;
    margin-bottom: 0.5rem;
}

.add-attribute-btn {
    background-color: transparent;
    border: 1px solid #0d6efd;
    color: #0d6efd;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
    cursor: pointer;
}

.remove-attribute-btn {
    background-color: transparent;
    border: 1px solid #dc3545;
    color: #dc3545;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
    cursor: pointer;
}

.pricing-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-bottom: 1.5rem;
}

.discounted-price {
    font-weight: 600;
    color: #0d6efd;
    font-size: 1.1rem;
}

.form-switch {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.form-switch input[type="checkbox"] {
    width: 3rem;
    height: 1.5rem;
    background-color: #6c757d;
    border-radius: 1rem;
    position: relative;
    appearance: none;
    cursor: pointer;
}

.form-switch input[type="checkbox"]:checked {
    background-color: #198754;
}

.form-switch input[type="checkbox"]::before {
    content: '';
    position: absolute;
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 50%;
    background-color: white;
    top: 0.125rem;
    left: 0.125rem;
    transition: transform 0.2s;
}

.form-switch input[type="checkbox"]:checked::before {
    transform: translateX(1.5rem);
}

.action-buttons {
    display: grid;
    gap: 0.5rem;
}

.btn-primary {
    background-color: #198754;
    border-color: #198754;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    font-weight: 500;
}

.btn-secondary {
    background-color: transparent;
    border: 1px solid #6c757d;
    color: #6c757d;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    cursor: pointer;
    font-weight: 500;
}

.btn-primary:hover {
    background-color: #157347;
}

.btn-secondary:hover {
    background-color: #6c757d;
    color: white;
}
</style>

<div class="container-fluid py-4">
    <div class="create-product-header">
        <h2><i class="fas fa-plus me-2"></i>Додати товар</h2>
        <a href="<?= url('admin/products') ?>" class="back-btn">
            <i class="fas fa-arrow-left"></i>Назад до списку
        </a>
    </div>

    <form method="POST" action="<?= url('admin/products/store') ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        
        <div class="row">
            <!-- Main Info -->
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5>Основна інформація</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Назва товару *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Введіть назву товару</div>
                            </div>
                            <div class="form-group">
                                <label for="sku" class="form-label">Артикул</label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="Автоматично">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Опис *</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                            <div class="invalid-feedback">Введіть опис товару</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="category_id" class="form-label">Категорія *</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Оберіть категорію</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Оберіть категорію</div>
                            </div>
                            <div class="form-group">
                                <label for="brand_id" class="form-label">Бренд *</label>
                                <select class="form-select" id="brand_id" name="brand_id" required>
                                    <option value="">Оберіть бренд</option>
                                    <?php foreach ($brands as $brand): ?>
                                    <option value="<?= $brand['id'] ?>"><?= htmlspecialchars($brand['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Оберіть бренд</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="form-card">
                    <div class="form-card-header">
                        <h5>Зображення</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group">
                            <label for="images" class="form-label">Завантажити зображення</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            <div class="form-text">Можна завантажити декілька зображень. Перше буде головним.</div>
                        </div>
                        
                        <div id="imagePreview" class="image-preview-container"></div>
                    </div>
                </div>

                <!-- Attributes -->
                <div class="form-card">
                    <div class="form-card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <h5>Характеристики</h5>
                        <button type="button" class="add-attribute-btn" onclick="addAttribute()">
                            <i class="fas fa-plus me-1"></i>Додати
                        </button>
                    </div>
                    <div class="form-card-body">
                        <div id="attributesContainer">
                            <div class="attribute-row">
                                <input type="text" class="form-control" name="attribute_names[]" placeholder="Назва характеристики">
                                <input type="text" class="form-control" name="attribute_values[]" placeholder="Значення">
                                <button type="button" class="remove-attribute-btn" onclick="removeAttribute(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Pricing -->
                <div class="pricing-card">
                    <div class="form-card-header">
                        <h5>Ціна та знижки</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group">
                            <label for="price" class="form-label">Ціна (₴) *</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                            <div class="invalid-feedback">Введіть ціну товару</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="discount" class="form-label">Знижка (%)</label>
                            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" value="0">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Ціна зі знижкою</label>
                            <div class="discounted-price" id="discountedPrice">0.00 ₴</div>
                        </div>
                    </div>
                </div>

                <!-- Inventory -->
                <div class="pricing-card">
                    <div class="form-card-header">
                        <h5>Склад</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group">
                            <label for="stock" class="form-label">Кількість на складі *</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                            <div class="invalid-feedback">Введіть кількість товару</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="min_stock" class="form-label">Мінімальний запас</label>
                            <input type="number" class="form-control" id="min_stock" name="min_stock" min="0" value="5">
                            <div class="form-text">Сповіщення при досягненні цього рівня</div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="pricing-card">
                    <div class="form-card-header">
                        <h5>Статус</h5>
                    </div>
                    <div class="form-card-body">
                        <div class="form-switch">
                            <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label for="is_active">Активний товар</label>
                        </div>
                        
                        <div class="form-switch">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1">
                            <label for="is_featured">Рекомендований товар</label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pricing-card">
                    <div class="form-card-body">
                        <div class="action-buttons">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save me-2"></i>Зберегти товар
                            </button>
                            <button type="button" class="btn-secondary" onclick="saveDraft()">
                                <i class="fas fa-file-alt me-2"></i>Зберегти як чернетку
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Calculate discounted price
function updateDiscountedPrice() {
    const price = parseFloat(document.getElementById('price').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const discountedPrice = price * (1 - discount / 100);
    document.getElementById('discountedPrice').textContent = discountedPrice.toFixed(2) + ' ₴';
}

document.getElementById('price').addEventListener('input', updateDiscountedPrice);
document.getElementById('discount').addEventListener('input', updateDiscountedPrice);

// Image preview
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    Array.from(e.target.files).forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.innerHTML = `
                    <div class="image-preview-card">
                        <img src="${e.target.result}" class="image-preview-img">
                        <div class="image-preview-body">
                            <small class="text-muted">${index === 0 ? 'Головне зображення' : 'Додаткове зображення'}</small>
                        </div>
                    </div>
                `;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Attributes management
function addAttribute() {
    const container = document.getElementById('attributesContainer');
    const row = document.createElement('div');
    row.className = 'attribute-row';
    row.innerHTML = `
        <input type="text" class="form-control" name="attribute_names[]" placeholder="Назва характеристики">
        <input type="text" class="form-control" name="attribute_values[]" placeholder="Значення">
        <button type="button" class="remove-attribute-btn" onclick="removeAttribute(this)">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(row);
}

function removeAttribute(button) {
    button.closest('.attribute-row').remove();
}

// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        const forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function saveDraft() {
    const form = document.querySelector('form');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'save_as_draft';
    input.value = '1';
    form.appendChild(input);
    form.submit();
}
</script>