<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Livewire </title>
	@livewireStyles
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				@yield('content')
			</div>
		</div>
	</div>
@livewireScripts
</body>
</html>