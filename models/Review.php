<?php
// models/Review.php
class Review extends Model {
    protected $table = 'reviews';
    
    public function getProductReviews($productId, $limit = null) {
        $sql = "SELECT r.*, u.first_name, u.last_name
                FROM reviews r
                LEFT JOIN users u ON r.user_id = u.id
                WHERE r.product_id = ?
                ORDER BY r.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        return $this->query($sql, [$productId]);
    }
    
    public function getUserReview($userId, $productId) {
        $sql = "SELECT * FROM reviews WHERE user_id = ? AND product_id = ?";
        return $this->queryOne($sql, [$userId, $productId]);
    }
    
    public function addReview($userId, $productId, $rating, $comment) {
        // Перевіряємо чи користувач вже залишав відгук
        $existingReview = $this->getUserReview($userId, $productId);
        
        if ($existingReview) {
            // Оновлюємо існуючий відгук
            return $this->update($existingReview['id'], [
                'rating' => $rating,
                'comment' => $comment
            ]);
        } else {
            // Створюємо новий відгук
            return $this->create([
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $rating,
                'comment' => $comment
            ]);
        }
    }
    
    public function canUserReview($userId, $productId) {
        // Перевіряємо чи користувач вже залишав відгук на цей товар
        $existingReview = $this->getUserReview($userId, $productId);
        
        // Якщо відгук вже існує, користувач може його редагувати
        // Якщо відгуку немає, користувач може його створити
        return true; // Дозволяємо всім авторизованим користувачам
    }
    
    public function hasUserPurchased($userId, $productId) {
        $sql = "SELECT COUNT(*) as count
                FROM order_items oi
                LEFT JOIN orders o ON oi.order_id = o.id
                WHERE o.user_id = ? AND oi.product_id = ? AND o.status = 'delivered'";
        
        $result = $this->queryOne($sql, [$userId, $productId]);
        return $result['count'] > 0;
    }
    
    public function getReviewStats($productId) {
        $sql = "SELECT 
                    COUNT(*) as total_reviews,
                    AVG(rating) as avg_rating,
                    COUNT(CASE WHEN rating = 5 THEN 1 END) as five_star,
                    COUNT(CASE WHEN rating = 4 THEN 1 END) as four_star,
                    COUNT(CASE WHEN rating = 3 THEN 1 END) as three_star,
                    COUNT(CASE WHEN rating = 2 THEN 1 END) as two_star,
                    COUNT(CASE WHEN rating = 1 THEN 1 END) as one_star
                FROM reviews 
                WHERE product_id = ?";
        
        return $this->queryOne($sql, [$productId]);
    }
    
    // ✅ ДОДАНО: Методи для адміністрування відгуків
    public function getReviewsForAdmin($limit = 20, $offset = 0, $search = '', $productId = 0, $rating = 0) {
        $sql = "SELECT r.*, u.first_name, u.last_name, u.email, p.name as product_name
                FROM reviews r
                LEFT JOIN users u ON r.user_id = u.id
                LEFT JOIN products p ON r.product_id = p.id
                WHERE 1=1";
        
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (u.first_name LIKE ? OR u.last_name LIKE ? OR u.email LIKE ? OR r.comment LIKE ? OR p.name LIKE ?)";
            $searchParam = "%{$search}%";
            $params = array_fill(0, 5, $searchParam);
        }
        
        if ($productId > 0) {
            $sql .= " AND r.product_id = ?";
            $params[] = $productId;
        }
        
        if ($rating > 0) {
            $sql .= " AND r.rating = ?";
            $params[] = $rating;
        }
        
        $sql .= " ORDER BY r.created_at DESC LIMIT {$limit} OFFSET {$offset}";
        
        return $this->query($sql, $params);
    }
    
    public function countReviewsForAdmin($search = '', $productId = 0, $rating = 0) {
        $sql = "SELECT COUNT(*) as count
                FROM reviews r
                LEFT JOIN users u ON r.user_id = u.id
                LEFT JOIN products p ON r.product_id = p.id
                WHERE 1=1";
        
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (u.first_name LIKE ? OR u.last_name LIKE ? OR u.email LIKE ? OR r.comment LIKE ? OR p.name LIKE ?)";
            $searchParam = "%{$search}%";
            $params = array_fill(0, 5, $searchParam);
        }
        
        if ($productId > 0) {
            $sql .= " AND r.product_id = ?";
            $params[] = $productId;
        }
        
        if ($rating > 0) {
            $sql .= " AND r.rating = ?";
            $params[] = $rating;
        }
        
        $result = $this->queryOne($sql, $params);
        return $result['count'];
    }
    
    // ✅ ДОДАНО: Метод для отримання одного відгуку
    public function find($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding review: " . $e->getMessage());
            return false;
        }
    }
    
    // ✅ ДОДАНО: Метод для видалення відгуку
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting review: " . $e->getMessage());
            return false;
        }
    }
}
?>
