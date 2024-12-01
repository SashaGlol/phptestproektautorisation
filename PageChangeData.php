<?php 
session_start(); 

include("ConectToBais.php");  
$query = "SELECT * FROM `users` WHERE login = '{$_SESSION["login"]}'";
$result = mysqli_query($mysqli ,$query);
$prod = mysqli_fetch_assoc($result);

$_SESSION["phone"] = $prod["phone"];
$_SESSION["email"] = $prod["email"];
$mysqli->close();

setcookie("textchengeisdata", "<p style='color: blue'> {$_SESSION["login"]} data </p>");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div align="center">
        <form class="Form">
            <?php printf($_COOKIE["textchengeisdata"]) ?>
            
            <h3>Name</h3>
            <input type="text" class="input-field" name="login" value="<?php session_start(); echo $_SESSION["login"] ?>" required>
            <?php printf($_COOKIE["textlogin"]) ?>

            <h3>Phone</h3>
            <input type="text" class="input-field" name="phone" value="<?php session_start(); echo $_SESSION["phone"] ?>" required> 
            <?php printf($_COOKIE["textphone"]) ?>

            <h3>Email</h3>
            <input type="text" class="input-field" name="email" value="<?php session_start(); echo $_SESSION["email"] ?>" required> 
            <?php printf($_COOKIE["textemail"]) ?>

            <h3>Password</h3>
            <input type="text" class="input-field" name="password" value="<?php session_start(); echo $_SESSION["password"] ?>" required> 
            <?php printf($_COOKIE["textpassword"]) ?>
            <p></p>

            <input type="submit" class="button" value=" Change " formaction="ChangeData.php" formmethod="POST" />
            <p></p>
        </form>

        <button onclick="{location.href='index.php'}"> Return to authorization </button>
    </div>
</body>
</html>