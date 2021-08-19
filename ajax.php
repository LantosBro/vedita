<?php
require_once __DIR__ . '/db.php';

class CProducts
{
    private $db;

    /**
     * Init DB Connector
     *
     * @param DBconnect $db
     */
    public function __construct(DBconnect $db)
    {
        $this->db = $db;
    }

    /**
     * Get all products from DataBase
     *
     * @param int $count
     * @return mixed
     */
    public function getProducts(int $count = 10)
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("SELECT * FROM Products ORDER BY id DESC LIMIT ?");
        $stmt->bind_param("i", $count);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
        return $products;
    }
}


