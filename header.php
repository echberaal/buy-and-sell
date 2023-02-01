<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        
<div id="content-wrapper" class="d-flex flex-column" style="min-width:100%;margin-top:15px;background-color:#F8F9FC">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<?php

if(end(explode("/",$_SERVER["PHP_SELF"])) != "discover.php"){
  ?>
  <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="assets/img/log.png" alt="logo" width="74.06" height="40">
      </a>
<?php
} else {
  ?>
<a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
<?php
}
?>

      

      <ul class="nav nav-pills" style="margin-right:20px">
        <li class=""><a href="discover.php?discover=1" class="nav-link active" aria-current="page">Discover</a></li>
        <?php  
          if(end(explode("/",$_SERVER["PHP_SELF"])) == "dashboard.php" || end(explode("/",$_SERVER["PHP_SELF"])) == "add_item.php" ){ ?>

            <li class=""><a href="index.php" class="nav-link ">Log out</a></li>
            
<button type="button" onclick="window.location.href='add_item.php';"  class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"></path>
                <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"></path>
                </svg>
                Add an item
        </button>
            <?php  }
          else{ ?>
            <li class=""><a href="login.php" class="nav-link">Login</a></li>
            <li class=""><a href="register.php" class="nav-link">Sign up</a></li>
            
            <?php  }
        ?>

        


        
      </ul>

      </nav>




