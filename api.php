<?php
require_once('./db.php');
require_once('./crud.php');

$action = 'read';
if (isset($_GET['action'])) {
  $action = $_GET['action'];
}

switch ($action) {
  case 'read':
    echo getStudents();
    break;
  case 'create':
    echo createStudent();
    break;
  case 'update':
    
    break;
  case 'delete':
    
    break;
  default:
    echo infoMessage('Esta acción no existe', '400', 'Bad Request');
    break;
}