<?php
// models/Brand.php
class Brand extends Model
{
    protected $table = 'brands';

    // Отримуємо всі бренди
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY name ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting brands: " . $e->getMessage());
            return [];
        }
    }

    // Отримуємо бренди з кількістю товарів
    public function getBrandsWithProductCount()
    {
        $sql = "SELECT b.*, COUNT(p.id) as product_count
                FROM brands b
                LEFT JOIN products p ON b.id = p.brand_id
                GROUP BY b.id
                ORDER BY b.id";

        return $this->query($sql);
    }

    // Перевіряємо чи існує бренд з такою назвою
    public function nameExists($name, $excludeId = null)
    {
        $sql = "SELECT id FROM brands WHERE name = ?";
        $params = [$name];

        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }

        $result = $this->queryOne($sql, $params);
        return $result !== false;
    }

    // Знаходимо бренд за ID
    public function find($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error finding brand: " . $e->getMessage());
            return false;
        }
    }

    // Створюємо новий бренд
    public function create($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO {$this->table} (name) VALUES (?)");
            $stmt->execute([$data['name']]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error creating brand: " . $e->getMessage());
            return false;
        }
    }

    // Оновлюємо бренд
    public function update($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET name = ? WHERE id = ?");
            return $stmt->execute([$data['name'], $id]);
        } catch (PDOException $e) {
            error_log("Error updating brand: " . $e->getMessage());
            return false;
        }
    }

    // Видаляємо бренд
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting brand: " . $e->getMessage());
            return false;
        }
    }
}
