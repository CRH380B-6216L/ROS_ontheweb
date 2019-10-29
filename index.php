<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ROS on the web</title>        
        <link href="/src/css/main.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <p>
        <?php
        // put your code here
        if (isset($_COOKIE["name"]))
            echo 'Hello, <a href="/mypanel/">' . $_COOKIE["name"] . '</a> | <a href="logout.php">Log out</a>';
        else
            echo "<a href=\"login.php\">Log in</a> | <a href=\"register.php\">Register</a>";
        ?>
        </p>
        <h1>ROS on the web</h1>
        <p> </p>
        <p>PHP 是世界上最好的编程语言！</p>
        <table class="main">
            <tbody>
                <tr><td>
                        

        <?php 
        if (isset($_COOKIE["name"])) {
        echo '<h2>Start your ROS container</h2>
    <form action="run.php" method="post">
      <p>Port ROSWWW: <input type="text" name="portRoswww" value="8000"></p>
      <p>Port ROSBRIDGE: <input type="text" name="portBridge" value="9090"></p>
      <input type="submit" value="docker run">
	</form>';
        } else {
			echo '<h2>login required</h2>
                        <p>You may need to <a href=\"login.php\">login</a> to use ROS on the web.</p>';
		}?>
		        </td></tr>
            </tbody>
        </table>
    </body>
</html>
