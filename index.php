<?php
	include('includes/config.php');
	$reqErr = $loginErr = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(!empty($_POST['txtUsername']) && !empty($_POST['txtPassword']) && isset($_POST['login_type'])){
			session_start();
			$username = $_POST['txtUsername'];
			$password = $_POST['txtPassword'];
			$_SESSION['sessLogin_type'] = $_POST['login_type'];
			if($_SESSION['sessLogin_type'] == "retailer") {
				
				$query_selectRetailer = "SELECT retailer_id,username,password FROM retailer WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectRetailer);
				$row = mysqli_fetch_array($result);
				if($row) {
					$_SESSION['retailer_id'] =  $row['retailer_id'];
					$_SESSION['sessUsername'] = $_POST['txtUsername'];
					$_SESSION['sessPassword'] = $_POST['txtPassword'];
					$_SESSION['retailer_login'] = true;
					header('Location:retailer/index.php');
				}
				else {
					$loginErr = "* Tài khoản hoặc mật khẩu không chính xác.";
				}
			}
			else if($_SESSION['sessLogin_type'] == "manufacturer") {
				
				$query_selectManufacturer = "SELECT man_id,username,password FROM manufacturer WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectManufacturer);
				$row = mysqli_fetch_array($result);
				if($row) {
					$_SESSION['manufacturer_id'] =  $row['man_id'];
					$_SESSION['sessUsername'] = $_POST['txtUsername'];
					$_SESSION['sessPassword'] = $_POST['txtPassword'];
					$_SESSION['manufacturer_login'] = true;
					header('Location:manufacturer/index.php');
				}
				else {
					$loginErr = "* Tài khoản hoặc mật khẩu không chính xác.";
				}
			}
			else if($_SESSION['sessLogin_type'] == "admin") {
				$query_selectAdmin = "SELECT username,password FROM admin WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectAdmin);
				$row = mysqli_fetch_array($result);
					if($row) {
						$_SESSION['admin_login'] = true;
						$_SESSION['sessUsername'] = $_POST['txtUsername'];
						$_SESSION['sessPassword'] = $_POST['txtPassword'];
						header('Location:admin/index.php');
					}
					else {
						$loginErr = "* Tài khoản hoặc mật khẩu không chính xác.";
					}
				}
			}
		else {
			$reqErr = "*Chọn tất cả mục được yêu cầu.";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Đăng nhập </title>
	<link rel="stylesheet" href="includes/main_style.css" >
</head>
<body class="login-box">
	<h1>ĐĂNG NHẬP</h1>
	<form action="" method="POST" class="login-form">
	<ul class="form-list">
	<li>
		<div class="label-block"> <label for="login:username">Tài Khoản</label> </div>
		<div class="input-box"> <input type="text" id="login:username" name="txtUsername" placeholder="Tài khoản" /> </div>
	</li>
	<li>
		<div class="label-block"> <label for="login:password">Mật Khẩu</label> </div>
		<div class="input-box"> <input type="password" id="login:password" name="txtPassword" placeholder="Mật khẩu" /> </div>
	</li>
	<li>
		<div class="label-block"> <label for="login:type">Kiểu đăng nhập</label> </div>
		<div class="input-box">
		<select name="login_type" id="login:type">
		<option value="" disabled selected>-- Tìm kiếm kiểu --</option>
		<option value="retailer">Nhà bán lẻ</option>
		<option value="manufacturer">Nhà sản xuất</option>
		<option value="admin">Quản trị viên</option>
		</select>
		</div>
	</li>
	<li>
		<input type="submit" value="Đăng nhập" class="submit_button" /> <span class="error_message"> <?php echo $loginErr; echo $reqErr; ?> </span>
	</li>
	</ul>
	</form>
</body>
</html>