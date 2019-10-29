<?php

/* 
 * Below is the mandatory credentials for connecting to your MySQL database.
 * 以下为连接 MySQL 数据库时所必备的凭据。
 * $servername：The server address where your database is stored.
 * $servername：数据库所在服务器的地址。
 * $dbname：The name of your database.
 * $dbname：数据库名称。
 * $dusername：The username using to connect your MySQL server.
 * $dusername：连接 MySQL 数据库的用户名。
 * $dpassword：The password of the username above.
 * $dpassword：该用户名的密码。 
 * 
 * Add code at head of PHP pages that you want to connect to the database:
 * (you can use 'require' to replace 'include' if you want):
 * 在需要访问数据库的 PHP 页面中，添加以下代码
 * （愿意用 require 就自己改掉）：
 * include("db_predential.php");
 *  
 * Then, connect to database with PDO:
 * 然后，使用 PDO 连接数据库：
 * $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
 */

    $servername = "localhost";
    $dbname = "ros_web";
    $dusername = "root";
    $dpassword = "";
    