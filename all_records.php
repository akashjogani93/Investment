<body class="hold-transition skin-blue sidebar-mini">
        <style>
            .error {
                color: red;
            }
        </style> 
    <div class="wrapper" id="form1">
      
        <?php require_once("header.php"); ?>
        <div class="content-wrapper">
            <script>
                $("#dyna").text("TOTAL AMOUNT DETAIL");
            </script>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Amount Investment</h2>
                                    <h4 class="card-text" style="margin-top:10px; color:red;"><b id="investinwords"></b></h4>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="investtotal"></b></h4>
                                </div>
                            </div></br>
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Balance</h2>
                                    <h4 class="card-text" style="margin-top:10px; color:red;"><b id="investinwords"></b></h4>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="invest"></b></h4>
                                </div>
                            </div></br>
                            <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Withdrawal</h2>
                                    <h4 class="card-text" style="margin-top:10px; color:red;"><b id="withdrawinwords"></b></h4>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;" ><b id="withdraw"></b></h4>
                                </div>
                            </div>
                        <!-- </br> -->
                            <!-- <div class="row bg-info" style="margin:0px;">
                                <div class="col-sm-8">
                                    <h2 class="card-title">Total Interest</h2>
                                    <h4 class="card-text" style="margin-top:10px; color:red;"><b id="interestinwords"></b></h4>
                                </div>
                                <div class="col-sm-2" style="margin-top: 20px;">
                                    <h4 class="card-text" style="margin-top:10px;"><b id="interest"></b></h4>
                                </div>
                            </div> -->
                        </form>
                    </div>  
                </div>  
            </section> 	            
        </div>
    </div>
    <?php include('footer.php');?>

    <script>
        $(document).ready(function()
        {
            let log = $.ajax({
                url: "ajax/total_records.php",
                type: 'POST',
                dataType: 'json',
                data: {submit: 'submit'},
                success: function(data) 
                { 
                    var investtotal=parseFloat(data[0].inv)+parseFloat(data[0].inv_invest);
                    $('#investtotal').html(Math.round(investtotal).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#invest').html(Math.round(data[0].inv_invest).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#withdraw').html(Math.round(data[0].inv).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error:", textStatus, errorThrown);
                }
            });

// var num = Number(data);
                    // $('#invest').html(num.toFixed(2)+'/-');
                    // var words = convertNumberToWords(num);
                    // $('#investinwords').html(words);
                    // console.log(log);
            // let log1=$.ajax({
            //     url:"ajax/total_records.php",
            //     type:'POST',
            //     datatype: 'json',
            //     data:{withdraw:'withdraw'},
            //     success: function(data)
            //     { 
            //         var num = Number(data);
            //         $('#withdraw').html(num.toFixed(2)+'/-');
            //         var words = convertNumberToWords(num);

            //         // $('#withdrawinwords').html(words);

            //         // console.log(log1);
            //     }
            // });

            // let log2=$.ajax({
            //     url:"ajax/total_records.php",
            //     type:'POST',
            //     datatype: 'json',
            //     data:{interest:'interest'},
            //     success: function(data)
            //     { 
            //         var num = Number(data);
            //         let interest= num.toFixed(2);
            //         $('#interest').html(interest+'/-');

            //         var words = convertNumberToWords(num);
            //         // $('#interestinwords').html(words);
            //         // console.log(log2);
            //     }
            // });

            // var amount = 592174066.1;
            // var words = convertNumberToWords(amount);
            // console.log(words)
            // $('#interest').html(words);


        });

        function convertNumberToWords(number) 
        {
  var words = ["ZERO", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN",
    "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN"
  ];

  var tensWords = ["", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY"];

  var wordsToReturn = "";
  var crore = Math.floor(number / 10000000);
  var lakh = Math.floor((number % 10000000) / 100000);
  var thousand = Math.floor((number % 100000) / 1000);
  var hundreds = Math.floor((number % 1000) / 100);
  var tens = Math.floor((number % 100) / 10);
  var ones = Math.floor(number % 10);

  if (crore > 0) {
    wordsToReturn += convertNumberToWords(crore) + " CRORE ";
  }

  if (lakh > 0) {
    wordsToReturn += convertNumberToWords(lakh) + " LAKH ";
  }

  if (thousand > 0) {
    wordsToReturn += convertNumberToWords(thousand) + " THOUSAND ";
  }

  if (hundreds > 0) {
    wordsToReturn += words[hundreds] + " HUNDRED ";
  }

  if (tens > 0 || ones > 0) {
    if (tens < 2) {
      wordsToReturn += words[tens * 10 + ones] + " ";
    } else {
      wordsToReturn += tensWords[tens] + " ";
      if (ones > 0) {
        wordsToReturn += words[ones] + " ";
      }
    }
  }

  return wordsToReturn.trim();
}


    </script>
</body>


