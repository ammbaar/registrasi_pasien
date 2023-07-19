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
		<header class="d-flex flex-wrap py-3 mb-4 border-bottom">
			<span class="fs-5">DATA KELURAHAN</span>
		</header>
		<div class="row" ng-init="init()">

			<div class="col-lg-5">
				<form role="form">
					<span class="badge mb-3" style="background-color: #1898ce;">INPUT</span>
					<div class="mb-3 row">
						<label for="inputKelurahan" class="col-sm-4 col-form-label">Nama Kelurahan</label>
						<div class="col-sm-8">
							<input class="form-control" id="inputKelurahan" placeholder="Nama Kelurahan" ng-model="nama_kelurahan" maxlength="100" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputKecamatan" class="col-sm-4 col-form-label">Nama Kecamatan</label>
						<div class="col-sm-8">
							<input class="form-control" id="inputKecamatan" placeholder="Nama Kecamatan" ng-model="nama_kecamatan" maxlength="100" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputKota" class="col-sm-4 col-form-label">Nama Kota</label>
						<div class="col-sm-8">
							<input class="form-control" id="inputKota" placeholder="Nama Kota" ng-model="nama_kota" maxlength="100" required>
						</div>
					</div>
					<button class="btn btn-secondary btn-md" type="reset" ng-click="init()"><i class="fas fa-undo-alt"></i> Batal</button>
					<button class="btn btn-primary btn-md ms-1" ng-click="inputKelurahan()"><i class="{{save_button}}"></i> Tambah</button>
					<small class="label label-info">{{process_message}}</small>
				</form>
			</div>
			<div class="col-lg-7">
				<form role="form">
					<div class="badge mb-3" style="background-color: #1898ce;">DATA</div>
					<div class="tableFixHead">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr class="table-light">
									<th class="col-xs-1">NO</th>
									<th class="col-xs-3">NAMA KELURAHAN</th>
									<th class="col-xs-3">NAMA KECAMATAN</th>
									<th class="col-xs-3">NAMA KOTA</th>
									<th class="col-xs-2">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="tableData in table_data">
									<td class="col-xs-1" align="center">{{$index+1}}</td>
									<td class="col-xs-3">
										<div ng-hide="editingData[tableData.id]">{{tableData.nama_kelurahan}}</div>
										<div ng-show="editingData[tableData.id]"><input class="form-control" placeholder="Nama Kelurahan" ng-model="tableData.nama_kelurahan" maxlength="100"></div>
									</td>
									<td class="col-xs-3">
										<div ng-hide="editingData[tableData.id]">{{tableData.nama_kecamatan}}</div>
										<div ng-show="editingData[tableData.id]"><input class="form-control" placeholder="Nama Kecamatan" ng-model="tableData.nama_kecamatan" maxlength="100"></div>
									</td>
									<td class="col-xs-3">
										<div ng-hide="editingData[tableData.id]">{{tableData.nama_kota}}</div>
										<div ng-show="editingData[tableData.id]"><input class="form-control" placeholder="Nama Kota" ng-model="tableData.nama_kota" maxlength="100"></div>
									</td>
									<td class="col-xs-2" align="center">
										<button class="btn btn-primary btn-sm" ng-hide="editingData[tableData.id]" ng-click="modify(tableData)">Edit</button>
										<button class="btn btn-primary btn-sm" ng-show="editingData[tableData.id]" ng-click="update(tableData)">Simpan</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>

				<button class="btn btn-warning btn-md mt-3" ng-click="init()"><i class="fas fa-sync-alt"></i> Reload</button>
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

		$scope.save_button = "far fa-save";
		$scope.process_message = "";

		$scope.init = function() {
			$scope.nama_kelurahan = "";
			$scope.nama_kecamatan = "";
			$scope.nama_kota = "";

			$scope.loadKelurahan();
		};

		$scope.loadKelurahan = function() {
			$scope.process_message = "";
			$scope.save_button = "far fa-save";

			$http.get(API_URL+"kelurahan").then(function(response) {
				$scope.table_data = response.data;

				$scope.editingData = {};

				for (var i = 0, length = $scope.table_data.length; i < length; i++) {
					$scope.editingData[$scope.table_data[i].id] = false;
				}

				$scope.modify = function(tableData){
					$scope.editingData[tableData.id] = true;
				};

				$scope.update = function(tableData){
					var data = {
						"id" : tableData.id,
						"nama_kelurahan" : tableData.nama_kelurahan,
						"nama_kecamatan" : tableData.nama_kecamatan,
						"nama_kota" : tableData.nama_kota
					};

					$http.put(API_URL+"update_kelurahan", data).then(function(response) {
						$scope.editingData[tableData.id] = false;

						$scope.init();
					});
				};
			});
		};

		$scope.inputKelurahan = function() {
			$scope.process_message = "";
			$scope.save_button = "fas fa-spinner fa-spin";

			var data = {
				"nama_kelurahan" : $scope.nama_kelurahan,
				"nama_kecamatan" : $scope.nama_kecamatan,
				"nama_kota" : $scope.nama_kota
			};

			$http.post(API_URL+"insert_kelurahan", data).then(function(response) {
				$scope.process_message = "Data berhasil disimpan.";
				$scope.save_button = "far fa-save";

				$scope.init();
			});
		};

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