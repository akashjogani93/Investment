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

        @media print {
        html,
        body {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        #A4 {
            padding:100px 60px;
        }

        .main {
            position:relative;
            top:410px;
            right:68px;
            transform: rotate(-90deg);

        }
        .cont > span{
            line-height:100px;
        }

       
        @page {
            size: auto; /* Use the default page size */
            margin: 0; /* Set margins to zero */
        }

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


        .second-line{
            display:flex;
            margin-top:10px;
        }
        .word-rupees{
            width:70%;
        }
        .num-rupee{
            width:30%;
        
        }

        .cont{
            width:100%;
        }

        .main 
        {
            transform: rotate(-90deg); 
        }

        .amt
        {
            position:relative;
            left:130px;
        }
        #inwords, #partyName, #partyAmt
        {
            font-weight:700;
        }
    </style>
</head>

<body>
    <div class="main">
        <div id="A4">
            <div class="bottomText">
                <div class="pay-name">
                    <!-- <div class="name-label"> <b>Pay:-</b></div> -->
                    <div class="pay-data"> <p><span>&nbsp; &nbsp; &nbsp; &nbsp;   </span><span style="line-height:18px; font-size:18px;" id="partyName"></span> </p></div>
                </div>

                <div class="second-line">
                    <div class="word-rupees">
                        <!-- <div class="name-label1"> <b>Rupees:-</b></div> -->
                        <div class="pay-data cont"><p style="line-height:24px;margin-top:-10px; text-align:left;" id="inwords">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;<span ></span></p> </div>
                    </div>
                    

                    <div class="num-rupee" style=" font-size:18px; margin-top:20px;">
                    
                        <div class="amt" id="partyAmt"></div>
                    </div>
                </div>

        </div>
    </div>

</body>

<script>
$(document).ready(function()
    {
        const urlParams = new URLSearchParams(window.location.search);
        const aggId = urlParams.get('aggId');
        const cid = urlParams.get('cid');
        let log=$.ajax({
            url: "ajax/agreement.php",
            method: "POST",
            data: { aggId: aggId },
            dataType: "json",
            success: function (data) 
            {
                console.log(data);
                var amountAsNumber = parseFloat(data.amount);
                var amtinwords=convertNumberToWords(amountAsNumber);
                var amt = amountAsNumber.toFixed(2);
                var name=data.party;
                var name1=name.toUpperCase();
                $('#partyName').html(name1);
                $('#partyAmt').html(amt);
                $('#inwords').html(amtinwords+" ONLY")
                printPage();
            }
        });
        console.log(log);
        // printPage();
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
    function printPage() 
    {
        window.close();
        window.print();
        window.close();
        window.onafterprint = function(event)
        {
            // window.location.href = "agreement_take.php?aggid="+aggId +"&cid="+cid;
            window.close();
        };
    }
</script>
</html>