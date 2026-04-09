<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_expense'])) {
    $description = $mysqli->real_escape_string($_POST['description']);
    $amount = $mysqli->real_escape_string($_POST['amount']);
    $user_id = $_SESSION['user_id'];
    $mysqli->query("INSERT INTO expenses (user_id, description, amount, date) VALUES ('$user_id', '$description', '$amount', NOW())");
    header("Location: dashboard.php");
}
?>

<h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
<form action="" method="post">
    <button type="submit" name="logout">Logout</button>
</form>

<form action="" method="post">
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" name="amount" step="0.01" placeholder="Amount" required>
    <button type="submit" name="add_expense">Add Expense</button>
</form>

<h3>Your Expenses</h3>
<table>
    <tr><th>Description</th><th>Amount</th><th>Date</th></tr>
    <?php
    $user_id = $_SESSION['user_id'];
    $result = $mysqli->query("SELECT * FROM expenses WHERE user_id = $user_id");
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['description']}</td><td>{$row['amount']}</td><td>{$row['date']}</td></tr>";
    }
    ?>
</table>