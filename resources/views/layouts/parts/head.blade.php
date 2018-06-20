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
  <!-- Select2 CSS -->
  <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
      color: white !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc !important;
        border: none !important;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-right: 10px;
        line-height: 20px;
    }
  </style>
  <!-- Scripts -->
  <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script>
</head>
