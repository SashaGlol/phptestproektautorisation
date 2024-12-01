<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
    <div align="center">
        <div align="center" style="width:500px;">
            <form class="Form">
                <h3>Phone or Email</h3>
                <input type="text" class="input-field" name="login" required>
                <p></p> 

                <h3>Password</h3>
                <input type="text" class="input-field" name="password" required> 
                <p></p>

                <div
                id="captcha-container"
                class="smart-captcha"
                data-sitekey="ysc1_fE1bxRnvIGBpTZDUNHO3d5Y0wMNaIsqqocJfiEa6aa0518fc"
                >
                    <input type="hidden" name="smart-token" value="123123123">
                </div>
                <p></p>

                <input type="submit" class="button" value=" Authorization " formaction="Authorization.php" formmethod="POST" />
                <?php printf($_COOKIE["textAutorization"]) ?>
                <p></p>

                <button onclick="{location.href='WindowRegisrtration.php'}"> Regisrtration </button>
                <p></p>
            </form>
        </div>
    </div>    
</body>
</html>