<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:title" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:description" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:image" content="https://mophy.dexignzone.com/xhtml/social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    <!-- Favicon icon -->
    <!-- Vectormap -->
    <link href="<?= base_url('assets/mophy/vendor/jqvmap/css/jqvmap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/mophy/css/style.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/mophy/vendor/owl-carousel/owl.carousel.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">

            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>
                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
									<div class="header-info">
										<span class="text-black">Hello,<strong>Franklin</strong></span>
										<p class="fs-12 mb-0">Super Admin</p>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?= base_url('Auth/logout'); ?>" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">Apps</span>
						</a>
                    </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-controls-3"></i>
							<span class="nav-text">Charts</span>
						</a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-internet"></i>
							<span class="nav-text">Bootstrap</span>
						</a>

                    </li>
                </ul>
				
				<div class="copyright">
					<p><strong>Tech meetings</strong> © 2025 All Rights Reserved</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head mb-4">
					<h2 class="text-black font-w600 mb-0">
                        <?= $this->renderSection('title'); ?>
                    </h2>
				</div>
				<div class="row">
                <?= $this->renderSection('content'); ?>
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://grupostandex.com.mx/" target="_blank">Grupo Standex</a> 2025</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->	
    <script src="<?= base_url('assets/mophy/vendor/global/global.min.js'); ?>"></script>
	<script src="<?= base_url('assets/mophy/vendor/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>
	<script src="<?= base_url('assets/mophy/vendor/chart.js/Chart.bundle.min.js'); ?>"></script>
	<script src="<?= base_url('assets/mophy/vendor/owl-carousel/owl.carousel.js'); ?>"></script>
    <script src="<?= base_url('assets/mophy/vendor/peity/jquery.peity.min.js'); ?>"></script>
    <script src="<?= base_url('assets/mophy/js/plugins-init/chartjs-init.js'); ?>"></script>
	<script src="<?= base_url('assets/mophy/vendor/apexchart/apexchart.js'); ?>"></script>
	<script src="<?= base_url('assets/mophy/js/dashboard/dashboard-1.js'); ?>"></script>
    <script src="<?= base_url('assets/mophy/js/custom.min.js'); ?>"></script>
	<script src="<?= base_url('assets/mophy/js/deznav-init.js'); ?>"></script>
    <script src="<?= base_url('assets/js/stdx_scripts.js'); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
	<script>

	</script>
</body>
</html>