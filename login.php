<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <header>
        <h1>Welcome to our website</h1>
        <nav class="styl">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
     <main>
        <div class="form-container">
            <form method="post" action="login_ct.php">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <input type="submit" name="login" value="Login">
            </form>
        <div class="form-container">
    </main>
</body>
</html>
