<?php
// Retrieve data from the AJAX request
$payeeName = isset($_GET['payee']) ? $_GET['payee'] : '';
$chequeAmount = isset($_GET['amount']) ? $_GET['amount'] : '';

// Perform server-side processing if needed
// For simplicity, it's currently not doing any processing

// Return a response to the client
echo json_encode(['status' => 'success']);
?>
