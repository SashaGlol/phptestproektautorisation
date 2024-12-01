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
            <h3>Name</h3>
            <input type="text" class="input-field" name="login" required>
            <p></p> 
            <?php printf($_COOKIE["textlogin"]) ?>

            <h3>Phone</h3>
            <input type="text" class="input-field" name="phone" required> 
            <p></p>
            <?php printf($_COOKIE["textphone"]) ?>

            <h3>Email</h3>
            <input type="text" class="input-field" name="email" required>
            <p></p> 
            <?php printf($_COOKIE["textemail"]) ?>

            <h3>Password</h3>
            <input type="text" class="input-field" name="password1" required>
            <p></p> 
            <input type="text" class="input-field" name="password2" required> 
            <p></p>
            <?php printf($_COOKIE["textpassword1"]) ?>
            <p></p>

            <input type="submit"  class="button" value=" Registation " formaction="Registration.php" formmethod="POST" />
            <p></p>
        </form>

        <button onclick="{location.href='index.php'}"> Return to authorization </button>
    </div>
</body>
</html>