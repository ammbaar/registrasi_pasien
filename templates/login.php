<?php
session_start();

$_SESSION["user_id"] = null;
$_SESSION["username"] = null;
$_SESSION["role"] = null;

unset( $_SESSION["user_id"] );
unset( $_SESSION["username"] );
unset( $_SESSION["role"] );

session_destroy();
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<title><?= html($title ?? 'Dashboard') ?></title>
	<base href="<?= $basePath ?>/"/>

	<link type="text/css" rel="stylesheet" href="<?= $uri ?>bower_components/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?= $uri ?>bower_components/fontawesome/css/all.css">
	<link type="text/css" rel="stylesheet" href="<?= $uri ?>assets/css/style.css">

	<script src="<?= $uri ?>bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= $uri ?>bower_components/bootstrap/js/bootstrap.js"></script>
	<script src="<?= $uri ?>bower_components/angular/angular.min.js"></script>

	<link type="image/png" rel="icon" a href="<?= $uri ?>assets/images/logo.png">
</head>
<body ng-controller="thisController">

<div class="login" ng-init="init()">

	<div class="card border-primary mb-3">
		<form id="loginform" role="form" method="post">
			<div class="card-body">
				<center><h5 class="card-title">Log In Registrasi Pasien</h5></center>
				<hr style="border: 0.5px solid #1898ce;">
				<div class="mb-3">
					<label>Username</label>
					<input type="text" class="form-control" placeholder="Username" ng-model="username" required>
				</div>
				<div class="mb-3">
					<label>Password</label>
					<input type="password" class="form-control" placeholder="Password" ng-model="password" required>
				</div>
				<center><button class="btn btn-primary" ng-click="login()"><i class="{{login_button}}"></i> Log In</button></center>
			</div>
		</form>

		<center><small style="color: #FF0000;">{{login_message}}</small></center>
	</div>
	<small>
		<div style="float: right;">Versi 1.0</div>
	</small>

</div>

<script type="text/javascript">

	function formSubmit(){
		$("#loginform").submit();
	}

	var thisController = angular.module('app', []).controller('thisController', ['$scope', '$http', function ($scope, $http) {

		// = = = = = MEDIA VARIABLES
		var API_URL = "<?= $uri ?>";

		$scope.login_button = "fas fa-sign-in-alt";

		$scope.init = function() {
			$scope.login_message = "";
		}

		$scope.login = function() {
			var username = $scope.username,
				password = $scope.password;

			if(username != undefined && password != undefined){
				$scope.login_button = "fas fa-spinner fa-spin";

				$http.get(API_URL+"authentication/"+username+"/"+password).then(function(response) {
					$scope.login_button = "fas fa-sign-in-alt";

					var value = response.data;

					if(value["id"] != "0"){
						document.cookie = "user_id = " + value["id"] + ";path=/;";
						document.cookie = "username = " + value["username"] + ";path=/;";
						document.cookie = "role = " + value["role"] + ";path=/;";

						window.location.replace(API_URL+"home");
					}else{
						$scope.login_message = "Data yang dimasukkan salah!";
					}
				});
			}
		}

	}]);

</script>

</body>
</html>