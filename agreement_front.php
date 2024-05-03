<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Agreement</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
            display: flex;
            justify-content: center;
            align-items: center;  
        }

        #A4 {
            width: 595px;
            height:1100px;
            /* height:auto; */
            display: flex;
            justify-content: center;
            position: relative;
        }

        .bottomText {
            position: absolute;
            bottom: 5%;
            /* padding: 80px; */
        }

        .bottomText h2{
            text-align: center;
            font-weight: bolder;
            text-decoration:underline;
            margin-bottom: 12px;
        }
        .bottomText p{
            font-size: 18px;
            text-align: justify;
            line-height: 40px;
            
        }
        .lineWithBold{
            font-weight: 600;
            text-decoration: underline;
        }
        .onlyBold{
            font-weight: 600;
        }
        @media print {
        html,
        body {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
           
        }

        #A4 {
            width: 595px;
            height: 1100px;
            /* height:auto; */
            display: flex;
            justify-content: center;
            position: relative;
        }

        .bottomText {
            position: absolute;
            bottom: 5%;
            /* padding: 80px; */
        }

        .bottomText h2{
            text-align: center;
            font-weight: bolder;
            text-decoration:underline;
            margin-bottom: 12px;
        }
        .bottomText p{
            font-size: 18px;
            text-align: justify;
            line-height: 27px;
            
        }
        .lineWithBold{
            font-weight: 600;
            text-decoration: underline;
        }
        .onlyBold{
            font-weight: 600;
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
    </style>
</head>

<body>
    <div class="main">
        <div id="A4">
            <div class="bottomText">
                <h2>HAND LOAN AGREEMENT</h2>
                <p style="text-align: justify !important;">
                    This hand loan agreement is made on this <span class="lineWithBold" id="datef"></span> between <span class="onlyBold">Mr. Shivanand
                    S Neelannavar</span>, Age - 43 yrs, Occ - Buisiness, R / o, Plot No - 11, Ram Nagar, Belagavi, hereafter called the <span class="onlyBold">Party No. 1</span>
                    (which expression shall mean and include their heirs, successors, assigns, representatives, legal claimants administrators etc) and
                </p>
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
        //         console.log(data);
        //         var amountAsNumber = parseFloat(data.amount);
        //         var amtinwords=convertNumberToWords(amountAsNumber);
        //         var amt = amountAsNumber.toFixed(2);

        //         var occ=data.occu;
        //         var res=data.resident;
        //         var content = "Occ : " + occ + " R/ o, " + res;
        //         $('#occ-res').html(content);
        //         $('#partyName').html(data.party);
        //         $('#partyAmt').html(amt)
        //         $('#partyAmt1').html(amt)

                    var originalDate = data.date;
                    var dateArray = originalDate.split("-");
                    var formattedDate = dateArray[2] + "-" + dateArray[1] + "-" + dateArray[0];
                    $('#datef').html(formattedDate);
        //         $('#date').html(formattedDate);
        //         $('#partName1').html("Mr/Miss "+data.party);

        //         $('#inwords').html(amtinwords)
        //         $('#inwords1').html(amtinwords)
        //         $('#partyAge').html("Age : "+data.age)
        //         $('#bank').html(" "+data.bank)
                printPage(aggId,cid);
            },
            error: function (xhr, status, error) 
            {
                console.error("AJAX Error:", status, error);
            }
        });
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
    function printPage(aggId,cid) 
    {
        window.print();
        // window.onafterprint = function(event)
        // {
            // window.location.href = "agreement_take.php?aggid="+aggId +"&cid="+cid;
            window.close();
        // };
    }
</script>
</html>