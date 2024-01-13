<?php session_start(); 
include("dbcon.php"); ?>
<?php include('link.php');
// date_default_timezone_set("Asia/Kolkata");
// if((($_SESSION["type"]<>"super-admin")||($_SESSION["type"]=="")&&($_SESSION["id"]=="")))
// {
//   echo "<script>window.location='index.php';</script>";
// }

//     if((($_SESSION["type"]<>"Member")||($_SESSION["type"]=="")&&($_SESSION["id"]==""))){
//         echo "<script>window.location='logout.php';</script>";
//     }
//     $id=$_SESSION["id"];
//     // cheak for timing permission
//     $qry="SELECT `end_time` FROM `log_permission` ORDER BY `log_per_id` DESC LIMIT 1;";
//     $conf=mysqli_query($conn,$qry) or die(mysqli_error());
//     $row=mysqli_fetch_array($conf);
//     date_default_timezone_set('Asia/Calcutta');
//     $date=date("Y-m-d H:i:s");
//     $_SESSION["endtime"]=$row['end_time'];
//     if($_SESSION["endtime"]<$date && $_SESSION["endtime"]!="")
//     {
//       echo "<script>alert('Log in session closed');</script>";
//        echo "<script>window.location='logout.php';</script>";
//     }
      // end  timing permission

      
// if((($_SESSION["type"]<>"super-admin")||($_SESSION["type"]=="")&&($_SESSION["id"]==""))){
//     echo "<script>window.location='index.php';</script>";
//   }
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        
        <header class="main-header">
            <a href="super-home.php" class="logo">
                <span class="logo-mini">SI</span>
                <span class="logo-lg"><b>THE INVESTMENT</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        
                        
                        <li>
                            <a href="logout.php">Logout</a>

                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
        
                <div class="user-panel">
                    <div class="pull-left image">
                    
                    </div>
                    <div class="pull-left info">
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li><a href="super-home.php"><i class="fa fa-table"></i> <span>Dashboard</span></a></li>
                    <li><a href="super_invest.php"><i class="fa fa-table"></i> <span>Single Investment</span></a></li>
                    <li><a href="super_investment.php"><i class="fa fa-table"></i> <span>All Investment</span></a></li>
                    <!-- <li><a href="all_report.php"><img class="fa" src="logos/roadmap.png"><span>All Investment Reports</span></a></li> -->
                    <!-- <li><a href="sub_profile.php"><i class="fa fa-table"></i> <span>Profile</span></a></li> -->
                    <!-- <li><a href="sub_payment.php"><i class="fa fa-table"></i> <span>Payment Details</span></a></li> -->
                    <!-- <li><a href="#"><i class="fa fa-table"></i> <span>Change Password</span></a></li> -->
                    <!-- <li><a href="#"><i class="fa fa-table"></i> <span><?php echo $id; ?></span></a></li> -->
                </ul>
            </section>
        </aside>
