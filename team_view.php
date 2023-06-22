<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="loader.css">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }

            #employee_grid tbody tr:hover {
                background-color: pink;
                }
        </style>
        <?php require_once("header.php"); ?>
        <script type="text/javascript">
            $(function() {
                
                $(".full").autocomplete({
            
                    source: 'investment_searchName.php',
                    focus: function (event, ui) {
                        event.preventDefault();
                        $("#full").val(ui.item.label);
                    },
                    select: function (event, ui) {
                        event.preventDefault();
                        $("#full1").val(ui.item.value);
                        $("#full").val(ui.item.label);
                }
                    
                }); 
            });
        </script>
        
        <div class="content-wrapper">
            <script>
                $("#dyna").text("team Referral Details");
                tex();
            </script>
            <section class="content">
                <!-- <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12 searchpad">
                            <form class="form-horizontal" id="addform" action="ajax/introduceReferal.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="inputEmail3" id="search_name" class="col-sm-3 control-label">Search Full Name</label>
                                                <div class="col-sm-7">
                                                    <input  type="text" class="form-control full" name="full" id="full" placeholder="Search Full Name" required="required">
                                                    <input type="text" id="full1">
                                                </div>
                                                <div class="col-sm-2">
                                                    <a type="button" id="search1" onclick="searchreferral()" class="btn btn-primary">Search</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="box">
                    <div class="box-body">
        </br>
                        <table id="employee_grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody class="mytable1" id="tb">
                            
                            </tbody>
                        </table>
                        <!-- <center><div class="loader"></div></center> -->
                    </div>
                </div>
            </section>


        </div>
    </div>
    <script type="text/javascript" src="js/team_view.js"></script>
    <?php require_once("footer.php"); ?>
</body>
