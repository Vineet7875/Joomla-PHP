
 <?php
    session_start();
    require '../Database/config.php';
    if(isset($_GET['id']))
    {
        $id=intval($_GET['id']);
        $sql="select * from employees where id=$id;";
        $result=$conn->query($sql);
        $userdata=$result->fetch_assoc();
    }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: #dc3545; 
            margin-top: 5px;
            font-size: 0.8em; 
            text-align: left;
            margin-bottom: 10px; 
        }
    </style>
</head>
<body>

<div class="form-container">
    <?php
    if(isset($_GET['id'])){
        echo "<h2>Edit Employee</h2>";
    }
    else
    {
        echo "<h2>Add Employee</h2>";
    }
    ?>
    
    <form id="employee-form" action="add_edit_employee_process.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" required value="<?php echo isset($_GET['id']) ? htmlspecialchars($userdata['name']) : (isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''); ?>">

            <div id="nameError" class="error" style="display: none;"></div> <!-- Error message div for name -->
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required value="<?php echo isset($_GET['id']) ? htmlspecialchars($userdata['email']) : (isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''); ?>">

            <div id="emailError" class="error" style="display: none;"></div> <!-- Error message div for email -->
            <?php
                if (isset($_SESSION['emailValidate'])) {
                    echo '<div class="error">' . $_SESSION['emailValidate'] . '</div>';
                    unset($_SESSION['emailValidate']); // Clear the message after displaying
                }
            ?>

        </div>
        <?php
        if (!isset($_GET['id'])) {
            echo '
            <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required value="' . (isset($_GET['id']) ? htmlspecialchars($userdata['password']) : (isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : '')) . '">
            </div>
            <div id="passError" class="error" style="display: none;"></div>
            ';
        }
        ?>


        <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" name="department" required value="<?php echo isset($_GET['id']) ? htmlspecialchars($userdata['department']) : (isset($_SESSION['department']) ? htmlspecialchars($_SESSION['department']) : ''); ?>">

        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <input type="text" name="designation" required value="<?php echo isset($_GET['id']) ? htmlspecialchars($userdata['designation']) : (isset($_SESSION['designation']) ? htmlspecialchars($_SESSION['designation']) : ''); ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="<?php echo isset($_GET['id']) ? 'Update Employee' : 'Add Employee'; ?>">
        </div>
        <input type="hidden" name="user_id" value="<?php echo isset($_GET['id']) ? $userdata['id'] : ''; ?>">
    </form>
</div>

</body>
</html>

<script>
    
document.getElementById('employee-form').addEventListener('submit',function(event)
{
    event.preventDefault(); //helps to do not submit the form untill all validations will pass
    
    //name validation
    //It should contain only alphabets and some special symbols like(',-)
    const name= document.getElementsByName('name')[0].value;
    const namepattern=/^[a-zA-Z\s'-]+$/;
    const nameErrorDiv=document.getElementById('nameError');
    nameErrorDiv.style.display='none';
    nameErrorDiv.textContent='';
    if(!namepattern.test(name))
    {
        console.log("invalid name");
        nameErrorDiv.style.display='block';
        nameErrorDiv.textContent='Enter valid name';
        return 0;
    }

    //Email validation
    //email structure
    const email= document.getElementsByName('email')[0].value;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const emailErrorDiv=document.getElementById('emailError');
    emailErrorDiv.style.display='none';
    emailErrorDiv.textContent='';
    if(!emailPattern.test(email))
    {
        console.log("invalid email");
        emailErrorDiv.style.display='block';
        emailErrorDiv.textContent='Enter valid Email';
        return 0;
    }

    //password validation
    //Password must be between 8 and 20 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.

    //if condtion because for edit option we are not acessing password due to security reasons
    //so for edit it will not excute
    if(!<?php echo isset($_GET['id']) ? 'true' : 'false'; ?>)
    {
        const pass= document.getElementsByName('password')[0].value;
        const passPattern =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,20}$/;
        const passErrorDiv=document.getElementById('passError');
        passErrorDiv.style.display='none';
        passErrorDiv.textContent='';
        if(!passPattern.test(pass))
        {
            console.log("invalid pass");
            passErrorDiv.style.display='block';
            passErrorDiv.textContent='Enter Strong Password';
            return 0;
        }
    }
    

    this.submit();  //all conditions satisfy then submit the form

})
</script>
