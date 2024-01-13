<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error {
            color: red;
        }
        </style>
        <?php require_once("super-header.php"); ?>
        <script type="text/javascript">
        $(function() {
            $(".pname").autocomplete({
                source: 'product_complete.php'
            });
        });
        </script>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Super Admin Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li><a href="super_home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <!-- <li><a href="#">Kitchen Master</a></li> -->
                </ol>
            </section>

            
                
</body>

</html>