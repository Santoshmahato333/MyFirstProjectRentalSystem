<?php 
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-weight: bold;
            text-align: center;
        }

        hr {
            margin: 20px 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #138496;
        }

        .text-right {
            text-align: right;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Owner Register</h3><hr><br>
    <form method="POST" action="owner-engine.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" placeholder="Enter Full Name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter Email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password1">Password:</label>
            <input type="password" id="password1" placeholder="Enter Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password2">Confirm Password:</label>
            <input type="password" id="password2" placeholder="Enter Password Again" required>
        </div>
        <div class="form-group">
            <label for="phone_no">Phone No.:</label>
            <input type="text" id="phone_no" placeholder="Enter Phone No." name="phone_no" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" placeholder="Enter Address" name="address" required>
        </div>
        <div class="form-group">
            <label for="id_type">Type of ID:</label>
            <select name="id_type" required>
                <option>Citizenship</option>
                <option>Driving Licence</option>
            </select>
        </div>
        <div class="form-group">
            <label for="card_photo">Upload your Selected Card:</label>
            <input type="file" placeholder="Upload id photo" name="id_photo" accept="image/*" onchange="preview_image(event)" required>
        </div>
        <div class="form-group">
            <label>Your selected File:</label><br>
            <img src="" id="output_image" height="200px">
        </div>
        <hr>
        <center><button id="submit" name="owner_register" onclick="return Validate()">Register</button></center><br>
        <div class="form-group text-right">
            <label>Register as a <a href="tenant-register.php">Tenant</a>?</label><br>
        </div><br><br>
    </form>
</div>

<script type='text/javascript'>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password1").value;
        var confirmPassword = document.getElementById("password2").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
</body>
</html>
