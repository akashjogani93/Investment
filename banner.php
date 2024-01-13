<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color:red;
            }
            .gallery-images
            {
                width:100%;
                align-items:center;
            }
            .img
            {
                width:10%;
                height:100px;
                margin:10px 15px;
            }
        </style>
        <?php require_once("header.php"); ?>
        <script>
            $("#dyna").text("banner");
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
                                    <b>Upload Banner</b>
                                </h3>
                            </div>
                        </div></br>
                        <div class="row">
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">Function</label>
                                <select name="cate" id="cate" class="col-sm-4 form-control form-control-sm">
                                    <option value="">Select Function</option>
                                    <option>Bloodcell Kart</option>
                                    <option>Insurance</option>
                                    <option>Home</option>
                                </select>
                            </div>
                            <div class="group-form col-md-4">
                                <label for="inputEmail3" class="form_label">Gallery</label>
                                <input type="file" class="col-sm-4 form-control form-control-sm gallery" name="files[]" id="path"  accept="image/jpeg, image/png" multiple>
                            </div>
                            <div class="group-form col-md-2">
                                <button name="submit" class="btn btn-primary col-sm-4 form-control" style="margin-top:25px;" id="add">Add Banner</button>
                            </div>
                        </div></br>
                    </div>
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="group-form col-md-12">
                                    <h3>
                                        <b>View Banner</b>
                                    </h3>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="group-form col-md-4">
                                    <label for="inputEmail3" class="form_label">Function</label>
                                    <select name="cate1" id="cate1" class="col-sm-4 form-control form-control-sm" onchange="funchange()">
                                        <option value="">Select Function</option>
                                        <option>Bloodcell Kart</option>
                                        <option>Insurance</option>
                                        <option>Home</option>
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
                    fetchData(0);
                    $('#add').click(function()
                    {
                        var cate = $('#cate').val();
                        var input = $('#path')[0];
                        var files = input.files;

                        if(cate=='')
                        {
                            $('#cate').css('border-color','red');
                            setTimeout(() => {
                                $('#cate').css('border-color','');
                            }, 2000);
                            return;
                        }
                        var form_data = new FormData();
                            form_data.append('cate', cate);
                        for (var i = 0; i < files.length; i++) 
                        {
                            form_data.append('files[]', files[i]);
                        }
                        let log=$.ajax({
                            url:"ajax/banner_upload.php",
                            method:"POST",
                            data:form_data,
                            datatype:'json',
                            contentType: false,
                            processData: false,
                            success: function(response) 
                            {
                                if(response==0)
                                {
                                    alert('Added Successfully');
                                    window.location='banner.php';
                                }else
                                {
                                    alert('Something Went wrong')
                                }
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
                    // function loade()
                    // {
                    //     let fun=$.ajax({
                    //         url: 'ajax/upload_movies.php',
                    //         type: "POST",
                    //         datatype:'json',
                    //         data:{fetchfun:"fetchfun"},
                    //         cache:false,
                    //         success:function(data)
                    //         {
                    //             data1=JSON.parse(data);
                    //             let selectElement = $('#cate');
                    //             let selectElement1 = $('#cate1');
                    //             selectElement.empty();
                    //             selectElement1.empty();
                    //             selectElement.append($('<option>', {
                    //                 value: '',
                    //                 text: 'Select Function'
                    //             }));
                    //             selectElement1.append($('<option>', {
                    //                 value: 'All',
                    //                 text: 'Select Function'
                    //             }));
                    //             for(i=0;i<data1.length;i++)
                    //             {
                    //                 selectElement.append($('<option>', {
                    //                     value: data1[i].id,
                    //                     text: data1[i].function
                    //                 }));
                    //                 selectElement1.append($('<option>', {
                    //                     value: data1[i].id,
                    //                     text: data1[i].function
                    //                 }));
                    //             }
                    //          
                    //         }
                    //     });
                        
                    // }
                    function fetchData(ckeck)
                    {
                        let log=$.ajax({
                            url: 'ajax/banner_upload.php',
                            type: "POST",
                            data:{submit:"submit",functio:ckeck},
                            datatype:'json',
                            cache:false,
                            success:function(data)
                            {
                                data1=JSON.parse(data);
                                console.log(data1);
                                $('#galleryData').empty();
                                var appendData='';
                                $.each(data1, function(index, item) 
                                {
                                    var galleryArray = item.image.split(',');
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
                                    appendData=`<div class="row">
                                                    <div class="col-md-12">
                                                        <center><h3>Banner-${item.cate}</h3></center>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="gallery-images">
                                                            ${imageHTML}
                                                        </div>
                                                    </div>
                                                </div>`;
                                    $('#galleryData').append(appendData);
                                });
                            }
                        });
                        // console.log(log);
                    }
            </script>
        </div>
    </div>
</body>


<!-- ../img/insuGallery/1.jpg,../img/insuGallery/2.jpg,../img/insuGallery/3.jpg,../img/insuGallery/4.jpg,../img/insuGallery/5.jpg,../img/insuGallery/6.jpg,../img/insuGallery/7.jpg,../img/insuGallery/8.jpg,../img/insuGallery/9.jpg,../img/insuGallery/10.jpg,../img/insuGallery/11.jpg,../img/insuGallery/12.jpg,../img/insuGallery/13.jpg,../img/insuGallery/14.jpg,../img/insuGallery/15.jpg,../img/insuGallery/16.jpg,../img/insuGallery/17.jpg,../img/insuGallery/18.jpg,../img/insuGallery/19.jpg,../img/insuGallery/20.jpg,../img/insuGallery/21.jpg,../img/insuGallery/22.jpg -->