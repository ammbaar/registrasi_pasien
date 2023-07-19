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
			<span class="fs-5">DATA PASIEN</span>
		</header>
		<div class="row" ng-init="init()">

			<div class="col-lg-5">
				<form role="form">
					<span class="badge mb-3" style="background-color: #1898ce;">INPUT</span>
					<div class="mb-3 row">
						<label for="inputNama" class="col-sm-3 col-form-label">Nama Pasien</label>
						<div class="col-sm-9">
							<input class="form-control" id="inputNama" placeholder="Nama Pasien" ng-model="nama_pasien" maxlength="40" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
						<div class="col-sm-9">
							<textarea class="form-control" rows="3" id="inputAlamat" placeholder="Alamat" ng-model="alamat" style="resize: none;"></textarea>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputRTRW" class="col-sm-3 col-form-label">RT/RW</label>
						<div class="col-sm-4">
							<input class="form-control" id="inputRTRW" placeholder="RT" ng-model="rt" maxlength="3" required>
						</div>
						<div class="col-sm-1" style="text-align: center;">/</div>
						<div class="col-sm-4">
							<input class="form-control" id="inputRTRW" placeholder="RW" ng-model="rw" maxlength="3" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputKelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
						<div class="col-sm-9">
							<select class="form-control" id="inputKelurahan" ng-model="id_kelurahan" required>
								<option value="" disabled selected>Pilih Kelurahan</option>
								<option ng-repeat="k in selectItem_kelurahan_Array" value="{{k.id}}">{{k.nama_kelurahan}}</option>
							</select>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputTelp" class="col-sm-3 col-form-label">No Telepon</label>
						<div class="col-sm-9">
							<input class="form-control" id="inputTelp" placeholder="No Telepon" ng-model="no_telp" maxlength="15" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputTgl" class="col-sm-3 col-form-label">Tanggal Lahir</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" id="inputTgl" placeholder="Pilih Tanggal" ng-model="tgl_lahir" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label for="inputJenis" class="col-sm-3 col-form-label">Jenis Kelamin</label>
						<div class="col-sm-9">
							<select class="form-control" id="inputJenis" ng-model="jenis_kelamin" required>
								<option value="" disabled selected>Pilih Jenis Kelamin</option>
								<option ng-repeat="jk in selectItem_jenisKelamin_Array" value="{{jk.value}}">{{jk.label}}</option>
							</select>
						</div>
					</div>
					<button class="btn btn-secondary btn-md" type="reset" ng-click="init()"><i class="fas fa-undo-alt"></i> Batal</button>
					<button class="btn btn-primary btn-md ms-1" ng-click="inputPasien()"><i class="{{save_button}}"></i> Tambah</button>
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
									<th class="col-xs-2">ID</th>
									<th class="col-xs-3">NAMA PASIEN</th>
									<th class="col-xs-3">NO TELEPON</th>
									<th class="col-xs-2">JENIS KELAMIN</th>
									<th class="col-xs-2">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="tableData in table_data">
									<td class="col-xs-2" align="center">{{tableData.id}}</td>
									<td class="col-xs-3">{{tableData.nama_pasien}}</div></td>
									<td class="col-xs-3">{{tableData.no_telp}}</td>
									<td class="col-xs-2">{{tableData.jenis_kelamin}}</div></td>
									<td class="col-xs-2" align="center">
										<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_{{tableData.id}}" ng-click="edit(tableData)">Edit</button>
										<!-- Modal -->
										<div class="modal fade" id="edit_{{tableData.id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<b class="modal-title">EDIT DATA PASIEN</b>
														<button class="btn close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body" style="text-align: left;">
														<center><b>DATA PASIEN</b></center>
														<br>
														<form role="form">
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">ID Pasien</label>
																<div class="col-sm-10">
																	<input class="form-control" placeholder="ID Pasien" ng-model="tableData.id" disabled>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">Nama Pasien</label>
																<div class="col-sm-10">
																	<input class="form-control" placeholder="Nama Pasien" ng-model="tableData.nama_pasien" maxlength="40" required>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">Alamat</label>
																<div class="col-sm-10">
																	<textarea class="form-control" rows="3" placeholder="Alamat" ng-model="tableData.alamat" style="resize: none;"></textarea>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">RT/RW</label>
																<div class="col-sm-10">
																	<input class="form-control" placeholder="RT" ng-model="tableData.rt_rw" maxlength="3" required>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">Kelurahan</label>
																<div class="col-sm-10">
																	<select class="form-control" ng-model="tableData.id_kelurahan" required>
																		<option value="" disabled selected>Pilih Kelurahan</option>
																		<option ng-repeat="k in selectItem_kelurahan_Array" value="{{k.id}}">{{k.nama_kelurahan}}</option>
																	</select>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">No Telepon</label>
																<div class="col-sm-10">
																	<input class="form-control" placeholder="No Telepon" ng-model="tableData.no_telp" maxlength="15" required>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">Tanggal Lahir</label>
																<div class="col-sm-10">
																	<input type="date" class="form-control" placeholder="Pilih Tanggal" ng-model="tableData.tgl_lahir" required>
																</div>
															</div>
															<div class="mb-3 row">
																<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
																<div class="col-sm-10">
																	<select class="form-control" ng-model="tableData.jenis_kelamin" required>
																		<option value="" disabled selected>Pilih Jenis Kelamin</option>
																		<option ng-repeat="jk in selectItem_jenisKelamin_Array" value="{{jk.value}}">{{jk.label}}</option>
																	</select>
																</div>
															</div>
															<button class="btn btn-primary btn-md ms-1" ng-click="update(tableData)" data-bs-dismiss="modal"><i class="{{save_button}}"></i> Simpan</button>
														</form>
													</div>
												</div>
											</div>
										</div>

										<br>

										<div style="padding-top: 10px;">
											<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#cetak_{{tableData.id}}" ng-click="cetak(tableData)">Cetak Kartu</button>
											<!-- Modal -->
											<div class="modal fade" id="cetak_{{tableData.id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<b class="modal-title">CETAK KARTU PASIEN</b>
															<button class="btn close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</div>
														<div class="modal-body" style="text-align: left;">
															<center><b>KARTU PASIEN</b></center>
															<br>
															<table>
																<tr>
																	<td width="120">ID Pasien</td>
																	<td width="20">:</td>
																	<td>{{tableData.id}}</td>
																</tr>
																<tr>
																	<td>Nama</td>
																	<td>:</td>
																	<td>{{tableData.nama_pasien}}</td>
																</tr>
																<tr>
																	<td style="vertical-align: top;">Alamat</td>
																	<td style="vertical-align: top;">:</td>
																	<td>{{tableData.alamat}} {{tableData.rt_rw}}
																		<br>Kel. {{tableData.nama_kelurahan}}, Kec. {{tableData.nama_kecamatan}}, Kota {{tableData.nama_kota}}
																	</td>
																</tr>
																<tr>
																	<td>No Telepon</td>
																	<td>:</td>
																	<td>{{tableData.no_telp}}</td>
																</tr>
																<tr>
																	<td>Tanggal Lahir</td>
																	<td>:</td>
																	<td>{{tableData.tgl_lahir}}</td>
																</tr>
																<tr>
																	<td>Jenis Kelamin</td>
																	<td>:</td>
																	<td>{{tableData.jenis_kelamin}}</td>
																</tr>
															</table>
															<br>
															<button class="btn btn-success btn-sm" onclick="window.print()" data-bs-dismiss="modal">Cetak</button>
														</div>
													</div>
												</div>
											</div>
										</div>
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

		$scope.selectItem_jenisKelamin_Array = [{label:'Laki-Laki', value:'Laki-Laki'},{label:'Perempuan', value:'Perempuan'}];

		$scope.init = function() {
			$scope.nama_pasien = "";
			$scope.alamat = "";
			$scope.rt = "";
			$scope.rw = "";
			$scope.id_kelurahan = "";
			$scope.no_telp = "";
			$scope.tgl_lahir = "";
			$scope.jenis_kelamin = "";

			$scope.loadKelurahan();
			$scope.loadPasien();
		};

		//kelurahan
		$scope.loadKelurahan = function() {
			$http.get(API_URL+"kelurahan_dropdown").then(function(result) {
				$scope.selectItem_kelurahan_Array = result.data;
			});
		}

		$scope.loadPasien = function() {
			$scope.process_message = "";
			$scope.save_button = "far fa-save";

			$http.get(API_URL+"pasien").then(function(response) {
				$scope.table_data = response.data;

				$scope.update = function(tableData){
					var data = {
						"id" : tableData.id,
						"nama_pasien" : tableData.nama_pasien,
						"alamat" : tableData.alamat,
						"no_telp" : tableData.no_telp,
						"rt_rw" : tableData.rt_rw,
						"id_kelurahan" : tableData.id_kelurahan,
						"tgl_lahir" : tableData.tgl_lahir,
						"jenis_kelamin" : tableData.jenis_kelamin
					};

					$http.put(API_URL+"update_pasien", data).then(function(response) {
						$scope.init();
					});
				};
			});
		};

		$scope.inputPasien = function() {
			$scope.process_message = "";
			$scope.save_button = "fas fa-spinner fa-spin";

			var data = {
				"nama_pasien" : $scope.nama_pasien,
				"alamat" : $scope.alamat,
				"rt_rw" : $scope.rt+"/"+$scope.rw,
				"id_kelurahan" : $scope.id_kelurahan,
				"no_telp" : $scope.no_telp,
				"tgl_lahir" : $scope.tgl_lahir,
				"jenis_kelamin" : $scope.jenis_kelamin
			};

			$http.post(API_URL+"insert_pasien", data).then(function(response) {
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