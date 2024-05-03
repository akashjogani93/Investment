<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download</title>
    <style>
        html,body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .cont{
            height: 50%;
            width: 40%;
            background-color: rgba(0,0,0,0.7);
            border-radius: 10px;
          
        }
        .cont a{
            text-decoration: none;
            background-color: black;
            color: aliceblue;
            padding: 8px;
            border-radius: 5px;
        }
        .container{
            background-image: url('./back.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
        @media screen and (max-width: 578px) {
            .cont{
            height: 50%;
            width: 90% !important;
            background-color: rgba(0,0,0,0.7);
            border-radius: 10px;
           
        }
                        
        }
    </style>
</head>
<body>
    <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh;width: 100vw;">
        <div class="cont" style="display: flex; justify-content: center; align-items: center;flex-direction: column;">
            <img src="./shivam.png"  style="height: 30%;width: 30%;object-fit:contain;border-radius: 5px; "/>
            <h6 style="text-align: center; color:#fff;">Download Our App Now</h6>
            <a href="./Shivam.apk" onclick="Go();" download="Shivam">Download</a>
            <small style="margin-top:10px;color:#fff;font-size:10px;">Version 1.2 Available</small>

        </div>
    </div>
  
</body>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    function Go(){
        
            $.ajax({
            url: './appcount.php', // Replace with your API endpoint
            method: 'GET',
             // Expected data type
            success: function(data) {
            // Handle the response data
             console.log(data)
            },
            error: function(xhr, status, error) {
            // Handle any errors
            console.error('Error:', error);
            }
        });
                
    }
    </script>
    
</html>