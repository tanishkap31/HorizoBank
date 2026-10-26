
<?php

require_once "db.php";
require_once "Customer.php";
require_once "Transaction.php";

$customer = new Customer();
$transaction = new Transaction();

while (true) {
    echo "\n========== HORIZON BANK ==========\n";
    echo "1. Add Customer\n";
    echo "2. View All Customers\n";
    echo "3. View Specific Customer\n";
    echo "4. Credit / Deposit\n";
    echo "5. Debit / Withdraw\n";
    echo "6. Delete \n";
    echo "7. Exit\n";
    echo "==================================\n";

    $choice = readline("Enter your choice: ");

    switch ($choice) {
        case "1":
            $customer->addCustomer($connection);
            break;

        case "2":
            $customer->viewAllCustomers($connection);
            break;

        case "3":
            $customer->viewCustomer($connection);
            break;

        case "4":
            $transaction->credit($connection);
            break;

        case "5":
            $transaction->debit($connection);
            break;
        case "6":
            $customer->deleteCustomer($connection);
            break;

        case "8":
            echo "Thank you for using Horizon Bank!\n";
            $connection->close();
            exit;

        default:
            echo "Invalid choice. Try again.\n";
    }
}
?>
