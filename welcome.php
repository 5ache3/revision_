
<?php
include 'connection.php';
$username = isset($_GET['username']) ? $_GET['username'] : '...wait a minute who are you ?' ;

echo "<h1> welcome back ".$username."</h1>";
?>