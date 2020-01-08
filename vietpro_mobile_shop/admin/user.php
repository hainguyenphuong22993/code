<?php 
if(!defined('SECURITY')){
 die('Bạn không có quyền truy cập file này!');
}
//phan trang
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page = 1;
}
//hien thi tren 1 trang
$row_per_page = 5;
$per_row = $page * $row_per_page - $row_per_page;
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user"));
$total_page = ceil($total_row / $row_per_page);
//prev
$list_page = '';
$page_prev = $page - 1;
if ($page_prev <= 0) {
    $page = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$page_prev.'">&laquo;</a></li>';
//tinh so trang
for ($i=1; $i <= $total_page; $i++) { 
    if ($i == $page) {
        $active = 'active';
    }else{
        $active = '';
    }
    $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
}
//next
$page_next = $page + 1;
if ($page_next > $total_page) {
    $page_next = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$page_next.'">&laquo;</a></li>';

?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách thành viên</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách thành viên</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_user" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm thành viên
            </a>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM user ORDER BY user_id ASC LIMIT $per_row, $row_per_page";
                                    $query = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                        <td style=""><?php echo $row['user_id'];?></td>
                                        <td style=""><?php echo $row['user_full'];?></td>
                                        <td style=""><?php echo $row['user_mail'];?></td>
                                        <td>
                                            <?php if ($row['user_level'] == 1) {
                                            echo '<span class="label label-success">Admin</span>';
                                        }else{
                                            echo '<span class="label label-warning">Member</span>';
                                        }?>
                                        </td>
                                        <td class="form-group">
                                            <a href="index.php?page_layout=edit_user&user_id=<?php echo $row['user_id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="/" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                            </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php echo $list_page; ?>
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->
