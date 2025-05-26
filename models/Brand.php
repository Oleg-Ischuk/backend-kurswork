<?php
// models/Brand.php
class Brand extends Model {
    protected $table = 'brands';
    
    // ✅ ВИКОРИСТОВУЄМО МЕТОД getAll() ЗАМІСТЬ findAll()
    public function getAll() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY name ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting brands: " . $e->getMessage());
            return [];
        }
    }
    
    public function getBrandsWithProductCount() {
        $sql = "SELECT b.*, COUNT(p.id) as product_count
                FROM brands b
                LEFT JOIN products p ON b.id = p.brand_id
                GROUP BY b.id
                ORDER BY b.name";
        
        return $this->query($sql);
    }
    
    public function nameExists($name, $excludeId = null) {
        $sql = "SELECT id FROM brands WHERE name = ?";
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