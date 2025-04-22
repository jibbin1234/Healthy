<?php
session_start();
if (isset($_SESSION["Admin"])) {
    header("Location: admin.php");;
} else if (isset($_SESSION["Resident"])) {
    header("Location: resident.php");
} else if (isset($_SESSION["Councilor"])) {
    header("Location: council.php");
} else if (isset($_SESSION["Business"])) {
    header("Location: business.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css">
    <title>LoginPage</title>
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-center">
                <h1 class="form-title">Welcome</h1>
                <p class="subtitle d-flex px-3">Log in to access your account and continue shopping securely</p>
            </div>
            <?php

        ?>
            <!-- Sign In Form -->
            <form class="mt-5" id="loginForm" >
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" placeholder="Enter Email:" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" placeholder="Enter Password:" name="password"  class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                <label for="userType" class="form-label">User type</label>
                <select name="userType" id="userType" class="form-control">
                    <option value="Admin">Admin</option>
                    <option value="Business">Business</option>
                    <option value="Councilor">Councilor</option>
                    <option value="Resident">Resident</option>
                </select>
            </div>              
                <input type="submit" value="Login" name="submit" class="btn btn-success w-100">                
            </form>  
            
            <div class="alert alert-danger" id="alertMessage" hidden> </div>
            
            
            <div class="mt-3 text-center"><p class="mt-2">Don't have an account? <a href="registration.php" class="text-decoration-none">Sign up</a></p>
                </div>          
        </div>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); 
            const formData = new FormData(this);
            formData.append('login', true);
            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const otputElement = document.getElementById('alertMessage');
                otputElement.textContent  = "";
                otputElement.textContent = data;
                otputElement.hidden = false;
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    </script>
</body>
</html>