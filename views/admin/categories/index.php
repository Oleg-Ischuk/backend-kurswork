<style>
.categories-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.add-category-btn {
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

.add-category-btn:hover {
    background-color: #157347;
    transform: translateY(-1px);
}

.categories-table {
    background: white;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    overflow: hidden;
}

.category-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.category-icon {
    width: 40px;
    height: 40px;
    border-radius: 0.375rem;
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.category-details {
    flex: 1;
}

.category-name {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.category-id {
    color: #6c757d;
    font-size: 0.875rem;
}

.action-buttons {
    display: flex;
    gap: 0.375rem;
    justify-content: left;
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
</style>

<div class="container-fluid py-4">
    <div class="categories-header">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= url('admin') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i>Назад до панелі
            </a>
            <h2><i class="fas fa-tags me-2"></i>Управління категоріями</h2>
        </div>
        <button class="add-category-btn" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="fas fa-plus"></i>Додати категорію
        </button>
    </div>

    <!-- Categories Table -->
    <div class="categories-table">
        <div class="card-body">
            <?php if (!empty($categories)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва категорії</th>
                            <th>Дата створення</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><strong><?= $category['id'] ?></strong></td>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div class="category-details">
                                        <div class="category-name"><?= htmlspecialchars($category['name']) ?></div>
                                        <div class="category-id">ID: <?= $category['id'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="fas fa-calendar me-1"></i>
                                    <?= date('d.m.Y H:i', strtotime($category['created_at'])) ?>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" onclick="viewCategory(<?= $category['id'] ?>)" title="Переглянути">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" onclick="editCategory(<?= $category['id'] ?>)" title="Редагувати">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" onclick="deleteCategory(<?= $category['id'] ?>)" title="Видалити">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-tags"></i>
                <h4>Категорії не знайдені</h4>
                <p class="text-muted">Поки що немає створених категорій</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>
                    Додати категорію
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('admin/categories/store') ?>" class="modal-form">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-tag me-1"></i>Назва категорії *
                        </label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">
                            <i class="fas fa-sitemap me-1"></i>Батьківська категорія
                        </label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">Головна категорія</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Скасувати
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Створити
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Category Modal -->
<div class="modal fade" id="viewCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-tag me-2"></i>
                    Інформація про категорію
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="categoryDetailsContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>
                    Редагувати категорію
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCategoryForm" class="modal-form">
                <div class="modal-body">
                    <input type="hidden" id="edit_category_id" name="category_id">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">
                            <i class="fas fa-tag me-1"></i>Назва категорії *
                        </label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_parent_id" class="form-label">
                            <i class="fas fa-sitemap me-1"></i>Батьківська категорія
                        </label>
                        <select class="form-select" id="edit_parent_id" name="parent_id">
                            <option value="">Головна категорія</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Скасувати
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>Зберегти зміни
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Замініть JavaScript частину в кінці файлу views/admin/categories/index.php на цей код: -->

<script>
// ✅ ВИПРАВЛЕНІ JAVASCRIPT ФУНКЦІЇ
function getCategoryDataFromTable(categoryId) {
    const categoryRow = document.querySelector(`tr:has([onclick*="${categoryId}"])`);
    if (!categoryRow) return null;
    
    const cells = categoryRow.querySelectorAll('td');
    const categoryName = cells[1].querySelector('.category-name').textContent.trim();
    const createdAt = cells[2].textContent.trim();
    
    return {
        id: categoryId,
        name: categoryName,
        created_at: createdAt
    };
}

function viewCategory(categoryId) {
    const categoryData = getCategoryDataFromTable(categoryId);
    if (!categoryData) return;
    
    const content = `
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <strong>ID категорії:</strong> #${categoryData.id}
                </div>
                <div class="mb-3">
                    <strong>Назва:</strong> ${categoryData.name}
                </div>
                <div class="mb-3">
                    <strong>Дата створення:</strong> ${categoryData.created_at}
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('categoryDetailsContent').innerHTML = content;
    const modal = new bootstrap.Modal(document.getElementById('viewCategoryModal'));
    modal.show();
}

function editCategory(categoryId) {
    const categoryData = getCategoryDataFromTable(categoryId);
    if (!categoryData) return;
    
    document.getElementById('edit_category_id').value = categoryData.id;
    document.getElementById('edit_name').value = categoryData.name;
    
    const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
    modal.show();
}

// ✅ ВИПРАВЛЕНА ФУНКЦІЯ ОНОВЛЕННЯ КАТЕГОРІЇ
document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Використовуємо правильний URL маршрут
    fetch('<?= url('admin/categories/update') ?>', {
        method: 'POST',
        body: formData  // Відправляємо FormData напряму (не URLSearchParams)
    })
    .then(response => {
        // Перевіряємо чи відповідь є JSON
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('success', data.message || 'Категорію успішно оновлено');
            bootstrap.Modal.getInstance(document.getElementById('editCategoryModal')).hide();
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification('error', data.message || 'Помилка при оновленні категорії');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('error', 'Помилка при оновленні категорії');
    });
});

// ✅ ВИПРАВЛЕНА ФУНКЦІЯ ВИДАЛЕННЯ КАТЕГОРІЇ
function deleteCategory(categoryId) {
    const categoryData = getCategoryDataFromTable(categoryId);
    if (!categoryData) return;
    
    if (!confirm(`Ви впевнені, що хочете видалити категорію "${categoryData.name}"?\n\nЦя дія незворотна!`)) {
        return;
    }
    
    // Створюємо FormData для відправки
    const formData = new FormData();
    formData.append('category_id', categoryId);
    formData.append('csrf_token', '<?= $csrf_token ?>');
    
    // Використовуємо правильний URL маршрут
    fetch('<?= url('admin/categories/delete') ?>', {
        method: 'POST',
        body: formData  // Відправляємо FormData напряму
    })
    .then(response => {
        // Перевіряємо чи відповідь є JSON
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('success', data.message || 'Категорію успішно видалено');
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification('error', data.message || 'Помилка при видаленні категорії');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('error', 'Помилка при видаленні категорії');
    });
}

// ✅ ФУНКЦІЯ ПОКАЗУ ПОВІДОМЛЕНЬ
function showNotification(type, message) {
    // Видаляємо існуючі повідомлення
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(n => n.remove());
    
    // Створюємо нове повідомлення
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <span><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}</span>
        <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    document.body.appendChild(notification);
    
    // Автоматично видалити через 5 секунд
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}
</script>