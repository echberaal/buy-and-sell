<?php
session_start();
$firstname = $_SESSION["firstname"];



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
      <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex justify-content-center py-4">
          <a href="index.php" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/logo.png" alt="logo" width="150">
          </a>
        </div>

        <div class="card shadow flex-row mb-6">

            <div class="card-body">
            <div style="width: 400px;" class="p-4">
                    <div class="text-center">
                        <h1 class="fs-3 mb-2 text-gray-900 fw-lighter mb-4">Welcome <?php echo $firstname; ?>!</h1>
                        <img style="padding-top:30px" width="340px" src="assets/img/regist.png" >
                        
                        <a href="login.php" class="btn btn-light btn-icon-split" style="margin-top: 130px;">
                                <span class="icon text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                                        </span>
                                        <span class="text">Log in</span>
                                    </a>
                    </div>
             </div>
            </div> 
            
            <img style="object-fit: cover; max-width: 400px; height: 590px;" src="assets/img/successgif.gif">
            
        </div>


            
        </div>


       
</section>

</div>
</div>
</html>