<?php
// models/Product.php
class Product extends Model {
    protected $table = 'products';
    
    public function getProductsWithDetails($limit = null, $offset = 0) {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                       pi.image_url as main_image,
                       AVG(r.rating) as avg_rating,
                       COUNT(r.id) as reviews_count
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                GROUP BY p.id
                ORDER BY p.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        
        return $this->query($sql);
    }
    
    public function getProductWithDetails($id) {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                       AVG(r.rating) as avg_rating,
                       COUNT(r.id) as reviews_count
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE p.id = ?
                GROUP BY p.id";
        
        return $this->queryOne($sql, [$id]);
    }
    
    // ✅ ДОДАНО МЕТОД FIND
    public function find($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding product: " . $e->getMessage());
            return false;
        }
    }
    
    // ✅ ДОДАНО МЕТОД DELETE
    public function delete($id) {
        try {
            // Спочатку видаляємо зображення товару
            $stmt = $this->db->prepare("DELETE FROM product_images WHERE product_id = ?");
            $stmt->execute([$id]);
            
            // Потім видаляємо сам товар
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting product: " . $e->getMessage());
            return false;
        }
    }
    
    public function getProductImages($productId) {
        $sql = "SELECT * FROM product_images WHERE product_id = ? ORDER BY is_main DESC, id ASC";
        return $this->query($sql, [$productId]);
    }
    
    public function getProductAttributes($productId) {
        $sql = "SELECT * FROM product_attributes WHERE product_id = ?";
        return $this->query($sql, [$productId]);
    }
    
    public function searchProducts($query, $categoryId = null, $brandId = null, $minPrice = null, $maxPrice = null) {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name,
                       pi.image_url as main_image,
                       AVG(r.rating) as avg_rating
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE 1=1";
        
        $params = [];
        
        if ($query) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $params[] = "%{$query}%";
            $params[] = "%{$query}%";
        }
        
        if ($categoryId) {
            $sql .= " AND p.category_id = ?";
            $params[] = $categoryId;
        }
        
        if ($brandId) {
            $sql .= " AND p.brand_id = ?";
            $params[] = $brandId;
        }
        
        if ($minPrice) {
            $sql .= " AND p.price >= ?";
            $params[] = $minPrice;
        }
        
        if ($maxPrice) {
            $sql .= " AND p.price <= ?";
            $params[] = $maxPrice;
        }
        
        $sql .= " GROUP BY p.id ORDER BY p.name";
        
        return $this->query($sql, $params);
    }
    
    public function getProductsByCategory($categoryId, $limit = null) {
        $sql = "SELECT p.*, pi.image_url as main_image,
                       AVG(r.rating) as avg_rating
                FROM products p
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE p.category_id = ?
                GROUP BY p.id";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        return $this->query($sql, [$categoryId]);
    }
    
    public function getPopularProducts($limit = 8) {
        $sql = "SELECT p.*, pi.image_url as main_image,
                       AVG(r.rating) as avg_rating,
                       COUNT(oi.id) as order_count
                FROM products p
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                LEFT JOIN order_items oi ON p.id = oi.product_id
                GROUP BY p.id
                ORDER BY order_count DESC, avg_rating DESC
                LIMIT {$limit}";
        
        return $this->query($sql);
    }
    
    public function getNewProducts($limit = 8) {
        $sql = "SELECT p.*, pi.image_url as main_image,
                       AVG(r.rating) as avg_rating
                FROM products p
                LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_main = 1
                LEFT JOIN reviews r ON p.id = r.product_id
                GROUP BY p.id
                ORDER BY p.created_at DESC
                LIMIT {$limit}";
        
        return $this->query($sql);
    }
    
    public function decreaseStock($productId, $quantity) {
        $sql = "UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $productId, $quantity]);
    }
    
    public function addProductImage($productId, $imageUrl, $isMain = false) {
        if ($isMain) {
            // Спочатку знімаємо прапорець is_main з інших зображень
            $sql = "UPDATE product_images SET is_main = 0 WHERE product_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productId]);
        }
        
        $sql = "INSERT INTO product_images (product_id, image_url, is_main) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$productId, $imageUrl, $isMain ? 1 : 0]);
    }
}
?>