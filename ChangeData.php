<?php
    session_start();
    setcookie("textlogin", 0, time() - 3600);
    setcookie("textphone", 0, time() - 3600);
    setcookie("textemail", 0, time() - 3600);
    setcookie("textpassword", 0, time() - 3600);

    // login
    if($_POST["login"] != $_SESSION["login"])
    {
        if(isset($_POST["login"]))
        {
            include("ConectToBais.php");                                           
            $request = "SELECT login FROM `users` WHERE login = '{$_POST["login"]}'";
            $result = mysqli_query($mysqli ,$request);
            $prod = mysqli_fetch_assoc($result);
            $login1 = $prod['login'];
            $mysqli->close();

            if($login1 ==  null) 
            {
                include("ConectToBais.php");     
                $request = "UPDATE `users` SET login = '{$_POST["login"]}' WHERE login = '{$_SESSION["login"]}'";
                $result = mysqli_query($mysqli ,$request);
                $mysqli->close();
                $_SESSION["login"] = $_POST["login"];
                setcookie("textlogin", "<p style='color: green'> Fiedl was change </p>");
                setcookie("textchengeisdata", "<p style='color: blue'> {$_SESSION["login"]} data </p>");
            }
            else setcookie("textlogin", "<p style='color: red'> $login1 This login is allready use </p>"); 
        }
        else  setcookie("textlogin", "<p style='color: red'> Fiedl is empty </p>");
    }
    else setcookie("textlogin", 0, time() - 3600);

    // Phone
    if($_POST["phone"] != $_SESSION["phone"])
    {
        if (isset($_POST["phone"]) && preg_match('/^[\+]?[0-9]{1,3}[\s\-]?[0-9]{3}[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/', $_POST["phone"]))
        {
            include("ConectToBais.php");                                           
            $request = "SELECT phone FROM `users` WHERE phone = '{$_POST["phone"]}'";
            $result = mysqli_query($mysqli ,$request);
            $prod = mysqli_fetch_assoc($result);
            $phone1 = $prod['phone'];
            $mysqli->close();

            if($phone1 == null) 
            {
                include("ConectToBais.php");     
                $request = "UPDATE `users` SET phone = '{$_POST["phone"]}' WHERE login = '{$_SESSION["login"]}'";
                $result = mysqli_query($mysqli ,$request);
                $mysqli->close();
                $_SESSION["phone"] = $_POST["phone"];
                setcookie("textphone", "<p style='color: green'> Fiedl was change </p>");
            }
            else setcookie("textphone", "<p style='color: red'> $phone1 This phone is allready use</p>");
        }
        else setcookie("textphone", "<p style='color: red'> Phone is not correct </p>");
    }
    else setcookie("textphone", 0, time() - 3600);
    
    // Email
    if($_POST["email"] != $_SESSION["email"])
    {
        if (isset($_POST["email"]) && preg_match('/(@mail.ru)$/', $_POST["email"]))
        {
            include("ConectToBais.php");                                           
            $request = "SELECT email FROM `users` WHERE email = '{$_POST["email"]}'";
            $result = mysqli_query($mysqli ,$request);
            $prod = mysqli_fetch_assoc($result);
            $email1 = $prod['email'];
            $mysqli->close();

            if($email1 == null) 
            {
                include("ConectToBais.php");     
                $request = "UPDATE `users` SET email = '{$_POST["email"]}' WHERE login = '{$_SESSION["login"]}'";
                $result = mysqli_query($mysqli ,$request);
                $mysqli->close();
                $_SESSION["email"] = $_POST["email"];
                setcookie("textemail", "<p style='color: green'> Fiedl was change </p>");
            }
            else setcookie("textemail", "<p style='color: red'> $email1 This email is allready use </p>"); 
        }
        else setcookie("textemail","<p style='color: red'> Email is not correct </p>");
    }
    else setcookie("textemail", 0, time() - 3600);

    // Password
    if($_POST["password"] != $_SESSION["password"])
    {
        if(isset($_POST["password"]))
        {
            $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            include("ConectToBais.php");     
            $request = "UPDATE `users` SET password = '$passwordHash' WHERE login = '{$_SESSION["login"]}'";
            $result = mysqli_query($mysqli ,$request);
            $mysqli->close();
            $_SESSION["password"] = $_POST["password"];
            setcookie("textpassword", "<p style='color: green'> Fiedl was change </p>");
        }
        else setcookie("textpassword", "<p style='color: red'> Fiedl is empty </p>");
    }
    else setcookie("textpassword", 0, time() - 3600);

    header('Location: http://d92361h9.beget.tech/PageChangeData.php');
?>

