<?php
//Connect to Database
  $conn = mysqli_connect('localhost', 'root', '', 'buyandsell'); //connecting to DataBase
  if (!$conn) {
    echo "error connexion" . mysqli_connect_error();
  }
// cities query
  $cityquery = "SELECT city_name FROM cities";
                  $cityresult = mysqli_query($conn, $cityquery);
                  $citydata = mysqli_fetch_all($cityresult, MYSQLI_ASSOC); //fetching an associative table containing all emails in our DB
                  mysqli_free_result($cityresult);


//variables
$firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST["firstname"])); // make it ready for sql queries and avoit special characters for more security
$lastname = mysqli_real_escape_string($conn,htmlspecialchars($_POST["lastname"]));
$birth = mysqli_real_escape_string($conn,htmlspecialchars($_POST["birth"]));
$gender = mysqli_real_escape_string($conn,htmlspecialchars($_POST["gender"]));
$email = mysqli_real_escape_string($conn,htmlspecialchars($_POST["email"]));
$password = mysqli_real_escape_string($conn,htmlspecialchars($_POST["password"]));
$phone = mysqli_real_escape_string($conn,htmlspecialchars($_POST["phone"]));
$address = mysqli_real_escape_string($conn,htmlspecialchars($_POST["address"]));
$city = mysqli_real_escape_string($conn,htmlspecialchars($_POST["city"]));
session_start();
$_SESSION["firstname"] = $firstname;
//errors
$i=1;
$errors = array($firstname, $lastname, $birth, $gender, $password, $phone, $address,$city); // array contains all attributes except email, it will be tested in a different way since we should know if it is unique
if (isset($_POST["submit"])) {
  foreach ($errors as $error) { //for each attribute, we test if it empty or not
    if (!empty($error)) 
      $valid[$i] = "is-valid"; 
    else 
      $valid[$i] = "is-invalid";
    $i++;
  }


//check mail if empty or already exists
$already_exists = false; // we suppose that this mail isn't exist
  if (isset($_POST["submit"])) {
    $emailquery = "SELECT email FROM users";
    $emailresult = mysqli_query($conn, $emailquery);
    $emaildata = mysqli_fetch_all($emailresult, MYSQLI_ASSOC); //fetching an associative table containing all emails in our DB
    mysqli_free_result($emailresult);
  }
$j=0;
while($emaildata[$j]["email"]!=null){ //Searching in all emails if the last entred mail already exists
  if($emaildata[$j]["email"]==$email){
      $already_exists = true; //if so, switch it to true
  }
    $j++; // now we can qualify if an email already exists or not
}

  if (empty($email)) {
    $valid[9] = "is-invalid"; // more for bootstrap green or red + add sentence
    $mailerror = "Please enter a valid Email address!"; // Preparing shown sentence error based on cases
  }
  else{
        if($already_exists==true){
          $valid[9] = "is-invalid";
          $mailerror = "This email address already exists, Please enter a valid one!";
        }
        else{
          $valid[9] = "is-valid";
    }
  }
    
}
//END chekeing mail
//END errors + Check for no errors
$check = 1;
foreach($valid as $va){
  if ($va == "is-invalid"){
    $check = 0;
    break;
  }
}

//if the form is checked 
if (isset($_POST["submit"]) && $check == 1) { // if there is NO error (INCLUDING EMAIL)
  //check if this email is already used

  $sql = "INSERT INTO users (firstName,lastName,birth,gender,email,passsword,phone,adddress,city)
  VALUES ('$firstname', '$lastname', '$birth', '$gender', '$email', '$password', '$phone', '$address','$city')";
  $result = mysqli_query($conn, $sql); //inserting to DB
  if($result){
    //success
    header("Location: account_created.php");
  }
  else
  {
    echo "Query error" . mysqli_error($conn);
  }

}
//END Database


?>
<!doctype html>
<html lang="en">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<title>Register</title>
<?php include 'header.php';?>

<div class="container">

<section class="section register min-vh-300 d-flex flex-column align-items-center justify-content-center py-1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex justify-content-center py-4">
          <a href="index.php" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/logo.png" alt="logo" width="150">
          </a>
        </div>

        <div class="card mb-3">

          <div class="card-body shadow">

            <div class="pt-4 pb-2">
              <h5 class="text-primary fw-bolder card-title text-center pb-0 fs-4">Create your Account</h5>
              <p class="fw-light text-center small">Enter your personal details to create account</p>
            </div>

        <form class="row g-3  needs-validation" novalidate method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
            <div class="row g-3">
              <div class="col">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control <?php echo $valid[1]; ?>" value="<?php echo $firstname; ?>" id="firstName" required>
                <div class="invalid-feedback">Please, enter your name!</div>
              </div>

              <div class="col">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control <?php echo $valid[2]; ?>" value="<?php echo $lastname; ?>" id="lastName" required>
                <div class="invalid-feedback">Please, enter your name!</div>
              </div>
              </div>

              <div class="row g-3">
              <div class="col">
                
              <label for="yourbirth" class="form-label">Date of birth</label>
                <input type="date" name="birth" class="form-control <?php echo $valid[3]; ?>" value="<?php echo $birth; ?>" id="yourbirth" required>
                <div class="invalid-feedback">Please, enter your date of birth!</div>

              </div>

              <div class="col">
              <label for="yourGender" class="form-label">Your Gender</label>
                <select class="form-select <?php echo $valid[4]; ?>" name="gender" aria-label="Default select example">
                <option <?php if( $gender==null) echo "selected" ; ?> disabled >Choose</option>
                <option <?php if( $gender=="male") echo "selected" ; ?> value="male">Male</option>
                <option <?php if( $gender=="female") echo "selected" ; ?> value="female">Female</option>
                </select>
              </div>
              </div>

              <div class="col-12">
                <label for="yourEmail" class="form-label">Your Email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="email" name="email" class="form-control <?php echo $valid[9]; ?>" value="<?php echo $email; ?>" id="yourEmail" required>
                  <div class="invalid-feedback"><?php echo $mailerror; ?></div>
                </div>
              </div>

              <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control <?php echo $valid[5]; ?>" value="<?php echo $password; ?>" id="yourPassword" required>
                <div class="invalid-feedback">Please enter your password!</div>
              </div>

              <div class="col-12">
                <label for="yourPhone" class="form-label">Your Phone</label>
                <input type="text" name="phone" class="form-control <?php echo $valid[6]; ?>" value="<?php echo $phone; ?>" id="yourPhone" required>
                <div class="invalid-feedback">Please, enter your phone!</div>
              </div>

              <div class="col">
              <label for="yourcity" class="form-label">Your city</label>
              <select class="form-select <?php echo $valid[8]; ?>" name="city" aria-label="Default select example">
                <option selected disabled>Choose your city</option>
                <?php
                    $k = 0;
                while ($citydata[$k]["city_name"] != null) {
                  ?>
                <option  value="<?php echo $citydata[$k]["city_name"]; ?>"><?php echo $citydata[$k]["city_name"]; ?></option>
                <?php
                $k++;
                }
                ?>
                </select>
              </div>

              <div class="col-12">
                <label for="yourAddress" class="form-label">Your Address</label>
                <input name="address" class="form-control <?php echo $valid[7]; ?>" id="yourAddress"  value="<?php echo $address; ?>" required aria-label="With textarea"></textarea>
                <div class="invalid-feedback">Please, enter your Address!</div>
              </div>

              <div class="col-12">
                <button class="btn btn-primary w-100" name="submit" type="submit">Create Account</button>
              </div>
              <div class="col-12">
                <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
              </div>

              
        </form>

          </div>
        </div>


      </div>
    </div>
  </div>

</section>

</div>
</div>
</html>
