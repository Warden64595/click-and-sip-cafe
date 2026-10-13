<?php
require('auth_session.php');
require('db.php');

$invoice = $_GET['invoice'] ?? '';
$stmt = mysqli_prepare($con, "SELECT SUM(subtotal_amount) AS total FROM orders WHERE invoice_number = ? AND user_id = ?");
$uid = (int)$_SESSION['user_id'];
mysqli_stmt_bind_param($stmt, "si", $invoice, $uid);
mysqli_stmt_execute($stmt);
$row   = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$total = $row['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select Payment Method</title>
    <link rel="stylesheet" href="../assets/css/payment.css">
</head>
<body>
<div class="box">
<?php if ($total === null): ?>
    <h2>Order not found</h2>
    <p>Please go back and place your order again.</p>
    <a href="index.php">Back to the menu</a>
<?php else: ?>
    <h2>Select Payment Method</h2>
    <p>Invoice: <strong><?php echo htmlspecialchars($invoice); ?></strong></p>
    <h3>Total: ₱<?php echo number_format((float)$total, 2); ?></h3>

    <form method="POST" action="save_payment.php">
        <input type="hidden" name="invoice" value="<?php echo htmlspecialchars($invoice); ?>">
        <button type="submit" name="payment_type" value="Cash">Cash</button>
    </form>

    <button type="button" onclick="showGCash()">GCash</button>

    <div id="gcashBox">
        <h3>Pay via GCash</h3>
        <p><strong>GCash Number:</strong> 09XXXXXXXXX</p>
        <p><strong>Account Name:</strong> Click &amp; Sip Cafe</p>
        <img src="../assets/images/qr.webp" width="200" alt="GCash QR code">
        <form method="POST" action="save_payment.php">
            <input type="hidden" name="invoice" value="<?php echo htmlspecialchars($invoice); ?>">
            <button type="submit" name="payment_type" value="GCash">Paid</button>
        </form>
    </div>
<?php endif; ?>
</div>
<script>
function showGCash(){ document.getElementById("gcashBox").style.display = "block"; }
</script>
</body>
</html>
