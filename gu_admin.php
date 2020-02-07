<!DOCTYPE html>
<!-- 

Original Author: Joshua Novikoff
Date Created: 1/31/2020
Version: 1.0
Date Last Modified: 2/7/2020
Modified by: Joshua Novikoff
Modification log: Added require of database.php & call to getDB();

				  
-->
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="description" content="Thank you for your inquiry">
<meta name="keywords" content="computers, technology, delivery, web design">
<meta name="author" content="Joshua Novikoff">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Giantbulb Unlimited||Thank You</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/styles.css">
<link href="https://fonts.googleapis.com/css?family=Lexend+Deca|Open+Sans+Condensed:300&display=swap" rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="images/gu_favicon.png"

</head>

<body>
<?php
    require('./model/database.php');
    require('./model/employee.php');
    require('./model/inquiry.php');
    
    //$inquiryName = filter_input(INPUT_POST, 'Name');
    /* echo "Fields: " . $inquiryName . $inquiryEmail . $inquiryPhone . $inquiryPrice . $inquiryMsg;  */
	
//	if (!isset($employee_id)) {
//    $employee_id = filter_input(INPUT_GET, 'employee_id', 
//            FILTER_VALIDATE_INT);
//    if ($employee_id == NULL || $employee_id == FALSE) {
//        $employee_id = 1;
//    }
//	}
    
    // Validate inputs
    
        
            //$dsn = 'mysql:host=localhost;dbname=gusystem';
            //$username = 'root';
            //$password = 'Pa$$w0rd';

            try {
                //$db = new PDO($dsn, $username, $password);
                $db = Database::getDB();  //function 1
                

            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                /* include('database_error.php'); */
                echo "DB Error: " . $error_message; 
                exit();
            }

            // Add the inquiry to the database  
//            $query = 'SELECT employeeID, firstName FROM employee ORDER BY employeeID';                         
//            $statement = $db->prepare($query);            
//            $statement->execute();
//            $employees = $statement;
            $employees = getEmployee();   //function 2
            /* echo "Fields: " . $inquiryName . $inquiryEmail . $inquiryPhone . $inquiryPrice . $inquiryMsg; */
			
//            $query2 = 'SELECT * FROM inquiry WHERE employeeID = :employeeID '
//				. 'ORDER BY inquiryEmail';                         
//            $statement2 = $db->prepare($query2); 
//            $statement2->bindValue(":employeeID", $employee_id);
//            $statement2->execute();
//            $inquiries = $statement2;
            $inquiries = getInquiry();   //function 3
            /* echo "Fields: " . $inquiryName . $inquiryEmail . $inquiryPhone . $inquiryPrice . $inquiryMsg; */
			
			
?>
<nav>
<a href="gu_index.html"><img src="images/gu_logo.png" alt="logo"></a>
<ul>
	<li><a href="gu_index.html">Home</a></li>
	<li><a href="gu_about.html">About</a></li>
	<li><a href="gu_pricing.html">Pricing</a></li>
	<li><a href="gu_examples.html">Examples</a></li>
	<li><a href="gu_contact.html">Contact</a></li>
        <li><a href="gu_login.php">Admin</a></li>
</ul>
</nav>
    <table class="inquiryTable">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th class="right">Message</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($inquiries as $inquiry) : ?>
            <tr>
                <td><?php echo $inquiry['inquiryName']; ?></td>
                <td><?php echo $inquiry['inquiryEmail']; ?></td>
                <td class="right"><?php echo $inquiry['inquiryMsg']; ?></td>
                <td><form action="delete_customer.php" method="post">
                    <input type="hidden" name="inquiry_id"
                           value="<?php echo $inquiry['inquiryID']; ?>">
                    <input type="hidden" name="employee_id"
                           value="<?php echo $inquiry['employeeID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
<aside>
        <!-- display a list of employees -->
        <h2>Employees</h2>        
        <ul>
            <?php foreach ($employees as $employee) : ?>
            <li><a href="?employee_id=<?php echo $employee['employeeID']; ?>">
                    <?php echo $employee['firstName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>         
    </aside>
	  

<footer>
Giantbulb Unlimited &#8226; 57814 Loower Moor Dr, New York NY
</footer>

</body>
</html>