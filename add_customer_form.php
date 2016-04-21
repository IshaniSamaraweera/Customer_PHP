<?php
// define variables and set to empty values
$ID_err = $fname_err = $lname_err = $NIC_err = $address_line1_err = $address_line2_err = $address_line3_err = $con_no_err = $email_err = $fax_err = "";
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

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Customer Registration Form</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

   ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="ID" value="<?php echo $ID;?>">
   <span class="error">* <?php echo $ID_err;?></span>
   <br><br>
   First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="fname" value="<?php echo $fname;?>">
   <span class="error">* <?php echo $fname_err;?></span>
   <br><br>
   Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="lname" value="<?php echo $lname;?>">
   <span class="error">* <?php echo $lname_err;?></span>
   <br><br>
   NIC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="NIC" value="<?php echo $NIC;?>">
   <span class="error">* <?php echo $NIC_err;?></span>
   <br><br>
   Address Line 1: <input type="text" name="address_line1" value="<?php echo $address_line1;?>">
   <span class="error">* <?php echo $address_line1_err;?></span>
   <br><br>
   Address Line 2: <input type="text" name="address_line2" value="<?php echo $address_line2;?>">
   <br><br>
   Address Line 3: <input type="text" name="address_line3" value="<?php echo $address_line3;?>">
   <br><br>
   Contact No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="con_no" value="<?php echo $con_no;?>">
   <span class="error">* <?php echo $con_no_err;?></span>
   <br><br>
   E-mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $email_err;?></span>
   <br><br>
   Fax No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="fax" value="<?php echo $fax;?>">
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
$check = empty($_POST["ID"]) || empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["NIC"]) || empty($_POST["con_no"]) || empty($_POST["address_line1"]);
if(isset($_POST['submit']) == TRUE && $check == FALSE ){
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
  $sql = "INSERT INTO
   customer (
    customer_ID, 
    first_name, 
    last_name, 
    NIC, 
    address_line1, 
    address_line2, 
    address_line3, 
    contact_no, 
    email , 
    fax)
    VALUES (
      '$ID', 
      '$fname', 
      '$lname', 
      '$NIC', 
      '$address_line1', 
      '$address_line2', 
      '$address_line3', 
      '$con_no', 
      '$email', 
      '$fax')";

//$result = $conn->query($sql);
  //echo "values saved to the database";
  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      //header("location:view.php");

  } 
  else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>
