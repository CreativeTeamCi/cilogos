<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>@yield('title') | CI Logos - Projet opensource</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

        @include('layouts.shared.meta')
        @include('layouts.shared.styles')
        @stack('styles')
	</head>
	<body>
		<!-- Loader -->
		<div class="crt-loader">
			<div>
				<span class="load" style="font-size: 30px">CI Logos</span>
				<img src="{{ asset('assets/images/oval.svg') }}" alt="Logo"/>
				<p>Powered By CreativeTeam</p>
			</div>
		</div>
		<!-- Background -->
		<div class="crt-background">
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
			<div class="crt-background-item"></div>
		</div>
		<!-- Wrapper -->
		<div class="crt-wrapper">
			<!-- Theme Style -->
			<div class="crt-theme-style">
				<a class="cursor-pointer" href="javascript:;">
                    Mode sombre
                </a>
			</div>
			<!-- Header -->
            @include('layouts.shared.nav')

            @yield('content')
            <!-- Footer -->
			@include('layouts.shared.footer')
		<!-- JQuery -->
        </div>
        @include('layouts.shared.scripts')

        @stack('scripts')
	</body>
</html>
