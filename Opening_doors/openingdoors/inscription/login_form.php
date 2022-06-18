<?php

@include 'config.php';

// session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $motpass = md5($_POST['motpass']);

    $select = "SELECT * FROM  customer WHERE mail = '$email' && motpass = '$motpass'  ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['nom'];
            header('location: admin_page.php');
        
        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['nom'];
            header('location: index.html');

        }
        
    }else{
        $error[] = 'incorrect email or password!';
    }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Form</title>
</head>
<body>
    
    <div class="form-container">
        <form action="" method="POST">
            <h3>Log In Now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="email" name="email" placeholder="Enter Your E-mail" ><br><br>
            <input type="password" name="motpass" placeholder="Enter Your Pass Word" ><br><br>
            <input type="submit" name="submit" value="Log In Now" class="form_btn">
            <p>You D'ont have an account? <a href="Signup_form.php">Sign UP Now</a></p>
        </form>
    </div>
</body>
</html>