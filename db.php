<?php
require_once('./config.php');
## Obtiene la conexión a la BD
function getConnection() {
  try {
    foreach (DB_ENV as $key => $value) {
      $$key = $value;
    }
    $url = "mysql:dbname=$db;host=$host;port=$port";
    $con = new PDO($url, $username, $password, [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ]);
    return $con;
  } catch (PDOException $e) {
    die('Error-> '.$e->getMessage());
  }
}