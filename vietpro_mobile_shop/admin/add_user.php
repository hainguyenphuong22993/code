<?php 
if(!defined('SECURITY')){
 die('Bạn không có quyền truy cập file này!');
}
$sql_user = "SELECT * FROM user ORDER BY user_id ASC";
$query_user = mysqli_query($connect, $sql_user);
if (isset($_POST['sbm'])) {
    $user_full = $_POST['user_full'];
    $user_mail = $_POST['user_mail'];
    $user_pass = $_POST['user_pass'];
    $user_re_pass = $_POST['user_re_pass'];
    $user_level = $_POST['user_level'];
    //check ton tai
    $sql_errorr = "SELECT * FROM user WHERE user_mail = '$user_mail'";
    $num_row = mysqli_num_rows(mysqli_query($connect, $sql_errorr));
    if ($num_row > 0) {
        $errorr = '<div class="alert alert-danger">Email đã tồn tại !</div>';
    }
    elseif ($user_re_pass != $user_pass){
        $errorr = '<div class="alert alert-danger">Mật khẩu không khớp !</div>';
    }else{
        $sql = "INSERT INTO user(user_full, user_mail, user_pass, user_level) VALUES('$user_full', '$user_mail', '$user_pass', '$user_level')";
        $query = mysqli_query($connect, $sql);
        header('location: index.php?page_layout=user');
    }
}
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý thành viên</a></li>
				<li class="active">Thêm thành viên</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm thành viên</h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                            	<!-- <div class="alert alert-danger">Email đã tồn tại !</div> -->
                                <?php if(isset($errorr)){ echo $errorr;}?>
                                <form role="form" method="post">
                                <div class="form-group">
                                    <label>Họ & Tên</label>
                                    <input name="user_full" required class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="user_mail" required type="text" class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input name="user_pass" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input name="user_re_pass" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="user_level" class="form-control">
                                        <option value=1>Admin</option>
                                        <option value=2>Member</option>
                                    </select>
                                </div>
                                <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
