<?php
class DB
{
  public $error = "";
  private $pdo = null;
  private $stmt = null;
  function __construct()
  {
    $this->pdo = new PDO(
      "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
      DB_USER,
      DB_PASSWORD,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]
    );
  }

  function __destruct()
  {
    if ($this->stmt !== null) {
      $this->stmt = null;
    }
    if ($this->pdo !== null) {
      $this->pdo = null;
    }
  }

  function execute($sql, $data = null)
  {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
    return $this->stmt;
  }

  function delete_user($id_user)
  {
    $query = "DELETE FROM tickets WHERE id_user = :id";
    $this->stmt = $this->pdo->prepare($query);
    $this->stmt->execute(["id" => $id_user]);
    $query = "DELETE FROM devices_users WHERE id_user = :id";
    $this->stmt = $this->pdo->prepare($query);
    $this->stmt->execute(["id" => $id_user]);
    $query = "DELETE FROM users WHERE id_user = :id";
    $this->stmt = $this->pdo->prepare($query);
    $this->stmt->execute(["id" => $id_user]);
  }
}

define("DB_HOST", "take-eir.fr");
define("DB_NAME", "take_eir");
define("DB_CHARSET", "utf8mb4");
$credentials = file_get_contents('.credentials');
$dictionary = json_decode($credentials, true);
define("DB_USER", $dictionary["mysql_user"]);
define("DB_PASSWORD", $dictionary["mysql_password"]);
$_DB = new DB();
?>
