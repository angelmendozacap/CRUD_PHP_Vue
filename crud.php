<?php

### Funciones CRUD
// READ
function getStudents() {
  try {
    $query = "SELECT name, email, web, created_at FROM students";
    $db = getConnection();
    $stmt = $db->query($query);
    if ($stmt) {
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      header('Content-Type: application/json');
      header($_SERVER["SERVER_PROTOCOL"].' 200 Ok');
      return json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
      return infoMessage('Error interno del servidor', '500', 'Internal Server Error');
    }
  } catch (PDOException $e) {
    die('Error-> '.$e->getMessage());
  } 
}
// CREATE
function createStudent() {
  try {
    if (isset($_POST['name']) && isset($_POST['email'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $web = $_POST['web'];

      $query = "INSERT INTO students (name, email, web) VALUES (?,?,?)";
      $db = getConnection();
      $stmt = $db->prepare($query);
      $result = $stmt->execute([$name, $email, $web]);
      if ($result) {
        return infoMessage('Estudiante creado con éxito', '201', 'Created');
      } else {
        return infoMessage('Error al registrar al estudiante', '500', 'Internal Server Error');
      }
    } else {
      return infoMessage('Datos incompletos para el registro', '400', 'Bad Request');
    }
  } catch (PDOException $e) {
    die('Error-> '.$e->getMessage());
  } 
}
// UPDATE
function updateStudent() {
  
}


## Mensaje de información
function infoMessage($msg,$code,$status) {
  $err = [
    'message' => $msg,
    'code' => $code
  ];
  header('Content-Type: application/json');
  header($_SERVER["SERVER_PROTOCOL"].' '.$code.' '.$status);
  return json_encode($err, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}