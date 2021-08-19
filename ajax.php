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
     * Hide product by product id
     *
     * @param int $product_id
     * @return bool
     */
    public function hideProduct(int $product_id)
    {
        $stmt = $this->db->stmt_init();
        $stmt->prepare("UPDATE `Products` SET `HIDE` = 1 WHERE `PRODUCT_ID` = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        if ($stmt->errno) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    }

    /**
     * Changing quantity of product
     *
     * @param int $product_id
     * @param string $option
     * @param int $value
     * @return bool
     */
    public function changeQuantity(int $product_id, string $option, int $value = 1)
    {
        $stmt = $this->db->stmt_init();
        if ($option === 'plus') {
            $stmt->prepare("UPDATE `Products` SET `PRODUCT_QUANTITY` = `PRODUCT_QUANTITY` + 1 WHERE `PRODUCT_ID` = ?");
        } elseif ($option === 'minus') {
            $stmt->prepare("UPDATE `Products` SET `PRODUCT_QUANTITY` = `PRODUCT_QUANTITY` - 1 WHERE `PRODUCT_ID` = ?");
        }
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        if ($stmt->errno) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
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
            $json = $CProducts->getShownProducts();
            break;
        case 'hide':
            if ($_GET['id'] != '') {
                (int)$id = trim(htmlspecialchars($_GET['id']));
                $json = $CProducts->hideProduct($id);
            }
            break;
        case 'quantity':
            if ($_GET['option'] != '' && $_GET['id'] != '') {
                (int)$id = trim(htmlspecialchars($_GET['id']));
                $option = trim(htmlspecialchars($_GET['option']));
                $json = $CProducts->changeQuantity($id, $option);
            }
    }
    echo json_encode($json, JSON_FORCE_OBJECT);
}