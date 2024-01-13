<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color:red;
            }
        </style>
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("events");
            tex();
        </script>
        <?php
            require_once("dbcon.php"); 
            $cid = 0;
            $sql = "SELECT max(id) FROM events";
            $retval = mysqli_query($conn,$sql);

            if(! $retval ) {
                die('Could not get data: ' . mysqli_error($conn));
            }
            while($row = mysqli_fetch_assoc($retval)) {
                $cid=$row['max(id)'];
                $cid++;
            }
        ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <!-- <form class="form-horizontal" id="addform" method="POST" autofocus="off"> -->
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Upload Events</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Sl.NO</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm"  value="<?php echo $cid;?>" name="cid" id="cid" readonly>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Title</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="title" id="title"  required autofocus="off">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Date</label>
                                    <input type="date" class=" col-sm-4 form-control form-control-sm" name="date" id="date"  required>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Mobile</label>
                                    <input type="text" class=" col-sm-4 form-control form-control-sm" name="mobile" id="mobile"  required>
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Location</label>
                                    <input type="text" class="col-sm-4 form-control form-control-sm"  name="location" id="location">
                                </div>
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Path</label>
                                    <input type="file" class="col-sm-4 form-control form-control-sm" name="path" id="path"  accept="image/jpeg, image/png" required>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-8">
                                    <label for="inputEmail3" class="form_label">Description</label>
                                    <!-- <input type="text" class="col-sm-4 form-control form-control-sm" name="desc" id="desc"  required autofocus="off"> -->
                                    <textarea class="col-sm-8 form-control form-control-sm" name="desc" id="desc" required autofocus="off"></textarea>
                                </div>
                            </div></br>
                            <div class="row">
                            <div class="group-form col-md-12">
                                <?php if('reg'=='reg')
                                        {
                                            ?>
                                                <center><button name="submit" id="sub" class="btn btn-primary regsub" style="margin-top:25px;">Submit</button></center>
                                                <center><button name="update" id="upd" class="btn btn-danger" style="margin-top:25px; display:none;">Update</button></center>
                                                <center><div id="submited"></div></center>
                                            <?php
                                        }else
                                        {
                                            ?>
                                                <button type="submit" name="update" class="btn btn-danger" style="margin-top:25px;">Update</button>
                                                <a href="register_customer.php" class="btn btn-primary" style="margin-top:25px;">Back</a>
                                            <?php
                                        }
                                ?>
                            </div>
                            </div>
                        </div>
                    <!-- </form> -->
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>Uploaded Events</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-12">
                                <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">Sl No</th>
                                            <th style="width:15%">Title</th>
                                            <th style="width:15%">Mobile</th>
                                            <th style="width:25%">Description</th>
                                            <th style="width:15%">Location</th>
                                            <th style="width:10%">Date</th>
                                            <th style="width:15%">Image</th>
                                            <th style="width:15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mytable">
                                        
                                    </tbody>
                                </table>
                                </div>
                            </div></br>

                        </div>
                    </div>
                </div>
            </section>
            <script>
                $(document).ready(function()
                {
                    loade();
                    function loade()
                    {
                        let log=$.ajax({
                            url: 'ajax/upload_events.php',
                            type: "POST",
                            data:{Submit:"submit"},
                            cache:false,
                            success:function(data)
                            {
                                $('.mytable').html(data);
                            }
                        }); 
                        $('#sub').show();
                        $('#upd').hide();
                    }
                    // $('#desc , #location , #title').keypress(function(event){
                    //     var keycode = (event.keyCode ? event.keyCode : event.which);
                    //         if ((keycode < 48 || keycode > 57))
                    //         return true;

                    //         return false;
                    // });
                    $('#mobile').keypress(function(event){
                        var keycode = (event.keyCode ? event.keyCode : event.which);
                            if ((keycode < 48 || keycode > 57))
                            return false;

                            return true;
                    });

                    $('#sub, #upd').click(function()
                    {

                        if ($(this).is('#sub')) 
                        {
                            var cid=0;
                            var inputIds = ['#title', '#date','#mobile','#location','#desc', '#path'];
                        } else if ($(this).is('#upd')) {
                           var cid=$('#cid').val();
                            var inputIds = ['#title', '#date','#mobile','#location','#desc'];
                        }
                        
                        var title = $('#title').val();
                        var desc = $('#desc').val();
                        var location = $('#location').val();
                        var date = $('#date').val();
                        var mobile = $('#mobile').val();
                        var file=$('#path')[0].files[0];

                        
                        for (var i = 0; i < inputIds.length; i++) 
                        {
                            var inputValue = $(inputIds[i]).val();
                            if (inputValue === '') 
                            {
                                $(inputIds[i]).css('border-color', 'red');
                                return
                            }else {
                                $(inputIds[i]).css('border-color', '');
                            }
                        }
                        var form_data = new FormData();

                        form_data.append('title', title);
                        form_data.append('cid', cid);
                        form_data.append('desc', desc);
                        form_data.append('location', location);
                        form_data.append('date', date);
                        form_data.append('file', file);
                        form_data.append('mobile', mobile);
                        let log=$.ajax({
                            url:"ajax/upload_events.php",
                            method:"POST",
                            data:form_data,
                            contentType: false,
                            processData: false,
                            success: function(response)
                            {
                                $('#submited').html(response);
                                loade();
                                setTimeout(function() {
                                    $('#submited').html('');
                                }, 3000);
                                for (var i = 0; i < inputIds.length; i++) {
                                    $(inputIds[i]).val('');
                                }
                            }
                        });
                        console.log(log);
                    });
            });
            function editEvent(button)
                 {
                    var closestTr = button.closest('tr');
                    var id = closestTr.querySelector('td:first-child').textContent;
                    var title = closestTr.querySelector('td:nth-child(2)').textContent;
                    var mobile = closestTr.querySelector('td:nth-child(3)').textContent;
                    var desc = closestTr.querySelector('td:nth-child(4)').textContent;
                    var location = closestTr.querySelector('td:nth-child(5)').textContent;
                    var date = closestTr.querySelector('td:nth-child(6)').textContent;

                    $('#title').val(title);
                    $('#desc').val(desc);
                    $('#location').val(location);
                    $('#date').val(date);
                    $('#mobile').val(mobile);
                    $('#cid').val(id);

                    $('#sub').hide();
                    $('#upd').show();
                }
                function deleteEvent(id) 
                {
                    let log = $.ajax({
                                url: 'ajax/delete.php',
                                type: "POST",
                                // dataType: 'json',
                                data: {
                                    tabname:'events',
                                    deleteid: id,
                                },
                                success: function (response)
                                {
                                    alert(response)
                                    location.readload();
                                }
                            });
                }
            </script>
        </div>
    </div>
</body>