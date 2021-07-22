<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Loaner Dashboard</title>
  <base href="{{ \URL::to('/')}}">
  <!-- Favicon -->
  <link rel="icon" href="img/alogo.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
    <div class="scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 594px;">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="img/alogo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{ route('loaner.home') }}" is class="nav-link {{ (request()->is('loaner/home*')) ? 'active' : ''}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">หน้าแรก</span>
              </a>
            </li>
  
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-planet text-orange"></i>  
             รายการ</a>
            
            <div class="dropdown-menu">
            <a class="dropdown-item"  href="{{ route('loaner.requestMenu1')}}" is class="nav-link {{ (request()->is('loaner/requestMenu1*')) ? 'active' : ''}}"> <i class="ni ni-send text-default"></i>คำขอ</a>
            <a class="dropdown-item"  href="{{ route('loaner.menu2') }}" is class="nav-link {{ (request()->is('loaner/menu2*')) ? 'active' : ''}}"> <i class="ni ni-ui-04 text-danger"></i>  รอโอนเงิน</a>
            <a class="dropdown-item"  href="{{ route('loaner.menu3') }}" is class="nav-link {{ (request()->is('loaner/menu3*')) ? 'active' : ''}}"> <i class="ni ni-time-alarm text-yellow"></i>  รอชำระ</a>
            <a class="dropdown-item"  href="{{ route('loaner.menu4') }}" is class="nav-link {{ (request()->is('loaner/menu4*')) ? 'active' : ''}}"> <i class="ni ni-check-bold text-success"></i>  สำเร็จ</a>
            <a class="dropdown-item"  href="{{ route('loaner.menu5') }}" is class="nav-link {{ (request()->is('loaner/menu5*')) ? 'active' : ''}}"> <i class="ni ni-fat-remove text-red"></i>  ไม่สำเร็จ</a>
            </div>
            </li>
            <li class="nav-item">
            <a href="#" is class="nav-link {{ (request()->is('admin/borrowermanage*')) ? 'active' : ''}}">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Borrower Request</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('loaner.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Logout</span>
              </a>
              <form action="{{ route('loaner.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Documentation</span>
          </h6>
          <!-- Navigation -->
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark  border-bottom" style="background-image: linear-gradient( 135deg, #81FBB8 10%, #28C76F 100%);">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-ungroup"></i>
              </a>
            </li>
          </ul>
         
              
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ url('/') }}/assets/uploadfile/Loaner/profile/{{ Auth::guard('loaner')->user()->imageProfile }}">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm font-weight-bold" style="color:white">{{ Auth::guard('loaner')->user()->firstname }}</span>
                  </div>
                </div>
              
           
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6 ">
    @yield('content')
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      
      
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if (Session::has('success'))
      <script>
          swal("Success!","{!! Session::get('success') !!}","success",{
          button:"OK",
          });             
      </script>
  @endif
  @if (Session::has('fail'))
      <script>
        swal("Success!","{!! Session::get('fail') !!}","warning",{
        button:"OK",
        });             
      </script>
  @endif

  <script>
  $.ajaxSetup({
     headers:{
       'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
  });
  


  $(function(){
              
              $("#Update").on('submit', function(e){
                  e.preventDefault();
          
                  $.ajax({
                      url:$(this).attr('action'),
                      method:$(this).attr('method'),
                      data:new FormData(this),
                      processData:false,
                      dataType:'json',
                      contentType:false,
                      beforeSend:function(){
                          $(document).find('span.error-text').text('');
                      },
                      success:function(data){
                          if(data.status == 0){
                              $.each(data.error, function(prefix, val){
                                  $('span.'+prefix+'_error').text(val[0]);
                              });
                          }else{
                            $('.money_minn').each(function(){
                              $(this).html( $('#Update').find( $('input[name="money_min"]') ).val() );
                            });
                            $('.money_maxx').each(function(){
                              $(this).html( $('#Update').find( $('input[name="money_max"]') ).val() );
                            });
                            $('.interestt').each(function(){
                              $(this).html( $('#Update').find( $('input[name="interest"]') ).val() );
                            });
                            $('.Interest_penaltyy').each(function(){
                              $(this).html( $('#Update').find( $('input[name="Interest_penalty"]') ).val() );
                            });
                            $('.instullment_maxx').each(function(){
                              $(this).html( $('#Update').find( $('input[name="instullment_max"]') ).val() );
                            });
                              swal("Success!",data.msg,"success",{
                              button:"OK",
                              })
                              .then((value) => {
                                $('#exampleModal').modal('hide');
                                window.location.reload();
                              }); 
                              
                          }
                      }
                  });
              });
  });


         

  </script>
</body>

</html>
