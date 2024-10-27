<?php
require './Database/config.php';

session_start();
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Verdana', sans-serif;
            background-color: #f4f4f4;
            color: #444;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #283593;
            color: #fff;
            width: 100%;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            background-color: #4caf50; /* Green background for buttons */
            padding: 10px 15px; /* Padding for button appearance */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        nav ul li a:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        main {
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #283593;
            color: #fff;
        }

        h2 {
            margin-bottom: 20px;
            color: #283593;
        }

        .action-buttons {
            display: flex;
            gap: 10px; /* Space between buttons */
        }

        .action-buttons button {
            background-color: #007bff; /* Blue background for action buttons */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <nav>
            <ul>
                <li><a href="./CRUD/add_edit_employee.php">Add</a></li>
                <li><a href="./LandingPage.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Employee List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- Changed header to Actions -->
                </tr>
            </thead>
            <tbody>
                <!-- Example employee data (replace with your own data) -->
                 <?php
                 $sql1="select * from employees order by id desc;";
                 $result=$conn->query($sql1);
                 $noofrows=$result->num_rows;
                 for($i=1;$i<=$noofrows;$i++)
                 {
                    $employee=$result->fetch_assoc();
                    echo "<tr>";
                    echo "<td>" . $employee['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($employee['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($employee['email']) . "</td>";
                    echo "<td>
                            <div class='action-buttons'>
                                <button style='background-color: green; color: white;' onclick='editEmployee(" . $employee['id'] . ")'>Edit</button>
                                <button style='background-color: red; color: white;' onclick='deleteEmployee(" . $employee['id'] . ")'>Delete</button>
                            </div>
                          </td>";
                    echo "</tr>";
                 }
                 ?>
               
             
            </tbody>
        </table>
    </main>

    <script>
        function editEmployee(id) {
    
            alert("Edit employee with ID: " + id);
            window.location.href="./CRUD/add_edit_employee.php?id="+id;

        }

        function deleteEmployee(id) {

            if (confirm("Are you sure you want to delete employee with ID: " + id + "?")) {
              
                window.location.href="./CRUD/delete.php?id="+id;
            }
        }
    </script>
</body>
</html>
