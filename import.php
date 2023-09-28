<?php
session_start();
?>
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
        .form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
}

input[type="file"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 15%;
}

.btn-container {
    text-align: left;
}

.btn-upload {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-upload:hover {
    background-color: #0056b3;
}
table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <span class="menu-icon" onclick="toggleSidebar()">☰</span>
        <nav>
            <a href="logout_ct.php" name="logout">LogOut</a>
        </nav>
    </header>
    
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="import.php">Import</a></li>
        </ul>
    </div>

    <main>
        <h2>Upload a File</h2>
        <form action="import_ct.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Choose a file:</label>
                <input type="file" id="file" name="file" accept=".csv, .xlsx, .xls" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-upload">Upload</button>
            </div>
        </form>
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
<?php


if (isset($_SESSION['changesCounter'])) 
{
    $changesCounter = $_SESSION['changesCounter'];
    $xy = $_SESSION['xy'];
$newchangesCounter=$_SESSION['newchangesCounter'];
    ?>
    <table border='1'>
    <tr>
        <th>Total rows processed</th>
        <th>New rows Inserted in the database</th>
        <th>Total rows with changes updated in the database</th>
    </tr>
    <tr>
        <td><?php echo $changesCounter; ?></td>
        <td><?php echo $newchangesCounter; ?></td>
        <td><?php echo $xy; ?></td>
    </tr>
</table>
    <?php
    unset($_SESSION['changesCounter']);
    unset($_SESSION['xy']);
    unset($_SESSION['newchangesCounter']);
} 
?>