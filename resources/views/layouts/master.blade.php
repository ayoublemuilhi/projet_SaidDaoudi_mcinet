<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="mcinet">
		<meta name="Author" content="mcinet">
		<meta name="Keywords" content="mcinet"/>
		@include('layouts.head')
<style>
    .hoverable-table .btn-primary{
        margin-left: 0;
        margin-right: 0;
        position: static;
    }
</style>
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.sidebar')

		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.header')
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				        @yield('content')

				@include('layouts.footer')

                <script>
                    $(function () {
                        $("#alert-message").fadeTo(2000, 500).slideUp(500, function () {
                            $('#alert-message').slideUp(500);
                        });
                    });
                </script>
	</body>
</html>
