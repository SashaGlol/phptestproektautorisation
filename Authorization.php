<?php
session_start();

define('SMARTCAPTCHA_SERVER_KEY', 'ysc2_fE1bxRnvIGBpTZDUNHO3f48lJzjl0ZoYLED1WLJL92c0e0c7');

function check_captcha($token) {
    $ch = curl_init("https://smartcaptcha.yandexcloud.net/validate");
    $args = [
        "secret" => SMARTCAPTCHA_SERVER_KEY,
        "token" => $token,
        //"ip" => "<IP-адрес_пользователя>", // Нужно передать IP-адрес пользователя.
                    // Способ получения IP-адреса пользователя зависит от вашего прокси.
    ];
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_POST, true);    
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch); 
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
        return true;
    }
 
    $resp = json_decode($server_output);
    return $resp->status === "ok";
}

setcookie("textAutorization", 0, time() - 3600);
$loginIs = "null";

if(isset($_POST["login"]) && isset($_POST["password"]))
{
    if(preg_match('/^[\+]?[0-9]{1,3}[\s\-]?[0-9]{3}[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/', $_POST["login"])) $loginIs = "phone";
    if(preg_match('/(@mail.ru)$/', $_POST["login"])) $loginIs = "email";
    if($loginIs != "null")
    {
        include("ConectToBais.php");   
        $query = "SELECT password,login FROM `users` WHERE {$loginIs}='{$_POST["login"]}'";
        $result = mysqli_query($mysqli ,$query);
        $prod = mysqli_fetch_assoc($result);
        
        if (password_verify($_POST['password'], $prod['password']))
        {
            if (check_captcha($_POST['smart-token'])) 
            {   
                $_SESSION['login'] = $prod['login'];
                $_SESSION['password'] = $_POST["password"]; 
                $mysqli->close();
                setcookie("textchengeisdata", "<p style='color: blue'>{$_SESSION["login"]} is data </p>");
                setcookie("textAutorization", 0, time() - 3600);

                setcookie("textlogin", 0, time() - 3600);
                setcookie("textphone", 0, time() - 3600);
                setcookie("textemail", 0, time() - 3600);
                setcookie("textpassword", 0, time() - 3600);

                header('Location: http://d92361h9.beget.tech/PageChangeData.php');
            } 
            else 
            {
                $mysqli->close();
                setcookie("textAutorization", "<p style='color: blue'> Captcha is not correct </p>");
                header('Location: http://d92361h9.beget.tech/');
            } 
        } 
        else 
        {
            $mysqli->close();
            setcookie("textAutorization", "<p style='color: blue'> Password is not correct </p>");
            header('Location: http://d92361h9.beget.tech/');
        }
    }
    else 
    {
        setcookie("textAutorization", "<p style='color: red'> Phone or email is not correct </p>");
        header('Location: http://d92361h9.beget.tech/');
    }
}
else 
{
    setcookie("textAutorization", "<p style='color: red'> Fiedls is empty </p>");
    header('Location: http://d92361h9.beget.tech/');
}



?>