<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kurir Tilang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="adminlte/plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{url('/css/sweetalert.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

  

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        {{-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a> --}}
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link-2" style="display: block;line-height: 1.5;border-bottom: 1px solid #dee2e6;padding-bottom: 0.5rem;">
      <img src="{{ asset('uploads/Logo-02.png')}}"
           {{-- alt="AdminLTE Logo" --}}
           {{-- class="brand-image img-circle elevation-3" --}}
           style="width: 235px;"           >
      {{-- <span class="brand-text font-weight-light">Kurir Tilang</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} / {{ Auth::user()->role }} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          {{-- @can('isAdmin') --}}
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home                
              </p>
            </a>            
          </li>
          @if(Gate::check('isKurir') || Gate::check('isAdmin'))
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard                
              </p>
            </a>            
          </li>
          @endif
          {{-- @endcan --}}
          @can('isCustomer')
          <li class="nav-item">
            <a href="{{ route('CreateOrder') }}" class="nav-link {{ request()->is('CreateOrder*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Pesan
              </p>
            </a>
          </li>
          @endcan
          <li class="nav-item has-treeview 
          {{ request()->is('GetAllPendingOrder*') ? 'menu-open' : '' }}  
          {{ request()->is('GetAllUnpaidOrder*') ? 'menu-open' : '' }}
          {{ request()->is('WaitPaymentConfirmation*') ? 'menu-open' : '' }}
          {{ request()->is('GetAllOnprogressOrder*') ? 'menu-open' : '' }}
          {{ request()->is('GetAllCompleteOrder*') ? 'menu-open' : '' }}
          ">
          
            <a href="#" class="nav-link 
            {{ request()->is('GetAllPendingOrder*') ? 'active' : '' }}
            {{ request()->is('GetAllUnpaidOrder*') ? 'active' : '' }}
            {{ request()->is('WaitPaymentConfirmation*') ? 'active' : '' }}
            {{ request()->is('GetAllOnprogressOrder*') ? 'active' : '' }}
            {{ request()->is('GetAllCompleteOrder*') ? 'active' : '' }}
            ">

              <i class="nav-icon fa fa-desktop"></i>
              <p>
                Monitor Order
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('GetAllPendingOrder') }}" class="nav-link {{ request()->is('GetAllPendingOrder*') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>
                  Pending
                  {{-- <span class="right badge badge-danger">5</span> --}}
                  </p>
                </a>
              </li>
              @if(Gate::check('isCustomer') || Gate::check('isAdmin'))
              <li class="nav-item">
                <a href="{{ route('GetAllUnpaidOrder') }}" class="nav-link {{ request()->is('GetAllUnpaidOrder*') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>
                  Wait Payment
                  {{-- <span class="right badge badge-danger">5</span> --}}
                  </p>
                </a>
              </li>
              @endif
              @if(Gate::check('isCustomer') || Gate::check('isAdmin'))
              <li class="nav-item">
                <a href="{{ route('WaitPaymentConfirmation') }}" class="nav-link {{ request()->is('WaitPaymentConfirmation*') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>
                  Wait Confirmation
                  {{-- <span class="right badge badge-danger">5</span> --}}
                  </p>
                </a>
              </li>
              @endif
              {{-- @endcan --}}
              <li class="nav-item">
                <a href="{{ route('GetAllOnprogressOrder') }}" class="nav-link {{ request()->is('GetAllOnprogressOrder*') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>On Progress</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('GetAllCompleteOrder') }}" class="nav-link {{ request()->is('GetAllCompleteOrder*') ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Complete</p>
                </a>
              </li>
            </ul>
          </li>
          @can('isAdmin') 
          <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Master Petugas
                </p>
              </a>
          </li>
          @endcan
          @can('isAdmin') 
          <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Master Kurir
                </p>
              </a>
          </li>
          @endcan
          @can('isAdmin') 
          <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Master Customer
                </p>
              </a>
          </li>
          @endcan
          <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>
                  Logout
                </p>
              </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">KurirTilang</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
<script src="{{ asset('js/sweetalert.min.js')}}"></script>
<script>
        $(function () {
          $("#example2").DataTable();
          $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,                      
          });
        });
      </script>
@include('sweetalert::alert')
</body>
</html>
