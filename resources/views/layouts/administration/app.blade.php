<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  {{-- Meta Starts --}}
    @include('layouts.administration.partials_.metas')
    {{-- Meta Ends --}}
  <title>
    @section('admin_title_content')
      @show
  </title>

  @include('admin.layouts.partials_.admin-css')
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      @include('admin.layouts.navigation')
      <!-- /.navbar -->

      @include('admin.layouts.partials_.main-sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      @section('admin_content_header')
                        @show
                      {{-- @include('admin.layouts.partials_.content-header') --}}
                      
                  </div><!-- /.row -->
              </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
              @section('admin_main_content')
                  @show
            
          </section>
          <!-- /.content -->
      </div>
      @include('admin.layouts.partials_.footer')
      

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('admin.layouts.partials_.admin-js')
    
</body>
</html>
