<?php
if(!defined('SECURITY')){
    die('Bạn không có quyền truy cập file này!');
   }
$connect = mysqli_connect('localhost', 'root', '', 'vietpro_mobile_shop');
if($connect){
 mysqli_query($connect, "SET NAMES 'utf8'");
 //print_r('Kết nối thành công');
}else{
 echo 'Kết nối thất bại';
}
?>