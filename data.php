<?php

session_start();

if(!isset($_SESSION['login'])){

    header("location:./login.php");
}
?>

<?php
$title=$_POST['title'];

// echo "Name Is".$name ."Phone Number:".$phone;


include 'database.php';
$name = $_SESSION['username'];
$sql="INSERT INTO todos(username,title)VALUES('$name' ,'$title')";

$result=mysqli_query($conn, $sql);

if($result){
    header("location: ./index.php");
}
else{
    // echo "Sorry We Can't Connect";
}

?>