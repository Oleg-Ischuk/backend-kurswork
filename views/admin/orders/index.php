<style>
    .filters-card {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        margin-bottom: 1.5rem;
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
        padding: 10px;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .orders-table {
        background: white;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .order-id {
        font-weight: 600;
        color: #0d6efd;
    }

    .customer-info {
        display: flex;
        flex-direction: column;
    }

    .customer-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .customer-email {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .product-image {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 0.25rem;
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .additional-items {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .order-total {
        font-weight: 600;
        color: #0d6efd;
        font-size: 1.1rem;
    }

    .status-select {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        width: auto;
        min-width: 120px;
    }

    .order-date {
        display: flex;
        flex-direction: column;
    }

    .date-main {
        font-weight: 500;
    }

    .date-time {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.25rem;
    }

    .action-btn {
        padding: 0.25rem 0.5rem;
        border: 1px solid;
        border-radius: 0.25rem;
        background: transparent;
        cursor: pointer;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn.view {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .action-btn.print {
        border-color: #0dcaf0;
        color: #0dcaf0;
    }

    .action-btn.delete {
        border-color: #dc3545;
        color: #dc3545;
    }

    .action-btn:hover {
        opacity: 0.8;
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
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= url('admin') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i>Назад до панелі
            </a>
            <h2><i class="fas fa-shopping-cart me-2"></i>Управління замовленнями</h2>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <div class="card-body">
            <form method="GET" action="<?= url('admin/orders') ?>" class="filter-form">
                <div>
                    <label for="search" class="form-label">Пошук</label>
                    <input type="text" class="form-control" id="search" name="search"
                        value="<?= htmlspecialchars($search ?? '') ?>" placeholder="ID замовлення або ім'я клієнта">
                </div>
                <div>
                    <label for="status" class="form-label">Статус</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Всі статуси</option>
                        <option value="pending" <?= ($selectedStatus ?? '') == 'pending' ? 'selected' : '' ?>>Очікує</option>
                        <option value="processing" <?= ($selectedStatus ?? '') == 'processing' ? 'selected' : '' ?>>Обробляється</option>
                        <option value="shipped" <?= ($selectedStatus ?? '') == 'shipped' ? 'selected' : '' ?>>Відправлено</option>
                        <option value="delivered" <?= ($selectedStatus ?? '') == 'delivered' ? 'selected' : '' ?>>Доставлено</option>
                        <option value="cancelled" <?= ($selectedStatus ?? '') == 'cancelled' ? 'selected' : '' ?>>Скасовано</option>
                    </select>
                </div>
                <div>
                    <label for="date_from" class="form-label">Дата від</label>
                    <input type="date" class="form-control" id="date_from" name="date_from"
                        value="<?= $dateFrom ?? '' ?>">
                </div>
                <div>
                    <label for="date_to" class="form-label">Дата до</label>
                    <input type="date" class="form-control" id="date_to" name="date_to"
                        value="<?= $dateTo ?? '' ?>">
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Фільтрувати
                    </button>
                    <a href="<?= url('admin/orders') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Очистити
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="orders-table">
        <div class="card-body">
            <?php if (!empty($orders)): ?>
                <div class="table-responsive">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Клієнт</th>
                                <th>Товари</th>
                                <th>Сума</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>
                                        <span class="order-id">#<?= $order['id'] ?></span>
                                    </td>
                                    <td>
                                        <div class="customer-info">
                                            <div class="customer-name"><?= htmlspecialchars($order['customer_name']) ?></div>
                                            <div class="customer-email"><?= htmlspecialchars($order['customer_email']) ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-item">
                                            <?php if (!empty($order['items'])): ?>
                                                <?php $firstItem = $order['items'][0]; ?>
                                                <img src="<?= url($firstItem['product_image'] ?? 'assets/images/no-image.jpg') ?>"
                                                    alt="<?= htmlspecialchars($firstItem['product_name']) ?>"
                                                    class="product-image">
                                                <div class="product-info">
                                                    <div class="product-name"><?= htmlspecialchars($firstItem['product_name']) ?></div>
                                                    <?php if (count($order['items']) > 1): ?>
                                                        <div class="additional-items">+<?= count($order['items']) - 1 ?> інших товарів</div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="order-total"><?= number_format($order['total_amount'], 2) ?> ₴</span>
                                    </td>
                                    <td>
                                        <select class="status-select"
                                            data-order-id="<?= $order['id'] ?>">
                                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Очікує</option>
                                            <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Обробляється</option>
                                            <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Відправлено</option>
                                            <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Доставлено</option>
                                            <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Скасовано</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="order-date">
                                            <div class="date-main"><?= date('d.m.Y', strtotime($order['created_at'])) ?></div>
                                            <div class="date-time"><?= date('H:i', strtotime($order['created_at'])) ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= url('admin/orders/' . $order['id']) ?>" class="action-btn view">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="action-btn delete" onclick="deleteOrder(<?= $order['id'] ?>)">
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
                                    <a class="page-link" href="<?= url('admin/orders?page=' . ($currentPage - 1)) ?>">Попередня</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= url('admin/orders?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= url('admin/orders?page=' . ($currentPage + 1)) ?>">Наступна</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-shopping-cart"></i>
                    <h4>Замовлення не знайдені</h4>
                    <p class="text-muted">Поки що немає замовлень для відображення</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Status change handler with SweetAlert confirmation
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-select')) {
            const orderId = e.target.dataset.orderId;
            const newStatus = e.target.value;

            Swal.fire({
                title: 'Підтвердіть зміну',
                text: 'Змінити статус замовлення?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#667eea',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Так, змінити',
                cancelButtonText: 'Скасувати'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateOrderStatus(orderId, newStatus);
                } else {
                    // Revert selection
                    e.target.value = e.target.dataset.originalValue;
                }
            });
        }
    });

    // Store original values
    document.querySelectorAll('.status-select').forEach(select => {
        select.dataset.originalValue = select.value;
    });

    function updateOrderStatus(orderId, status) {
        fetch('<?= url('admin/orders/update-status') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `order_id=${orderId}&status=${status}&csrf_token=<?= $csrf_token ?>`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update original value
                    const select = document.querySelector(`[data-order-id="${orderId}"]`);
                    select.dataset.originalValue = status;

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Успіх!',
                        text: 'Статус замовлення оновлено',
                        confirmButtonColor: '#667eea',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    // Revert selection
                    const select = document.querySelector(`[data-order-id="${orderId}"]`);
                    select.value = select.dataset.originalValue;

                    Swal.fire({
                        icon: 'error',
                        title: 'Помилка!',
                        text: data.message || 'Помилка при оновленні статусу',
                        confirmButtonColor: '#667eea'
                    });
                }
            })
            .catch(error => {
                // Revert selection
                const select = document.querySelector(`[data-order-id="${orderId}"]`);
                select.value = select.dataset.originalValue;

                Swal.fire({
                    icon: 'error',
                    title: 'Помилка!',
                    text: 'Помилка при оновленні статусу',
                    confirmButtonColor: '#667eea'
                });
            });
    }

    function deleteOrder(orderId) {
        Swal.fire({
            title: 'Підтвердіть видалення',
            text: 'Ви дійсно хочете видалити це замовлення?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Так, видалити',
            cancelButtonText: 'Скасувати'
        }).then((result) => {
            if (!result.isConfirmed) return;

            fetch('<?= url('admin/orders/delete') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `order_id=${orderId}&csrf_token=<?= $csrf_token ?>`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Успіх!',
                            text: 'Замовлення успішно видалено',
                            confirmButtonColor: '#667eea'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Помилка!',
                            text: data.message || 'Помилка при видаленні замовлення',
                            confirmButtonColor: '#667eea'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Помилка!',
                        text: 'Помилка при видаленні замовлення',
                        confirmButtonColor: '#667eea'
                    });
                });
        });
    }

    function showNotification(type, message) {
        // Для сумісності, але краще використовувати SweetAlert
        if (type === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Успіх!',
                text: message,
                confirmButtonColor: '#667eea',
                timer: 3000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Помилка!',
                text: message,
                confirmButtonColor: '#667eea'
            });
        }
    }
</script>