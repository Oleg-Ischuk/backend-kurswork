<style>
    .card-shadow {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .empty-state {
        text-align: center;
        padding: 2rem 0;
    }

    .empty-state i {
        font-size: 3rem;
        color: #858796;
        margin-bottom: 1rem;
    }

    .quick-action-btn {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .dashboard-subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }
</style>

<div class="container-fluid py-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="dashboard-title">
            <i class="fas fa-tachometer-alt me-2"></i>
            Панель адміністратора
        </div>
        <div class="dashboard-subtitle">
            Ласкаво просимо до системи управління SportStore
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-8 mb-4">
            <div class="card card-shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Останні замовлення</h6>
                    <a href="<?= url('admin/orders') ?>" class="btn btn-primary btn-sm">Переглянути всі</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($recentOrders)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Клієнт</th>
                                        <th>Сума</th>
                                        <th>Статус</th>
                                        <th>Дата</th>
                                        <th>Дії</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentOrders as $order): ?>
                                        <tr>
                                            <td>#<?= $order['id'] ?></td>
                                            <td><?= htmlspecialchars($order['customer_name'] ?? 'Невідомо') ?></td>
                                            <td><?= number_format($order['total'] ?? 0, 2) ?> ₴</td>
                                            <td>
                                                <span class="badge bg-<?= getStatusColor($order['status'] ?? 'pending') ?>">
                                                    <?= getStatusText($order['status'] ?? 'pending') ?>
                                                </span>
                                            </td>
                                            <td><?= date('d.m.Y', strtotime($order['created_at'])) ?></td>
                                            <td>
                                                <a href="<?= url('admin/orders/' . $order['id']) ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p class="text-muted">Поки немає замовлень</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card card-shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Швидкі дії</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= url('admin/products') ?>" class="btn btn-success quick-action-btn">
                            <i class="fas fa-box"></i>Управління товарами
                        </a>
                        <a href="<?= url('admin/categories') ?>" class="btn btn-info quick-action-btn">
                            <i class="fas fa-list"></i>Управління категоріями
                        </a>
                        <a href="<?= url('admin/orders') ?>" class="btn btn-warning quick-action-btn">
                            <i class="fas fa-shopping-cart"></i>Переглянути замовлення
                        </a>
                        <a href="<?= url('admin/users') ?>" class="btn btn-primary quick-action-btn">
                            <i class="fas fa-users"></i>Управління користувачами
                        </a>
                        <a href="<?= url('admin/brands') ?>" class="btn btn-secondary quick-action-btn">
                            <i class="fas fa-tags"></i>Управління брендами
                        </a>
                        <a href="<?= url('/') ?>" class="btn btn-outline-secondary quick-action-btn">
                            <i class="fas fa-home"></i>Перейти на сайт
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
function getStatusColor($status)
{
    switch ($status) {
        case 'pending':
            return 'warning';
        case 'processing':
            return 'info';
        case 'shipped':
            return 'primary';
        case 'delivered':
            return 'success';
        case 'cancelled':
            return 'danger';
        default:
            return 'secondary';
    }
}

function getStatusText($status)
{
    switch ($status) {
        case 'pending':
            return 'Очікує';
        case 'processing':
            return 'Обробляється';
        case 'shipped':
            return 'Відправлено';
        case 'delivered':
            return 'Доставлено';
        case 'cancelled':
            return 'Скасовано';
        default:
            return 'Невідомо';
    }
}
?>