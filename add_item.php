<?php
session_start();
$id = $_SESSION["id"];
//Connect to Database
  $conn = mysqli_connect('localhost', 'root', '', 'buyandsell'); //connecting to DataBase
  if (!$conn) {
    echo "error connexion" . mysqli_connect_error();
  }

$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST["title"])); // make it ready for sql queries and avoit special characters for more security
$category = mysqli_real_escape_string($conn,htmlspecialchars($_POST["category"]));
$price = mysqli_real_escape_string($conn,htmlspecialchars($_POST["price"]));

//errors
$i=1;
$errors = array($title,$category,$price); // array contains all attributes 
if (isset($_POST["submit"])) {
  foreach ($errors as $error) { //for each attribute, we test if it empty or not
    if (!empty($error))
      $valid[$i] = "is-valid";
    else
      $valid[$i] = "is-invalid";
    $i++;
  }
}
$check = 1;
foreach($valid as $va){
  if ($va == "is-invalid"){
    $check = 0;
    break;
  }
}
//if the form is checked 
if (isset($_POST["submit"]) && $check == 1 ) { // if there is NO error (INCLUDING EMAIL)
  //check if this email is already used
  $sql_item = "INSERT INTO items (id,title,price,category) VALUES ('$id','$title', '$price','$category')";
  $result = mysqli_query($conn, $sql_item); //inserting to DB

  if($result){
    //success
    header("Location: dashboard.php?id=$id");

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
<title>Buy and Sell</title>
<?php include 'header.php';?>

<div class="container">

<section class="section register min-vh-300 d-flex flex-column align-items-center justify-content-center py-1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-6 d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex justify-content-center py-4">
          <a href="index.php" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/logo.png" alt="logo" width="150">
          </a>
        </div>

        <div class="card mb-3">

          <div class="card-body shadow">
            <div class="pt-4 pb-2">
              <h5 class="text-success fw-bolder card-title text-center pb-0 fs-4">Add an item</h5>
              <p class="fw-light text-center small">Enter your items details</p>
            </div>

        <form class="row g-3  needs-validation" novalidate method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
              <div class="col-12">
                <label for="yourtitle" class="form-label">Title</label>
                <input type="text" name="title" class="form-control <?php echo $valid[0]; ?>" value="<?php echo $title; ?>" id="yourtitle" required>
                <div class="invalid-feedback">Please enter the title!</div>
              </div>
              <div class="row g-3">
              
              

          <div class="col">
              <label for="yourGender" class="form-label">Category</label>
                <select class="form-select" name="category" aria-label="Default select example">
                <option  selected disabled >Choose</option>
                <option  value="Electronics">Electronics</option>
                <option  value="Vehicules">Vehicules</option>
                <option  value="Apparels">Apparels</option>
                <option  value="Home Sales">Home Sales</option>
                </select>
              </div>

          <div class="col">
                  <label for="yourPrice" class="form-label">Image</label>
                  <div class="input-group mb-3">
            
                  <input type="file" class="form-control" id="inputGroupFile02">
                    </div>   
                      </div>


          <div class="col">
                <label for="yourPrice" class="form-label">Price</label>
                <input type="number" name="price" class="form-control <?php echo $valid[3]; ?>" value="<?php echo $price; ?>" id="yourPrice" required>
                <div class="invalid-feedback">Please, enter the price!</div>
              </div>


         
              <div class="col-12">
                <button class="btn btn-success w-100" name="submit" type="submit">Add</button>
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
