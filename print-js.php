<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Cheque</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #chequeContainer {
            width: 600px;
            margin: auto;
            text-align: center;
        }

        #payee, #amount {
            font-weight: bold;
            margin-top: 50px;
        }

        #printButton {
            margin-top: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="chequeContainer">
    <div id="payee"></div>
    <div id="amount"></div>
    <button id="printButton" onclick="printCheque()">Print Cheque</button>
</div>

<script>
    function printCheque() {
        var payeeName = prompt("Enter Payee Name:");
        var chequeAmount = prompt("Enter Cheque Amount:");

        // Make an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Response from the server
                document.getElementById('payee').innerText = "Pay to the Order of: " + payeeName;
                document.getElementById('amount').innerText = "Amount: " + chequeAmount;
                
                // Trigger the browser's print functionality
                window.print();
            }
        };

        // Send the data to the server
        xhr.open("GET", "print.php?payee=" + encodeURIComponent(payeeName) + "&amount=" + encodeURIComponent(chequeAmount), true);
        xhr.send();
    }
</script>

</body>
</html>
