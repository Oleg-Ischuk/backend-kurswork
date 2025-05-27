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
            return 'Очікує обробки';
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

<style>
    .order-details-container {
        padding: 20px;
    }

    .order-header-card {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-bottom: 1.5rem;
    }

    .order-header-content {
        padding: 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 2rem;
    }

    .info-section h6 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .info-item {
        margin-bottom: 0.75rem;
    }

    .info-label {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.875rem;
    }

    .info-value {
        font-weight: 500;
        color: #212529;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
        color: white;
        display: inline-block;
    }

    .status-badge.warning {
        background-color: #ffc107;
        color: #000;
    }

    .status-badge.info {
        background-color: #0dcaf0;
        color: #000;
    }

    .status-badge.primary {
        background-color: #0d6efd;
    }

    .status-badge.success {
        background-color: #198754;
    }

    .status-badge.danger {
        background-color: #dc3545;
    }

    .items-card {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-bottom: 1.5rem;
    }

    .items-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #dee2e6;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .items-body {
        padding: 1.5rem;
    }

    .order-item {
        display: grid;
        grid-template-columns: 80px 1fr auto auto auto;
        gap: 1rem;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
        padding: 0.25rem;
    }

    .item-info h6 {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #212529;
    }

    .item-info small {
        color: #6c757d;
    }

    .item-quantity,
    .item-price,
    .item-total {
        text-align: center;
        font-weight: 600;
    }

    .item-total {
        color: #0d6efd;
    }

    .order-total {
        padding-top: 1rem;
        border-top: 2px solid #dee2e6;
        margin-top: 1rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.25rem;
        font-weight: 700;
        color: #0d6efd;
    }

    .actions-card {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .actions-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #dee2e6;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .actions-body {
        padding: 1.5rem;
    }

    .status-form {
        margin-bottom: 1.5rem;
    }

    .status-select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    .action-btn {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        border: none;
    }

    .btn-primary {
        background: #0d6efd;
        color: white;
    }

    .btn-primary:hover {
        background: #0b5ed7;
    }

    .btn-outline-secondary {
        background: transparent;
        color: #6c757d;
        border: 1px solid #6c757d;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    /* Стилі для чеку */
    .invoice-preview {
        display: none;
        margin-top: 2rem;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        background: white;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .invoice-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        position: relative;
    }

    .invoice-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
        opacity: 0.3;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 2rem;
        align-items: center;
    }

    .company-info h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .company-tagline {
        font-size: 1.1rem;
        opacity: 0.9;
        font-style: italic;
    }

    .invoice-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 1rem 2rem;
        border-radius: 15px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        text-align: center;
    }

    .invoice-number {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .invoice-date {
        font-size: 1rem;
        opacity: 0.9;
    }

    .invoice-body {
        padding: 2rem;
    }

    .invoice-info-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .invoice-info-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: 15px;
        border-left: 5px solid #667eea;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .invoice-info-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .invoice-info-item {
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
    }

    .invoice-info-label {
        font-weight: 600;
        color: #666;
    }

    .invoice-info-value {
        font-weight: 500;
        color: #333;
    }

    .invoice-status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .invoice-status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .invoice-status-processing {
        background: #d1ecf1;
        color: #0c5460;
    }

    .invoice-status-shipped {
        background: #cce5ff;
        color: #004085;
    }

    .invoice-status-delivered {
        background: #d4edda;
        color: #155724;
    }

    .invoice-status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .invoice-items-section {
        margin: 2rem 0;
    }

    .invoice-section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .invoice-items-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .invoice-items-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .invoice-items-table th,
    .invoice-items-table td {
        padding: 1rem;
        text-align: left;
    }

    .invoice-items-table th {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }

    .invoice-items-table tbody tr {
        background: white;
        transition: all 0.3s ease;
    }

    .invoice-items-table tbody tr:nth-child(even) {
        background: #f8f9fa;
    }

    .invoice-item-image {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border-radius: 10px;
        border: 2px solid #eee;
        padding: 0.25rem;
    }

    .invoice-product-info {
        font-weight: 600;
        color: #333;
    }

    .invoice-product-sku {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.25rem;
    }

    .invoice-quantity-badge {
        background: #667eea;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-weight: 600;
        text-align: center;
    }

    .invoice-price {
        font-weight: 700;
        color: #333;
    }

    .invoice-total-price {
        font-weight: 800;
        color: #667eea;
        font-size: 1.1rem;
    }

    .invoice-total-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 15px;
        margin-top: 2rem;
        border: 2px solid #667eea;
    }

    .invoice-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 2px solid #667eea;
    }

    .invoice-total-label {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }

    .invoice-total-amount {
        font-size: 2rem;
        font-weight: 800;
        color: #667eea;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .invoice-thank-you-section {
        text-align: center;
        padding: 2rem;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        margin-top: 2rem;
        border: 2px solid #667eea;
    }

    .invoice-thank-you-message {
        font-size: 1.2rem;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 0.5rem;
    }

    .invoice-thank-you-sub {
        color: #666;
        font-style: italic;
    }

    .print-controls {
        margin: 1rem 0;
        text-align: center;
    }

    .print-controls .btn {
        margin: 0 0.5rem;
    }

    /* Стилі для друку чеку */
    @media print {
        body * {
            visibility: hidden;
        }

        .invoice-preview,
        .invoice-preview * {
            visibility: visible;
        }

        .invoice-preview {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none;
            border-radius: 0;
        }

        .print-controls {
            display: none !important;
        }

        .invoice-header {
            background: #667eea !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .invoice-items-table thead {
            background: #667eea !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .invoice-status-badge,
        .invoice-quantity-badge {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        @page {
            margin: 1cm;
            size: A4;
        }
    }

    @media (max-width: 768px) {
        .order-header-content {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .order-item {
            grid-template-columns: 1fr;
            gap: 0.5rem;
            text-align: center;
        }

        .header-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .invoice-info-section {
            grid-template-columns: 1fr;
        }

        .invoice-items-table {
            font-size: 0.8rem;
        }

        .invoice-item-image {
            width: 40px;
            height: 40px;
        }
    }
</style>

<div class="container-fluid order-details-container">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="<?= url('admin/orders') ?>" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i>Назад до списку
        </a>
    </div>

    <!-- Order Header -->
    <div class="order-header-card">
        <div class="order-header-content">
            <div class="info-section">
                <h6>Інформація про замовлення</h6>
                <div class="info-item">
                    <div class="info-label">ID замовлення:</div>
                    <div class="info-value">#<?= $order['id'] ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Дата створення:</div>
                    <div class="info-value"><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Статус:</div>
                    <div class="info-value">
                        <span class="status-badge <?= getStatusColor($order['status']) ?>">
                            <?= getStatusText($order['status']) ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <h6>Клієнт</h6>
                <div class="info-item">
                    <div class="info-label">ID клієнта:</div>
                    <div class="info-value">#<?= $order['user_id'] ?></div>
                </div>
            </div>

            <div class="info-section">
                <h6>Адреса доставки</h6>
                <div class="info-item">
                    <div class="info-value"><?= htmlspecialchars($order['shipping_address']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-value"><?= htmlspecialchars($order['shipping_city']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-value"><?= htmlspecialchars($order['shipping_postal_code']) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Order Items -->
            <div class="items-card">
                <div class="items-header">
                    <h5><i class="fas fa-box me-2"></i>Товари в замовленні</h5>
                </div>
                <div class="items-body">
                    <?php foreach ($order['items'] as $item): ?>
                        <div class="order-item">
                            <img src="<?= url($item['main_image'] ?? 'assets/images/no-image.jpg') ?>"
                                class="item-image" alt="<?= htmlspecialchars($item['product_name']) ?>">

                            <div class="item-info">
                                <h6><?= htmlspecialchars($item['product_name']) ?></h6>
                                <small>Артикул: <?= htmlspecialchars($item['product_sku'] ?? 'N/A') ?></small>
                            </div>

                            <div class="item-quantity"><?= $item['quantity'] ?> шт.</div>

                            <div class="item-price"><?= number_format($item['price'], 2) ?> ₴</div>

                            <div class="item-total"><?= number_format($item['quantity'] * $item['price'], 2) ?> ₴</div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Total -->
                    <div class="order-total">
                        <div class="total-row">
                            <strong>Загальна сума:</strong>
                            <strong><?= number_format($order['total_amount'], 2) ?> ₴</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Actions -->
            <div class="actions-card">
                <div class="actions-header">
                    <h5><i class="fas fa-cogs me-2"></i>Дії</h5>
                </div>
                <div class="actions-body">
                    <!-- Status Update -->
                    <div class="status-form">
                        <label for="statusSelect" class="form-label">Змінити статус:</label>
                        <select class="status-select" id="statusSelect">
                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Очікує обробки</option>
                            <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Обробляється</option>
                            <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Відправлено</option>
                            <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Доставлено</option>
                            <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Скасовано</option>
                        </select>
                        <button class="action-btn btn-primary" onclick="updateStatus()">
                            <i class="fas fa-save"></i>Оновити статус
                        </button>
                    </div>

                    <!-- Other Actions -->
                    <button class="action-btn btn-outline-secondary" onclick="toggleInvoicePreview()">
                        <i class="fas fa-print"></i>Показати чек
                    </button>

                    <button class="action-btn btn-danger" onclick="deleteOrder()">
                        <i class="fas fa-trash"></i>Видалити замовлення
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Preview (приховано за замовчуванням) -->
    <div class="invoice-preview" id="invoicePreview">
        <!-- Print Controls -->
        <div class="print-controls">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Друкувати чек
            </button>
            <button class="btn btn-outline-secondary" onclick="toggleInvoicePreview()">
                <i class="fas fa-times me-1"></i>Сховати чек
            </button>
        </div>

        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="company-info">
                    <h1>🏪 SportStore</h1>
                    <div class="company-tagline">Ваш надійний спортивний партнер</div>
                </div>
                <div class="invoice-badge">
                    <div class="invoice-number">#<?= $order['id'] ?></div>
                    <div class="invoice-date"><?= date('d.m.Y', strtotime($order['created_at'])) ?></div>
                </div>
            </div>
        </div>

        <!-- Invoice Body -->
        <div class="invoice-body">
            <!-- Info Section -->
            <div class="invoice-info-section">
                <div class="invoice-info-card">
                    <div class="invoice-info-title">
                        👤 Інформація про клієнта
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">Ім'я:</span>
                        <span class="invoice-info-value"><?= htmlspecialchars(($customer['first_name'] ?? '') . ' ' . ($customer['last_name'] ?? '')) ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">Email:</span>
                        <span class="invoice-info-value"><?= htmlspecialchars($customer['email'] ?? '') ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">ID клієнта:</span>
                        <span class="invoice-info-value">#<?= $order['user_id'] ?></span>
                    </div>
                </div>

                <div class="invoice-info-card">
                    <div class="invoice-info-title">
                        📦 Деталі замовлення
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">Дата:</span>
                        <span class="invoice-info-value"><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">Статус:</span>
                        <span class="invoice-info-value">
                            <span class="invoice-status-badge invoice-status-<?= $order['status'] ?>">
                                <?= match ($order['status']) {
                                    'pending' => '⏳ Очікує',
                                    'processing' => '⚙️ Обробляється',
                                    'shipped' => '🚚 Відправлено',
                                    'delivered' => '✅ Доставлено',
                                    'cancelled' => '❌ Скасовано',
                                    default => '❓ Невідомо'
                                } ?>
                            </span>
                        </span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">Адреса:</span>
                        <span class="invoice-info-value"><?= htmlspecialchars($order['shipping_address']) ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="invoice-info-label">Місто:</span>
                        <span class="invoice-info-value"><?= htmlspecialchars($order['shipping_city'] . ', ' . $order['shipping_postal_code']) ?></span>
                    </div>
                </div>
            </div>

            <!-- Items Section -->
            <div class="invoice-items-section">
                <h2 class="invoice-section-title">
                    🛍️ Товари в замовленні
                </h2>
                <table class="invoice-items-table">
                    <thead>
                        <tr>
                            <th>Зображення</th>
                            <th>Товар</th>
                            <th>Кількість</th>
                            <th>Ціна</th>
                            <th>Сума</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?= url($item['main_image'] ?? 'assets/images/no-image.jpg') ?>"
                                        class="invoice-item-image" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                </td>
                                <td>
                                    <div class="invoice-product-info"><?= htmlspecialchars($item['product_name']) ?></div>
                                    <div class="invoice-product-sku">Артикул: <?= htmlspecialchars($item['product_sku'] ?? 'N/A') ?></div>
                                </td>
                                <td>
                                    <span class="invoice-quantity-badge"><?= $item['quantity'] ?> шт.</span>
                                </td>
                                <td class="invoice-price"><?= number_format($item['price'], 2) ?> ₴</td>
                                <td class="invoice-total-price"><?= number_format($item['quantity'] * $item['price'], 2) ?> ₴</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="invoice-total-section">
                <div class="invoice-total-row">
                    <div class="invoice-total-label">💰 Загальна сума:</div>
                    <div class="invoice-total-amount"><?= number_format($order['total_amount'], 2) ?> ₴</div>
                </div>
            </div>

            <!-- Thank You Section -->
            <div class="invoice-thank-you-section">
                <div class="invoice-thank-you-message">Дякуємо за ваше замовлення! 🎉</div>
                <div class="invoice-thank-you-sub">SportStore - Завжди в русі! 🏃‍♂️💨</div>
            </div>
        </div>
    </div>
</div>

<script>
    const orderId = <?= $order['id'] ?>;
    const csrfToken = '<?= $csrf_token ?>';
    let invoiceVisible = false;

    function updateStatus() {
        const newStatus = document.getElementById('statusSelect').value;

        if (!confirm('Оновити статус замовлення?')) {
            return;
        }

        fetch('<?= url('admin/orders/update-status') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `order_id=${orderId}&status=${newStatus}&csrf_token=${csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Помилка при оновленні статусу');
                }
            })
            .catch(error => {
                alert('Помилка при оновленні статусу');
            });
    }

    function toggleInvoicePreview() {
        const invoice = document.getElementById('invoicePreview');
        const button = document.querySelector('.action-btn.btn-outline-secondary');

        if (invoiceVisible) {
            invoice.style.display = 'none';
            button.innerHTML = '<i class="fas fa-print"></i>Показати чек';
            invoiceVisible = false;
        } else {
            invoice.style.display = 'block';
            button.innerHTML = '<i class="fas fa-eye-slash"></i>Сховати чек';
            invoiceVisible = true;

            // Плавна прокрутка до чеку
            setTimeout(() => {
                invoice.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }
    }

    function deleteOrder() {
        if (!confirm('Ви впевнені, що хочете видалити це замовлення? Цю дію не можна скасувати.')) {
            return;
        }

        fetch('<?= url('admin/orders/delete') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `order_id=${orderId}&csrf_token=${csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '<?= url('admin/orders') ?>';
                } else {
                    alert(data.message || 'Помилка при видаленні замовлення');
                }
            })
            .catch(error => {
                alert('Помилка при видаленні замовлення');
            });
    }

    // Smooth animations for invoice items
    function animateInvoiceItems() {
        const rows = document.querySelectorAll('.invoice-items-table tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            setTimeout(() => {
                row.style.transition = 'all 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Trigger animations when invoice becomes visible
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                const invoice = document.getElementById('invoicePreview');
                if (invoice.style.display === 'block') {
                    setTimeout(animateInvoiceItems, 300);
                }
            }
        });
    });

    observer.observe(document.getElementById('invoicePreview'), {
        attributes: true,
        attributeFilter: ['style']
    });
</script>