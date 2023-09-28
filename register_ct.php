<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["username"];
    $password = trim($_POST["password"]);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "insert into login_details(username,password)values('".$username."','".$hashed_password."')";
    $qry = $conn->query($sql);

    if($qry)
    {
        header("Location: index.php");
        exit();
    }
    else
    {
        "<alert>User Registeration Failed!!!</alert>";
    }
}


?>
