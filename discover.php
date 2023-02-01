<?php
$category = $_GET["category"];
$discover = $_GET["discover"];
$last_c=$category; //remember last category to set search (form post) 
$last_d=$discover;
//background color

switch($category){
  case ("electronics"):
    $bg_colorr = "primary";
    break;
  case ("vehicules"):
    $bg_colorr = "warning";
    break;
  case ("apparels"):
    $bg_colorr = "success";
    break;
  case ("homesales"):
    $bg_colorr = "danger";
    break;
}
//Connect to Database
$conn = mysqli_connect('localhost', 'root', '', 'buyandsell');
if (!$conn) {
  echo "error connexion" . mysqli_connect_error();
}
//item DB by category
$item_sql = "SELECT * FROM items "; // general
//by category
switch($category){
  case ("electronics"):
    $item_sql = "SELECT * FROM items WHERE category='Electronics' ";
    break;
  case ("vehicules"):
    $item_sql = "SELECT * FROM items WHERE category='Vehicules' ";
    break;
  case ("apparels"):
    $item_sql = "SELECT * FROM items WHERE category='Apparels' ";
    break;
  case ("homesales"):
    $item_sql = "SELECT * FROM items WHERE category='Home Sales' ";
    break;
}

// cities query

$cityquery = "SELECT city_name FROM cities";
$cityresult = mysqli_query($conn, $cityquery);
$citydata = mysqli_fetch_all($cityresult, MYSQLI_ASSOC); //fetching an associative table containing all emails in our DB
mysqli_free_result($cityresult);



// sql users

$id = mysqli_real_escape_string($conn,htmlspecialchars($_GET["id"])); // get (always from the URL) get the data just after ".php?id="
$idsql = "SELECT id,firstName,phone,city FROM users";

$idresult = mysqli_query($conn, $idsql);
$iddata = mysqli_fetch_all($idresult, MYSQLI_ASSOC); //fetching an associative table containing all ids
mysqli_free_result($idresult);




//filter by cities
if(isset($_POST["search"])){
  $city_choose = $_POST["city"];
  $idsql2 = "SELECT id,firstName,phone,city FROM users WHERE city='$city_choose'";
  $idresult2 = mysqli_query($conn, $idsql2);
  $iddata2 = mysqli_fetch_all($idresult2, MYSQLI_ASSOC); //fetching an associative table containing all ids
  mysqli_free_result($idresult2);
  $f=0;
  while ($iddata2[$f]["firstName"] != null) {
    $arr[] = $iddata2[$f]["id"]; // array contains id of users of the chosen city
    $f++;
  }
  $item_sql = "SELECT * FROM items WHERE id IN ('$arr')";
}

//items query

$item_result = mysqli_query($conn, $item_sql);
$item_data = mysqli_fetch_all($item_result, MYSQLI_ASSOC); //fetching an associative table containing all ids
mysqli_free_result($item_result);


?>

<!DOCTYPE html>
<head>

    <title>Discover</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-<?php 
        if($discover == 1)
        {
          echo "dark";
        }
        else{
        echo "gradient-".$bg_colorr;
        } ?> sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar Logo -->
            <a style="margin-top:20px;"class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <img src="assets/img/logowhite.png" alt="logo" width="200">
            </a>
            <form  method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?category=<?php echo $last_c; ?>&discover=<?php echo $last_d ;?>" >
            <!-- Divider -->
            <div class="sidebar-heading" style="margin-top: 30px;">
                City
            </div>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading d-flex justify-content-center mt-2 mb-2">
            <select class="form-select <?php echo $valid[8]; ?>" name="city" aria-label="Default select example">
                <option selected disabled>Choose</option>
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

            <div class="sidebar-heading">
                Price
            </div>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading d-flex justify-content-center mt-2 mb-2">
             
            </div>

            <div class="text-center d-none d-md-inline">

            
            <button type="submit" name="search" class="mt-4 ml-5  btn btn-<?php echo $bg_colorr; ?>"> Search</button>
            
            </div>
            </form>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
        <!-- header -->
        <?php include 'header.php';?>
        <!-- End of header -->
        <!-- Main Content -->

<?php
$m=0;
while ($item_data[$m]["title"] != null ) {
  //color choice
  switch($item_data[$m]["category"]){
    case ("Electronics"):
      $colorr = "primary";
      break;
    case ("Vehicules"):
      $colorr = "warning";
      break;
    case ("Apparels"):
      $colorr = "success";
      break;
    case ("Home Sales"):
      $colorr = "danger";
      break;
  }
  echo $iddata[$p]["city"];
  ?>






<!-- BEGIN One card -->
<div class="col-xl-9 col-md-6 mb-4 ">
  <div class="card border-left-<?php echo $colorr; ?> complexclass" style="margin-left:20px; padding-left:3px">
        <div class="row align-items-center">
            <div class="col-2">
            <img  src="assets/img/test7.jpg" alt="imgthumbnail" class="img-thumbnail2">
          </div>
          <div class="col-sm">
            <div class=" h5 fw-bold text-<?php echo $colorr; ?> text-uppercase mb-1 ">&nbsp;&nbsp;&nbsp;<?php echo $item_data[$m]["title"]; ?></div>
            <div class="fst-italic fs-9 mb-0 font-weight-lighter text-gray-800">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <!-- user name phone and city show bbased on id and item -->
              <?php
                $p=0;
                while ($iddata[$p]["firstName"] != null) {
                  if ($iddata[$p]["id"] == $item_data[$m]["id"] ) {
                    echo $iddata[$p]["firstName"] . " , " . $iddata[$p]["phone"] . " , " . $iddata[$p]["city"];
                  }
                
                  $p++;
               
              }
                  ?>
            </div>
          </div>
          <div class="col-2">
          <i class="fas fa-comments font-weight-bold fa-2x fs-5 text-gray-700"><?php echo $item_data[$m]["price"]." MAD"; ?></i>
          </div>
          
          </div>
  </div>
</div>
<!-- END One card -->


<?php
    $m++;
}


?>











        <!-- End of Content Wrapper -->
    </div>
    </div>
    </div>
</body>



