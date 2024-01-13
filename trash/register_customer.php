<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
            /* Ensure that the demo table scrolls */
            th, td { white-space: nowrap; }
            .table-striped>tbody>tr:nth-child(odd)>td, 
            .table-striped>tbody>tr:nth-child(odd)>th 
            {
                background-color: #E5DCC3;
                padding:15px; 
            }
            .table-striped>tbody>tr:nth-child(even)>td, 
            .table-striped>tbody>tr:nth-child(even)>th 
            {
                background-color: #C9CCD5;
                padding:15px;  
            }
            
            table.dataTable thead {background-color:#D3E4CD}

        </style>
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("Customer data");
        </script>
        <div class="content-wrapper">
            <!-- <section class="content-header">
                <h1>
                    Total Registered Customer List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i>Home</a></li>
                </ol>
            </section> -->
            <section class="content">
                <div class="box box-default">
                    <div id="showdata">

                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#showdata').load('ajax/customer_data.php');
        });
        function custEdit(custid)
            {
                window.location.href="registration.php?edit=" + custid;
            }
    </script>
    
    <?php require_once("footer.php");?>
</body>
