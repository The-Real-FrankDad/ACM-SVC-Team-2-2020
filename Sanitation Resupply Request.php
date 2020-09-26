<!DOCTYPE HTML>  
<html>
<!--- SVC Team 2, Bull-****-a-Thon sanitiation resupply request form, V1.01, Spetember 25th, 2020--->
<!--- note, this will not work unless there is a php server present, so I will attempt to upload this to the apachee server tomorrow--->
<head>
<!-- sam add this--->
<style>

</style>
<link rel="icon href="pictures/bearcat.png">
<title>
Sanitation Resupply Request Form
</title>
</head>
<body>  
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
// define variables and set to empty values
$NameErr = $EmailErr = $SaniTypeErr = $SaniStationErr = "";
$Name = $Email = $SaniType = $SaniStation = "";
function isvalid(){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Name"])) {
    $NameErr = "Name is required";
  } else {
    $Name = test_input($_POST["Name"]);
    // check if Name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Name)) {
      $NameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["Email"])) {
    $EmailErr = "Email is required";
  } else {
    $Email = test_input($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($Email, FILTER_VALIDATE_Email)) {
      $EmailErr = "Invalid Email format";
    }
  }
    
  if (empty($_POST["SaniStation"])) {
    $SaniStation = "";
  } else {
    $SaniStation = test_input($_POST["SaniStation"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("\d",$SaniStation)) {
      $SaniStationErr = "Invalid URL";
    }
  }

 
  if (empty($_POST["SaniType"])) {
    $SaniTypeErr = "SaniType is required";
  } else {
    $SaniType = test_input($_POST["SaniType"]);
  }
}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Sanitation Station Resupply Request Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" onsubmit=return isvalid()" action="pages/valid.php">  
  Name: <input type="text" name="Name" value="<?php echo $Name;?>">
  <span class="error">* <?php echo $NameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="Email" value="<?php echo $Email;?>">
  <span class="error">* <?php echo $EmailErr;?></span>
  <br><br>
  Sanitation Station (Number is listed next to or above station: <input type="text" name="SaniStation" value="<?php echo $SaniStation;?>">
  <span class="error">*<?php echo $SaniStationErr;?></span>
  <br><br>
  Type of Sanitation:
  <input type="radio" name="SaniType" <?php if (isset($SaniType) && $SaniType=="Wipes") echo "checked";?> value="female">Wipes
  <input type="radio" name="SaniType" <?php if (isset($SaniType) && $SaniType=="White Pump") echo "checked";?> value="male">White Pump
  <input type="radio" name="SaniType" <?php if (isset($SaniType) && $SaniType=="Black Pump Sanitizer") echo "checked";?> value="other">Black Pump Sanitizer
  <input type="radio" name="SaniType" <?php if (isset($SaniType) && $SaniType=="Black Pump Soap") echo "checked";?> value="other">Black Pump Soap   
  <span class="error">* <?php echo $SaniTypeErr;?></span>
  <br><br>
  <div class="g-recaptcha" data-sitekey="your_site_key"></div>
      <br/>
      <input type="submit" value="Submit">
	  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $Name;
echo "<br>";
echo $Email;
echo "<br>";
echo $SaniStation;
echo "<br>";
echo $SaniType;
$mgs= $Name." with the email ".$Email. " has reported that Sanitation Station ".$SaniStation." is out and needs ".$SaniType;
$msg = wordwrap($msg,60);
mail("test@test.edu","Sanitation Station Resupply Request",$msg); 
?>

</body>
</html>