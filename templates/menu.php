<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1898ce;">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= $uri ?>/../home" style="color: #FFFFFF;"><i class="fas fa-home"></i> Registrasi Pasien</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<?php if($_COOKIE["role"] == "Admin"){ ?>
				<li class="nav-item dropdown">
					<a class="nav-link" href="<?= $uri ?>/../page_kelurahan" style="color: #FFFFFF;"><i class="fas fa-table"></i> Data Kelurahan</a>
				</li>
				<?php }else{ ?>
				<li class="nav-item dropdown">
					<a class="nav-link" href="<?= $uri ?>/../page_pasien" style="color: #FFFFFF;"><i class="fas fa-table"></i> Data Pasien</a>
				</li>
				<?php } ?>
			</ul>
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FFFFFF;">
						<i class="fas fa-user"></i> <?php echo $_COOKIE["username"]; ?>
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="" onclick="return log_out()"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<script>
	function log_out() {
		if (confirm('Apakah Anda yakin akan keluar dari aplikasi ini?')) {
			var scope = angular.element(document.getElementById('main')).scope();
			scope.logout();
		} else {
			return false;
		}
	}
</script>