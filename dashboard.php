<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }

        main {
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            padding-left: 40%;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            height: 100%;
            position: fixed;
            top: 0;
            left: -250px;
            transition: left 0.3s ease-in-out;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
            text-align: center;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <header>
        <span class="menu-icon" onclick="toggleSidebar()">☰</span> <!-- 3 dots menu icon -->
        <h1>Welcome to Dashboard</h1>
        <nav>
            <a href="logout_ct.php" name="logout">LogOut</a>
        </nav>
    </header>

    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="import.php">Import</a></li> <!-- Add your import option here -->
        </ul>
    </div>

    <main>
        <p>WELCOME</p>
    </main>

    <script>
        function toggleSidebar() 
        {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            var sidebar = document.getElementById('sidebar');
            var menuIcon = document.querySelector('.menu-icon');
            
            if (!sidebar.contains(event.target) && event.target !== menuIcon) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>
