<?php

define("db_hostname","localhost");
define("db_username","root");
define("db_password","");
define("db_name","crud");

$conn = mysqli_connect(db_hostname, db_username, db_password, db_name);

// if($conn){
//     echo "connected";
// }else{
//     echo "not connected";
// }


?>