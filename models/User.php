<?php
// models/User.php
class User extends Model
{
    protected $table = 'users';

    public function createUser($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->create($data);
    }

    public function checkLogin($email, $password)
    {
        $user = $this->findWhere('email', $email);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function emailExists($email)
    {
        return $this->findWhere('email', $email) !== false;
    }

    // ✅ ВИПРАВЛЕНИЙ МЕТОД - додано поля адреси та завантаження товарів
    public function getUserOrders($userId)
    {
        $sql = "SELECT o.id, 
                       o.total_price as total_amount,
                       o.status,
                       o.address as shipping_address,
                       o.city as shipping_city, 
                       o.postal_code as shipping_postal_code,
                       o.created_at,
                       COUNT(oi.id) as items_count,
                       SUM(oi.quantity) as total_items
                FROM orders o 
                LEFT JOIN order_items oi ON o.id = oi.order_id 
                WHERE o.user_id = ? 
                GROUP BY o.id, o.total_price, o.status, o.address, o.city, o.postal_code, o.created_at
                ORDER BY o.created_at DESC";

        $orders = $this->query($sql, [$userId]);

        // ✅ ДОДАЄМО ТОВАРИ ДО КОЖНОГО ЗАМОВЛЕННЯ
        foreach ($orders as &$order) {
            $itemsSql = "SELECT oi.*, 
                                p.name as product_name,
                                pi.image_url as main_image
                         FROM order_items oi
                         LEFT JOIN products p ON oi.product_id = p.id
                         LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                         WHERE oi.order_id = ?";

            $order['items'] = $this->query($itemsSql, [$order['id']]);
        }

        return $orders;
    }

    public function updateProfile($userId, $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->update($userId, $data);
    }

    public function getAllUsers($limit = null, $offset = 0)
    {
        $sql = "SELECT id, first_name, last_name, email, role, created_at 
            FROM users 
            ORDER BY id ASC";

        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        return $this->query($sql);
    }
}
