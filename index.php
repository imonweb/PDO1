<?php 
// print_r(PDO::getAvailableDrivers());

try {
  $handler = new PDO('mysql:host=localhost;dbname=php_codecourse_pdo', 'imon', 'p@ssw0rd');
  $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  // die('Sorry, database problem');
  echo $e->getMessage();
  die();
}

$query = $handler->query('SELECT * FROM guestbook');

// while($r = $query->fetch()){
//   echo $r['message'], '<br>';
// }

$r = $query->fetch();
// print_r($r);
echo '<pre>', print_r($r), '</pre>';