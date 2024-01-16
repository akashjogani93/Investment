<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error
            {
                color:red;
            }
            .gallery-images
            {
                width:100%;
                align-items:center;
            }
            .img ,iframe
            {
                width:20%;
                height:100px;
                margin:10px 15px;
            }
        </style>
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("InsuRance Gallery");
            tex();
        </script>
        <?php
            require_once("dbcon.php"); 
        ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="group-form col-md-12">
                                <h3>
                                    <b>Upload Insurance Gallery Images</b>
                                </h3>
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">Function</label>
                                <select name="cate" id="cate" class="col-sm-4 form-control form-control-sm">
                                    <option value="">Select Function</option>
                                    
                                </select>
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Add Functions</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" id="function" name="function">
                                                </div>
                                            </div></br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                     <input type="file" class="form-control" name="banner" id="banner"  accept="image/jpeg, image/png" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <center><p id="successText" style="margin-top:10px;"></p></center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                                            <button type="button" class="btn btn-primary" id="addFunction">Add</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="group-form col-md-2">
                                <button name="submit" class="btn btn-primary col-sm-4 form-control" style="margin-top:25px;" data-toggle="modal" data-target="#staticBackdrop">Add Functions</button>
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="group-form col-md-8">
                                        <label for="inputEmail3" class="form_label">Gallery</label>
                                        <input type="file" class="col-sm-4 form-control form-control-sm gallery" name="path" id="path"  accept="image/jpeg, image/png" required>
                                    </div>
                                    <div class="group-form col-md-4">
                                        <button class="btn btn-primary col-sm-4 form-control addimage" style="margin-top:25px;">Add More</button>
                                    </div>
                                </div></br>
                                <div id="images">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="group-form col-md-8">
                                        <label for="inputEmail3" class="form_label">Videos Url</label>
                                        <input type="text" class="col-sm-4 form-control form-control-sm url" name="url" id="url">
                                    </div>
                                    <div class="group-form col-md-4">
                                        <button class="btn btn-primary col-sm-4 form-control addurl" style="margin-top:25px;">Add More</button>
                                    </div>
                                </div></br>
                                <div id="vidios">

                                </div>
                            </div>
                        </div>
                        <div class="group-form col-md-12">
                            <?php if('reg'=='reg')
                                {
                                    ?>
                                    <center><button name="submit" id="sub" class="btn btn-primary regsub" style="margin-top:25px;">Submit</button></center>
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
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>View Gallery</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Function</label>
                                    <select name="cate1" id="cate1" class="col-sm-4 form-control form-control-sm" onchange="funchange()">
                                        <option value="All">Select Function</option>
                                    </select>
                                </div>
                            </div>
                            <div id="galleryData">
                            </div>
                        </br>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                $(document).ready(function()
                {
                    $('#addFunction').click(function()
                    {
                       var cate=$('#function').val()
                       if(cate=='')
                       {
                            $('#function').css('border-color','red');
                            setTimeout(() =>{
                                $('#function').css('border-color','');
                            }, 2000);
                            return;
                       }
                       var file=$('#banner')[0].files[0];
                       var formData1 = new FormData();
                        formData1.append('addFunction1', cate);
                        formData1.append('file1', file);
                        // console.log(file)
                         let log=$.ajax({
                            url: 'ajax/upload_movies.php',
                            type: 'POST',
                            data: formData1,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data) 
                            {
                                if(data=='success')
                                {
                                    $('#successText').text('Function Successfully Added');
                                    setTimeout(() => {
                                        $('#successText').text('');
                                        $("#close").click();
                                    }, 2000);
                                    loade();
                                    fetchData(0);
                                }else
                                {
                                    $('#successText').text('Function Already Added');
                                    setTimeout(() => {
                                        $('#successText').text('');
                                    }, 2000);
                                }
                            }
                        });
                        console.log(log)
                    });
                    loade();
                    fetchData(0);

                    $('.addimage').click(function(e) 
                    {
                        e.preventDefault();
                        $('#images').after(`<div class="row">  
                                            <div class="group-form col-md-8">
                                                <label for="inputEmail3" class="form_label">Gallery</label>
                                                <input type="file" class="col-sm-4 form-control form-control-sm gallery" name="path" id="path"  accept="image/jpeg, image/png" required>
                                            </div>
                                            <div class="group-form col-md-4">
                                                <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger remove" style="margin-top:20px;">Remove</a>
                                            </div>
                                        </div></br>`);
                    });

                    $(document).on('click', '.remove', function(e)
                    {
                        e.preventDefault();
                        let row_item = $(this).parent().parent();
                        $(row_item).remove();
                    });

                    $('.addurl').click(function(e) 
                    {
                        e.preventDefault();
                        $('#vidios').after(`<div class="row">  
                                            <div class="group-form col-md-8">
                                                <label for="inputEmail3" class="form_label">Vidios Url</label>
                                                <input type="text" class="col-sm-4 form-control form-control-sm url" name="url" id="url">
                                            </div>
                                            <div class="group-form col-md-4">
                                                <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger removeurl" style="margin-top:20px;">Remove</a>
                                            </div>
                                        </div></br>`);
                    });

                    $(document).on('click', '.removeurl', function(e)
                    {
                        e.preventDefault();
                        let row_item = $(this).parent().parent();
                        $(row_item).remove();
                    });

                    $('#sub').click(function() 
                    {
                        var cate = $('#cate').val();
                        var formData = new FormData();
                        formData.append('cate', cate);

                        var val = [];
                        let i = 0;
                        
                        $('.gallery').each(function(index, item) {
                        var fileInput = item;
                            if (fileInput.files.length > 0) 
                            {
                                formData.append('images[]', fileInput.files[0]);
                                formData.append('check', 1);
                            }else
                            {
                                formData.append('check', 0);
                            }
                        });
                        $('.url').each(function(index, item) 
                        {
                            if (item.value.length > 0) 
                            {
                                formData.append('url[]', item.value);
                                formData.append('check1', 1);
                            }else
                            {
                                formData.append('check1', 0);
                            }
                        });
                        let log=$.ajax({
                            url: 'ajax/upload_insuranceGallery.php',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(response) 
                            {
                                if(response=='Added Gallery Successfully')
                                {
                                    alert(response);
                                    window.location="insuranceGallery.php";
                                }else
                                {
                                    alert(response);
                                }

                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                        // console.log(log);
                    });
                });

                function funchange()
                {
                    var cate1=$('#cate1').val();
                    fetchData(cate1)
                }
                function loade()
                {
                        let fun=$.ajax({
                            url: 'ajax/upload_insuranceGallery.php',
                            type: "POST",
                            datatype:'json',
                            data:{fetchfun:"fetchfun"},
                            cache:false,
                            success:function(data)
                            {
                                data1=JSON.parse(data);
                                let selectElement = $('#cate');
                                let selectElement1 = $('#cate1');
                                selectElement.empty();
                                selectElement1.empty();
                                selectElement.append($('<option>', {
                                    value: '',
                                    text: 'Select Function'
                                }));
                                selectElement1.append($('<option>', {
                                    value: 'All',
                                    text: 'Select Function'
                                }));
                                for(i=0;i<data1.length;i++)
                                {
                                    selectElement.append($('<option>', {
                                        value: data1[i].id,
                                        text: data1[i].category
                                    }));
                                    selectElement1.append($('<option>', {
                                        value: data1[i].id,
                                        text: data1[i].category
                                    }));
                                }
                            }
                        });
                        console.log(fun);
                        
                    }
                    function fetchData(ckeck)
                    {
                        // var cate=1;
                        let log=$.ajax({
                            url: 'ajax/upload_insuranceGallery.php',
                            type: "POST",
                            data:{submit:"submit",cat:ckeck},
                            datatype:'json',
                            cache:false,
                            success:function(data)
                            {
                                data1=JSON.parse(data);
                                $('#galleryData').empty();
                                var appendData='';
                                $.each(data1, function(index, item) 
                                {
                                    var galleryArray = item.gallery.split(',');
                                    var imageHTML = '';
                                    if (galleryArray.length > 0) 
                                    {
                                        $.each(galleryArray, function(index, img) {
                                            imageHTML += `<img src="ajax/${img}"/ class="img">`;
                                        });
                                    }else
                                    {
                                        imageHTML = '';
                                    }

                                    var vidioArra = item.url;
                                    var vidioHTML = '';

                                    if (vidioArra.length > 0) 
                                    {
                                        var vidioArray = item.url.split(',');
                                        $.each(vidioArray, function(index, url) 
                                        {
                                            var embedUrl = url.replace('/watch?v=', '/embed/');
                                            var videoId = url.match(/(?:v=)([\w-]+)/)[1];
                                            var embedUrl = `https://www.youtube.com/embed/${videoId}`;
                                            vidioHTML += `<iframe src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;

                                        });
                                    }else
                                    {
                                        vidioHTML = '';
                                    }

                                    appendData=`<div class="row">
                                                    <div class="col-md-12">
                                                        <center><h3>Function-${item.category}</h3></center>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="gallery-images">
                                                            ${imageHTML}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        ${vidioHTML}
                                                    </div>
                                                </div>`;
                                    $('#galleryData').append(appendData);
                                });
                                
                            }
                        });
                    }
            </script>
        </div>
    </div>
</body>