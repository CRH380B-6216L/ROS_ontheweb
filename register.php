<html>
<head>
    <title>注册新账户 - Console PHP</title>
    <link href="/src/css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <?php
    $email = $name = $pwd = $pwd2 = $password = "";
    $errMessage = "　";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
	$validate = true;	
       
	if (levenshtein($_POST["password"], $_POST["password2"]) != 0) 
        {
            $errMessage = "The passwords are not same!";
	    $validate = false;
            $pwd = $pwd2 = "";
        }
		
	if (empty($_POST["password2"])) 
        {
            $errMessage = "Please enter password again!";
	    $validate = false;
            $pwd = $_POST["password"];
        }
		
        if (empty($_POST["password"])) 
        {
            $errMessage = "Please enter password!";
	    $validate = false;
        } else {
            $password = md5($_POST["password"]);
        }

	if (empty(test_input($_POST["name"]))) 
        {
            $errMessage = "Please enter your name!";
	    $validate = false;
        }
        else 
        {
            $name = test_input($_POST["name"]);
        }
		
        if (empty($_POST["email"])) 
        {
            $errMessage = "Please enter your email!";
	    $validate = false;
        }
        else 
        {
            $email = test_input($_POST["email"]);
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) 
            {
                $errMessage = "Email invalid!";
		$validate = false;
                $email = "";
            }
        }
		
        if ($validate == true)
        {
            try
            {
                include("/functions/db_predential.php");
            
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
                
                $sqlfind = "SELECT COUNT(*) FROM users WHERE email = '$email'";
                
                $validate_email = $conn->query($sqlfind);
                $hasRegistered = $validate_email->fetchColumn();
                
                if ($hasRegistered > 0)
                {
                    $errMessage = "This Email is already registered!";
                    $email = "";
                }
                else
                {
                    $time = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO users (fullName, password, email, dateJoined) VALUES ('$name', '$password', '$email', '$time')";
                    try
                    //$conn = null;
                    {
                        $count = $conn->exec($sql);
                        if ($count == 1)
                        {
                            setcookie("name",$name);                        
                            setcookie("user",$email);
                            setcookie("auth",true);
                            send_email($email, $name);
                            $sqlfind2 = "SELECT id FROM users WHERE email = '$email'";
                            foreach ($conn->query($sqlfind) as $row)
                            {                                          
                                setcookie("uid",$row['id']);                                
                            }
                            echo '<p>Successfully registered! <a href="index.php">Click here</a> if not directed automatically</p>'
                               . '<script Language="JavaScript">window.location.href("index.php");</script>';
                            die;
                        }
                        else 
                        {
                            $errMessage = "Registration failed due to SQL Error!";
                            $pwd = $pwd2 = $_POST["password"];
                        }
                    }
                    catch(PDOException $ex)
                    {
                        $errMessage =  $ex->getMessage();
                    }
                }
            } 
            catch (PDOException $e) 
            {
                $errMessage = $e->getMessage();
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <p>　</p>
    <h1>Register ROS on the web</h1>
    <p> </p>
    <p style="color:red"><?php echo $errMessage;?></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>Email: <br><input style="width:180px" type="text" name="email" maxlength="64" value="<?php echo $email;?>"/></p>
        <p>Name: <br><input style="width:180px" type="text" name="name" maxlength="32" value="<?php echo $name;?>"/></p>
        <p>Password: <br><input style="width:180px" type="password" name="password" maxlength="32" value="<?php echo $pwd;?>"/></p>
        <p>Confirm password: <br><input style="width:180px" type="password" name="password2" maxlength="32" value="<?php echo $pwd2;?>"/></p>
        <input type="submit" name="register" value="Register" />
    </form>
    <p>　</p>
    <a href="login.php">Login with an account</a><br /><br />
    <a href="password.php">Forgot password?</a>
</body>
</html>