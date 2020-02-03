<?php
$dsn = 'mysql:host=localhost;dbname=gusystem';
            $username = 'root';
            $password = 'Pa$$w0rd';

            try {
                $db = new PDO($dsn, $username, $password);

            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                /* include('database_error.php'); */
                echo "DB Error: " . $error_message; 
                exit();
            }
// Get IDs
$inquiryID = filter_input(INPUT_POST, 'inquiry_id', FILTER_VALIDATE_INT);
$employeeID = filter_input(INPUT_POST, 'employee_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($inquiryID != false && $employeeID != false) {
    $query = 'DELETE FROM inquiry
              WHERE employeeID = :employee_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':employee_id', $employeeID);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('gu_admin.php');