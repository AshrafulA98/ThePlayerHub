<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "theplayerhub";

$conn = mysqli_connect($serverName, $userName, $password, $dataBaseName);

if($conn){
    // echo "Connected";
}else{
    ?>
    <script type="text/javascript">
        alert("Failed to connect the Database");
    </script>
    <?php
}


?>