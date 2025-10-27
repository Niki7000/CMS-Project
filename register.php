<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="images/file.svg">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <input type="hidden" name="register">
            <input type="text" name="name" class="form-input" placeholder="Full Name" required>
            <input type="email" name="email" class="form-input" placeholder="Email" required>
            <input type="password" name="password" class="form-input" placeholder="Password" required>
            <input type="password" name="confirmPassword" class="form-input" placeholder="Confirm Password" required>

            <select name="role" class="form-input" onchange="verifyAdmin()" required>
                <option value="" disabled selected>Select Role</option>
                <option value="editor">Editor</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
        <p>Or continue as <a href="home.php">Guest</a></p>
    </div>

    <script>
        function verifyAdmin()
        {
            let option = document.getElementsByName("role")[0].value;
            if(option == "admin")
            {
            let password = prompt("Enter the admin password: (adminadmin)");
            if(password !== "adminadmin")
                {
                    alert("Wrong password");
                    window.location.reload();
                }
            } 
        }
    </script>

</body>

</html>