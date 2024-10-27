<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px; /* Adjust margin for spacing */
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Error Message Styling */
        .error {
            color: #dc3545; /* Red color for error */
            margin-top: 5px;
            font-size: 0.8em; /* Smaller font size */
            text-align: left; /* Align text to the left */
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
            margin-top: 10px; /* Added margin for spacing above the button */
        }

        button:hover {
            background-color: #4caf50;
        }

        /* Success Message Styling */
        #msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php
        if (isset($_COOKIE['signup_msg'])) {
            echo '<div id="msg">' . $_COOKIE['signup_msg'] . '</div>';
            //  clear the cookie 
            setcookie('signup_msg', '', time() - 3600);
        }
        ?>
        <h2>Log In</h2>
        <form action="login_process.php" method="POST">
            <div>
                <input type="email" name="email" placeholder="Email" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
                <?php
                if (isset($_SESSION['emailvalidate'])) {
                    echo '<div class="error">' . $_SESSION['emailvalidate'] . '</div>';
                    unset($_SESSION['emailvalidate']); // Clear the message after displaying
                }
                ?>
            </div>
            <div style="margin-top: 10px;">
                <input type="password" name="password" placeholder="Password" required value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>">
                <?php
                if (isset($_SESSION['passvalidate'])) {
                    echo '<div class="error">' . $_SESSION['passvalidate'] . '</div>';
                    unset($_SESSION['passvalidate']); // Clear the message after displaying
                }
                ?>
            </div>
            <button type="submit">Log In</button>
            <a href="./signup.php" style="display: block; margin-top: 10px;">Don't have an account? Sign up</a>
        </form>
    </div>
</body>
</html>
<script>
    // Check if there is a message to display
    var msg = document.getElementById('msg');
    if (msg) {
        msg.style.display = 'block'; // Show the message

        // Hide the message after 5 seconds
        setTimeout(function() {
            msg.style.display = 'none';
        }, 5000);
    }
</script>
