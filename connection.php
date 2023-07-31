<?php
    session_start();
    //Intialize variables
    echo 'Connection Stablished!';

    $name = '';
    $mobileNumber;
    $emailID = '';
    $id ;

    $con = mysqli_connect('localhost', 'root', '', 'PHP_CRUD');

    if(isset($_GET['submit'])){
        // $id = $_GET['id']
        $name = $_GET['Name'];
        $mobileNumber = $_GET['Mobile_No'];
        $emailID = $_GET['Email'];
        $query = "insert into Form(name, mobile_no, email) values('$name', '$mobileNumber', '$emailID')";
        mysqli_query($con, $query);
        header('location: table.php');
    }
   
    $result = mysqli_query($con,"SELECT * From Form");

    //edit 
    


    //update
    if(isset($_POST['update'])){
        $id = $_POST['ID'];
        $name = $_POST['Name'];
        $mobileNumber = $_POST['Mobile_No'];
        $emailID = $_POST['Email'];
        mysqli_query($con, "UPDATE form SET name = '$name', mobileNumber = '$mobileNumber', emailID = '$emailID' WHERE id = $id");

        $_SESSION['message'] = 'Adress Updated';
        header(location: table.php);
    }
?>