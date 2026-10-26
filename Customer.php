
<?php
require_once "db.php";

class Customer
{
    // Add Customer
    public function addCustomer(mysqli $connection)
    {
        $name = readline("Enter Name: ");
        $email = readline("Enter Email: ");
        $balanceInput = readline("Enter Initial Balance: ");

        if ($name == "" || $email == "") {
            echo "Please enter Name and Email.\n";
            return;
        } elseif ($balanceInput < 0) {
            echo "Balance cannot be negative.\n";
            return;
        }

        $balance = (float) $balanceInput;

        $sql = "INSERT INTO Customers (Name, Email, Balance)
                VALUES (?, ?, ?)";

        $connection->execute_query(
            $sql,
            [$name, $email, $balance]
        );

        echo "Customer Added Successfully!\n";
        echo "New Customer ID: " . $connection->insert_id . "\n";
    }

    // Delete Customer 
    public function deleteCustomer(mysqli $connection)
    {
        $id = (int) readline("Enter Customer ID to delete: ");

        if ($id <= 0) {
            echo "Enter a valid Customer ID.\n";
            return;
        }

        $sql = "DELETE FROM Customers WHERE Customer_ID = ?";

        $connection->execute_query($sql, [$id]);

        if ($connection->affected_rows > 0) {
            echo "Customer deleted successfully!\n";
        } else {
            echo "Customer not found.\n";
        }
    }
    // View All Customers
    public function viewAllCustomers(mysqli $connection)
    {
        $select = "SELECT * FROM Customers WHERE Customer_ID = ?";
        $id = (int) readline("Enter Customer ID: ");
        $result = $connection->execute_query($select, [$id]);

        if ($result->num_rows === 0) {
            echo "No customers found.\n";
            $result->free();
            return;
        }

        echo "\n HORIZON BANK: ALL CUSTOMERS \n\n";

        while ($row = $result->fetch_assoc()) {
            echo "Customer ID: " . $row["Customer_ID"] . "\n";
            echo "Name: " . $row["Name"] . "\n";
            echo "Email: " . $row["Email"] . "\n";
            echo "Balance: " . number_format(
                (float) $row["Balance"],
                2
            ) . "\n";

            echo "----------------------------------\n";
        }

        $result->free();
    }

    // View Specific Customer
    public function viewCustomer(mysqli $connection)
    {
        $select = "SELECT * FROM Customers WHERE Customer_ID = ?";
        $id = (int) readline("Enter Customer ID: ");

        $result = $connection->execute_query($select, [$id]);

        if ($row = $result->fetch_assoc()) {
            echo "\n CUSTOMER DETAILS \n";
            echo "Customer ID: " . $row["Customer_ID"] . "\n";
            echo "Name: " . $row["Name"] . "\n";
            echo "Email: " . $row["Email"] . "\n";
            echo "Balance: " . number_format(
                (float) $row["Balance"],
                2
            ) . "\n";
        } else {
            echo "No such customer found.\n";
        }

        $result->free();
    }
}
?>

?>
