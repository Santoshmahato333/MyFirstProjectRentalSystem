<?php 
session_start();
if(isset($_SESSION["email"])){
  header("location:index.php");
  exit;
}
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .sign-in-form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .sign-up {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sign-up h3 {
            font-weight: bold;
        }

        .sign-up button {
            width: 200px;
            padding: 10px;
            margin: 10px;
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .sign-up button:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
    <section class="container sign-in-form-section">
        <div class="sign-up">
            <h3>How do you want to Register?</h3>
            <hr>
            <p>If you want to register as a tenant click on tenant register button otherwise click on owner register button.</p>
            <br><br>
            <button onclick="window.location.href='tenant-register.php'">Tenant Register</button>
            <button onclick="window.location.href='owner-register.php'">Owner Register</button>
        </div>
    </section>
</body>
</html>
