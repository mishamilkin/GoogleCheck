<?php
class sPDO {
    private static $_db = NULL;
    private static $_instance = NULL;
    private function __construct() {
        try {
            self::$_db = new PDO("sqlite:./db/stat.sqlite");
            self::$_db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // PDO::ERRMODE_SILENT
        }
        catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
    public static function getConnection() {
        if (self::$_instance == NULL) {
            self::$_instance = new self();
        }
        return self::$_db;
    }
    public function __destruct(){
        self::$_db = NULL;
        self::$_instance = NULL;
    }
}