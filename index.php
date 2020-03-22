<?php
require_once 'core/config_connect_function.php';

$page_name = "Home";
confirm_task_status($conn);
change_task_text($conn);
//if(change_task_text($conn) === false){header("Location: index.php");}

$full_data = select_main_page($conn);

$data = $full_data['data'];
$DESC = $full_data['parameter']['desc'];
$order = $full_data['parameter']['order'];
$page = $full_data['parameter']['page'];

$count_page = pagination_count($conn);

close($conn);
$flash = '';
if (isset($_COOKIE['new_task']) && $_COOKIE['new_task']!='' 
    && $_COOKIE['new_task'] == 1){    
    setcookie('new_task', 1, time()-10);
    $flash =  "New post created successfully";    
}

require_once 'template/head_html.php';

?>
<div class="container">

    <div class="col-lg-12 text-center my-2">        
        <span class="font-weight-bold">Sort by:</span>
        <div class="btn-group" role="group" aria-label="Basic example">           
            <button type="button" class="btn btn-secondary">
                <a href="index.php?page=<?echo $page?>&DESC=&order=id" class='text-white'> 
                    id<i class="fas fa-arrow-up"></i>            
                </a>
            </button>               
            <button type="button" class="btn btn-secondary">
                <a href="index.php?page=<?echo $page?>&DESC=DESC&order=id" class='text-white'>  
                    id<i class="fas fa-arrow-down"></i>
                </a>            
            </button>
            <button type="button" class="btn btn-secondary">
                <a href="index.php?page=<?echo $page?>&DESC=&order=user_name" class='text-white'>  
                    <i class="fas fa-user"></i><i class="fas fa-arrow-up"></i>
                </a>            
            </button>      
            <button type="button" class="btn btn-secondary">
               <a href="index.php?page=<?echo $page?>&DESC=DESC&order=user_name" class='text-white'>  
                    <i class="fas fa-user"></i><i class="fas fa-arrow-down"></i>
               </a>            
            </button>            
            <button type="button" class="btn btn-secondary">
                <a href="index.php?page=<?echo $page?>&DESC=&order=email" class='text-white'>  
                    <i class="fas fa-envelope-open-text"></i><i class="fas fa-arrow-up"></i>
                </a>            
            </button>      
            <button type="button" class="btn btn-secondary">
               <a href="index.php?page=<?echo $page?>&DESC=DESC&order=email" class='text-white'>  
                    <i class="fas fa-envelope-open-text"></i><i class="fas fa-arrow-down"></i>
               </a>            
            </button>
            <button type="button" class="btn btn-secondary">
                <a href="index.php?page=<?echo $page?>&DESC=&order=status" class='text-white'>  
                    <i class="fas fa-thumbs-up"></i><i class="fas fa-arrow-up"></i>
                </a>            
            </button>      
            <button type="button" class="btn btn-secondary">
               <a href="index.php?page=<?echo $page?>&DESC=DESC&order=status" class='text-white'>  
                    <i class="fas fa-thumbs-down"></i><i class="fas fa-arrow-down"></i>
               </a>            
            </button>
        </div>        
    </div>

<?
if($flash !== ''){
    echo '<div class="col-lg-12"> 
            <h2>INFO</h2>   
            <p class="bg-warning">'.$flash.'</p>
        </div>';
}
echo "<div class='row'>";    
        echo '<table class="table table-striped">';
            echo '<thead style="background-color:#e5e1e1;">';
                echo '<tr>';
                if($order == 'id'){
                    echo '<th class="align-middle text-center text-primary">№ id</th>';
                } else {
                    echo '<th class="align-middle text-center">№ id</th>';
                }                
                    echo '<th class="align-middle text-center">Task</th>';
                if($order == 'user_name'){
                    echo '<th class="align-middle text-center text-primary">User Name</th>';
                } else {
                    echo '<th class="align-middle text-center">User Name</th>';
                }                   
                if($order == 'email'){
                    echo '<th class="align-middle text-center text-primary">Email</th>';
                } else {
                    echo '<th class="align-middle text-center">Email</th>';
                }                    
                if($order == 'status'){
                    echo '<th class="align-middle text-center text-primary"">Status</th>';
                } else {
                    echo '<th class="align-middle text-center">Status</th>';
                }
                    echo '<th class="align-middle text-center">Edited by Admin</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $out = '';            
            foreach ($data as $value) {
                if($value['status'] == 'Not confirmed'){
                    $out .='<tr class="table-warning">';
                        $out .='<td class="table-warning">'.$value['id'].'</td>';                       

                        if (isset($_COOKIE['user_name']) && $_COOKIE['user_name']!='' 
                        && $_COOKIE['user_name'] == 'admin'){
                            
                            
                            
                            if (isset($_POST['formSubmitText']) && trim($_POST['formSubmitText']) =='Edit Text'
                            &&  isset($_POST['status_edit_text']) && trim($_POST['status_edit_text'] == $value['id'])){
                                $out .='<td class="table-warning">';                                
                               
                                $out .='<form action="" method="POST">';
                                $out .='<div class="form-group">'; 
                                $out .='<input type="checkbox" class="d-none" name="status_task" checked="checked" value='.$value['id'].' />';       
                                $out .="<textarea type='text' class='form-control' aria-describedby='status_text' name='status_text' >".$value['task']."</textarea>";
                                $out .='</div>';                                
                                $out .='<input type="submit" name="formSubmitTextDB" value="ChangeText" class="btn btn-primary float-right my-1 btn-sm">';
                                $out .='</form>';
                                $out .='<button type="button" class="btn btn-secondary float-left text-white my-1 btn-sm"/><a href="index.php" class="text-white">Cancel</button>';
                                $out .='</td>';
                            } else {
                                $out .='<td class="table-warning">'.$value['task'].'</td>';
                            };
                            $out .='<td class="table-warning">'.$value['user_name'].'</td>';
                            $out .='<td class="table-warning">'.$value['email'].'</td>';
                            $out .='<td class="table-warning">';

                            $out .='<form action="" method="POST">';                           
                            $out .='<input type="checkbox" class="d-none" name="status_task" checked="checked" value='.$value['id'].' />';
                            $out .='<input type="submit" name="formSubmitStatus" value="Confirm" class="btn btn-success btn-sm"/>';
                            $out .='</form>';                            
                            $out .='<hr>';
                            $out .='<span class="bg-warning text-dark">Not confirmed</span>';                            
                            $out .='</td>';

                            $out .='<td class="table-warning">';                            
                            
                            $out .='<form action="" method="POST">';                           
                            $out .='<input type="checkbox" class="d-none" name="status_edit_text" checked="checked" value='.$value['id'].' />';
                            $out .='<input type="submit" name="formSubmitText" value="Edit Text" class="btn btn-secondary btn-sm"/>';
                            $out .='</form>';                            

                            if($value['edit_admin'] != null){
                                $out .='<hr>';
                                $out .='<span class="text-danger">Edited by admin</span>';                                
                            }
                        } else { 
                            $out .='<td class="table-warning">'.$value['task'].'</td>';
                            $out .='<td class="table-warning">'.$value['user_name'].'</td>';
                            $out .='<td class="table-warning">'.$value['email'].'</td>';
                            $out .='<td class="table-warning">';
                            $out .='<span class="bg-warning text-dark">Not confirmed</span>';
                            $out .='</td>';
                            $out .='<td class="table-warning">';
                            if($value['edit_admin'] != null){
                                $out .='<hr>';
                                $out .='<span class="text-danger">Edited by admin</span>';                                
                            }
                        };                                                
                        $out .= '</td>';                    
                } else {
                    $out .='<tr class="table-success">';
                        $out .='<td class="table-success">'.$value['id'].'</td>';
                        
                        if (isset($_POST['formSubmitText']) && trim($_POST['formSubmitText']) =='Edit Text'
                            &&  isset($_POST['status_edit_text']) && trim($_POST['status_edit_text'] == $value['id'])){
                                $out .='<td class="table-warning">';                              

                                $out .='<form action="" method="POST">';
                                $out .='<div class="form-group">'; 
                                $out .='<input type="checkbox" class="d-none" name="status_task" checked="checked" value='.$value['id'].' />';       
                                $out .="<textarea type='text' class='form-control' aria-describedby='status_text' name='status_text' >".$value['task']."</textarea>";
                                $out .='</div>';                                
                                $out .='<input type="submit" name="formSubmitTextDB" value="ChangeText" class="btn btn-primary float-right my-1 btn-sm">';
                                $out .='</form>';
                                $out .='<button type="button" class="btn btn-secondary float-left text-white my-1 btn-sm"/><a href="index.php" class="text-white">Cancel</button>';
                                $out .='</td>';
                            } else {
                                $out .='<td class="table-warning">'.$value['task'].'</td>';
                            };



                        $out .='<td class="table-success">'.$value['user_name'].'</td>';
                        $out .='<td class="table-success">'.$value['email'].'</td>';
                        $out .='<td class="table-success font-weight-bold text-primary">Done</td>';
                        $out .='<td class="table-warning">';
                        
                        if (isset($_COOKIE['user_name']) && $_COOKIE['user_name']!='' 
                        && $_COOKIE['user_name'] == 'admin'){
                        $out .='<form action="" method="POST">';                           
                            $out .='<input type="checkbox" class="d-none" name="status_edit_text" checked="checked" value='.$value['id'].' />';
                            $out .='<input type="submit" name="formSubmitText" value="Edit Text" class="btn btn-secondary btn-sm"/>';
                            $out .='</form>';
                        }

                        if($value['edit_admin'] != null){ 
                            $out .='<hr>';                          
                            $out .='<span class="text-danger">Edited by admin</span>';                            
                        }                        
                        $out .= '</td>'; 
                }
                $out .="</tr>";                
            };            
            echo $out;
        echo '</table>'; //row   
    
   
echo '</div>'; //row

echo '<nav aria-label="Page navigation example" class="m-2">';
    echo '<ul class="pagination justify-content-center">';        
        for ($i=0; $i < $count_page; $i++){
            $j = $i+1;
            if ($i == $_GET['page']) {
                echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}&DESC={$DESC}&order={$order}' class='pagination '>{$j}</a></li>";                
            }
            else {
                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}&DESC={$DESC}&order={$order}' class='pagination'>{$j}</a></li>";
            }                    
        }
        echo '</li>';
    echo '</ul>';
echo '</nav>';


echo ' </div>'; //container

require_once 'template/footer.php';
?>


