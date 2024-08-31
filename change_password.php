<?php
include 'connect.php';
include 'header.php'; 


$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM user_reg WHERE id = $user_id";
$user_data = $con->query($query);
$user_row = mysqli_fetch_assoc($user_data);

if(isset($_POST['pass'])){
    
    $hide_password = $_POST['hide_password'];
    $hide_uidser_hide = $_POST['hide_uidser_hide'];
    
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if($hide_password != $current_pass){
        $message[]='Incorrect Current Password..!';
    }
    else{
        if($new_pass !== $confirm_pass){
            $message[] = 'Confirm Password do not match..!';
        }
        else
        {
            echo $new_pass;
            echo $confirm_pass;
            $q=mysqli_query($con,"UPDATE user_reg SET `password`='$new_pass' WHERE `id`='$hide_uidser_hide'")
            or die('Qurey Failed');
            if($q)
            {
                $message[]='Password Changed Successfully';
            }
            else
            {
                $message[]='Password Not Changed..!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="content">
        <h2>Change Password</h2>
        <?php
                        if(isset($message))
                        {
                            foreach($message as $message)
                            {
                                echo'<div class="message">'.$message.'</div>';
                            }
                        }
                        if(isset($confirm))
                        {
                            foreach($confirm as $confirm)
                            {
                                echo'<div class="confirm">'.$confirm.'</div>';
                            }
                        }
                        
            ?>
        <form action="change_password.php" method="POST">
      
        <input type="hidden" name="hide_uidser_hide" value="<?php echo $user_row['id']?>">
            <div class="form-group">
                <label>Current Password:</label>
                <input type="password" name="current_password" required>
            </div>
            
            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="new_password">
            </div>
            
            <div class="form-group">
                <label>Confirm New Password:</label>
                <input type="password" name="confirm_password">
            </div>
            
            <button type="submit" name="pass">Change Password</button>
        </form>
    </main>
</body>
</html>
