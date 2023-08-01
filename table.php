<?php
    include 'connection.php';
    //for edit button
    if(isset($_GET['edit'])){
        $editId  = $_GET['edit'];
        $update = true;
        $record = mysqli_query($con, "SELECT * from form where id = $editId");

        if(mysqli_num_rows($record) == 1){
            $n = mysqli_fetch_array($record);
            $name = $n['Name'];
            $mobileNumber = $n['Mobile_No'];
            $emailID = $n['Email'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
    <div class="conatiner">
    <?php if(isset($_SESSION['message'])): ?>
        <div class=" alert alert-success ms-5 me-5 text-center">
            <?php
                echo $_SESSION['message'];
                unset ($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    </div>
    <div class="container card p-3 mt-2">
        <form action = "connection.php" method = "POST">
            <input type="hidden" name="id" value = "<?php echo $editId; ?>" >
            <div class="item">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo isset($_GET['edit'])?$name:''?>">
            </div>
            <div class="item">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input type="number" name="mobileNumber" class="form-control" id="phoneNumber" value="<?php echo isset($_GET['edit'])?$mobileNumber:''?>">
            </div>
            <div class="item">
              <label for="exampleInputEmail" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo isset($_GET['edit'])?$emailID:''?>">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="item">
              <label for="exampleInputPassword" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword">
            </div>
            <div class="item form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck" required>
              <label class="form-check-label" for="exampleCheck">Check me out</label>
            </div>
            <div class="item">
                <?php if(isset($_GET['edit'])){if($update==true){ ?>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>

                <?php }}else { ?>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <?php  }?>
            </div>
          </form>
    </div>

    <div class="container card p-2 mt-2" >
        <table class="table">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Email ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while($row  = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Mobile_No']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td>
                    <button type="button" class="btn btn-primary text-light" >
                    <a href="table.php?edit=<?php echo $row['ID']; ?>" class="link-Success">Edit</a>
                    </button>
                    <button type="button" class="btn btn-danger text-light">
                    <a href="connection.php?delete=<?php echo $row['ID']; ?>" class="link-Success">Delete</a>
                    </button> 
                </td>
            </tr>
             <?php } ?>
        </table>
    </div>
    
</body>
</html>