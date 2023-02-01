<?php
//Connect to Database
  $conn = mysqli_connect('localhost', 'root', '', 'buyandsell');
  if (!$conn) {
    echo "error connexion" . mysqli_connect_error();
  }


$email = mysqli_real_escape_string($conn,htmlspecialchars($_POST["email"]));
$password = mysqli_real_escape_string($conn,htmlspecialchars($_POST["password"]));
//errors
$i=1;
$errors = array($email, $password);
if (isset($_POST["submit"])) {
  foreach ($errors as $error) {
    if (!empty($error)) 
      $valid[$i] = "is-valid";
    else 
      $valid[$i] = "is-invalid";
    $i++;
  }
}
//END errors + Check for no errors
$check = 1;
foreach($valid as $va){
  if ($va == "is-invalid"){
    $check = 0;
    break;
  }
}
//if the form is checked 
if (isset($_POST["submit"]) && $check == 1) {
  //fetch in the database
  $userquery = "SELECT id,email,passsword FROM users";
  $userresult = mysqli_query($conn, $userquery);
  $userdata = mysqli_fetch_all($userresult, MYSQLI_ASSOC); //fetching an associative table containing all emails in our DB
  mysqli_free_result($userresult);
  $j = 0;
  $account_connected = 0;
  while ($userdata[$j]["email"] != null) {
    if($userdata[$j]["email"]==$email && $userdata[$j]["passsword"]==$password ){
      $account_connected = 1;
      $id = $userdata[$j]["id"];
      break;
    }
    $j++;
  }
// both of 2 forms will be red is not valid if the account doesn't exist
  if ($account_connected == 0) {
    $valid[1] = $valid[2] = "is-invalid";
  }
  else{ // Connecting ... and go to  account's Dashboard
    header("Location: dashboard.php?id=$id");
  }

}
//END Database
session_start();
$_SESSION["BRIDGE_account_connected"] = $account_connected;


?>
<!doctype html>
<html lang="en">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        
<title>Login</title>
<?php include 'header.php';?>

<div class="container">

<section class="section register min-vh-300 d-flex flex-column align-items-center justify-content-center py-1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex justify-content-center py-4">
          <a href="index.php" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/logo.png" alt="logo" width="150">
          </a>
        </div>

        <div class="card mb-3">

          <div class="card-body shadow">

            <div class="pt-4 pb-2">
              <h5 class="text-primary fw-bolder card-title text-center pb-0 fs-4">Login Account</h5>
              <p class="fw-light text-center small">Enter your personal details to Login</p>
            </div>

        <form class="row g-3 needs-validation" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" novalidate>

            <div class="form-floating mb-3 col-12">
            <input type="email" name="email" class="form-control valid <?php echo $valid[1]; ?>" value="<?php echo $email; ?>" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">&nbsp;&nbsp;&nbsp;Email address</label>
            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
            </div>

            <div class="form-floating col-12">
            <input type="password" name="password" class="form-control <?php echo $valid[2]; ?>" value="<?php echo $password; ?>" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">&nbsp;&nbsp;&nbsp;Password</label>
            <div class="invalid-feedback">Please enter your password!</div>
            </div>

              <div class="text-center col-12">
                <button class="btn btn-primary w-100" name="submit" type="submit">Log in</button>
              </div>
              <div class="col-12">
                <p class="small mb-0">Don't have an account? <a href="register.php">Sign up</a></p>
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
