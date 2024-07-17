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

// $name = $_POST['name'];
$name = 'Jenny';
$message = 'jennys messaged';

$sql = "INSERT INTO guestbook (name, message, posted) VALUES (:name, :message, NOW())";
// $handler->query($sql);
$query = $handler->prepare($sql);

$query->execute(array(
  ':name' => $name,
  ':message' => $message
));


class GuestbookEntry {
  public $id, $name, $message, $posted, $entry;
  public function __construct() {
    $this->entry = "{$this->name} posted: {$this->message}";
  }
}

$query = $handler->query('SELECT * FROM guestbook LIMIT 0');

// while($r = $query->fetch()){
//   echo $r['message'], '<br>';
// }

// $r = $query->fetch(PDO::FETCH_OBJ);
// print_r($r);
// echo '<pre>', print_r($r), '</pre>';
/*
while($r = $query->fetch(PDO::FETCH_OBJ)){
  echo $r->message, '<br>'; 
}
*/

$query->setFetchMode(PDO::FETCH_CLASS, 'GuestbookEntry');

// Set fetch mode
/*
while($r = $query->fetch()){
  // echo '<pre>', print_r($r), '</pre>';
  echo $r->entry, '<br>';
}
*/

// echo '<pre>', print_r($query->fetchAll(PDO::FETCH_ASSOC)), '</pre>';

$results = $query->fetchAll(PDO::FETCH_ASSOC);

if(count($results)){
  echo 'There are results';
} else {
  echo 'There are no results';
}