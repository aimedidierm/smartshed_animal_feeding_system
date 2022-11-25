<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require '../php-includes/connect.php';
require 'php-includes/check-login.php';
$query = "SELECT * FROM user WHERE email= ? limit 1";
$stmt = $db->prepare($query);
$stmt->execute(array($_SESSION['code']));
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount()>0) {
    $names=$rows['names'];
    $email=$rows['email'];
    $address=$rows['address'];
    $telephone=$rows['phone'];
}
if(isset($_POST['update'])){
    $uaddress=$_POST['address'];
    $uphone=$_POST['phone'];
    $cpassword=md5($_POST['cpassword']);
    $apassword=md5($_POST['apassword']);
    if ($apassword == $cpassword){
        if($apassword == $cpassword){
            $sql ="UPDATE user SET address = ?, phone = ? , password = ? WHERE email = ?";
            $stm = $db->prepare($sql);
            if ($stm->execute(array($uaddress, $uphone, $cpassword, $_SESSION['code']))) {
                print "<script>alert('your data updated');window.location.assign('settings.php')</script>";

                }
        } else{
            echo "<script>alert('Passwords are not match');window.location.assign('settings.php')</script>";
        }
    } else{
        echo "<script>alert('Passwords are not match');window.location.assign('settings.php')</script>";
    }
}
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
                <style>
                #chartdiv {
                  width: 80%;
                  height: 700px;
                }
                </style>

                <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

                <?php
                // getting chart data
                $level1 = "80";
                $names1 = " Food container";
                $level2 = "20";
                $names2 = " Water container";
                ?>
                <!-- Chart code -->
                <script>
                am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("chartdiv", am4charts.XYChart3D);

                chart.titles.create().text = "Animal feeding tank monitoring";

                // Add data

                chart.data = [{
                  "category": '<?php echo $names1 ?>',
                  "value1": '<?php echo $level1 ?>',
                  "value2": '<?php echo 100 - $level1 ?>'
                }, {
                  "category": '<?php echo $names2 ?>',
                  "value1": '<?php echo $level2 ?>',
                  "value2": '<?php echo 100 - $level2 ?>'
              }];

                // Create axes
                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "category";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.grid.template.strokeOpacity = 0;
                
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.renderer.grid.template.strokeOpacity = 0;
                valueAxis.min = -10;
                valueAxis.max = 110;
                valueAxis.strictMinMax = true;
                valueAxis.renderer.baseGrid.disabled = true;
                valueAxis.renderer.labels.template.adapter.add("text", function(text) {
                  if ((text > 100) || (text < 0)) {
                    return "";
                  }
                  else {
                    return text + "%";
                  }
                })

                // Create series
                var series1 = chart.series.push(new am4charts.ConeSeries());
                series1.dataFields.valueY = "value1";
                series1.dataFields.categoryX = "category";
                series1.columns.template.width = am4core.percent(80);
                series1.columns.template.fillOpacity = 0.9;
                series1.columns.template.strokeOpacity = 1;
                series1.columns.template.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.ConeSeries());
                series2.dataFields.valueY = "value2";
                series2.dataFields.categoryX = "category";
                series2.stacked = true;
                series2.columns.template.width = am4core.percent(80);
                series2.columns.template.fill = am4core.color("#000");
                series2.columns.template.fillOpacity = 0.1;
                series2.columns.template.stroke = am4core.color("#000");
                series2.columns.template.strokeOpacity = 0.2;
                series2.columns.template.strokeWidth = 2;

                }); // end am4core.ready()
                </script>

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
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>