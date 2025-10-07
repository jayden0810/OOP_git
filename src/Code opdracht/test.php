<?php
include 'classes/User.php';

$t = new User();
$t->username = "testuser";
$t ->dbConnect();

?>