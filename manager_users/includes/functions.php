<?php
if(!defined('_CODE')){
    die('Access denied...');
}

function layouts($layoutName='header'){
    if(file_exists(_WEB_PATH_TEMPLATES .'/layout/'.$layoutName.'.php')){
        require_once _WEB_PATH_TEMPLATES .'/layout/'.$layoutName.'.php';
    }
}
// Kiểm tra phương thức GET
function isGet() {
    if($_SERVER['REQUEST_METHOD']== 'GET'){
    return true;
    }
    return false;
}
// Kiểm tra phương thức POST
function isPost() {
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    return true;
    }
    return false;
}
// Hàm filter lọc dữ liệu
function filter(){
    $filterArr = [];
    if(isGet()){
        if(!empty($_GET)){
            foreach($_GET as $key => $value)
            {
                $key = strip_tags($key);
               if(is_array($value)){
                 $filterArr[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
               }else{
                 $filterArr[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS);
               }
            }
        }
    }
    
    if(isPost()){
        if(!empty($_POST)){
            foreach($_POST as $key => $value)
            {
                $key = strip_tags($key);
                if(is_array($value)){
                  $filterArr[$key] = filter_input(INPUT_POST,$key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                  $filterArr[$key] = filter_input(INPUT_POST,$key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $filterArr;
}
//Thông báo lỗi
function getMsg($msg, $type ='success'){
    echo '<div class= "alert alert-'.$type.' ">';
    echo $msg;
    echo '</div>';
}
// Hàm chuyển hướng
function redirect($path='index.php'){
    header("Location: $path");
    exit;
}