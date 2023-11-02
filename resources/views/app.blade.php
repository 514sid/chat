<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Chat</title>
		@viteReactRefresh
		@vite(['resources/js/main.tsx', 'resources/css/app.css'])
	</head>

	<body class="font-sans antialiased">
		<div id="app"></div>
	</body>

</html>
