<?php
class Main {
    private $db;
    function __construct($type = NULL){
        $this->db=$type;
    }
    public function addStat($arr){
        $sql = "INSERT INTO stat(domain) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        foreach($arr as $item){
            $stmt->bindValue('1', $item);
            try {
                $stmt->execute();
            } catch (PDOException $e){}
        }
        return true;
    }
    public function getStat(){
        $sql = "SELECT COUNT(*) AS `data`, (CASE WHEN `check`= 1 THEN 'check' ELSE 'uncheck' END || ' (' || COUNT(*) || ')') AS label FROM stat GROUP BY `check`";
        $res = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if($res && !empty($res)){
            return json_encode($res);
        }
        return 0;
    }
    public function getData(){
        $sql = "SELECT domain FROM stat";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateData($arr){
        $sql = "UPDATE stat SET `check`=1 WHERE domain=? AND `check`<>1";
        $stmt = $this->db->prepare($sql);
        foreach($arr as $item){
                $stmt->bindValue('1', $item);
            try {
                $stmt->execute();
            } catch (PDOException $e){}
        }
        return true;
    }
    function __destruct(){
        $this->db=NULL;
    }
}