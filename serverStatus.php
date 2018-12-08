#!/usr/bin/php
<?php
//connect
$link = mysqli_connect("192.168.1.10", "dbFail", "password123!", "loginDB");
// check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	exec("gnome-terminal -e /var/www/html/490/Server.php");
    exit();
}
//perform simple query
if ($result = mysqli_query($link, "SELECT 1")) {
    if(mysqli_num_rows($result)) echo "SUCCESS";
    mysqli_free_result($result);
}
//close
mysqli_close($link);
?>
