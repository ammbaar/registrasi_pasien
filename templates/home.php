<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

if(!isset($_COOKIE["user_id"])){
	header("Location: http://localhost/registrasi_pasien/");
	die();
}
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<title><?= html($title ?? 'Dashboard') ?></title>
	<base href="<?= $basePath ?>/"/>

	<link type="text/css" rel="stylesheet" href="<?= $uri ?>/../bower_components/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?= $uri ?>/../bower_components/fontawesome/css/all.css">
	<link type="text/css" rel="stylesheet" href="<?= $uri ?>/../assets/css/style.css">

	<script src="<?= $uri ?>/../bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= $uri ?>/../bower_components/bootstrap/js/bootstrap.js"></script>
	<script src="<?= $uri ?>/../bower_components/angular/angular.min.js"></script>

	<link type="image/png" rel="icon" a href="<?= $uri ?>/../assets/images/logo.png">
</head>
<body ng-controller="thisController" id="main">

<!-- Navigation -->
<?php
	include("menu.php");
?>

<div class="container-fluid mb-5">
	<div class="content">
		<div class="row" ng-init="init()">
			<div class="col-lg-12" style="text-align:center; padding-top:260px;">
				<h4><b>Selamat Datang di Aplikasi Registrasi Pasien</b></h4>
				<!-- Hello <?= html($name) ?> -->
			</div>
		</div>
	</div>
</div>

<nav class="navbar fixed-bottom navbar-light bg-light">
	<div class="container-fluid">
		<small>&copy; 2023</small>
	</div>
</nav>

<script type="text/javascript">

	var thisController = angular.module('app', []).controller('thisController', ['$scope', '$http', '$interval', function ($scope, $http, $interval) {

		// = = = = = MEDIA VARIABLES
		var API_URL = "<?= $uri ?>/../";

		$scope.init = function() {};

		$scope.logout = function(){
			document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
			document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
			document.cookie = "role=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

			window.location.replace(API_URL);
		};

		//auto logout setelah 1 jam
		$interval(function(){
			$scope.logout();
		},3600000);

	}]);

</script>

</body>
</html>