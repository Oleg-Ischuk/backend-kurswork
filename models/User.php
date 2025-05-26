<?php
// models/User.php
class User extends Model {
    protected $table = 'users';
    
    public function createUser($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->create($data);
    }
    
    public function checkLogin($email, $password) {
        $user = $this->findWhere('email', $email);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    public function emailExists($email) {
        return $this->findWhere('email', $email) !== false;
    }
    
    public function getUserOrders($userId) {
        $sql = "SELECT o.*, 
                       COUNT(oi.id) as items_count,
                       SUM(oi.quantity) as total_items
                FROM orders o 
                LEFT JOIN order_items oi ON o.id = oi.order_id 
                WHERE o.user_id = ? 
                GROUP BY o.id 
                ORDER BY o.created_at DESC";
        
        return $this->query($sql, [$userId]);
    }
    
    public function updateProfile($userId, $data) {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        return $this->update($userId, $data);
    }
    
    public function getAllUsers($limit = null, $offset = 0) {
        $sql = "SELECT id, first_name, last_name, email, role, created_at FROM users ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        return $this->query($sql);
    }
}
?>