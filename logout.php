<html>
    <head>
        <meta charset="UTF-8">
        <link href="src/css/main.css" type="text/css" rel="stylesheet" />
    </head>
<body>
<?php
    setcookie("name","",-2592000);                        
    setcookie("user","",-2592000);
    setcookie("auth","",-2592000);                       
    setcookie("uid","",-2592000);
    echo '<p>Logged out sueecssfully! <a href="index.php">Click here</a> if not directed automatically</p>'
    . '<script Language="JavaScript">window.location.href("index.php");</script>';
    die;
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
?>
</body>
</html>