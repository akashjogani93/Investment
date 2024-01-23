<?php session_start();

if( $_SESSION["login"]!==true)
{	
        echo '<script>location="index.php"</script>';
}
include("dbcon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloodcell Kart Events</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .mainLog{
          background-image: linear-gradient(to right, #33001b, #ff0084); 
        }
        .logContainer{
            background-color:#fff;
            width: 100%;
            padding: 10px;
          border-radius:10px;
        }
      body, html{
         background-image: linear-gradient(to right, #33001b, #ff0084); 
        padding:0;
        margin:0;
      }
      form h4{
         font-family:"sans-serif";
         color:#000;
         font-weight:600;
        font-size:20px;
      }
      
       .group-form label{
        margin-bottom:7px;
         font-family:"sans-serif";
         color:#000;
         font-weight:600;
        }
       .group-form{
            margin-top: 20px;
        }
       #desc, .input-field input{
            background-color: #f0f0f0;
            border: none;
         	height:40px;
            width:100%;
            border-radius: 7px;
            font-family:"sans-serif"
        }
        .group-form input
        {
            background-color: #f0f0f0;
            /* border: none; */
            border-radius: 7px;
            font-family:"sans-serif"
        }
      .newform
      {
        background-color:#fff;
        padding: 15px;
        border-radius:10px;
        margin:20px 50px;
      }
      .table-container
      {
        background-color:white;
        margin:0 50px;
      }

      #submitbtn{
        cursor: pointer;
	    background-image: linear-gradient(to right, #33001b, #ff0084); 
	    text-shadow: 1px 1px 2px rgba(100, 48, 22, 1);
        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
         border-radius: 7px;
        color:#fff;
        font-weight:600;
        font-family:"sans-serif";
       
      }
      i{
        color:#000; 
        font-size:20px;
        font-weight:600;
        
       
      }
      button{
       margin:10px;
        padding:10px;
      }
      
      @media screen and (max-width:998px){
        .logContainer{
            background-color:#fff;
            width: 100%;
           
            padding: 10px;
          border-radius:10px;
        }
      }
       .gallery-images
            {
                width:100%;
                align-items:center;
            }
            .img 
            {
                width:10%;
                height:150px;
                margin:10px 15px;
            }
    </style>
</head>
<body style="">
    <!-- <form action="logout.php">
        <input type="submit" name="select" value="Logout" />
    </form> -->
    <div class="mainLog pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <form method="post" action="upload.php" class="newform"> -->
                    <div class="newform">
                        <center><h4>Upload Events</h4></center>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-info" id="logout">Logout</button>
                                <button class="btn btn-info" id="gallery">Gallery</button>
                                <button class="btn btn-info" id="uploadevents">Bloodcell</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-form">
                                   <label>Image</label>
                                    <input type="file" id="img" name="files[]" accept="image/jpeg, image/png" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-form">
                                    <input type="button" id="submitbtn" value="SUBMIT" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div></br>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-container" id="galleryImage">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $('#submitbtn').click(function()
            {
                
                var input = $('#img')[0];
                var files = input.files;

                var inputIds = ['#img'];
                
                for (var i = 0; i < inputIds.length; i++) 
                {
                    var inputValue = $(inputIds[i]).val();
                    if (inputValue === '') 
                    {
                        $(inputIds[i]).css('border-color', 'red');
                        exit();
                    }else {
                        $(inputIds[i]).css('border-color', '');
                    }
                }
                var form_data = new FormData();
                for (var i = 0; i < files.length; i++) 
                {
                    form_data.append('files[]', files[i]);
                }


                let log=$.ajax({
                    url:"uploadGallery.php",
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
                            window.location='gallery.php';
                        }else
                        {
                            alert('Something Went wrong')
                        }
                    }
                });
            });

            $('#uploadevents').click(function()
            {
                window.location='uploadevents.php';
            });
            $('#logout').click(function()
            {
                window.location='logout.php';
            });
            let log=$.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:{data:'data'},
                    datatype:'jsno',
                    success: function(response)
                    {
                        var images=JSON.parse(response)
                        // console.log(JSON.parse(response));
                        $('#galleryImage').empty()
                        var imageHTML='';
                        $.each(images, function(index, item) 
                        {
                            imageHTML+=`<img src="${item.image}" class="img">`;
                        });
                        appendData=`<div class="row">
                                        <div class="col-md-12">
                                            <div class="gallery-images">
                                                ${imageHTML}
                                            </div>
                                        </div>
                                    `;
                        $('#galleryImage').append(appendData);
                    }
            });
            console.log(log);
        });
    </script>
  
</body>
</html>