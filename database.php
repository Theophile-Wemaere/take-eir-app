<?php
class DB {
  public $error = "";
  private $pdo = null;
  private $stmt = null;
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  function execute ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
    return $this->stmt->fetchAll();
  }
}

define("DB_HOST", "take-eir.fr");
define("DB_NAME", "take_eir");
define("DB_CHARSET", "utf8mb4");
$creds = file(".creds");                                                                                                                                                                                     
$creds_line = $creds[0];                                                                                                                                                                                     
$creds_parts = explode(":", $creds_line);                                                                                                                                                                    
$username = $creds_parts[0];                                                                                                                                                                                 
$password = str_replace("\n", "", $creds_parts[1]); 
define("DB_USER", $username);
define("DB_PASSWORD", $password);
$_DB = new DB();
?>
