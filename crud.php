<?php

### Funciones CRUD
// READ
function getStudents() {
  try {
    $query = "SELECT id, name, email, web, created_at FROM students";
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
  try {
    if (isset($_POST['id'])) {
      $id = $_POST['id'];
      if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $web = $_POST['web'];
        
        $db = getConnection();
        $query = "UPDATE students SET name = ?, email = ?, web = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$name, $email, $web, $id]);
        if ($result) {
          return infoMessage('Estudiante actualizado con éxito', '200', 'Ok');
        } else {
          return infoMessage('Error al actualizar al estudiante', '500', 'Internal Server Error');
        }
      } else {
        return infoMessage('Datos incompletos para la actualización', '400', 'Bad Request');      
      }
    } else {
      return infoMessage('No se puede editar al estudiante', '400', 'Bad Request');
    }
  } catch (PDOException $e) {
    die('Error-> '.$e->getMessage());
  } 
}
// DELETE
function deleteStudent() {
  try {
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      $db = getConnection();
      $query = "DELETE FROM students WHERE id = ?";
      $stmt = $db->prepare($query);
      $result = $stmt->execute([$id]);
      if ($result) {
        return infoMessage('Estudiante eliminado con éxito', '200', 'Ok');
      } else {
        return infoMessage('Error al eliminar al estudiante', '500', 'Internal Server Error');
      }
    } else {
      return infoMessage('Datos incompletos para la eliminación', '400', 'Bad Request');
    }
  } catch (PDOException $e) {
    die('Error-> '.$e->getMessage());
  } 
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