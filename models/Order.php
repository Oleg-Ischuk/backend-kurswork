<?php
// models/Order.php
class Order extends Model
{
    protected $table = 'orders';

    public function createOrder($userId, $items, $address, $city, $postalCode)
    {
        try {
            $this->db->beginTransaction();

            // Підраховуємо загальну суму
            $totalPrice = 0;
            $productModel = new Product();

            foreach ($items as $productId => $quantity) {
                $product = $productModel->find($productId);
                if ($product) {
                    $totalPrice += $product['price'] * $quantity;
                }
            }

            // Створюємо замовлення
            $orderData = [
                'user_id' => $userId,
                'total_price' => $totalPrice,
                'address' => $address,
                'city' => $city,
                'postal_code' => $postalCode,
                'status' => 'pending'
            ];

            $orderId = $this->create($orderData);

            if (!$orderId) {
                throw new Exception('Помилка створення замовлення');
            }

            // Додаємо товари до замовлення
            foreach ($items as $productId => $quantity) {
                $product = $productModel->find($productId);
                if ($product && $product['stock'] >= $quantity) {
                    // Додаємо товар до замовлення
                    $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute([$orderId, $productId, $quantity, $product['price']]);

                    // Зменшуємо кількість на складі
                    $productModel->decreaseStock($productId, $quantity);
                } else {
                    throw new Exception("Недостатньо товару на складі: {$product['name']}");
                }
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД - додано правильні назви полів
    public function getOrderWithItems($orderId)
    {
        $sql = "SELECT o.id,
                       o.user_id,
                       o.total_price as total_amount,
                       o.status,
                       o.address as shipping_address,
                       o.city as shipping_city,
                       o.postal_code as shipping_postal_code,
                       o.created_at
                FROM orders o
                WHERE o.id = ?";

        $order = $this->queryOne($sql, [$orderId]);

        if (!$order) {
            return null;
        }

        $sql = "SELECT oi.*, 
                       p.name as product_name, 
                       pi.image_url as main_image,
                       p.id as product_sku
                FROM order_items oi
                LEFT JOIN products p ON oi.product_id = p.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                WHERE oi.order_id = ?";

        $order['items'] = $this->query($sql, [$orderId]);

        return $order;
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД - правильні назви полів
    public function getOrdersWithDetails($limit = null, $offset = 0)
    {
        $sql = "SELECT o.id,
                       o.user_id,
                       o.total_price as total_amount,
                       o.status,
                       o.address as shipping_address,
                       o.city as shipping_city,
                       o.postal_code as shipping_postal_code,
                       o.created_at,
                       u.first_name, 
                       u.last_name, 
                       u.email,
                       COUNT(oi.id) as items_count,
                       SUM(oi.quantity) as total_items
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN order_items oi ON o.id = oi.order_id
                GROUP BY o.id, o.user_id, o.total_price, o.status, o.address, o.city, o.postal_code, o.created_at, u.first_name, u.last_name, u.email
                ORDER BY o.created_at DESC";

        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }

        return $this->query($sql);
    }

    public function updateStatus($orderId, $status)
    {
        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (!in_array($status, $allowedStatuses)) {
            return false;
        }

        return $this->update($orderId, ['status' => $status]);
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД - правильна назва поля
    public function getOrderStats()
    {
        $sql = "SELECT 
                    COUNT(*) as total_orders,
                    SUM(total_price) as total_revenue,
                    AVG(total_price) as avg_order_value,
                    COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending_orders,
                    COUNT(CASE WHEN status = 'processing' THEN 1 END) as processing_orders,
                    COUNT(CASE WHEN status = 'shipped' THEN 1 END) as shipped_orders,
                    COUNT(CASE WHEN status = 'delivered' THEN 1 END) as delivered_orders
                FROM orders";

        return $this->queryOne($sql);
    }
    // ✅ НОВИЙ МЕТОД ДЛЯ ВИДАЛЕННЯ ЗАМОВЛЕННЯ
    public function deleteOrder($orderId)
    {
        try {
            $this->db->beginTransaction();

            // Спочатку видаляємо товари замовлення
            $sql = "DELETE FROM order_items WHERE order_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$orderId]);

            // Потім видаляємо саме замовлення
            $sql = "DELETE FROM orders WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([$orderId]);

            $this->db->commit();
            return $result;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Error deleting order: " . $e->getMessage());
            return false;
        }
    }

    // ✅ НОВИЙ МЕТОД ДЛЯ ВИДАЛЕННЯ ВСІХ ЗАВЕРШЕНИХ ЗАМОВЛЕНЬ КОРИСТУВАЧА
    public function deleteCompletedOrders($userId)
    {
        try {
            $this->db->beginTransaction();

            // Отримуємо ID завершених замовлень користувача
            $sql = "SELECT id FROM orders WHERE user_id = ? AND status IN ('delivered', 'cancelled')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId]);
            $orderIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if (empty($orderIds)) {
                $this->db->rollback();
                return 0;
            }

            // Видаляємо товари для всіх цих замовлень
            $placeholders = str_repeat('?,', count($orderIds) - 1) . '?';
            $sql = "DELETE FROM order_items WHERE order_id IN ($placeholders)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($orderIds);

            // Видаляємо самі замовлення
            $sql = "DELETE FROM orders WHERE user_id = ? AND status IN ('delivered', 'cancelled')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId]);
            $deletedCount = $stmt->rowCount();

            $this->db->commit();
            return $deletedCount;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Error deleting completed orders: " . $e->getMessage());
            return false;
        }
    }
}
