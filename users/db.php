<?php
// Database connection (XAMPP defaults: user root, no password)
$con = mysqli_connect("localhost", "root", "", "coffee_shop_namin");
if (!$con) {
    die("Database connection failed. Start MySQL in XAMPP and import database/click.sql first.");
}
mysqli_set_charset($con, "utf8mb4");
