<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <div class="form_deg">
        <h2>
            <?php          
            //u slučaju kivog unosa pojavljuje se poruka koju uništavamo nakon prikaza
            if (isset($_SESSION['loginMessage'])){
                echo $_SESSION['loginMessage'];
                session_destroy();
            }
            ?>
           </h2>
            <form action="login_check.php" method="POST" class="login_form">
                <label for="" class="label_deg">Username</label>
                <input type="text" name="username"><br><br>

                <label for="" class="label_deg">Password</label>
                <input type="password" name="password"><br>

                <br>
                <input type="submit" value="Login" name="submit">


            </form>
        </div>
    </center>
</body>
</html>