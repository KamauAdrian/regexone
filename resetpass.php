<html lang="en">
<head>
    <title>reset password</title>
</head>
<body>
<form method="post">
    <input type="text" name="mail" placeholder="Enter your email address"/>
    <input type="submit" name="reset"/>
</form>
</body>
</html>
<?php
if (isset($_POST['reset'])){
    if (!empty($_POST['mail'])){
        $email=$_POST['mail'];
if(filter_var($email, FILTER_VALIDATE_EMAIL)==true){
    include 'connection.php';

    $result= mysqli_query($connection,"SELECT * FROM regexm WHERE email=$email");
    if ($result){
    $confirmemail=rand();
    $query="INSERT INTO reset VALUES ('','$email','')";
    }else{
        $error='Email not registered';
        echo $error;
    }

}else{
    $error='Enter a valid email address';
    echo $error;
}
    }
}
?>