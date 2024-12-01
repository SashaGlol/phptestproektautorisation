<?php
    ob_start();
    $allIsOk = true;

    setcookie("textlogin", 0, time() - 3600);
    setcookie("textphone", 0, time() - 3600);
    setcookie("textemail", 0, time() - 3600);
    setcookie("textpassword1", 0, time() - 3600);

    // Name
    if(!(isset($_POST["login"])))
    {
        setcookie("textlogin", "<p style='color: red'> Fiedl is empty </p>");
        $allIsOk = false;
    }
    else  setcookie("textlogin", "<p style='color: green'> ok </p>");

    // Phone
    if(!(isset($_POST["phone"])))
    {
        setcookie("textphone", "<p style='color: red'> Fiedl is empty </p>");
        $allIsOk = false;
    }   //  '/^[\+]?[0-9]{11}$/'
    elseif (!preg_match('/^[\+]?[0-9]{1,3}[\s\-]?[0-9]{3}[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/', $_POST["phone"]))
    {
        setcookie("textphone", "<p style='color: red'> Phone is not correct </p>");
        $allIsOk = false;
    }
    else setcookie("textphone", "<p style='color: green'> ok </p>");

    // Email
    if(!(isset($_POST["email"])))
    {
        setcookie("textemail", "<p style='color: red'> Fiedl is empty </p>");
        $allIsOk = false;
    }
    elseif (!preg_match('/(@mail.ru)$/', $_POST["email"]))
    {
        setcookie("textemail","<p style='color: red'> Email is not correct </p>"  );
        $allIsOk = false;
    }
    else setcookie("textemail", "<p style='color: green'> ok </p>");
    
    // Password
    if(!(isset($_POST["password1"])))
    {
        setcookie("textpassword1", "<p style='color: red'> Fiedl is empty </p>");
        $allIsOk = false;
    }
    elseif(!(isset($_POST["password2"])))
    {
        setcookie("textpassword2", "<p style='color: red'> Fiedl is empty </p>");
        $allIsOk = false;
    }
    elseif($_POST["password1"] != $_POST["password2"])
    {
        setcookie("textpassword1", "<p style='color: red'> Passwords do not match </p>");
        $allIsOk = false;
    }
    else 
    {
        setcookie("textpassword1", "<p style='color: green'> ok </p>");
    }

    // check only (login, phone, email)   
    if($allIsOk)
    {
        $login = $_POST["login"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        // login   
        include("ConectToBais.php");                                           
        $request = "SELECT login FROM `users` WHERE login = '{$_POST["login"]}'";
        $result = mysqli_query($mysqli ,$request);
        $prod = mysqli_fetch_assoc($result);
        if($prod['login'] !=  null) 
        {
            setcookie("textlogin", "<p style='color: red'> {$prod['login']} This login is allready use </p>"); 
            $allIsOk = false;
        }
        else setcookie("textlogin", "<p style='color: green'> ok </p>");
        $mysqli->close();

        //phone
        include("ConectToBais.php");                                           
        $request = "SELECT phone FROM `users` WHERE phone = '{$_POST["phone"]}'";
        $result = mysqli_query($mysqli ,$request);
        $prod = mysqli_fetch_assoc($result);
        if($prod['phone'] !=  null) 
        {
            setcookie("textphone", "<p style='color: red'> {$prod['phone']} This phone is allready use</p>"); 
            $allIsOk = false;
        }
        else setcookie("textphone", "<p style='color: green'> ok </p>");
        $mysqli->close();

        // email
        include("ConectToBais.php");                                           
        $request = "SELECT email FROM `users` WHERE email = '{$_POST["email"]}'";
        $result = mysqli_query($mysqli ,$request);
        $prod = mysqli_fetch_assoc($result);
        if($prod['email'] !=  null) 
        {
            setcookie("textemail", "<p style='color: red'> {$prod['email']} This email is allready use </p>"); 
            $allIsOk = false;
        }
        else setcookie("textemail", "<p style='color: green'> ok </p>");
        $mysqli->close();
        
    }

    if($allIsOk)
    {
        include("ConectToBais.php");     
        $passwordHash = password_hash($password1, PASSWORD_DEFAULT);
        if(password_verify($password1, $passwordHash)) setcookie("textAutorization", "<p style='color: grine'> Password is correct </p>");
        
        $request = "INSERT INTO `users` (`email`, `phone`, `login`, `password`) VALUES ('$email', '$phone','$login','$passwordHash')";
        $result = mysqli_query($mysqli ,$request);
        $mysqli->close();

        setcookie("textlogin", 0, time() - 3600);
        setcookie("textphone", 0, time() - 3600);
        setcookie("textemail", 0, time() - 3600);
        setcookie("textpassword1", 0, time() - 3600);
        setcookie("textpassword2", 0, time() - 3600);

        header('Location: http://d92361h9.beget.tech/index.php');  
    }
    else
    {
        header('Location: http://d92361h9.beget.tech/WindowRegisrtration.php');
    }


?>