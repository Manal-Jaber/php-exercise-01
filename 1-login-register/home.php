<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style_home.css">
</head>
<body>
<?php
    $nameErr = $usernameErr = $passwordErr = $confirm_passwordErr = $emailErr = $phoneErr = $dobErr = $numErr = $login_usernameErr = $login_passwordErr = "";
    $pass="";
    $users = array("Manal", "Shadi", "Manal_Jaber", "Mhammad");
    $names = array ("Manal Jaber", "Shadi Nakhal", "Manal Jaber", "Mhammad Agha");
    $emails = array ("manal.jaber94@gmail.com", "shadi@nakhal.com", "manal.jaber94@gmail.com", "mhammad@agha.com");
    $phones = array (71527943,12345678,12345678,12345678);
    $dobs = array ("01/07/1994","01/07/1994","01/07/1994","01/07/1994");
    $social_nums = array(000,001,002,003);
    $passwords = array("12345678","23456781","34567812","45678123");
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['register'])){
        if(empty($_POST["name"])){
            $nameErr = "This is a required field";
        }elseif(strlen($_POST["name"]) < 5){
            $nameErr = "At least 5 characters";
        }elseif(strlen($_POST["name"])>100){
            $nameErr = "Maximum 100 characters";
        }
        if(empty($_POST["username"])){
            $usernameErr = "This is a required field";
        }elseif(strlen($_POST["username"])<5){
            $usernameErr = "At least 5 characters";
        }elseif(strlen($_POST["username"])>100){
            $usernameErr = "Maximum 100 characters";
        }
        if(in_array($_POST["username"],$users)==True) {
            $usernameErr = "Username already exists";
        }
        if(empty($_POST["password"])){
            $passwordErr = "This is a required field";
        }elseif(strlen($_POST["password"])<8){
            $passwordErr = "At least 8 characters";
        }elseif(strlen($_POST["password"])>100){
            $passwordErr = "Maximum 100 characters";
        }else{
            $pass=($_POST["password"]);
        }
        if(empty($_POST["confirm_password"])){
            $confirm_passwordErr = "This is a required field";
        }elseif(strlen($_POST["confirm_password"])<8){
            $confirm_passwordErr = "At least 8 characters";
        }elseif(strlen($_POST["confirm_password"])>100){
            $confirm_passwordErr = "Maximum 100 characters";
        }
        if (($_POST["confirm_password"])!== $_POST["password"]){
            $confirm_passwordErr = "Passwords not Matching";
        }
        if (empty($_POST["email"])) {
            $emailErr = "This is a required field";
        }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
        }
        if(empty($_POST["phone"])){
            $phoneErr = "This is a required field";
        }elseif(strlen($_POST["phone"])<8){
            $phoneErr = "At least 8 characters";
        }elseif(strlen($_POST["phone"])>100){
            $phoneErr = "Maximum 100 characters";
        }
        if(empty($_POST["date_of_birth"])){
            $dobErr = "This is a required field";
        }
        if(empty($_POST["social_security"])){
            $numErr = "This is a required field";
        }elseif(strlen($_POST["social_security"])>100){
            $numErr = "Maximum 100 characters";
        }
    }elseif(isset($_POST['login'])){
            if(empty($_POST["login_username"])){
                $login_usernameErr = "This is a required field";
            }elseif(strlen($_POST["login_username"])<5){
                $login_usernameErr = "At least 5 characters";
            }elseif(strlen($_POST["login_username"])>100){
                $login_usernameErr = "Maximum 100 characters";
            }elseif(in_array($_POST["login_username"],$users)==False) {
                $login_usernameErr = "Username doesn't exist";
            }else{
                $pass=$passwords[array_search($_POST["login_username"],$users)];
            }
            if(empty($_POST["login_password"])){
                $login_passwordErr = "This is a required field";
            }elseif(strlen($_POST["login_password"])<8){
                $login_passwordErr = "At least 8 characters";
            }elseif(strlen($_POST["login_password"])>100){
                $login_passwordErr = "Maximum 100 characters";
            }elseif($_POST["login_password"]!== $pass){
                    $login_passwordErr = "Invalid password";
            }
        }
    if($nameErr == "" && $usernameErr == "" && $passwordErr == "" && $confirm_passwordErr == "" && $emailErr == "" && $phoneErr == "" && $dobErr == "" && $numErr == "" && $login_usernameErr == "" && $login_passwordErr == "" && $pass !=""){
        array_push($names,$_POST["name"]);
        array_push($users,$_POST["username"]);
        array_push($passwords,$_POST["password"]);
        array_push($emails,$_POST["email"]);
        array_push($phones,$_POST["phone"]);
        array_push($dobs,$_POST["date_of_birth"]);
        array_push($social_nums,$_POST["social_security"]);

        header('Location: ./safe.php');
    }
}

?>

    <div class="wrapper">
        <form id="register"  action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
            <h1>Sign Up</h1>
            <div class="input">
                <label for="name">Full Name: <span class = "error">* <?php echo $nameErr;?></span><input id="name" name = "name" placeholder="Name" type="text"></label>
            </div>
            <div class="input">
                <label for="username">Username: <span class = "error">* <?php echo $usernameErr;?></span><input id="username" name = "username" type="text" placeholder="Username"></label>
            </div>
            <div class="input">
                <label for="password">Password: <span class = "error">* <?php echo $passwordErr;?></span><input id="password" name = "password" type="password" placeholder="Password"></label>
            </div>
            <div class="input">
                <label for="confirm_password">Confirm Password: <span class = "error">* <?php echo $confirm_passwordErr;?></span><input id="confirm_password" name = "confirm_password" type="password" placeholder="Confirm Password"></label>
            </div>
            <div class="input">
                <label for="email">Email: <span class = "error">* <?php echo $emailErr;?></span><input id="email" name = "email" type="email" placeholder="Email"></label>
            </div>
            <div class="input">
                <label for="phone">Phone: <span class = "error">* <?php echo $phoneErr;?></span><input id="phone" name = "phone" type="text" placeholder="Phone"></label>
            </div>
            <div class="input">
                <label for="date_of_birth">Date of Birth: <span class = "error">* <?php echo $dobErr;?></span><input id="date_of_birth" name = "date_of_birth" type="date"></label>
            </div>
            <div class="input">
                <label for="social_security">Social Security Number: <span class = "error">* <?php echo $numErr;?></span><input id="social_security" name = "social_security" type="number" placeholder="Social Security Number"></label></div>
                <button id="register_btn" onclick="submit" name="register" value="register">Register</button>
        </form>

        <form id="login" action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
            <h1>Log In</h1>
            <div class="input">
                <label for="login_username">Username: <span class = "error">* <?php echo $login_usernameErr;?></span><input id="login_username" name = "login_username" type="text" placeholder="Username"></label>
            </div>
            <div class="input">
                <label for="login_password">Password: <span class = "error">* <?php echo $login_passwordErr;?></span><input id="login_password" name = "login_password" type="password" placeholder="Password"></label>
            </div>
            <button id="login_btn" onclick="submit" name="login" value="login">Login</button>
        </form>
    </div>
</body>
</html>
