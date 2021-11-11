<?php
include "header.php";
include "config.php";

$temp_id = "";
$temp_username = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //temporary id for next validation
    $temp_id = $id;

    // get the user from db 
    $sql = "SELECT * FROM user WHERE user_id = {$id}";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $temp_username = $user['username'];
    }
}

// Update Users
if (isset($_POST['update'])) {

    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username =  mysqli_real_escape_string($conn, $_POST['username']);
    // $password =  mysqli_real_escape_string($conn, md5($_POST['password']));
    $role =  mysqli_real_escape_string($conn, $_POST['role']);


        //update the users
        $sql1 = "UPDATE user SET first_name='{$fname}',last_name='{$lname}',username='{$username}',role={$role} WHERE user_id = {$userid}";
        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
        if ($result1) {
            //if success then redirect to users page 
            header("Location: {$host}admin/users.php");
        }else{
            die("Query Failed");
        }
}



?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id'];  ?>" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $user['first_name'];  ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $user['last_name'];  ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option <?php echo $user['role'] == 0 ? "selected" : "";  ?> value="0">Normal</option>
                            <option <?php echo $user['role'] == 1 ? "selected" : "";  ?> value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>