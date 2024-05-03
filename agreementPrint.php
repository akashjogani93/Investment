<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        #main,#main1 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #backPage {
            width: 595px;
            height: 842px;
            display: flex;
            justify-content: center;
            position: relative;
            padding: 0px;
        }
        #frontPage
        {
            width: 595px;
            height: 842px;
            display: flex;
            justify-content: center;
            position: relative;
            padding: 0px;
            align-items:flex-end !important;
        }
        .bottomText {
            padding: 40px;
        }
        .bottomText1 {
            /* position: absolute;
            bottom: 3.5%; */
            padding: 0px;
            
        }


        .bottomText h2,.bottomText1 h2 {
            text-align: center;
            font-weight: bolder;
            text-decoration: underline;
            margin-bottom: 12px;
        }

        .bottomText p,.bottomText1 p {
            font-size: 18px;
            text-align: justify;
            line-height: 40px;
        }

        .lineWithBold {
            font-weight: 600;
            text-decoration: underline;
        }

        .onlyBold {
            font-weight: 600;
        }

        .row1 {
            display: flex;
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .BoldHighlight {
            font-weight: 600;
            font-size: 17px;
        }

        .bigSize {
            font-size: 17px;
        }

        .mar {
            margin: 0px 8px;
        }

        .left,
        .right {
            width: 50%;
        }

        @media print {
            html,
        body {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        #main,#main1 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #backPage {
            width: 595px;
            height: 842px;
            display: flex;
            justify-content: center;
            position: relative;
            padding: 0px;
        }
        #frontPage
        {
            width: 595px;
            height: 842px;
            display: flex;
            justify-content: center;
            position: relative;
            padding: 0;
            align-items:flex-end !important;
        }
        .bottomText {
            padding: 40px;
        }
        .bottomText1 {
            /* position: absolute;
            bottom: 3.5%; */
            padding: 0px;
            
        }


        .bottomText h2,.bottomText1 h2 {
            text-align: center;
            font-weight: bolder;
            text-decoration: underline;
            margin-bottom: 12px;
        }

        .bottomText p,.bottomText1 p {
            font-size: 18px;
            text-align: justify;
            line-height: 40px;
        }

        .lineWithBold {
            font-weight: 600;
            text-decoration: underline;
        }

        .onlyBold {
            font-weight: 600;
        }

        .row1 {
            display: flex;
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .BoldHighlight {
            font-weight: 600;
            font-size: 17px;
        }

        .bigSize {
            font-size: 17px;
        }

        .mar {
            margin: 0px 8px;
        }
        #front{
            position:relative;
            bottom:0;
        }
        .left,
        .right {
            width: 50%;
        }

            @page {
                size: auto;
                margin: 0;
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
    <div id="front">
    <div id="main1">
        <div id="frontPage">
            <div class="bottomText1">
                <h2>HAND LOAN AGREEMENT</h2>
                <p style="text-align: justify !important;">
                    This hand loan agreement is made on this <span class="lineWithBold" id="datef"></span> between
                    <span class="onlyBold">Mr. Shivanand S Neelannavar</span>, Age - 43 yrs, Occ - Business, R / o, Plot
                    No - 11, Ram Nagar, Belagavi, hereafter called the <span class="onlyBold">Party No. 1</span> (which
                    expression shall mean and include their heirs, successors, assigns, representatives, legal claimants
                    administrators etc) and
                </p>
            </div>
        </div>
    </div>
    </div>

    <div id="main">
        <div id="backPage">
            <div class="bottomText">
                <div class="row">
                    <span class="BoldHighlight" id="partyName"></span>
                    <span class="bigSize" id="partyAge"></span>
                </div>
                <span class="bigSize" id="occ-res"></span>

                <p style="text-align: justify !important;margin-top: 7px;margin-bottom: 7px;"> hereinafter called Party
                    No. 2 (which expression shall mean and include their legal heirs, successors, assigns,
                    representatives, legal claimants administrators etc. ) Whereas, the Party No. 1, being in need of
                    money to meet out his financial difficulties approached Party No. 2 and Party No. 2 has agreed to
                    assist the Party No. 1 financially on the following terms : <br> The Party No 1 and Party No 2 are
                    both friends and as Party No. 1 needs money for his personal purpose. <br>
                    <div class="row1">
                        <span class="onlyBold">Amount Rs :</span><span class="lineWithBold"
                            style="margin-left: 20px;" id="partyAmt"></span>
                    </div>
                    <div class="row1">
                        <span class="onlyBold">In Words :</span><span class="lineWithBold"
                            style="margin-left: 20px;" id="inwords"></span>
                    </div>
                    which has to be paid within 12 months. <br> <br>
                    <div class="row1">
                        <span class="onlyBold">Cheque No ______________ </span><span class="mar">of </span><span
                            class="onlyBold" id="bank"></span>
                    </div>
                    <div class="row1">
                        <span class="onlyBold">Amount Rs : </span><span class="lineWithBold"
                            style="margin-left: 20px;" id="partyAmt1"></span>
                    </div>
                    <div class="row1">
                        <span class="onlyBold">In Words :</span><span class="lineWithBold"
                            style="margin-left: 20px;" id="inwords1"></span>
                    </div>
                    Party No. 1 has to give to Party No. 2 <br>
                    <p>The above said loan, in case if Party No. 1 fails to repay the amount, then Party No. 2 can
                        initiate for Count proceedings.</p>
                    Hence the Agreement. <br> <br>
                    <div class="row1">
                        <span class="">Place :</span><span class="onlyBold"
                            style="margin-left: 20px;">Belagavi</span>
                    </div>
                    <div class="row1">
                        <span class="">Date :</span><span class="onlyBold"
                            style="margin-left: 20px;" id="date"></span>
                    </div>
                    <span class="onlyBold">Witness</span>
                    <br> <br>
                    <div class="row">
                        <div class="left">
                            1.__________________
                        </div>
                        <div class="right">
                            <span class="onlyBold">Party No. 1 ______________________</span><br>
                            <div style="margin-top: 8px;">
                                <span class="onlyBold" style="">Mr. Shivanand S Neelannavar</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="left">
                            1.__________________
                        </div>
                        <div class="right">
                            <span class="onlyBold">Party No. 2 ______________________</span><br>
                            <div style="margin-top: 8px;">
                                <span class="onlyBold" style="" id="partName1"></span>
                            </div>
                        </div>
                    </div>
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

                    var occ=data.occu;
                    var res=data.resident;
                    var content = "Occ : " + occ + " R/ o, " + res;
                    $('#occ-res').html(content);
                    $('#partyName').html(data.party);
                    $('#partyAmt').html(amt)
                    $('#partyAmt1').html(amt)

                    var originalDate = data.date;
                    var dateArray = originalDate.split("-");
                    var formattedDate = dateArray[2] + "-" + dateArray[1] + "-" + dateArray[0];
                    $('#datef').html(formattedDate);
                    $('#date').html(formattedDate);
                    $('#partName1').html("Mr/Miss "+data.party);

                    $('#inwords').html(amtinwords)
                    $('#inwords1').html(amtinwords)
                    $('#partyAge').html("Age : "+data.age)
                    $('#bank').html(" "+data.bank)


                    printPage()
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

    function printPage()
    {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>');
        var styles = document.getElementsByTagName('style');
        for (var i = 0; i < styles.length; i++) {
            printWindow.document.write(styles[i].innerText);  // Use innerText instead of innerHTML
        }
        printWindow.document.write('</style></head><body>');
        // Copy the HTML content for the front page
        printWindow.document.write(document.getElementById('front').innerHTML);
        printWindow.document.write('<div style="page-break-before: always;"></div>'); // Add page break
        // Copy the HTML content for the back page
        printWindow.document.write(document.getElementById('backPage').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>


</html>
