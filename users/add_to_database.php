<?php
// Saves the cart as one order (one invoice). Called by assets/js/script.js
require('auth_session.php');
require('db.php');
header('Content-Type: application/json');

$items = json_decode(file_get_contents('php://input'), true);
if (!is_array($items) || count($items) === 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Your cart is empty.']);
    exit();
}

$userId  = (int)$_SESSION['user_id'];
$date    = date('Y-m-d');
$invoice = 'INV-' . date('ymd') . '-' . random_int(100000, 999999);
$total   = 0;

mysqli_begin_transaction($con);
try {
    $stmt = mysqli_prepare($con, "INSERT INTO orders (price, title, quantity, subtotal_amount, date, invoice_number, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($items as $it) {
        $title = trim((string)($it['title'] ?? ''));
        $price = (float)($it['price'] ?? 0);
        $qty   = (int)($it['quantity'] ?? 0);
        if ($title === '' || strlen($title) > 100 || $price <= 0 || $qty < 1 || $qty > 99) {
            throw new Exception('Invalid item in cart.');
        }
        $sub = round($price * $qty, 2);
        $total += $sub;
        mysqli_stmt_bind_param($stmt, "dsidssi", $price, $title, $qty, $sub, $date, $invoice, $userId);
        if (!mysqli_stmt_execute($stmt)) { throw new Exception('Could not save the order.'); }
    }
    mysqli_commit($con);
    echo json_encode(['success' => true, 'invoice' => $invoice, 'total' => round($total, 2)]);
} catch (Exception $e) {
    mysqli_rollback($con);
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
