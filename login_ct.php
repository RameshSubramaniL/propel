<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) 
{
    
    $username = $_POST["username"];
    $password = trim($_POST["password"]);

    $sql = "select username,password from login_details where username='".$username."'";
    $res = $conn->query($sql);
    $data = $res->fetch_assoc();

    $db_pass = $data['password'];

    if ($res->num_rows == 1) 
    {
        if (password_verify($password,$db_pass))
        {
            session_start();
            
            header("Location: dashboard.php");
            exit();
        } else 
        {
           echo $error_message = "Invalid password";
        }
    } else 
    {
       echo $error_message = "Invalid username";
    }
}

?>
