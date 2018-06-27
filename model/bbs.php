<?php
class Bbs{
  public $id = 0;
  public $contents = "";

  public static function init($db){
    $db->exec("
    CREATE TABLE IF NOT EXISTS bbs(id INTEGER PRIMARY KEY, contents TEXT)
    ");
  }

  public static function insert($db, $text){
    $stmt = $db->prepare("
      INSERT INTO bbs(contents) VALUES(?)
    ");
    $stmt->execute([$text]);

    $result["status"] = "success";
    $result["text"] = $text;
    return $result;
  }

  public static function findAll($db){
    $stmt = $db->prepare("
      SELECT id, contents FROM bbs ORDER by ID DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, "bbs");
  }  
}