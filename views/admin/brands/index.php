<style>
    .card-shadow {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .brand-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .brand-count {
        color: #858796;
        font-size: 0.875rem;
    }

    .add-brand-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .add-brand-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .table-container {
        background: white;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .table th {
        background: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        font-weight: 600;
        color: #5a5c69;
    }

    .btn-edit {
        background: linear-gradient(45deg, #36b9cc, #258391);
        border: none;
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(54, 185, 204, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(45deg, #e74a3b, #c0392b);
        border: none;
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(231, 74, 59, 0.4);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #858796;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    .form-label {
        font-weight: 600;
        color: #5a5c69;
    }

    .form-control {
        border: 1px solid #d1d3e2;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-tags me-2"></i>
                Управління брендами
            </h1>
            <p class="text-muted mb-0">Додавайте, редагуйте та видаляйте бренди товарів</p>
        </div>
        <button type="button" class="btn add-brand-btn" data-bs-toggle="modal" data-bs-target="#addBrandModal">
            <i class="fas fa-plus me-2"></i>
            Додати бренд
        </button>
    </div>

    <!-- Brands Table -->
    <div class="card card-shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-2"></i>
                Список брендів
            </h6>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($brands)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Назва бренду</th>
                                <th>Кількість товарів</th>
                                <th class="text-center">Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brands as $brand): ?>
                                <tr>
                                    <td><strong>#<?= $brand['id'] ?></strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-tag text-primary me-2"></i>
                                            <span class="brand-name"><?= htmlspecialchars($brand['name']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?= $brand['product_count'] ?> товарів
                                        </span>
                                    </td>
                                    <td>
                                        <div class="brand-actions justify-content-center">
                                            <button type="button" class="btn btn-edit btn-sm"
                                                onclick="editBrand(<?= $brand['id'] ?>, '<?= htmlspecialchars($brand['name'], ENT_QUOTES) ?>')">
                                                <i class="fas fa-edit me-1"></i>
                                                Редагувати
                                            </button>
                                            <button type="button" class="btn btn-delete btn-sm"
                                                onclick="deleteBrand(<?= $brand['id'] ?>, '<?= htmlspecialchars($brand['name'], ENT_QUOTES) ?>', <?= $brand['product_count'] ?>)">
                                                <i class="fas fa-trash me-1"></i>
                                                Видалити
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
                    <h5>Немає брендів</h5>
                    <p>Додайте ваш перший бренд, щоб почати управління товарами</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                        <i class="fas fa-plus me-2"></i>
                        Додати перший бренд
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>
                    Додати новий бренд
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('admin/brands/store') ?>">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <div class="mb-3">
                        <label for="brandName" class="form-label">Назва бренду</label>
                        <input type="text" class="form-control" id="brandName" name="name"
                            placeholder="Введіть назву бренду" required>
                        <div class="form-text">Назва повинна бути унікальною</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>
                        Скасувати
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Зберегти
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>
                    Редагувати бренд
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editBrandForm">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <input type="hidden" name="brand_id" id="editBrandId">
                    <div class="mb-3">
                        <label for="editBrandName" class="form-label">Назва бренду</label>
                        <input type="text" class="form-control" id="editBrandName" name="name"
                            placeholder="Введіть назву бренду" required>
                        <div class="form-text">Назва повинна бути унікальною</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>
                        Скасувати
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Оновити
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Підключаємо SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Перевіряємо чи завантажені бібліотеки
    document.addEventListener('DOMContentLoaded', function() {
        console.log('SweetAlert2 loaded:', typeof Swal !== 'undefined');
        console.log('Bootstrap loaded:', typeof bootstrap !== 'undefined');
    });

    // Функція для редагування бренду
    function editBrand(id, name) {
        console.log('Edit brand called:', id, name);

        document.getElementById('editBrandId').value = id;
        document.getElementById('editBrandName').value = name;

        // Перевіряємо чи Bootstrap доступний
        if (typeof bootstrap !== 'undefined') {
            const modal = new bootstrap.Modal(document.getElementById('editBrandModal'));
            modal.show();
        } else {
            // Fallback без Bootstrap
            document.getElementById('editBrandModal').style.display = 'block';
            document.getElementById('editBrandModal').classList.add('show');
        }
    }

    // Функція для видалення бренду
    function deleteBrand(id, name, productCount) {
        console.log('Delete brand called:', id, name, productCount);

        if (productCount > 0) {
            // Якщо SweetAlert недоступний, використовуємо звичайний alert
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Неможливо видалити',
                    text: `Бренд "${name}" містить ${productCount} товарів. Спочатку видаліть або перемістіть товари до інших брендів.`,
                    confirmButtonColor: '#667eea'
                });
            } else {
                alert(`Бренд "${name}" містить ${productCount} товарів. Спочатку видаліть або перемістіть товари до інших брендів.`);
            }
            return;
        }

        // Функція для виконання видалення
        function performDelete() {
            console.log('Performing delete for brand:', id);

            const formData = new FormData();
            formData.append('brand_id', id);
            formData.append('csrf_token', '<?= $csrf_token ?>');

            console.log('Sending request to:', '<?= url("admin/brands/delete") ?>');

            fetch('<?= url("admin/brands/delete") ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);
                    return response.text(); // Спочатку отримуємо як текст для відладки
                })
                .then(text => {
                    console.log('Raw response:', text);
                    try {
                        const data = JSON.parse(text);
                        console.log('Parsed response:', data);

                        if (data.success) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Успіх!',
                                    text: data.message,
                                    confirmButtonColor: '#667eea'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                alert('Бренд успішно видалено!');
                                location.reload();
                            }
                        } else {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Помилка!',
                                    text: data.message,
                                    confirmButtonColor: '#667eea'
                                });
                            } else {
                                alert('Помилка: ' + data.message);
                            }
                        }
                    } catch (e) {
                        console.error('JSON parse error:', e);
                        console.error('Response was:', text);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Помилка!',
                                text: 'Неочікувана відповідь від сервера',
                                confirmButtonColor: '#667eea'
                            });
                        } else {
                            alert('Помилка: неочікувана відповідь від сервера');
                        }
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Помилка!',
                            text: 'Сталася помилка при видаленні бренду: ' + error.message,
                            confirmButtonColor: '#667eea'
                        });
                    } else {
                        alert('Сталася помилка при видаленні бренду: ' + error.message);
                    }
                });
        }

        // Показуємо підтвердження
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Підтвердіть видалення',
                text: `Ви дійсно хочете видалити бренд "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Так, видалити',
                cancelButtonText: 'Скасувати'
            }).then((result) => {
                if (result.isConfirmed) {
                    performDelete();
                }
            });
        } else {
            // Fallback з звичайним confirm
            if (confirm(`Ви дійсно хочете видалити бренд "${name}"?`)) {
                performDelete();
            }
        }
    }

    // Обробка форми редагування
    document.getElementById('editBrandForm').addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Edit form submitted');

        const formData = new FormData(this);
        console.log('Form data:', Object.fromEntries(formData));

        fetch('<?= url("admin/brands/update") ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Update response status:', response.status);
                return response.text(); // Спочатку отримуємо як текст
            })
            .then(text => {
                console.log('Update raw response:', text);
                try {
                    const data = JSON.parse(text);
                    console.log('Update parsed response:', data);

                    if (data.success) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Успіх!',
                                text: data.message,
                                confirmButtonColor: '#667eea'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            alert('Бренд успішно оновлено!');
                            location.reload();
                        }
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Помилка!',
                                text: data.message,
                                confirmButtonColor: '#667eea'
                            });
                        } else {
                            alert('Помилка: ' + data.message);
                        }
                    }
                } catch (e) {
                    console.error('Update JSON parse error:', e);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Помилка!',
                            text: 'Неочікувана відповідь від сервера',
                            confirmButtonColor: '#667eea'
                        });
                    } else {
                        alert('Помилка: неочікувана відповідь від сервера');
                    }
                }
            })
            .catch(error => {
                console.error('Update error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Помилка!',
                        text: 'Сталася помилка при оновленні бренду: ' + error.message,
                        confirmButtonColor: '#667eea'
                    });
                } else {
                    alert('Сталася помилка при оновленні бренду: ' + error.message);
                }
            });
    });
</script>