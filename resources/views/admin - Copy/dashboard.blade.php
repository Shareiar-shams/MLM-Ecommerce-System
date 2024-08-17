@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Dashboard
@endsection
@section('admin_content_header')
  <div class="col-sm-6">
    <h1 class="m-0">Dashboard</h1>
  </div><!-- /.col -->
  @php 
    $list = json_encode(['Home', 'Dashboard']);
  @endphp
  <x-ad-breadcrumb :list="$list"/>
@endsection
@section('admin_css_content')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('admin_main_content')

    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($users)}}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('customers.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                        <h3>{{count($activeUsers)}}</h3>

                        <p>Active Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('customers.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{count($mlmUsers)}}</h3>

                        <p>Total Mlm Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('adminmlm.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{count($activemlmUsers)}}</h3>

                        <p>Active Mlm Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('adminmlm.active')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($activemlmUsers)}}</h3>

                        <p>Purchase Digital Product</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('customers.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <!-- AREA CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Area Chart</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              
              <!-- TABLE: LATEST ORDERS -->
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Order</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Item</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td><a href="javascript:void(0)">UpComing</a></td>
                        <td>Upcoming</td>
                        <td><span class="badge badge-success">Upcoming</span></td>
                        
                      </tr>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                 
                  <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <!-- Calendar -->
              <div class="card bg-gradient-success">
                <div class="card-header border-0">

                  <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i>
                      </button>
                      {{-- <div class="dropdown-menu" role="menu">
                        <a href="#" class="dropdown-item">Add new event</a>
                        <a href="#" class="dropdown-item">Clear events</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View calendar</a>
                      </div> --}}
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              

              <!-- PRODUCT LIST -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Recently Added Products</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach($digitalproducts as $item)
                    <li class="item">
                      <div class="product-img">
                        @if($item->display_image != 'noimage.jpg')

                          <img class="img-size-50" src="{{Storage::disk('local')->url($item->featured_image)}}" alt="Digital Product Image {{$item->id}}">

                        @else

                          <img src="{{Vite::asset('resources/dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">

                        @endif
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{$item->name}}
                          <span class="badge badge-warning float-right">&#2547;{{ (isset($item->special_price)) ? $item->special_price : $item->price }}</span></a>
                        <span class="product-description">
                          @if($item->status == 1)
                            <label class="badge badge-success">Active</label>
                          @else
                            <label class="badge badge-info">Inactive</label>
                          @endif
                        </span>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="{{route('digitalproduct.index')}}" class="uppercase">View All Digital Products</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    
@endsection
@section('admin_js_content')

    <!-- ChartJS -->
    <script src="{{Vite::asset('resources/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{Vite::asset('resources/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{Vite::asset('resources/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{Vite::asset('resources/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{Vite::asset('resources/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{Vite::asset('resources/plugins/moment/moment.min.js')}}"></script>
    <script src="{{Vite::asset('resources/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{Vite::asset('resources/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{Vite::asset('resources/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{Vite::asset('resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{Vite::asset('resources/dist/js/pages/dashboard.js')}}"></script>

    <script type="text/javascript">
        $(function () {

           // The Calender
          $('#calendar').datetimepicker({
            format: 'L',
            inline: true
          });
          /* ChartJS
           * -------
           * Here we will create a few charts using ChartJS
           */

          //--------------
          //- AREA CHART -
          //--------------

          // Get context with jQuery - using jQuery's .get() method.
          var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

          var areaChartData = {
            labels  : ['January', 'March', 'May', 'July', 'September', 'June', 'November'],
            datasets: [
              {
                label               : 'Transections',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [28, 48, 40, 19, 86, 27, 90]
              },
              
            ]
          }

          var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : false,
                }
              }],
              yAxes: [{
                gridLines : {
                  display : false,
                }
              }]
            }
          }

          // This will get the first returned node in the jQuery collection.
          new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
          })
        })
    </script>
@endsection
