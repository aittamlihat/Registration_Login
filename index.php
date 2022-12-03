<?php
include_once'db/connect_db.php';
session_start();
if(isset($_POST['btn_login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $select = $pdo->prepare("select * from users  where email='$email' AND password='$password' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($row['email']==$email  AND $row['password']==$password AND $row['role']=="admin"){
        $_SESSION['email']=$row['email'];
        $_SESSION['fname']=$row['fname'];
        $_SESSION['lname']=$row['lname'];
        $_SESSION['institute']=$row['institute'];
        $_SESSION['role']=$row['role'];

        $message = 'success';
        header('refresh:2;dashboard.php');

    }else if($row['email']==$email  AND $row['password']==$password AND $row['role']=="user"){
           $_SESSION['email']=$row['email'];
           $_SESSION['fname']=$row['fname'];
           $_SESSION['lname']=$row['lname'];
           $_SESSION['institute']=$row['institute'];
           $_SESSION['role']=$row['role'];

        $message = 'success';
        header('refresh:2;dashboard.php');
    }else {
        $errormsg = 'error';
    }
}

?>
