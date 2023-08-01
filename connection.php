<?php
    session_start();
    //Intialize variables
    echo 'Connection Stablished!';

    $name = '';
    $mobileNumber;
    $emailID = '';
    $id ;

    $con = mysqli_connect('localhost', 'root', '', 'php_CRUD');

    if(isset($_POST['submit'])){
        // $id = $_GET['id']
        $name = $_POST['name'];
        $mobileNumber = $_POST['mobileNumber'];
        $emailID = $_POST['email'];
        $query = "INSERT into Form (name, mobile_no, email) values ('$name', '$mobileNumber', '$emailID')";
        $ans = mysqli_query($con, $query);
        header('Location: table.php');
        
        if($ans){
            echo "No error";  
        }
        else{
            echo "Error hai";
        }  
    }

    $result = mysqli_query($con,"SELECT * From Form");
    if($result){
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else{
        echo "Table couldn't fetch";
    }

    //for edit button
    if(isset($_GET['edit'])){
        $editId  = $_GET['edit'];
        $update = true;
        $record = mysqli_query($con, "SELECT * from form where id = $editId");

        if(mysqli_num_rows($record) == 1){
            //it will fetch when edit is clicked;
            $n = mysqli_fetch_array($record);
            $name = $n['Name'];
            $mobileNumber = $n['Mobile_No'];
            $emailID = $n['Email'];
        }
        echo $emailID;
    }


    //update
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $mobileNumber = $_POST['mobileNumber'];
        $emailID = $_POST['email'];
        mysqli_query($con, "UPDATE form SET name = '$name', mobile_no = '$mobileNumber', email = '$emailID' WHERE ID = '$id' ");
        $_SESSION['message'] = 'Adress Updated';
        header('Location: table.php');
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        mysqli_query($con, "DELETE FROM form WHERE id = $id");
        $_SESSION['message']='Data Deleted';
        header('Location: table.php');

    }
?>