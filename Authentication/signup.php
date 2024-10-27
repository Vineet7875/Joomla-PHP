<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container Styling */
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #283593;
        }

        /* Input Fields Styling */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px; /* Gap between input fields */
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Submit Button Styling */
        button {
            background-color: #283593;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        button:hover {
            background-color: #4caf50;
        }

        /* Error Message Styling */
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
        <h2>Sign Up</h2>
        <form id="signupForm" action="signupprocess.php" method="POST">
        <input type="text" name="name" placeholder="Name" required value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>">
        <div id="nameError" class="error" style="display: none;"></div> <!-- Error message div for name -->

            <input type="email" name="email" placeholder="Email" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
            <?php
                if (isset($_SESSION['emailvalidate'])) {
                    echo '<div class="error">' . $_SESSION['emailvalidate'] . '</div>';
                    unset($_SESSION['emailvalidate']); // Clear the message after displaying
                }
            ?>
               <div id="emailError" class="error" style="display: none;"></div> <!-- Error message div for email -->


            <input type="password" name="password" placeholder="Password" required value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>">
            <div id="passError" class="error" style="display: none;"></div> <!-- Error message div for name -->

            <button type="submit">Sign Up</button>
            <a href="./login.php" style="display: block; margin-top: 10px;">Already have an account? Login</a>
        </form>
    </div>
</body>
</html>
<script>

document.getElementById('signupForm').addEventListener('submit',function(event)
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
    

    this.submit();  //all conditions satisfy then submit the form

})




</script>