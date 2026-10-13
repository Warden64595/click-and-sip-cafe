<?php
require('auth_session.php');
require('db.php');

$invoice = $_POST['invoice'] ?? '';
$type    = $_POST['payment_type'] ?? '';
$uid     = (int)$_SESSION['user_id'];

if (!in_array($type, ['Cash', 'GCash'], true) || $invoice === '') {
    http_response_code(400);
    die("Invalid payment request.");
}

// The amount is calculated again on the server from the saved order.
$stmt = mysqli_prepare($con, "SELECT SUM(subtotal_amount) AS total FROM orders WHERE invoice_number = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, "si", $invoice, $uid);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if ($row['total'] === null) { die("Order not found."); }
$amount = (float)$row['total'];

$status = ($type === 'Cash') ? 'To Pay' : 'Waiting for Payment';
$now    = date('Y-m-d H:i:s');

$ins = mysqli_prepare($con, "INSERT INTO payment_method (invoice_number, user_id, payment_type, amount, payment_status, date_created) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($ins, "sisdss", $invoice, $uid, $type, $amount, $status, $now);
if (mysqli_stmt_execute($ins)) {
    echo "<script>alert('Order placed! Thank you. Payment method saved: " . $type . "');window.location.href='index.php';</script>";
} else {
    echo "Could not save the payment. Please try again.";
}
