<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page_title') | Online Store</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/assets/admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/admin/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
    <!-- Logo -->
    <a href="assets/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>MS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CMS</b> Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img class="profile-user-img img-responsive img-circle" src="/uploads/user/{{Auth()->user()->user_img}}" alt="User profile picture">
              <span class="hidden-xs">{{Auth()->user()->name}}</span>   
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(Auth()->user()->user_img == 'No image found')
                  <img class="profile-user-img img-responsive img-circle" src="/uploads/no-img.jpg" alt="User profile picture">
                @else
                  <img class="profile-user-img img-responsive img-circle" width="50" height="50" src="/uploads/user/{{Auth()->user()->user_img}}" alt="User profile picture">
                @endif
                <p>
                  {{Auth()->user()->designation}}
                  <small>{{Auth()->user()->created_at}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="#" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        @if(Auth()->user()->user_img == 'No image found')
                          <img class="profile-user-img img-responsive img-circle" src="/uploads/no-img.jpg" alt="User profile picture">
                        @else
                          <img class="profile-user-img img-responsive img-circle" src="/uploads/user/{{Auth()->user()->user_img}}" alt="User profile picture">
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{Auth()->user()->name}}</p>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            
            

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{Route('category.create')}}"><i class="fa fa-circle-o"></i> Create Category </a></li>
                    <li class=""><a href="{{Route('category.all')}}"><i class="fa fa-circle-o"></i> View Category --- <span class="text-primary ps-2">{{count(DB::table('category')->get())}}</a></li>
                </ul>
            </li>

            <li class=" treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{Route('product.create')}}"><i class="fa fa-circle-o"></i> Create Product </a></li>
                    <li class=""><a href="{{Route('product.all')}}"><i class="fa fa-circle-o"></i> View Product --- <span class="text-primary ps-2">{{count(DB::table('product')->get())}}</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{Route('admin.order')}}" class="text-primary"><i class="fa fa-circle-o"></i> Add To Cart Orders --- <span class="text-primary ps-2">{{count(DB::table('orders')->where("buy_now","no")->get())}}</span></a>

                    </li>
                    <li class=""><a href="{{Route('admin.single.order')}}"><i class="fa fa-circle-o"></i> Buy Now Orders --- <span class="text-primary ps-2">{{count(DB::table('orders')->where("buy_now","yes")->get())}}</span></a>
                    </li>
                </ul>
                <li class="treeview">
                <a href="{{Route('settings')}}">
                    <i class="fa fa-tasks"></i> <span>Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
        </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>@yield('page_title')</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Tables</a></li>
                    <li class="active">Simple</li>
                </ol>
            </section>
            <!-- Main content -->
            @yield('main_content')
        	<!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019-2024 <a href="https://www.alfateemacademy.com/" target="_blank">Waleed Ali</a>.</strong> All rights reserved.
    </footer>
    <!-- ./wrapper -->
    <script src="/assets/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/admin/dist/js/app.min.js"></script>
    <script src="/assets/admin/dist/js/demo.js"></script>

</body>

</html>