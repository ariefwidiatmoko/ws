<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSFR token for ajax call -->
  <meta name="_token" content="{{ csrf_token() }}"/>
  <title>{{ config('app.name', 'Laravel') }} | Administrator Dashboard</title>
  <link rel="icon" href="/favicon.ico">
  <!-- Responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- All CSS -->
  @yield('stylesheets')
  <link rel="stylesheet" href="/src/css/all.css">
  <!-- Scripts -->
  <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script>
</head>
