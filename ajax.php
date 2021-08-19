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
     * Get all non-hidden products from DataBase
     *
     * @param int $count
     * @return mixed
     */
    public function getShownProducts(int $count = 10)
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("SELECT * FROM `Products` WHERE `HIDE` = 0 ORDER BY `DATE_CREATE` DESC LIMIT ?");
        $stmt->bind_param("i", $count);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     *  Close MySQLi connect on destruct
     */
    public function __destruct()
    {
        $this->db->close();
    }

}

if ($_GET['action'] != '') {
    $CProducts = new CProducts($db);
    $json = [];
    switch ($_GET['action']) {
        case 'getProducts':
            $json = json_encode($CProducts->getShownProducts(), JSON_FORCE_OBJECT);
            break;
    }
    echo $json;
}