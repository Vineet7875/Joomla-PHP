<?php
require './Database/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Verdana', sans-serif;
            background-color: #e9f0f5;
            color: #444;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #283593;
            color: #fff;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            flex-wrap: wrap;
        }

        .navbar h1 {
            font-size: 1.6em;
            font-weight: bold;
            color: #ffeb3b;
        }

        .navbar .nav-buttons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .navbar .nav-buttons a {
            text-decoration: none;
            color: #283593;
            background-color: #ffeb3b;
            padding: 10px 18px;
            border-radius: 6px;
            transition: background-color 0.2s ease;
            font-weight: 600;
        }

        .navbar .nav-buttons a:hover {
            background-color: #fbc02d;
        }

        /* Container Styling */
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #283593;
        }

        /* Table Styling */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            min-width: 600px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #283593;
            color: white;
        }

        /* Action Buttons */
        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }

        .edit-btn {
            background-color: #4caf50;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #e91e63;
            cursor: pointer;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }

        .modal-content p {
            margin-bottom: 20px;
            font-size: 1.1em;
            color: #283593;
        }

        .modal-buttons a {
            display: block;
            background-color: #283593;
            color: #ffeb3b;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }

            .navbar .nav-buttons {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .container h2 {
                font-size: 1.4em;
            }

            table {
                font-size: 0.9em;
            }

            .action-btn {
                padding: 4px 8px;
                font-size: 0.9em;
            }
        }

        @media (max-width: 480px) {
            .navbar h1 {
                font-size: 1.4em;
                text-align: center;
                margin-bottom: 10px;
            }

            .container h2 {
                font-size: 1.2em;
            }

            .modal-content {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <h1>Employee Management System</h1>
        <div class="nav-buttons">
            <a href="./CRUD/add_edit_employee.php" id="addEmployee">Add Employee</a>
            <a href="./Authentication/login.php">Login</a>
            <a href="./Athentication/signup.php">Signup</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2>List of Employees</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- employee data -->
                    <?php
                    $sql1 = "SELECT * FROM employees order by id desc;";
                    $result = $conn->query($sql1);
                    $noofrows = $result->num_rows;
                    for ($i = 1; $i <= $noofrows; $i++) {
                        $employee = $result->fetch_assoc();
                        echo "<tr>";
                        echo "<td>" . $employee['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($employee['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($employee['email']) . "</td>";
                        echo "<td>";
                        echo "<a href='./CRUD/add_edit_employee.php?id=" . $employee['id'] . "' onclick='return confirmEdit()' class='action-btn edit-btn'>Edit</a> ";
                        echo "<a href='./CRUD/delete.php?id=" . $employee['id'] . "' onclick='return confirmDelete()' class='action-btn delete-btn'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <p>Please Log In or Sign Up First</p>
            <div class="modal-buttons">
                <a href="./Authentication/login.php">Log In</a>
                <a href="./Authentication/signup.php">Sign Up</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("addEmployee").onclick = function(event) {
            event.preventDefault();
            document.getElementById("loginModal").style.display = "flex";
        };

        document.getElementById("closeModal").onclick = function() {
            document.getElementById("loginModal").style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == document.getElementById("loginModal")) {
                document.getElementById("loginModal").style.display = "none";
            }
        };
        
        function confirmDelete() {
            event.preventDefault();
            document.getElementById("loginModal").style.display = "flex";
        }

        function confirmEdit() {
            event.preventDefault();
            document.getElementById("loginModal").style.display = "flex";
        }
    </script>
</body>
</html>
