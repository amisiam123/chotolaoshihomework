<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'hostel_expense_tracker');
if ($mysqli->connect_error) {
    die('Connection Failed: ' . $mysqli->connect_error);
}
?>