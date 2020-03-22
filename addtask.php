<?php
require_once 'core/config_connect_function.php';
$page_name = "New task";

$flash = '';

if (isset($_POST['task']) && trim($_POST['task']) !=''
    && isset($_POST['user_name']) && trim($_POST['user_name']) !='' 
    && isset($_POST['email']) && trim($_POST['email']) !='' && trim($_POST['email']) !='@'
) {
    if(preg_match("/.*<\s*script\s*>.*<\s*\/\s*script\s*>.*/", $_POST['task'])){
        $patterns = array ('/</', '/>/');
        $replace = array ('&lt;', '&gt;');
        $task = preg_replace( $patterns , $replace , $_POST['task']);
    } else {
        $task = $_POST['task'];
    }    
    
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO php_task_1_tasks (task, user_name, email) 
    VALUES ('".$task."', '".$user_name."', '".$email."')";    

    if (mysqli_query($conn, $sql)) {
        setcookie('new_task', 1, time()+20);
        header('Location: index.php');
    } else {
        $flash = 'Error: in SERVER connection!';        
    }
    
} else if(!isset($_POST['task']) && !isset($_POST['user_name']) && !isset($_POST['email'])){
    $flash = '';
} else {
    $flash = 'Please verify your input';
}

require_once 'template/head_html.php';

?>
<div class="container">    
    <div class="row">
        <?
            if($flash !== ''){
                echo '<div class="col-lg-4"> 
                        <h2>INFO</h2>   
                        <p class="bg-warning">'.$flash.'</p>
                    </div>';
            }
        ?>
        <div class="col-lg-8"> 
            <h2>Create new TASK</h2>       
            <form action="" method="POST" class="p-1">
                <div class="form-group">
                    <label for="task">Task:</label>
                    <textarea type="text" class="form-control" aria-describedby="task" name="task" value="<?echo $_POST['task']?>" required></textarea>
                    <small id="title" class="form-text text-muted">Brief task description</small>
                </div>                
                <div class="form-group">
                    <label for="task">User Name:</label>
                    <input type="text" class="form-control" name="user_name" value="<?echo $_POST['user_name']?>" required>                    
                </div>                
                <div class="form-group">
                    <label for="task">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?echo $_POST['email']?>" required>                    
                </div>                
                <div class="text-right">
                    <input type="submit" value="Add task" class="btn btn-success">
                </div>
            </form>
        </div>        
    </div>
</div>
<?

close($conn);
require_once 'template/footer.php';
?>