<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");  
    exit();
}
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
} elseif (isset($_GET['error']) && $_GET['error'] === 'emptyfields') {
    echo '<div class="alert alert-danger" role="alert">Please Select A Strand.</div>';
}

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="upload.css">
    <link rel="stylesheet" href="admin.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            position: absolute;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            min-width: 150vh;
            background-color: rgb(255, 216, 216);
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 99;
            background-color: #44b3fd;
            z-index: 99;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.25);
        }

        .logo {
            font-size: 1em;
            font-style: italic;
            user-select: none;
            color: white;
            font-weight: bold;
            background-color: #162938;
            width: 130px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-sidebar {
            display: flex;
            position: absolute;
            flex-direction: column;
            top: 0;
            left: 0;
            bottom: 0;
            width: 200px;
            padding-top: 100px;
            background-color: #67c1fd;
            border: 1px solid gray;
        }

        .profile-picture {
            position: relative;
            height: 100px;
            width: 100px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .left-sidebar p {
            margin: 0;
        }

        .strand {
            font-size: small;
            font-style: italic;
        }

        .panel {
            display: flex;
            flex-direction: column;
            position: relative;
            width: 100%;
        }

        .profile {
            display: flex;
            flex-direction: column;
            position: relative;
            width: 100%;
        }

        .student-info {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .form-box h2 {
            font-size: 50px;
            color: #162938;
            text-align: center;
            font-weight: 600;
        }

        .input-box {
            position: relative;
            width: 100%;
            height: 40px;
            border-bottom: 2px solid #162938;
            margin: 30px 0px;
        }

        .input-box label {
            position: absolute;
            top: -5px;
            left: 5px;
            transform: translateY(-50%);
            font-size: 1em;
            color: #162938;
            font-weight: 500;
            pointer-events: none;
            transition: .5s;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            transition: .5s;
            font-size: 1em;
            color: #162938;
            font-weight: 600;
            padding: 0 35px 0 5px;
        }

        .input-box .icon {
            position: absolute;
            right: 8px;
            font-size: 1.2em;
            color: #162938;
            line-height: 50px;
        }

        .btn {
            width: 100%;
            height: 45px;
            background: #162938;
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            color: white;
            font-weight: 500;
        }
        .notification {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .notification.error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    </style>
</head>
<body>
    <header>
        <h2 class="logo">EmpowerEDU</h2>
        <div class="right-nav">
            <a href="logout.php"><button class="btn">Logout</button></a>
            <a href="registeredusers.php">Users</a>
        </div>
        
    </header>

    <section>
        

        <div class="form-box register">
            <h2>Enter Student's LRN</h2>
            <form action="adminregistrar.php" method="post" onsubmit="return validateForm()">
    <div class="input-box" style="margin-top: 40px;">
        <div class="input-box">
            <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
            <input type="text" name="lrn" id="lrn" required> 
            <label>LRN</label>
        </div>
    </div>
    <div class="input-box">
        <select class="form-select" name="role" id="strand" required> 
            <option selected disabled>Select a Grade Strand</option>
                        <option value="standby">Standby</option>
                        <option value="Humms">Humms11</option>
                        <option value="ABM">ABM11</option>
                        <option value="ICT">ICT11</option>
                        <option value="STEM">STEM11</option>
                        <option value="GAS">GAS11</option>
                        <option value="Humms12">Humms12</option>
                        <option value="ABM12">ABM12</option>
                        <option value="ICT12">ICT12</option>
                        <option value="STEM12">STEM12</option>
                        <option value="GAS12">GAS12</option>
                        <option value="HUMMSteacher12">Humms12teacher</option>
                        <option value="ABMteacher12">ABM12teacher</option>
                        <option value="ICTteacher12">ICT12teacher</option>
                        <option value="STEMteacher12">STEM12teacher</option>
                        <option value="GASteacher12">GAS12teacher</option>
                        <option value="HUMMSteacher">Humms11teacher</option>
                        <option value="ABMteacher">ABM11teacher</option>
                        <option value="ICTteacher">ICT11teacher</option>
                        <option value="STEMteacher">STEM11teacher</option>
                        <option value="GASteacher">GAS11teacher</option>
                        <option value="admin">admin</option>
                        </select>
    </div>
    <button type="submit" value="Register LRN" name="submit" class="btn">Enter</button>
</form>


        </div>
    </section>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
