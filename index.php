<?php
session_start();

$host = "localhost";
$user = "root";
$username = "";
$password = "";
$mobilenumber = "";
$email = "";
$address = "";
$DataBase = "crud";

$id = 0;
$edit_state = false;

$con = mysqli_connect($host,$user,$password,$DataBase);

//

if (isset($_POST['save'])){

    /*if(preg_match($regex, $_POST['UserName'])){
        $output = "<span> </span>";
    }else{
        $output = "<span> UserName must start with a Capital letter </span>";
    }*/


    $username = $_POST['UserName'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $email = $_POST['Email'];
    $mobilenumber = $_POST['MobileNumber'];
    $address = $_POST['Address'];

    //$hash = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $query = "insert into info1 (UserName,Password,Email,MobileNumber,Address) values ('$username','$password','$email','$mobilenumber','$address')";
    mysqli_query($con,$query);
//--------------validation--------
    $emailquery = " select * from info1 where email = '$email' ";
    $data = mysqli_query($con,$emailquery);

    if ($data){
        ?>
        <script type = "text/javascript" > 
        alert("Data Saved")  </script>
        <?php
    }

    //$_SESSION['message'] = "Data Saved";
    //header('location: index.php');
}

//delete records
if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $query = "delete from info1 where Id = $id";
    $data = mysqli_query($con,$query);

    if ($data){
        ?>
        <script type = "text/javascript" > 
        alert("Data Deleted") </script>
        <?php
    }
    //$_SESSION['message'] = "Data Deleted";
}

//updating records
if(isset($_POST['update'])){
    $username = ($_POST['UserName']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $email = ($_POST['Email']);
    $mobilenumber = ($_POST['MobileNumber']);
    $address = ($_POST['Address']);
    $id = ($_POST['Id']);

    $query = "update info1 set UserName = '$username', Password = '$password', email = '$email', MobileNumber = '$mobilenumber', Address = '$address' where Id = $id" ;
    $data = mysqli_query($con,$query);

    if ($data){
        ?>
        <script type = "text/javascript" > 
        alert("Data Updated") </script>
        <?php
    }
    //$_SESSION['message'] = "Data Updataed";
    //header('location: index.php');
}

//retrive records
$result = mysqli_query($con,"select * from info1");
?>

<?php 
//fetch the records to be updated

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($con, "select * from info1 where Id = $id");
    $record = mysqli_fetch_array($rec);
    $username = $record['UserName'];
    $password = $record['Password'];
    $email = $record['Email'];
    $mobilenumber = $record['MobileNumber'];
    $address = $record['Address'];
    $id = $record['Id'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>  CRUD Operations </title>
    <link rel = 'stylesheet' type="text/css" href="style.css">
</head>
<body>

<?php if (isset($_SESSION['message'])): ?>
            <div class = 'message' > 
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>

<?php endif ?>



    <form action = "index.php" method = "POST" >
    <input type = "hidden" name ="Id" value = "<?php echo $id; ?>" >
        <div class = "input-group">
            <label> User Name </label>
            <input type = "text" Name="UserName" placeholder = "UserName" value = "<?php echo $username; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Password </label>
            <input type = "Password" Name="Password" placeholder = "Password" value = "<?php echo $password; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Email </label>
            <input type = "Email" Name="Email" placeholder = "Email" value = "<?php echo $email; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> MobileNumber </label>
            <input type = "num" Name = "MobileNumber" placeholder = "Mobile Number" value = "<?php echo $mobilenumber; ?>" required > <br><br>
        </div>
        <div class = "input-group">
            <label> Address </label>
            <input type = "text" Name = "Address" placeholder = "Address" value = "<?php echo $address; ?>" required > <br><br>
        </div>
        
        <div class = "input-group">
            <?php if ($edit_state == false): ?>
                <button type = "Submit" name = "save" class = "btn"> Save </button>   
               <!-- <?php if (isset($output)){echo $output;}?>  -->      
            <?php else: ?>
                <button type = "Submit" name = "update" class = "btn"> Update </button>           
            <?php endif ?>


        </div>
    </form>

    

    <table>
        <thead>
            <tr>                
                <th> UserName </th>
                <th> Password </th>
                <th> EmailID </th>
                <th> MobileNumber </th>
                <th> Address </th>       
                <th colspan = "2"> Action </th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['UserName'] ?></td>
                <td><?php echo '*******' ?></td>
                <td><?php echo $row['Email'] ?></td>
                <td><?php echo $row['MobileNumber'] ?></td>
                <td><?php echo $row['Address'] ?></td>
                <td>  <a class = "edit_btn" href = "index.php?edit=<?php echo $row['Id']; ?>" > Edit </a> </td> 
                
                <td> <a class = "del_btn" onclick ="return confirm('Are you sure, you want to delete this data')" href = "index.php?Delete=<?php echo $row['Id']; ?>"> Delete</a> </td> 
                
            </tr>
            <?php } ?>           
        </tbody>    
    </table>
</body>
</html>