<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Not-authorized - {{config('app.name')}}</title>
    <link rel="apple-touch-icon" href="{{url('app-assets/images/ico/apple-icon-120.html')}}">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/components.min.css')}}">
    <!-- END: Theme CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- not authorized start -->
            <section class="row flexbox-container">
              <div class="col-xl-7 col-md-8 col-12">
                <div class="card bg-transparent shadow-none">
                  <div class="card-body text-center bg-transparent">
                    <img src="{{url('app-assets/images/pages/not-authorized.png')}}" class="img-fluid" alt="not authorized" width="400">
                    <h1 class="my-2 error-title">You are not authorized!</h1>
                    <p>You do not have permission to view this directory or page using the credentials that you supplied.</p>
                    <span class="btn btn-primary round glow mt-2" style="text-transform: uppercase;user-select: none;">{{config('app.name')}}</span>
                  </div>
                </div>
              </div>
            </section>
            <!-- not authorized end -->
        </div>
      </div>
    </div>
    <!-- END: Content-->

</body>
<!-- END: Body-->
</html>