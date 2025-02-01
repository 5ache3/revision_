<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            
            <p id="errorMessage" class="error"></p>
            <button id="send" type="submit">Register</button>
        </form>
    </div>
    
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirmPassword').value;
            let errorMessage = document.getElementById('errorMessage');
            
            if (password !== confirmPassword) {
                event.preventDefault();
                errorMessage.textContent = 'Passwords do not match!';
                return;
            }
            errorMessage.textContent = '';
        });
    </script>
    
    <?php
    include 'connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($con, $query);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<script>document.getElementById('errorMessage').textContent = 'Username or Email already exists!';</script>";
        } else {
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($con, $query)) {
                echo "<script>alert('Registration successful!');</script>";
                exit();
            } else {
                echo "<script>alert('Error during registration: " . mysqli_error($con) . "');</script>";
            }
        }
    }
    ?>
</body>
</html>
