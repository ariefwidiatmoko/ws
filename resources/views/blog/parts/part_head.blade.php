
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="description" content="PCnesia adalah blog teknologi mengulas berita dan artikel tentang update terbaru, meliputi tren teknologi, Hardware, Operating System, Console, Game dan Software" itemprop="description" />
  <link rel="shortcut icon" href="/favicon.ico" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('google.analytics')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/src/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/src/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/src/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/src/css/AdminLTE.min.css">
  <!-- AdminLTE Skins-->
  <link rel="stylesheet" href="/src/css/skins/_all-skins.min.css">
  <!-- Loading Page-->
  <link rel="stylesheet" href="/src/css/loading-page.css">
  <style media="screen">
    #header {
      padding: 0 0;
      height: 50px;
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      transition: all 0.5s;
      z-index: 997;
    }

    #header.header-scrolled {
      background: rgba(0, 0, 0, 0.9);
      padding: 20px 0;
      height: 72px;
      transition: all 0.5s;
    }
    #sub-menu {
      background-color: grey;
    }

    p {
      font-weight: normal !important;
    }
  </style>
