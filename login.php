<?php
require_once 'core/config_connect_function.php';
$page_name = "Вход / Регистрация";
$flash='';
// Вход по логину и паролю
if (isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "SELECT id, user_name, password FROM php_task_1_users WHERE email='".$email."' LIMIT 1");
    $row = mysqli_fetch_assoc($query);
    
    if ($row['password'] == md5($_POST['password'])){
        $hash = generateHash(30);
        mysqli_query($conn, "UPDATE php_task_1_users SET hash='".$hash."' WHERE id=".$row['id']);
        setcookie('id', $row['id'], time()+30*24*60*60);
        setcookie('hash', $hash, time()+30*24*60*60, null, null, null, true);
        setcookie('user_name', $row['user_name'], time()+30*24*60*60, null, null, null, true);
        header("Location: index.php");
        exit();
    }
    else {
        $flash= "Password / Email - Incorrect";
    }
}

close($conn);

require_once 'template/head_html.php';

?>
<div class="container">
    <?
        if($flash !== ''){
            echo '<div class="col-lg-4"> 
                    <h2>INFO</h2>   
                    <p class="bg-warning">'.$flash.'</p>
                </div>';
        }
    ?>

    <div class="row mb-4">
        <div class="col-lg-6">
            <h4>Login: task management</h4>
            <form method="POST" class="mb-5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="admin@admin.net">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="123">
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </form>
        </div>
    
        <div class="col-lg-6">
            <h4 >Registration</h4>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="exampleName">Name</label>
                    <input type="text" class="form-control" id="exampleName" aria-describedby="namelHelp" placeholder="Your Name" name="name_reg" value="<? echo $_COOKIE['name_reg'] ?>">
                    <small id="namelHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email_reg" value="<? echo $_COOKIE['email_reg'] ?> ">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Input Password" name="password_reg_1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Repeat Password" name="password_reg_2">
                </div>

                <button type="submit" class="btn btn-primary">Registration</button>
            </form>
        </div>
    </div>
</div>

<?php 
    require_once 'template/footer.php';
?>