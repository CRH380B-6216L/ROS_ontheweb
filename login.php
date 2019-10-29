<html>
<head>
    <title>登录 - Console PHP</title>
    <link href="src/css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <?php
    $email = $password = "";
    $errMessage = "　";
    $previous = $_SERVER["HTTP_REFERER"];
    if (isset($_GET['redirect'])) $errMessage = "You need to login before access the page!";    
    if (isset($_GET['previous'])) $previous = "http://".$_SERVER['HTTP_HOST'].$_GET['previous'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
	$validate = true;
        if (empty($_POST["password"])) 
        {
            $errMessage = "Please enter password!";
            $validate = false;
        } else {
            $password = md5($_POST["password"]);
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
                $email = "";
		$validate = false;
            }
        }
		
        if ($validate == true)
        {
            try
            {
		include("/functions/db_predential.php");
			
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
			
		$sqlfind = "SELECT id, password, fullName FROM users WHERE email = '$email'";
			
		$found = false;
				
		foreach ($conn->query($sqlfind) as $row)
		{
                    $found = true;
                    if ($row['password'] != $password)
                    {
                        $errMessage = "Password Incorrect";
                    }
                    else
                    {
                        $name = $row['fullName'];
                        $length = 0;
                        if (!empty($_POST["remember"])) $length = time()+2592000;
                        setcookie("name",$name,$length);                        
                        setcookie("user",$email,$length);                                               
                        setcookie("uid",$row['id'],$length);
                        setcookie("auth",true);
                        echo '<p>Logged in successfully! <a href="' . $previous . '">Click here</a> if not directed automatically</p>'
                        . '<script Language="JavaScript">window.location.href("' . $previous . '");</script>';
                        die;
                    }
		}
				
		if (!$found)
		{
		    $errMessage = "User does not exist!";
		}					
	    }
	    catch(PDOException $e)
	    {
		$errMessage =  $e->getMessage();
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
    <h1>Login ROS on the web</h1>
    <p> </p>
    <p style="color:red"><?php echo $errMessage;?></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
        <p>Email: <input style="width:180px" type="text" name="email" maxlength="64" value="<?php echo $email;?>"/></p>
        <p>Password: <input style="width:180px" type="password" name="password" maxlength="32" /></p>
        <p><input  type="checkbox" name="remember" value="yes"/>Remember me (for 30 days)</p>
        <input type="submit" name="login" value="Log in" />
    </form>
    <p>　</p>
    <a href="register.php">Create account</a><br /><br />
    <a href="password.php">Forgot password?</a>
</body>
</html>