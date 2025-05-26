<?php
// models/Order.php
class Order extends Model {
    protected $table = 'orders';
    
    public function createOrder($userId, $items, $address, $city, $postalCode) {
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
    
    public function getOrderWithItems($orderId) {
        $order = $this->find($orderId);
        if (!$order) {
            return null;
        }
        
        $sql = "SELECT oi.*, p.name as product_name, pi.image_url as product_image
                FROM order_items oi
                LEFT JOIN products p ON oi.product_id = p.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                WHERE oi.order_id = ?";
        
        $order['items'] = $this->query($sql, [$orderId]);
        return $order;
    }
    
    public function getOrdersWithDetails($limit = null, $offset = 0) {
        $sql = "SELECT o.*, u.first_name, u.last_name, u.email,
                       COUNT(oi.id) as items_count,
                       SUM(oi.quantity) as total_items
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN order_items oi ON o.id = oi.order_id
                GROUP BY o.id
                ORDER BY o.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        
        return $this->query($sql);
    }
    
    public function updateStatus($orderId, $status) {
        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }
        
        return $this->update($orderId, ['status' => $status]);
    }
    
    public function getOrderStats() {
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
}
?>