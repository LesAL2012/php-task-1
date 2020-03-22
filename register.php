<?
require_once 'core/config_connect_function.php';
$page_name = "Registration";
$flash='';

setcookie('name_reg', trim($_POST['name_reg']), time()+5*60);
setcookie('email_reg', trim($_POST['email_reg']), time()+5*60);

if (isset($_POST['name_reg']) && trim($_POST['name_reg']) != '' && isset($_POST['email_reg']) && trim($_POST['email_reg']) != '' && isset($_POST['password_reg_1']) && trim($_POST['password_reg_1']) != '' && isset($_POST['password_reg_2']) && trim($_POST['password_reg_2']) != ''){
    
    $email_reg = trim($_POST['email_reg']);
    $email_bd = get_email($conn, $email_reg);
    
    if ($_POST['password_reg_1'] != $_POST['password_reg_2']) {
        $flash = 'The entered passwords 1 and 2 do not match: <a href="login.php">Return to registration form</a>';
    }

    else if (isset($email_bd)) {
        $flash = "This email $email_bd is already registered - <a href='login.php'>Return to registration form</a>";
    }   

    else {
        $hash = generateHash(30);
        $sql = "INSERT INTO php_task_1_users (user_name, email, password, hash) VALUES ('".trim($_POST['name_reg'])."', '".$email_reg."', '".md5(trim($_POST['password_reg_1']))."', '".$hash."')";
    
        mysqli_query($conn, $sql);    
        $id_user = mysqli_insert_id ($conn);        
        
        setcookie('hash', $hash, time()+30*24*60*60, null, null, null, true);
        setcookie('user_name', trim($_POST['name_reg']), time()+30*24*60*60, null, null, null, true);
        setcookie('id', $id_user, time()+30*24*60*60);
        header("Location: index.php");
        exit();
    }

} else {
    $flash = "All fields are required - <a href='login.php'>Return to registration form</a>";
}
require_once 'template/head_html.php';
    if($flash !== ''){
        echo '<div class="col-lg-4"> 
                <h2>INFO</h2>   
                <p class="bg-warning">'.$flash.'</p>
            </div>';
    }
close($conn);
require_once 'template/footer.php';
?>