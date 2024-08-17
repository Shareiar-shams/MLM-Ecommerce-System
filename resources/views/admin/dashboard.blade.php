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
    <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
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
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{count($orders)}}</h3>

                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $orders->where('order_status', 'Pending')->count() }}</h3>

                        <p>Pending Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $orders->where('order_status', 'Delivery_in_progess')->count() }}</h3>

                        <p>Delivered Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $orders->where('order_status', 'Canceled')->count() }}</h3>

                        <p>Canceled Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{count($ordered_items)}}</h3>

                        <p>Total Product Sale</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                    
                </div>
            </div>
            @php
                use Carbon\Carbon;

                $today = Carbon::today();
                $startOfMonth = Carbon::now()->startOfMonth();
                $startOfYear = Carbon::now()->startOfYear();

                $salesToday = $ordered_items->filter(function($item) use ($today) {
                    return $item->created_at->isSameDay($today);
                })->count();

                $salesThisMonth = $ordered_items->filter(function($item) use ($startOfMonth) {
                    return $item->created_at->greaterThanOrEqualTo($startOfMonth);
                })->count();

                $salesThisYear = $ordered_items->filter(function($item) use ($startOfYear) {
                    return $item->created_at->greaterThanOrEqualTo($startOfYear);
                })->count();
            @endphp
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$salesToday}}</h3>

                        <p>Today Product Order</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$salesThisMonth}}</h3>

                        <p>This Month Sale</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$salesThisYear}}</h3>

                        <p>This Year Product Sale</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                    
                </div>
            </div>

            @php
                $today = Carbon::today();
                $startOfMonth = Carbon::now()->startOfMonth();
                $startOfYear = Carbon::now()->startOfYear();

                // Calculate total earnings
                $totalEarnings = $transactions->sum('amount');

                // Calculate earnings for this month
                $monthlyEarnings = $transactions->filter(function($transaction) use ($startOfMonth) {
                    return $transaction->created_at->greaterThanOrEqualTo($startOfMonth);
                })->sum('amount');

                // Calculate earnings for this year
                $yearlyEarnings = $transactions->filter(function($transaction) use ($startOfYear) {
                    return $transaction->created_at->greaterThanOrEqualTo($startOfYear);
                })->sum('amount');

                // Calculate the number of unique users
                $uniqueUsersCount = $transactions->unique('user_id')->count();
            @endphp

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>&#2547;{{ number_format($totalEarnings, 2) }}</h3>

                        <p>Total Earning</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>&#2547;{{ number_format($monthlyEarnings, 2) }}</h3>

                        <p>This Month Earning</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>&#2547;{{ number_format($yearlyEarnings, 2) }}</h3>

                        <p>This Year Earning</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                    </div> 
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>&#2547;{{count($products)}}</h3>

                        <p>Total Product</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$uniqueUsersCount}}</h3>

                        <p>Total Customers</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{count($reviews)}}</h3>

                        <p>Total Reviews</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{count($transactions)}}</h3>

                        <p>Total Transactions</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($tickets)}}</h3>

                        <p>Total Ticket</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($openticket)}}</h3>

                        <p>Open Ticket</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($closeticket)}}</h3>

                        <p>Close Ticket</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-check-circle"></i>
                    </div>
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
                        <h3 class="card-title">Orders Chart ({{ Carbon::now()->year }})</h3>

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
            <section class="col-lg-6 connectedSortable">
                <!-- LINE CHART -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Monthly Product Sales Report</h3>

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
                      <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>

            <section class="col-lg-6 connectedSortable">
                <!-- LINE CHART -->
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Monthly Earnings Report</h3>

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
                      <canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                  <h3 class="card-title">Recent Order</h3>

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
                        <th>Customer</th>
                        <th>Tracking Id</th>
                        <th>Payment Method</th>
                        <th>Total</th>
                      </tr>
                      </thead>
                      <tbody>
                        @forelse($recent_orders as $order)
                        <tr>
                          <td>{{$order->user->name}}</td>
                          <td>{{$order->tracking_id}}</td>
                          <td>{{$order->transactions->payment_type}}</td>
                          <td>{{number_format($order->total), 2}}</span></td>
                          
                        </tr>
                        @empty
                        @endforelse
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                 
                  <a href="{{route('orders.index')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
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
                  <h3 class="card-title">Recently Added Digital Products</h3>

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

                          <img src="{{asset('admin/dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">

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
    <script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>

    <script type="text/javascript">
        // var labels =  '';
        // var data =  '';
        // $(document).ready(function() {
        //   $.ajax({
        //     url: "{{ route('orders.chart.data') }}", // Replace with your actual route
        //     type: 'GET',
        //     success: function(response) {
        //         function updateChartData(labels, data) {
        //           var chart = $('#areaChart');

        //           // Clear existing chart data (optional)
        //           chart.data().datasets[0].data = [];
        //           chart.data().labels = [];

        //           // Update chart data with new labels and values
        //           chart.data().labels = labels;
        //           chart.data().datasets[0].data = data;

        //           chart.update();
        //         }
        //         updateChartData(response.labels, response.data);
        //     },
        //     error: function(error) {
        //       console.error("Error fetching data:", error);
        //     }
        //   });
        // });
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
                labels  : @json($data['labels']),
                datasets: [
                  {
                    label               : 'Orders',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : @json($data['data'])
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

            //-------------
            //- LINE CHART -
            //--------------

            var lineChartData = {
              labels  : @json($month_wise_data['labels']),
              datasets: [
                {
                  label               : 'Product Sale',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : @json($month_wise_data['data'])
                },
                {
                  label               : 'Electronics',
                  backgroundColor     : 'rgba(210, 214, 222, 1)',
                  borderColor         : 'rgba(210, 214, 222, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : [0]
                },
              ]
            }

            var lineChartOptions = {
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
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, lineChartOptions)
            var lineChartData = $.extend(true, {}, lineChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
              type: 'line',
              data: lineChartData,
              options: lineChartOptions
            })


            //-------------
            //- LINE CHART -2
            //--------------

            var lineChartData2 = {
              labels  : @json($month_wise_data['labels']),
              datasets: [
                {
                  label               : 'Earning',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : @json($month_wise_data['amount'])
                },
                {
                  label               : 'Electronics',
                  backgroundColor     : 'rgba(210, 214, 222, 1)',
                  borderColor         : 'rgba(210, 214, 222, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : [0]
                },
              ]
            }

            var lineChartOptions2 = {
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
            var lineChartCanvas2 = $('#lineChart2').get(0).getContext('2d')
            var lineChartOptions2 = $.extend(true, {}, lineChartOptions2)
            var lineChartData2 = $.extend(true, {}, lineChartData2)
            lineChartData2.datasets[0].fill = false;
            lineChartData2.datasets[1].fill = false;
            lineChartOptions2.datasetFill = false

            var lineChart = new Chart(lineChartCanvas2, {
              type: 'line',
              data: lineChartData2,
              options: lineChartOptions2
            })
        });

        
        
    </script>
@endsection
