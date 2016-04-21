<!DOCTYPE HTML> 
 

<?php
// define variables and set to empty values
$ID_err = $fname_err = $lname_err = $NIC_err = "";
$address_line1_err = $address_line2_err = $address_line3_err = $con_no_err = $email_err = $fax_err = "";
$ID = $fname = $lname = $NIC = $address_line1 = $address_line2 = $address_line3 = $con_no = $email = $fax = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //ID
  if (empty($_POST["ID"])) {
     $ID_err = "ID is required";
   } 
   else {
     $ID = test_input($_POST["ID"]);
     //check if ID contains only numbers
     if (!preg_match("/^[0-9]{10}$/", $ID)) {
       $ID_err = "Invalid ID"; 
     }
   }

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "samarasinghemotors";

  // Create connection
  $conn = new mysqli($servername, $username, $password,$dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  //echo "Connected successfully";
  $sql = "SELECT * FROM customer WHERE customer_ID = '$ID'";
  $detail = $conn->query($sql);
    
  if ($detail->num_rows > 0) {
    // output data of each row
    while($row = $detail->fetch_assoc()) {
        $ID = $row["customer_ID"]; 
        $fname = $row["first_name"];
        $lname = $row["last_name"];
        $NIC = $row["NIC"];
        $address_line1 = $row["address_line1"]; 
        $address_line2 = $row["address_line2"];
        $address_line3 = $row["address_line3"];
        $con_no = $row["contact_no"];
        $email = $row["email"];
        $fax = $row["fax"];

      }
    }
    else {
    echo "0 results";
    }

$conn->close();   
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Customer Details</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

  ID: <input type="text" name="ID" value="<?php echo $ID;?>">
   <span class="error">* <?php echo $ID_err;?></span>
   <br><br>

  <button type="Submit" name = "search" class="btn btn-primary btn-md">
                                    
                                    Search
        </button>
        <br><br>

  <?php
  if(isset($_POST['search'])){
  $form = <<<EOT
   ID: <input type="text" name="ID" value="$ID">
   <span class="error">* <?php echo $ID_err;?></span>
   <br><br>
   First Name: <input type="text" name="fname" value="$fname">
   <span class="error">* <?php echo $fname_err;?></span>
   <br><br>
   Last Name: <input type="text" name="lname" value="$lname">
   <span class="error">* <?php echo $lname_err;?></span>
   <br><br>
   NIC: <input type="text" name="NIC" value="$NIC">
   <span class="error">* <?php echo $NIC_err;?></span>
   <br><br>
   Address Line 1: <input type="text" name="address_line1" value="$address_line1">
   <span class="error">* <?php echo $address_line1_err;?></span>
   <br><br>
   Address Line 2: <input type="text" name="address_line2" value="$address_line2">
   <br><br>
   Address Line 3: <input type="text" name="address_line3" value="$address_line3">
   <br><br>
   Contact No: <input type="text" name="con_no" value="$con_no">
   <span class="error">* <?php echo $con_no_err;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="$email">
   <span class="error">* <?php echo $email_err;?></span>
   <br><br>
   Fax No: <input type="text" name="fax" value="$fax">
   <br><br>
   <button type="Submit" name = "update" class="btn btn-primary btn-md">
                                    
                                    Update
        </button>
        <br><br>
    <button type="Submit" name = "delete" class="btn btn-primary btn-md">
                                    
                                    Delete
        </button>
        <br><br>
   </form>
EOT;
echo $form;}

//Updating variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {


   //First Name
   if (empty($_POST["fname"])) {
     $fname_err = "First Name is required";
   } 
   else {
     $fname = test_input($_POST["fname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
       $fname_err = "Only letters and white space allowed"; 
     }
   }

   //Last Name
   if (empty($_POST["lname"])) {
     $lname = "";
   } 
   else {
     $lname = test_input($_POST["lname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
       $lname_err = "Only letters and white space allowed"; 
     }
   }

   //NIC
    if (empty($_POST["NIC"])) {
     $NIC_err = "NIC number is required";
    } 
    elseif(strlen($_POST['NIC']) !== 10) {
      //Here is not 10 characters long
      $NIC_err = "Please provide 10 character number"; 
    }
    elseif (!preg_match("/^[0-9V]*$/",$NIC)) {
      // check whether the given NIC is valid
       $NIC_err = "Invalid NIC number"; 
     }
    else {
     $NIC = test_input($_POST["NIC"]);
     // check whether the given NIC is vaid
     }

   //Address Line 1
   if (empty($_POST["address_line1"])) {
     $address_line1_err = "Contact address is required";
   } 
   else {
     $address_line1 = test_input($_POST["address_line1"]);
   }

   //Address Line 2
   if (empty($_POST["address_line2"])) {
     $address_line2 = "";
   } 
   else {
     $address_line2 = test_input($_POST["address_line2"]);
   }
   
   //Address Line 3
   if (empty($_POST["address_line3"])) {
     $address_line3 = "";
   } 
   else {
     $address_line3 = test_input($_POST["address_line3"]);
   }

   //Contact No
   if(empty($_POST["con_no"])){
      $con_no_err = "Contact number is required";
   }
   elseif(!is_numeric($_REQUEST['con_no'])) {
      $con_no_err = "Please provide a valid contact number";
   }
   elseif(strlen($_REQUEST['con_no']) !== 10) {
      //Here is not 11 characters long
      $con_no_err = "Please provide 10 character number";   
   }
   else {
     $con_no = test_input($_POST["con_no"]);
   }

   //E-mail
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }

   //Fax No
   if(empty($_POST["fax"])){
      $fax = "";
   }
   elseif(!is_numeric($_REQUEST['fax'])) {
      $fax_err = "Please provide a valid fax number";
   }

   else {
     $fax = test_input($_POST["fax"]);
   }   
}

if(isset($_POST['update'])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "samarasinghemotors";

// Create connection
$con_edit = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($con_edit->connect_error) {
    die("Connection failed: " . $con_edit->connect_error);
  } 
  //echo "Connected successfully";
  $sql = "UPDATE customer SET
    first_name = '$fname', 
    last_name = '$lname', 
    NIC = '$NIC', 
    address_line1 = '$address_line1', 
    address_line2 = '$address_line2', 
    address_line3 = '$address_line3', 
    contact_no = '$con_no', 
    email = '$email', 
    fax = '$fax'
    WHERE customer_ID = '$ID'";
  
//$result = $conn->query($sql);
  if ($con_edit->query($sql) === TRUE) {
      echo "Values updated successfully";
      //header("location:view.php");

  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }}

  //Delete existing value

  if(isset($_POST['delete'])){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "samarasinghemotors";

// Create connection
$con_delete = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($con_delete->connect_error) {
    die("Connection failed: " . $con_edit->connect_error);
  } 
  //echo "Connected successfully";
  $sql = "DELETE FROM customer 
    WHERE customer_ID = '$ID'";
  
//$result = $conn->query($sql);
  if ($con_delete->query($sql) === TRUE) {
      echo "Values deleted successfully";
      //header("location:view.php");

  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }}

?>
   
   


