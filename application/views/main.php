<!DOCTYPE html>
<html lang='en'><head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'>
<title>test</title>
<!-- GOOGLE FONTS -->
<link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500' rel='stylesheet'>
<!-- GLOBAL VENDOR STYLES -->
<link rel='stylesheet' href='/css/vendor/bootstrap.css'>
<link rel='stylesheet' href='/vendor/metismenu/dist/metisMenu.css'>
<link rel='stylesheet' href='/vendor/switchery-npm/index.css'>
<link rel='stylesheet' href='/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css'>
<!-- LINE AWESOME ICONS -->
<link rel='stylesheet' href='/css/icons/line-awesome.min.css'>
<!-- DRIP ICONS -->
<link rel='stylesheet' href='/css/icons/dripicons.min.css'>
<!-- MATERIAL DESIGN ICONIC FONTS -->
<link rel='stylesheet' href='/css/icons/material-design-iconic-font.min.css'>
<!-- PAGE LEVEL VENDOR STYLES -->
<link rel='stylesheet' href='/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css'>
<link rel='stylesheet' href='/vendor/bootstrap-daterangepicker/daterangepicker.css'>
<link rel='stylesheet' href='/vendor/select2/select2.min.css'>
<!-- GLOBAL COMMON STYLES -->
<link rel='stylesheet' href='/css/common/main.bundle.css'>
<!-- LAYOUT TYPE -->
<link rel='stylesheet' href='/css/layouts/vertical/core/main.css'>
<!-- MENU TYPE -->
<link rel='stylesheet' href='/css/layouts/vertical/menu-type/default.css'>
<!-- THEME COLOR STYLES -->
<link rel='stylesheet' href='/css/layouts/vertical/themes/theme-a.css'>
</head>

<body>

    <div class='row m-l-0 m-r-0 p-20'>
	<div class='card col-12 p-20'>
	
										<div class="alert alert-danger alert-dismissible fade show" style='display:none;' role="alert"><strong>Oops!</strong> Something goes wrong. <span class='error_text'></span>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="la la-close"></span></button></div>
										<div class="alert alert-success alert-dismissible fade show" style='display:none;' role="alert"><strong>Success!</strong> <span class='error_text'></span>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="la la-close"></span></button></div>
	    
	<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>name</th>
																<th>surename</th>
																<th>date of birth</th>
																<th>phone</th>
																<th>email</th>
																<th>save</th>
																<th>delete</th>
															</tr>
															<tr>
																<th><input type='text' class='name form-control text-center' value='' placeholder='Name'></th>
																<th><input type='text' class='surename form-control text-center' value='' placeholder='Surename'></th>
																<th>
																
																    <div class="input-group input-daterange">
																	<input type="text" class='date form-control text-center' id="range-picker-1" style='border-radius:3px 3px 3px 3px;' data-date-format="dd-mm-yyyy" value=''>
																    </div>
																
																</th>
																<th><input type='text' class='mobile form-control text-center' value='' placeholder='+380506800793'></th>
																<th><input type='email' class='email form-control text-center' value='' placeholder='mail@domain.com'></th>
																<th><input type='button' class='save btn btn-success btn-floating' value='save'></th>
																<th><input type='button' class='del btn btn-danger btn-floating' value='delete'></th>

															</tr>
														</thead>
														<tbody id='data'>
														</tbody>
													</table>
												</div>
	
	
	</div>
    </div>
    
<!-- GLOBAL VENDOR SCRIPTS -->
<script src='/vendor/modernizr/modernizr.custom.js'></script>
<script src='/vendor/jquery/dist/jquery.min.js'></script>
<script src='/vendor/bootstrap/dist/js/bootstrap.bundle.min.js'></script>
<script src='/vendor/js-storage/js.storage.js'></script>
<script src='/vendor/js-cookie/src/js.cookie.js'></script>
<script src='/vendor/pace/pace.js'></script>
<script src='/vendor/metismenu/dist/metisMenu.js'></script>
<script src='/vendor/switchery-npm/index.js'></script>
<script src='/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'></script>
<!-- PAGE LEVL VENDOR SCRIPTS -->
<script src='/vendor/jquery-mask/jquery.mask.min.js'></script>
<script src='/vendor/moment/min/moment.min.js'></script>
<script src='/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js'></script>
<script src='/vendor/bootstrap-daterangepicker/daterangepicker.js'></script>
<script src='/vendor/select2/select2.min.js'></script>
<!-- GLOBAL APP SCRIPTS -->
<script src='/js/global/app.js'></script>
<script src='/js/main.js'></script>
<!-- PAGE LEVEL APP SCRIPTS -->
<script src='/js/components/bootstrap-datepicker-init.js'></script>
<script src='/js/components/bootstrap-date-range-picker-init.js'></script>
<script src='/js/components/select2-init.js'></script>
<script src='/js/components/jquery-mask-init.js'></script>
</body></html>