<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Loan Agreement</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap');
        html,
        body {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .main {
            position:relative;
            /* bottom:0; */
            top:410px;
            right:68px;
            display: flex;
            justify-content: center;
            align-items: center;  
        }

        #A4 {
            /* width: 100%; */
            /* height:1000px; */
            padding:100px 60px;
            justify-content: center;
            position: relative;
           
        }

 
        @media print {
        html,
        body {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        #A4 {
            /* width: 100%; */
            /* height:1000px; */
            padding:100px 60px;
            justify-content: center;
            position: relative;
           
        }

        .main {
            position:relative;
            /* bottom:20%;
            left:0; */
            top:410px;
            right:68px;
             display: flex;
            justify-content: center;
            align-items: center;
           
        }

        

        /* .bottomText {
            padding: 80px;
        } */

        .main {
            transform: rotate(-90deg); You can change the degree value as needed
            }
        .cont > span{
    line-height:100px;
}

       
        @page {
    size: auto; /* Use the default page size */
    margin: 0; /* Set margins to zero */
  }



  /* Add other print styles as needed */

  /* Hide header and footer */
  @page :first {
    margin-top: 0;
  }

  @page :left {
    margin-left: 0;
  }

  @page :right {
    margin-right: 0;
  }
}

.pay-data{
width:90%;
}
.pay-name{
    display:flex;
    /* border-bottom:1px dotted black; */
}
.second-line{
    display:flex;
    margin-top:10px;
}
.word-rupees{
    width:80%;
}
.num-rupee{
    width:20%;
   height:25px;
   position:relative;
   top:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    /* border:1px solid black; */
}
.rupee-icon{
    /* border-right:1px solid black; */
    width:10%;
    float:left;
}
.pay-data > p {
    font-size:12px;
    font-weight:400;
    margin:0;
    padding:0;
    
}
.pay-data > p > span{
    font-size:16px;
    font-weight:400;
    margin:0;
    padding:0;
}
.cont{
    width:100%;
    /* border-bottom:1px dotted black; */
}

        .main {
            transform: rotate(-90deg); /* You can change the degree value as needed */
        }
/* .cont > span{
    line-height:100px;
} */

.amt{
    position:relative;
    left:130px;
}
    </style>
</head>

<body>
    <div class="main">
        <div id="A4">
            <div class="bottomText">
                <div class="pay-name">
                    <!-- <div class="name-label"> <b>Pay:-</b></div> -->
                    <div class="pay-data"> <p><span>&nbsp; &nbsp; &nbsp; &nbsp;   </span><span style="line-height:18px; font-size:18px;">SAGAR ARVIND SHINDE</span> </p></div>
                </div>

                <div class="second-line">
                    <div class="word-rupees">
                        <!-- <div class="name-label1"> <b>Rupees:-</b></div> -->
                        <div class="pay-data cont"><p style="line-height:24px;margin-top:-10px;">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="line-height:43px; font-size:18px;">TWELVE LAKH FIFTY THOUSAND SIX HUNDRED FIFTY ONE</span></p> </div>
                    </div>
                    

                    <div class="num-rupee" style=" font-size:18px; margin-top:20px;">
                        <div class="rupee-icon"></div>
                        <div class="amt">12,50,651</div>
                    </div>
            </div>

        </div>
    </div>

</body>
<script>
    // var printWindow = window.open('', '_blank');
    // printWindow.document.write('<html><head><title></title>');
    // printWindow.document.write('<style>');
    // // Copy the styles for both screen and print
    // var styles = document.getElementsByTagName('style');
    // for (var i = 0; i < styles.length; i++) {
    //     printWindow.document.write(styles[i].innerHTML);
    // }
    // printWindow.document.write('</style></head><body>');
    // // Copy the HTML content
    // printWindow.document.write(document.getElementById('A4').innerHTML);
    // printWindow.document.write('</body></html>');
    // printWindow.document.close();
    // printWindow.print();

    $(document).ready(function()
    {
        printPage();
    });
    function printPage() 
    {
        window.print();
        window.onafterprint = function(event)
        {
            // window.location.href = "agreement_take.php?aggid="+aggId +"&cid="+cid;
            window.close();
        };
    }
</script>
</html>