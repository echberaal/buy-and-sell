<?php
$wishlist="0";

//Connect to Database
$conn = mysqli_connect('localhost', 'root', '', 'buyandsell');
if (!$conn) {
  echo "error connexion" . mysqli_connect_error();
}
// sql users
$id = mysqli_real_escape_string($conn,htmlspecialchars($_GET["id"])); // get (always from the URL) get the data just after ".php?id="
$idsql = "SELECT * FROM users WHERE id=$id";
$idresult = mysqli_query($conn, $idsql);
$iddata = mysqli_fetch_all($idresult, MYSQLI_ASSOC); //fetching an associative table containing all ids
mysqli_free_result($idresult);

$firstName = $iddata[0]["firstName"];
$lastname = $iddata[0]["lastName"];
$birth = $iddata[0]["birth"];
$gender = $iddata[0]["gender"];
$phone = $iddata[0]["phone"];
$email = $iddata[0]["email"];
$address = $iddata[0]["adddress"];
$city = $iddata[0]["city"];
$id = $iddata[0]["id"];
session_start();
$_SESSION["id"] = $id;
// sql items selection only user's items where id = id
$item_sql = "SELECT * FROM items WHERE id=$id";
$item_result = mysqli_query($conn, $item_sql);
$item_data = mysqli_fetch_all($item_result, MYSQLI_ASSOC); //fetching an associative table containing all ids
mysqli_free_result($item_result);
//count element
$m=0;
$item_counter = 0;
while ($item_data[$m]["title"] != null) { // we repeat it for all rows
    $item_counter++;
    $m++;
}
//delete
if(isset($_POST["delete_btn"])){
    $idDelete = $_POST["delete_id"];
    $delete_sql = "DELETE FROM items WHERE item_id='$idDelete' ";
    if(mysqli_query($conn,$delete_sql)){
      header("Location: dashboard.php?id=$id");
    }
}
//edit
if (isset($_POST["edit_btn"])) {
    $idEdit = $_POST["edit_id"];
    header("Location: edit_item.php?id=$idEdit");
}
?>


<!doctype html>
<html lang="en">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
                
<title>Dashboard</title>
<?php

include 'header.php';?>

<div class="container">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Active Phone -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Active phone</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $phone; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Default location -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Default location</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $city; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-3x text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
</svg></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- total items -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">total items
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $item_counter; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
</svg></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Wishlist</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $wishlist; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


<div class="card shadow mb-4">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Your items 
            
    </h6>
  </div>

  <div class="card-body">
    <div class="table-responsive ">

      <table class="table table-borderedn" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> item ID </th>
            <th> Title </th>
            <th>Price </th>
            <th>Category</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php
        $m=0;
        while ($item_data[$m]["title"] != null) { // we repeat it for all rows
        ?>
             <tr>

                    <td> <?php echo $item_data[$m]["item_id"]; ?> </td>
                    <td> <?php echo $item_data[$m]["title"]; ?></td>
                    <td> <?php echo $item_data[$m]["price"]." MAD"; ?></td>
                    <td> <?php echo $item_data[$m]["category"]; ?> </td>


            <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $item_data[$m]["item_id"]; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $item_data[$m]["item_id"]; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
        <?php
        $m++;
        }
        ?>
        
        </tbody>
      </table>

  </div>

</div>
</div>


<div>
<div class="row">

<!-- Area Chart -->
<div class="col-xl-7 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Your personal information</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            
                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold ">First Name</div>
                    <div class="col-lg-9 col-md-8 "><?php echo $firstName ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">Last name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $lastname ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">Birth Date</div>
                    <div class="col-lg-9 col-md-8xs"><?php echo $birth ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $gender ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">E-mail</div>
                    <div class="col-lg-9 col-md-8"><?php echo $email ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $phone ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $address ; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 mb-3 label fw-bold">City</div>
                    <div class="col-lg-9 col-md-8"><?php echo $city ; ?></div>
                  </div>

        </div>
    </div>
</div>

<!-- Area Chart -->
<div class="col-xl-5 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Your favourite list</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                
            </div>
        </div>
    </div>
</div>

</div>


</div>
</div>
</html>
