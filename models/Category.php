<?php
// models/Category.php
class Category extends Model {
    protected $table = 'categories';
    
    public function getAll() {
        $sql = "SELECT * FROM categories ORDER BY id ASC";
        return $this->query($sql);
    }
    
    public function getCategoriesWithProductCount() {
        $sql = "SELECT c.*, COUNT(p.id) as product_count
                FROM categories c
                LEFT JOIN products p ON c.id = p.category_id
                GROUP BY c.id
                ORDER BY c.id ASC";
        
        return $this->query($sql);
    }
    
    public function getCategoryWithProducts($id, $limit = null) {
        $category = $this->find($id);
        if (!$category) {
            return null;
        }
        
        $productModel = new Product();
        $products = $productModel->getProductsByCategory($id, $limit);
        
        $category['products'] = $products;
        return $category;
    }
    
    public function nameExists($name, $excludeId = null) {
        $sql = "SELECT id FROM categories WHERE name = ?";
        $params = [$name];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $result = $this->queryOne($sql, $params);
        return $result !== false;
    }
}
?>