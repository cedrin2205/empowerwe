<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SESSION['user']['role'] !== 'GAS12') {
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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="students.css">
      <title>GAS 12</title>
  </head>
  <body>
    
        <header>

            <div class="profile-strand">
                <img class="profile-img" src="img/blob.jpg">
                <p class="strand">GAS 12</p>
            </div>

            <div class="welcome">
                <p>Welcome,</p>
                <a href="logout.php"><button class="btn">Logout</button></a>
            </div>
        
            
            
        </header>

        <section>

            <div class="folders">

                <div class="folder1-nav">
                    <p class="title">Handouts</p>
                </div>
                
                <hr>
                <div class="teachers-folder">
                    <div class="folder-module1-2">
                        <a href="handout1stud.php"><img class="folder" src="img/folderblue.png"></a>
                        <p class="gulo">Handouts 1-2</p>
                     </div>

                    <div class="folder-module3-4">
                            <a href="handout2stud.php"><img class="folder" src="img/folderblue.png"></a>
                            <p>Handouts 3-4</p>
                     </div>

                    <div class="folder-module5-6">
                        <a href="handout3stud.php"><img class="folder" src="img/folderblue.png"></a>
                        <p>Handouts 5-6</p>
                    </div>
                    
                </div>

                <div class="folder2-nav">
                    <p class="title">handouts that only GAS 12 have</p>
                </div>
                
                <div class="comproghands">
                    <div class="core">
                        <a href="handoutgas12.php"><img class="folder" src="img/folderblue.png"></a>
                        <p>Academic track</p>
                    </div>
                </div>
            </div>
         </section>

         <script src="script.js"></script>
         <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
         <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
             
  </body>
</html>