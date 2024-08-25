<?php 
session_start();
if (isset($_SESSION["email"])) {
    header("location:admin/admin-index.php");
}

include("navbar.php");
include("admin-engine.php");
?>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 400px;
    margin: auto;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h3 {
    font-weight: bold;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #17a2b8;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

a {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>

<div class="container">
    <h3>Admin Login</h3>
    <hr>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" id="pwd" placeholder="Enter password" name="password" required>
        </div>
        <div class="form-group">
            <a href="forgot-password-owner.php">Lost your Password?</a> 
        </div>
        <input type="submit" id="submit" name="admin_login" value="Login">
    </form>
</div>
