<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require '../php-includes/connect.php';
require 'php-includes/check-login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Animal feeding system
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <style>
* { font-family: 'Roboto', sans-serif; }

body {
  background: #23262D;
  color: #aaa;
  line-height: 1.6;
  font-weight: 300;
}

.container { margin:150px auto; max-width:640px;}
.chart-col { margin:20px auto;}
.graph-container {
  height: 219px;
  width: 450px;
  border: 1px solid #a0a0a0;
  border-right: none;
  border-top: none;
  position: relative;
  margin-left: auto;
  margin-right: auto;
}

.graph-container .graph-bar {
  position: absolute;
  width: 162px;
  padding-top: 15px;
  padding-left: 10px;
  bottom: -100%;
}

.graph-container .graph-bar p {
  font-family: 'HelveticaNeueW01-75Bold', Arial, Helvetica, sans-serif;
  color: #ffffff;
  text-align: center;
  font-size: 44px;
  display: none;
  position: relative;
  top: -25px;
}

.graph-container .graph-bar.placebo-bar {
  background: -webkit-gradient(radial, center center, 0, center center, 100%, color-stop(0%, #a4a4a4), color-stop(60%, #868686), color-stop(100%, #868686));
  background: -webkit-radial-gradient(center, circle cover, #a4a4a4 0%, #868686 60%, #868686 100%);
  background: -webkit-radial-gradient(center circle, #a4a4a4 0%, #868686 60%, #868686 100%);
  background: radial-gradient(circle at center, #a4a4a4 0%, #868686 60%, #868686 100%);
  background: #868686;
  background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiNhNGE0YTQiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSI2MCUiIHN0b3AtY29sb3I9IiM4Njg2ODYiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjODY4Njg2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
  left: 0;
  background-size: cover;
}

.graph-container .graph-bar.creon-bar {
  background: -webkit-gradient(radial, center center, 0, center center, 100%, color-stop(0%, #1996cb), color-stop(60%, #1575a0), color-stop(100%, #1575a0));
  background: -webkit-radial-gradient(center, circle cover, #1996cb 0%, #1575a0 60%, #1575a0 100%);
  background: -webkit-radial-gradient(center circle, #1996cb 0%, #1575a0 60%, #1575a0 100%);
  background: radial-gradient(circle at center, #1996cb 0%, #1575a0 60%, #1575a0 100%);
  background: #1575a0;
  background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiMxODljZDMiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSI2MCUiIHN0b3AtY29sb3I9IiMxNTc1YTAiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjMTU3NWEwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
  background-size: cover;
}

.bar-overflow {
  overflow: hidden;
  position: relative;
  width: 450px;
  height: 207px;
  bottom: -12px;
}

.graph-container .y-axis-label {
  transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  position: absolute;
  top: 45px;
  left: -62px;
}

.graph-container .y-axis-label p {
  font-size: 10px;
  color: #004d71;
}

.graph-container .y-axis-units {
  position: absolute;
  bottom: -2px;
  left: -21px;
  height: 242px;
  width: 0;
}

.graph-container .y-axis-units p {
  font-size: 10px;
  color: #868686;
  text-align: right;
  margin-bottom: 0;
  position: absolute;
  width: 18px;
}

.graph-container .y-axis-units p.unit-100 {
  top: -1px;
  left: -1px;
}

.graph-container .y-axis-units p.unit-80 { top: 23px; }

.graph-container .y-axis-units p.unit-60 { top: 46px; }

.graph-container .y-axis-units p.unit-40 { top: 69px; }

.graph-container .y-axis-units p.unit-20 { top: 91px; }

.graph-container .y-axis-units p.unit-0 { bottom: -6px; }

.graph-container .y-axis-units p.unit-0:after { top: 2px; }

.graph-container .y-axis-units p:after {
  content: "\00af";
  position: relative;
  right: -2px;
  font-size: 9px;
  top: 1px;
}

.graph-container .graph-bar.placebo-bar { left: 34px; }

.graph-container .graph-bar.creon-bar { left: 242px; }

.graph-container .y-axis-label {
  top: 85px;
  left: -79px;
}

.graph-container .y-axis-label p { font-size: 13px; }

.graph-container .y-axis-units {
  left: -29px;
  bottom: -4px;
  height: 242px;
}

.graph-container .y-axis-units p {
  font-size: 13px;
  width: 25px;
}

.graph-container .y-axis-units p.unit-100 {
  top: -1px;
  left: 0;
}

.graph-container .y-axis-units p.unit-80 { top: 43px; }

.graph-container .y-axis-units p.unit-60 { top: 85px; }

.graph-container .y-axis-units p.unit-40 { top: 128px; }

.graph-container .y-axis-units p.unit-20 { top: 170px; }

.graph-container .y-axis-units p.unit-0 { bottom: -7px; }

.graph-container .y-axis-units p.unit-0:after { top: 2px; }
</style>
</head>

<body class="g-sidenav-show bg-gray-100">
<?php require 'php-includes/nav.php';?>
<div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4">
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
        </div>
        <div class="row">
          <div class="row">
            <div class="col-12 col-xl-12">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                <div class="container"><!--container start-->
                <div class="row">
                <div class="col-md-12">
                <!-- Styles -->
                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
                <script src="./waterTank.js"></script>
                <script>
                $(document).ready(function() {

                    $('.waterTankHere1').waterTank({
                        width: 420,
                        height: 360,
                        color: 'skyblue',
                        level: 83
                    }).on('click', function(event) {
                        $(this).waterTank(Math.floor(Math.random() * 100) + 0 );
                    });

                    $('.waterTankHere2').waterTank({
                        width: 80,
                        height: 360,
                        color: '#DA4453',
                        level: 80
                    }).on('click', function(event) {
                        $(this).waterTank(Math.floor(Math.random() * 100) + 0 );
                    });

                    $('.waterTankHere3').waterTank({
                        width: 20,
                        height: 360,
                        color: '#46CFB0',
                        level: 80
                    }).on('click', function(event) {
                        $(this).waterTank(Math.floor(Math.random() * 100) + 0 );
                    });
                });
                </script>

                <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
                <!-- HTML -->
                <div id="chartdiv">
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>