
<?php

class Transaction
{
    // Credit for

    public function credit(mysqli $connection)
    {
        $id = (int) readline("Enter Customer ID: ");
        $amount = (float) readline("Enter Credit Amount: ");

        if ($id <= 0 || $amount <= 0) {
            echo "Invalid customer ID or amount\n";
            return;
        }

        $sql = "UPDATE Customers
                SET Balance = Balance + ?
                WHERE Customer_ID = ?";

        $connection->execute_query($sql, [$amount, $id]);

        if ($connection->affected_rows > 0) {
            echo "Amount credited successfully!\n";
            $this->showBalance($connection, $id);
        } else {
            echo "Customer not found or balance unchanged.\n";
        }
    }

    // Debit for
    public function debit(mysqli $connection)
    {
        $id = (int) readline("Enter Customer ID: ");
        $amount = (float) readline("Enter Debit Amount: ");

        if ($id <= 0 || $amount <= 0) {
            echo "Invalid customer ID or amount\n";
            return;
        }

        $sql = "UPDATE Customers
                SET Balance = Balance - ?
                WHERE Customer_ID = ? AND Balance >= ?";

        $connection->execute_query($sql, [$amount, $id, $amount]);

        if ($connection->affected_rows > 0) {
            echo "Amount debited successfully!\n";
            $this->showBalance($connection, $id);
        } else {
            echo "Customer not found or insufficient balance.\n";
        }
    }

    public function showBalance(mysqli $connection, int $id)
    {
        $result = $connection->execute_query(
            "SELECT Name, Balance FROM Customers WHERE Customer_ID = ?",
            [$id]
        );

        if ($row = $result->fetch_assoc()) {
            echo "Customer: " . $row["Name"] . "\n";
            echo "Current Balance: "
                . number_format((float) $row["Balance"], 2) . "\n";
        } else {
            echo "Customer not found.\n";
        }

        $result->free();
    }
}
?>
