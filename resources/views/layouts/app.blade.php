<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Indra Cellular | Dashboard</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

    @include('layouts.preloader')
    @include('layouts.navigation')
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')

    {{-- {{ $slot }} --}}

  </div>

  <footer class="main-footer">
    @include('layouts.footer')
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

    @include('layouts.script')
    @stack('scripts')

</body>
</html>
