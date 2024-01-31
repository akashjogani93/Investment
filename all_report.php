<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card
{
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}
h4>span{
    font-size:18px;
}
.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.card .card-block {
    padding: 25px 20px 50px 20px;
}

.order-card i {
    font-size: 64px;
}

.f-left {
    float: left;
    font-size:50px !important;
}

.f-right {
    float: right;
}
a >.card-block {
    color:white;

}
a:hover{
    color:white;
}
i.fa{
    font-size:20px;
}
        </style>
        <?php require_once("header.php"); 
            
        ?>

        <div class="content-wrapper">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <script>
                $("#dyna").text("all Investment Reports");
                tex();
            </script>
            <!-- <section class="content-header">
                <h1>
                    Reports By Investments
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->
            <section class="content">
                <div class="box">
                    <!-- <form class="form-horizontal" id="addform" action="registration_insert.php" method="POST"> -->
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card bg-c-blue order-card">
                                        <a href="register_customer1.php" title="Customer Registration Details">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-list-ul f-left"></i><span>Registration Details</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card bg-c-yellow order-card">
                                        <a href="investment_report1.php" title="All Investment Details">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa fa-solid fa-indian-rupee-sign f-left"></i><span>Investment Details</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card bg-c-green order-card">
                                        <a href="Refrel_Payment.php" title="Investment & Introducer Details">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-asterisk f-left"></i><span>Investment & Introducer Details</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card bg-c-pink order-card">
                                    <a href="withdraw_report.php" title="Withdrawal Details">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-money-bill-transfer f-left"></i><span>Withdrawal Details</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-c-blue order-card">
                                        <a href="single_payment_report.php" title="Customer Payment Details">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-image-portrait f-left"></i><span>Individual Payment Details</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card bg-c-yellow order-card">
                                        <a href="current_month_payment.php" title="Current Month Payment">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-calendar-week f-left"></i><span>Current Month Payment</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card bg-c-green order-card">
                                    <a href="monthwisePaymentHistory.php" title="Monthwise Payment History">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-money-bill-1-wave f-left"></i><span>Monthwise Payment History</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-c-pink order-card">
                                        <a href="NewCurrentMonthDetail.php" title="New Current Month Payment">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-indian-rupee-sign f-left"></i><span>New Current Month Payment</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card bg-c-blue order-card">
                                    <a href="log_Information.php" title="Log Information">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-right-to-bracket f-left"></i><span>Log Information</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="card bg-c-green order-card">
                                    <a href="agreement_take.php" title="">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-money-bill-1-wave f-left"></i><span>Agreement</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-c-green order-card">
                                    <a href="cheque_take.php" title="">
                                        <div class="card-block">
                                            <h4 class="text-right"><i class="fa fa-solid fa-money-bill-1-wave f-left"></i><span>Cheque Print</span></h4>
                                        </div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- <div class="row">
                                <div class="groupcol-md-2" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                    
                                        <a href="register_customer1.php" title="All Customer">
                                            <div class="card-body text-center"> 
                                                <img class="img-fluid" width="50" src="img/report/icons8-registration-80.png" >
                                            </div>
                                            <div class="text-center mb-3"> 
                                                <p style="font-weight: 600"> Customer Registration Details</p>
                                            </div>
                                        </a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                    

                                        <a href="investment_report.php" title="All Investment Details"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/introducer.png" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600"> Customer Investment Details</p>
                                        </div></a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                    
                                        <a href="Refrel_Payment.php" title="All Customer"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/money.png" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600">Investment & Introducer Details</p>
                                        </div></a>
                                    
                                </div>
                                <div class="group-form col-md-2" >
                                        
                                        
                                        
                                </div>
                                
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-2" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                        
                                        <a href="withdraw_report.php" title="All Customer"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/monthly payment.JPG" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600">Withdrawal Details</p>
                                        </div></a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde" >
                                    
                                    
                                <a href="single_payment_report.php" title="All Customer"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/rupee.png" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600">Individual Customer Payment Details</p>
                                        </div></a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                        <a href="current_month_payment.php" title="All Customer"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/rupee.png" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600">Current Month Payment</p>
                                        </div></a>
                                        
                                    
                                </div>
                                <div class="group-form col-md-2" >
                                        
                                        
                                        
                                </div>
                                
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-2" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                    
                                        <a href="monthwisePaymentHistory.php" title="All Customer"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/history.png" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600"> Monthwise Payment History</p>
                                        </div></a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde">
                                    
                                    
                                        <a href="NewCurrentMonthDetail.php" title="All Customer"><div class="card-body text-center"> 
                                        <img class="img-fluid" width="50" src="img/report/history.png" >
                                        </div>
                                        <div class="text-center mb-3"> 
                                        <p style="font-weight: 600">New Current Month Payment Details</p>
                                        </div></a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                                <div class="group-form col-md-2 carde" >
                                    
                                    
                                    <a href="log_Information.php" title="All Investment Details"><div class="card-body text-center"> 
                                    <img class="img-fluid" width="50" src="img/report/gold.png" >
                                    </div>
                                    <div class="text-center mb-3"> 
                                    <p style="font-weight: 600">Log Information</p>
                                    </div></a>
                                    
                                </div>
                                <div class="group-form col-md-1" >
                                        
                                        
                                        
                                </div>
                            </div></br> -->
                        </div>
                </div>
            </section>
        </div>
    </div>
</body>