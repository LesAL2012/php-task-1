<?php
// Подключение к БД с установкой кодировки utf8
function connect_db(){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, "utf8");
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function close($conn){
    mysqli_close($conn);
}

// Подключение к задачам - выводим все задачи для главной страницы в обратном порядке, и устанавливаем количество задач вывода под пагинацию
function select_main_page($conn){    
    $offset = 0;
    $desc = 'DESC'; 
    $order = 'id';   
    
    if (isset($_GET['page']) && trim($_GET['page'])!=''){
        $offset = trim($_GET['page']);
    }
    if (isset($_GET['DESC']) && trim($_GET['DESC']) ==''){
        $desc = trim($_GET['DESC']);
    }
    if (isset($_GET['order']) && trim($_GET['order']) !=''){
        $order = trim($_GET['order']);
    }

    //var_dump($_GET);    
    $sql = "SELECT * FROM php_task_1_tasks ORDER BY ".$order." ".$desc." LIMIT ".TASK_ON_PAGE." OFFSET ".$offset*TASK_ON_PAGE;
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a['data'][] = $row;
        }       
    }

    $a['parameter']['desc'] = $desc;
    $a['parameter']['order'] = $order;
    $a['parameter']['page'] = $offset;

    return $a;
}

// Определяем число пагинаций 
function pagination_count($conn){
    $sql = "SELECT id FROM php_task_1_tasks";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);    
    return ceil( $result / TASK_ON_PAGE );
}

function get_email($conn, $email_reg){
    $sql = "SELECT email FROM php_task_1_users WHERE email='$email_reg'";
    $result = mysqli_query($conn, $sql);    
    $a = array();   
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {            
            $a[] = $row['email'];            
        }
    } 
    return $a[0];   
}

function generateHash($length = 5) {
    $symbol = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890";
    $code = "";
    for ($i = 0; $i <=$length; $i++) {
        $code .=$symbol[rand(0, strlen($symbol)-1)];
    }
    return $code;
}

function confirm_task_status($conn){    
    if (isset($_POST['formSubmitStatus']) && trim($_POST['formSubmitStatus']) =='Confirm'
    &&  isset($_POST['status_task']) && trim($_POST['status_task']) !=''    
    ){
        $id = trim($_POST['status_task']);
        $sql = "UPDATE php_task_1_tasks SET status='Done' WHERE id=".$id;
        mysqli_query($conn, $sql);
    } else {
        return false;
    }
}

function change_task_text($conn){ 
    
    if(isset($_COOKIE['hash']) && trim($_COOKIE['hash']) !='' &&
       isset($_COOKIE['id']) && trim($_COOKIE['id']) !=''    
    ){
        $id_cookie = trim($_COOKIE['id']);

        $query = mysqli_query($conn, "SELECT hash FROM php_task_1_users WHERE id='$id_cookie' LIMIT 1");
        $row = mysqli_fetch_assoc($query);

        if($row['hash'] === trim($_COOKIE['hash'])){                      
            if (isset($_POST['formSubmitTextDB']) && trim($_POST['formSubmitTextDB']) =='ChangeText'
            &&  isset($_POST['status_task']) && trim($_POST['status_task']) !=''
            &&  isset($_POST['status_text']) && trim($_POST['status_text']) !=''    
            ){
                $id = trim($_POST['status_task']);
                $text = trim($_POST['status_text']);
                $sql = "UPDATE php_task_1_tasks SET task='$text', edit_admin='Edited by admin' WHERE id=".$id;
                mysqli_query($conn, $sql);
            } else {
                return false;            }        
        } else {            
            setcookie('id', "", time()-10);
            setcookie('user_name',"",  time()-10);
            setcookie('hash', "",  time()-10);            
        }        

    } else{        
        setcookie('id', "", time()-10);
        setcookie('user_name',"",  time()-10);
        setcookie('hash', "",  time()-10);             
        return false;
    }    
}