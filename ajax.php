<?php
require_once __DIR__ . '/db.php';

class CProducts
{
    private $db;

    public function __construct(DBconnect $db)
    {
        $this->db = $db;
    }
}
