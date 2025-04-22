<?php
$servername = "217.154.57.199";
$usrnm = "ionos_mysql_user";
$pwd = "ionosmysqlpassword";
$dbname = "healthy_db";
$conn = null;
$conn = mysqli_connect($servername, $usrnm, $pwd, $dbname);
if (!$conn) {
    die("Something went wrong;");
}
