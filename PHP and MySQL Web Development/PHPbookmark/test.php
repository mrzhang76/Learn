<?php 
function filled_out($form_vars){
    foreach($form_vars as $key => $value){
        if((!isset($key)) || ($value == "")){
            return false;
        }
    }
    return true;
}
if(empty($_GET)){
   # echo $_GET;

}
$a = '12';
$b = '';
if(!empty($a))
    echo $a; 
if(empty($b))
    echo $b; 
?>