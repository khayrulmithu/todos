<?php

session_start();

if(!isset($_SESSION['login'])){

    header("location:./login.php");
}
?>


<?php
    include 'database.php';
    $id=$_GET['id'];

    $sql="DELETE FROM todos WHERE id=$id";
    $result=mysqli_query($conn, $sql);

    if($result){
        header("location: ./index.php");
    }

?>