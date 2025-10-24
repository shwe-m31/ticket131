<?php
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='';
    $DATABASE='flexigo';
    $con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);
    if($con){
       // echo "connection successfully";
    }
    else{
        die(mysqli_error($con));
    }
?>