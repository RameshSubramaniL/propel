<?php
include('db.php');

session_destroy();
echo "SESSIO Destroyed";
header("Location: index.php");
exit();

?>