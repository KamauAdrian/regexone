<?php
$user_err=$phone_err=$email_err="";
$user_name= $user_phone=$user_email= $success="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if (empty($_POST['user'])){
    $user_err='Name required';
}else{
$user_name=$_POST['user'];
if (!preg_match("/^[a-zA-z0-9 \s]+$/", $user_name)){
    $user_err='Name can only contain letters or numbers';
}
if(strlen($user_name) <=4){
    $user_err='Name too short';
}
}
if (empty($_POST['phone'])){
    $phone_err='Phone number required';
}else{
    $user_phone=$_POST['phone'];
    // mobile number mask +254 797 938 403
    if (!preg_match("/^\d{9}?[0-9]$/", $user_phone)){
$phone_err='Enter a Valid number';
    }
}
if (empty($_POST['mail'])){
    $email_err='Email required';
}else{
    $user_email=$_POST['mail'];
    if (filter_var($user_email, FILTER_VALIDATE_EMAIL) == false){
        $email_err='invalid email address';
    }

}
if (empty($user_err) && empty($phone_err) && empty($email_err)){
        include 'connection.php';
        $result=mysqli_query($connection,"INSERT INTO regexm VALUES ('','$user_name','$user_phone','$user_email')");
        if ($result){
            $success='Registered Successfully';
            $user_name= '';
            $user_phone= '';
            $user_email= '';

        }else{
            $success='Registration Failed please try again';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>regex</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        #message{
            color: green;
        }
        .error{
           color: red;
        }
    </style>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"/>
<div class="form-group">
    <label for="user" class="col-sm-2">User Name</label>
    <div class="">
        <input type="text"id="user" name="user" placeholder="name" value="<?php echo htmlspecialchars($user_name)?>"/>
    </div>
    <span class="error"><?php echo $user_err;?></span><br /><br />
</div>
    <input type="text" id="phone" name="phone" placeholder="phone" value="<?php echo htmlspecialchars($user_phone)?>"/>
<span class="error"><?php echo $phone_err;?></span><br /><br />
    <input type="text" id="mail"  name="mail" placeholder="email" value="<?php echo htmlspecialchars($user_email)?>"/>
<span class="error"><?php echo $email_err;?></span><br /><br />
    <input type="submit" id="register" name="register" value="register"/><span id="message"><?php echo $success;?></span>
</form>
<script  type="text/javascript" src="js/bootstrap.js"></script>
<script  type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
<?php
//if (isset($_POST['register'])){
//    $user_name=$_POST['user'];
//    $user_phone=$_POST['phone'];
//    $user_mail=$_POST['mail'];
//
//    if (!empty($user_name) && !empty($user_phone) && !empty($user_mail)) {
//        if (!preg_match("/^[a-zA-Z0-9 \s]+$/", $user_name)) {
//            $message = 'Name can  only contain letters or numbers';
//            echo $message;
//            if (!preg_match("/^\d{4}[-.\s]?\d{3}[-.\s]?\d[3]/", $user_phone)) {
//                $message = 'Enter a valid Phone number';
//                echo $message;
//            }
//            if (filter_var($user_mail, FILTER_VALIDATE_EMAIL) == false) {
//                echo 'Enter a valid email address';
//            }
//
//        }
//        else {
//            include 'connection.php';
//            $result = mysqli_query($connection, "SELECT * FROM regexm WHERE phone=$user_phone");
//            if ($result) {
//                $message = 'phone number already registered';
//            } else {
//
//                $sql = "INSERT INTO regexm VALUES ('','$user_name','$user_phone','$user_mail')";
//            }
//        }
//
//
//    }
//}
?>