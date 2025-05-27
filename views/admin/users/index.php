<style>
.users-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}
.btn-outline-primary {
    border: 2px solid #667eea;
    color: #667eea;
    transition: all 0.3s;
}

.btn-outline-primary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-1px);
}

.add-user-btn {
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

.add-user-btn:hover {
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
    grid-template-columns: 2fr 1fr 2fr;
    gap: 1rem;
    align-items: end;
    padding: 1rem;
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
}

.users-table {
    background: white;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    overflow: hidden;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.user-details {
    flex: 1;
}

.user-name {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.user-id {
    color: #6c757d;
    font-size: 0.875rem;
}

.email-link {
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.2s;
}

.email-link:hover {
    text-decoration: underline;
    color: #0b5ed7;
}

.role-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge.admin {
    background-color: #dc3545;
    color: white;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
}

.role-badge.user {
    background-color: #0d6efd;
    color: white;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.3);
}

.registration-date {
    display: flex;
    flex-direction: column;
    align-items: left;
}

.date-main {
    font-weight: 500;
    color: #2d3748;
}

.date-time {
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

.modal-footer {
    border-top: 1px solid #dee2e6;
    padding: 1rem 1.5rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: all 0.3s;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-success {
    background-color: #198754;
    border-color: #198754;
    transition: all 0.3s;
}

.btn-success:hover {
    background-color: #157347;
    border-color: #146c43;
    transform: translateY(-1px);
}

.btn-warning {
    background-color: #fd7e14;
    border-color: #fd7e14;
    color: white;
    transition: all 0.3s;
}

.btn-warning:hover {
    background-color: #e8681c;
    border-color: #dc5f0a;
    transform: translateY(-1px);
}

.user-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.detail-item {
    padding: 0.75rem;
    background-color: #f8f9fa;
    border-radius: 0.375rem;
    border-left: 3px solid #667eea;
}

.detail-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.detail-value {
    color: #2d3748;
    font-size: 1rem;
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
    
    .user-details-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="container-fluid py-4">
    <div class="users-header">
        <div class="d-flex align-items-center gap-3">
        <a href="<?= url('admin') ?>" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Назад до панелі
        </a>
        <h2><i class="fas fa-users me-2"></i>Управління користувачами</h2>
        </div>
        <button class="add-user-btn" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="fas fa-user-plus"></i>Додати користувача
        </button>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <div class="card-body">
            <form method="GET" action="<?= url('admin/users') ?>" class="filter-form">
                <div>
                    <label for="search" class="form-label">Пошук</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Ім'я або email">
                </div>
                <div>
                    <label for="role" class="form-label">Роль</label>
                    <select class="form-select" id="role" name="role">
                        <option value="">Всі ролі</option>
                        <option value="admin" <?= ($selectedRole ?? '') == 'admin' ? 'selected' : '' ?>>Адміністратор</option>
                        <option value="user" <?= ($selectedRole ?? '') == 'user' ? 'selected' : '' ?>>Користувач</option>
                    </select>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Фільтрувати
                    </button>
                    <a href="<?= url('admin/users') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Очистити
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="users-table">
        <div class="card-body">
            <?php if (!empty($users)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Користувач</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Дата реєстрації</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><strong><?= $user['id'] ?></strong></td>
                            <td>
                                <div class="user-info">
                                    <div class="avatar-circle">
                                        <?= strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1)) ?>
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></div>
                                        <div class="user-id">ID: <?= $user['id'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($user['email']) ?>" class="email-link">
                                    <i class="fas fa-envelope me-1"></i>
                                    <?= htmlspecialchars($user['email']) ?>
                                </a>
                            </td>
                            <td>
                                <span class="role-badge <?= $user['role'] ?>">
                                    <i class="fas fa-<?= $user['role'] === 'admin' ? 'crown' : 'user' ?> me-1"></i>
                                    <?= $user['role'] === 'admin' ? 'Адміністратор' : 'Користувач' ?>
                                </span>
                            </td>
                            <td>
                                <div class="registration-date">
                                    <div class="date-main">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d.m.Y', strtotime($user['created_at'])) ?>
                                    </div>
                                    <div class="date-time">
                                        <i class="fas fa-clock me-1"></i>
                                        <?= date('H:i', strtotime($user['created_at'])) ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" onclick="viewUser(<?= $user['id'] ?>)" title="Переглянути">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" onclick="editUser(<?= $user['id'] ?>)" title="Редагувати">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                    <button class="action-btn delete" onclick="deleteUser(<?= $user['id'] ?>)" title="Видалити">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <?php endif; ?>
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
                        <a class="page-link" href="<?= url('admin/users?page=' . ($currentPage - 1)) ?>">Попередня</a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="<?= url('admin/users?page=' . $i) ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= url('admin/users?page=' . ($currentPage + 1)) ?>">Наступна</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>

            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h4>Користувачі не знайдені</h4>
                <p class="text-muted">Поки що немає зареєстрованих користувачів</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>
                    Додати користувача
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('admin/users/store') ?>" class="modal-form">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">
                                <i class="fas fa-user me-1"></i>Ім'я *
                            </label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">
                                <i class="fas fa-user me-1"></i>Прізвище *
                            </label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i>Email *
                        </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i>Пароль *
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">
                            <i class="fas fa-user-tag me-1"></i>Роль *
                        </label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user">Користувач</option>
                            <option value="admin">Адміністратор</option>
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

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>
                    Інформація про користувача
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>
                    Редагувати користувача
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" class="modal-form">
                <div class="modal-body">
                    <input type="hidden" id="edit_user_id" name="user_id">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_first_name" class="form-label">
                                <i class="fas fa-user me-1"></i>Ім'я *
                            </label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_last_name" class="form-label">
                                <i class="fas fa-user me-1"></i>Прізвище *
                            </label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">
                            <i class="fas fa-envelope me-1"></i>Email *
                        </label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">
                            <i class="fas fa-lock me-1"></i>Новий пароль
                        </label>
                        <input type="password" class="form-control" id="edit_password" name="password" 
                               placeholder="Залиште порожнім, щоб не змінювати">
                        <small class="text-muted">Залиште порожнім, якщо не хочете змінювати пароль</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">
                            <i class="fas fa-user-tag me-1"></i>Роль *
                        </label>
                        <select class="form-select" id="edit_role" name="role" required>
                            <option value="user">Користувач</option>
                            <option value="admin">Адміністратор</option>
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

<script>
// Отримання даних користувача з таблиці
function getUserDataFromTable(userId) {
    const userRow = document.querySelector(`tr:has([onclick*="${userId}"])`);
    if (!userRow) return null;
    
    const cells = userRow.querySelectorAll('td');
    const userNameText = cells[1].querySelector('.user-name').textContent.trim();
    const nameParts = userNameText.split(' ');
    
    return {
        id: userId,
        first_name: nameParts[0] || '',
        last_name: nameParts.slice(1).join(' ') || '',
        email: cells[2].querySelector('.email-link').textContent.trim(),
        role: cells[3].querySelector('.role-badge').classList.contains('admin') ? 'admin' : 'user',
        created_at: cells[4].querySelector('.date-main').textContent.trim() + ' ' + cells[4].querySelector('.date-time').textContent.trim()
    };
}

function viewUser(userId) {
    const userData = getUserDataFromTable(userId);
    if (!userData) return;
    
    const content = `
        <div class="user-details-grid">
            <div class="detail-item">
                <div class="detail-label">ID користувача</div>
                <div class="detail-value">#${userData.id}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Повне ім'я</div>
                <div class="detail-value">${userData.first_name} ${userData.last_name}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Email адреса</div>
                <div class="detail-value">${userData.email}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Роль в системі</div>
                <div class="detail-value">
                    <span class="role-badge ${userData.role}">
                        <i class="fas fa-${userData.role === 'admin' ? 'crown' : 'user'} me-1"></i>
                        ${userData.role === 'admin' ? 'Адміністратор' : 'Користувач'}
                    </span>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Дата реєстрації</div>
                <div class="detail-value">
                    <i class="fas fa-calendar me-1"></i>
                    ${userData.created_at}
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Статус акаунту</div>
                <div class="detail-value">
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle me-1"></i>
                        Активний
                    </span>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('userDetailsContent').innerHTML = content;
    const modal = new bootstrap.Modal(document.getElementById('viewUserModal'));
    modal.show();
}

function editUser(userId) {
    const userData = getUserDataFromTable(userId);
    if (!userData) return;
    
    // Заповнюємо форму редагування
    document.getElementById('edit_user_id').value = userData.id;
    document.getElementById('edit_first_name').value = userData.first_name;
    document.getElementById('edit_last_name').value = userData.last_name;
    document.getElementById('edit_email').value = userData.email;
    document.getElementById('edit_role').value = userData.role;
    document.getElementById('edit_password').value = '';
    
    // Показуємо модальне вікно
    const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
    modal.show();
}

// Обробка форми редагування
document.getElementById('editUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = new URLSearchParams();
    
    for (let [key, value] of formData.entries()) {
        data.append(key, value);
    }
    
    fetch('<?= url('admin/users/update') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data.toString()
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', 'Користувача успішно оновлено');
            bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification('error', data.message || 'Помилка при оновленні користувача');
        }
    })
    .catch(error => {
        showNotification('error', 'Помилка при оновленні користувача');
    });
});

function deleteUser(userId) {
    const userData = getUserDataFromTable(userId);
    if (!userData) return;
    
    if (!confirm(`Ви впевнені, що хочете видалити користувача "${userData.first_name} ${userData.last_name}"?\n\nЦя дія незворотна!`)) {
        return;
    }
    
    fetch('<?= url('admin/users/delete') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${userId}&csrf_token=<?= $csrf_token ?>`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', 'Користувача успішно видалено');
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification('error', data.message || 'Помилка при видаленні користувача');
        }
    })
    .catch(error => {
        showNotification('error', 'Помилка при видаленні користувача');
    });
}

function showNotification(type, message) {
    // Видаляємо попередні повідомлення
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(n => n.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <span><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}</span>
        <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    document.body.appendChild(notification);
    
    // Автоматично видаляємо через 5 секунд
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Валідація email в реальному часі
document.getElementById('edit_email').addEventListener('input', function() {
    const email = this.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && !emailRegex.test(email)) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

// Валідація паролю
document.getElementById('edit_password').addEventListener('input', function() {
    const password = this.value;
    
    if (password && password.length < 6) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});
</script>