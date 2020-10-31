<?php
   // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
   
    require_once('lib/database.php');
    $database = new Database();

    $hotels = $database->getRows("restaurant");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>HelloSky Eats - Admin portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
</head>

<body>

    <!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                	<span class="glyphicon"></span> 
                	HelloSky Restos
                </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="http://localhost/Restaurants/Index.php" target ="_blank">View end-user website</a>
                    </li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage users<span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="about-us">
							<li><a href="#">Modify users</a></li>
							<li><a href="#">Add administrator</a></li>
							<li><a href="#">Add Normal user</a></li>
						</ul>		
					</li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                    <li><a href= "http://localhost/Restaurants/logout.php" class="btn btn-outline-danger focus"> Logout </a></li>   
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

	<!-- Header -->
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>HelloSky Restos Administrator portal</h1>
                <p>continuously finding you the best restaurants around</p>
                <!--<a href="#" class="btn btn-primary btn-lg">Engage Now</a>-->
            </div>
        </div>
    </header>
    
	<!-- Content 1 -->
    <section class="content">
        <div class="container">
          <div class="row">
              <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Address</th>
                <th scope="col">Contact No.</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
           
            <?php
            $count = 0;
                foreach($hotels as &$restaurant_final) {
                    $count++;
            ?>
            <tr>
                <td><?php echo $count?></td>
                <td><?php echo $restaurant_final['Name'];?></td>
                <td><?php echo $restaurant_final['Description']; ?> </td>
                <td><?php echo $restaurant_final['Address']; ?></td>
                <td><?php echo $restaurant_final['Contact_Number']; ?></td>
                <td>
                <a href= "<?php echo $restaurant_final['Website_Address']; ?>?id=" class="btn btn-info" target ="_blank"> Visit the website</a>
                <a href="Edit_restaurant.php?id=<?php echo $restaurant_final['Restaurant_ID'];?>" class="btn btn-warning">Edit</a>
                <a href="Delete_Resto script.php?id=<?php echo $restaurant_final['Restaurant_ID'];?>" class="btn btn-danger">Delete</a> 
                </td>
            </tr>
            <?php
                }
            ?>
            
        </tbody>
    </table>     
              </div> 
          </div>
          <a class="btn btn-primary btn-lg" href="http://localhost/restaurants/addrestaurant.php" >Add Restaurant</a>
      </div>
    </section>

    
	<!-- Footer -->
    <footer class="page-footer">
    
    	<!-- Contact Us -->
        <div class="contact" id="contact">
        	<div class="container">
				<h2 class="section-heading">Contact Us</h2>
				<p><span class="glyphicon glyphicon-earphone"></span><br> 00250788430000</p>
				<p><span class="glyphicon glyphicon-envelope"></span><br> contact.HSEats@hellosky.com</p>
        	</div>
        </div>
        	
        <!-- Copyright etc -->
        <div class="small-print">
        	<div class="container">
        		<p>Copyright &copy; 2019 - HelloSky Developers</p>
        	</div>
        </div>
        
    </footer>

    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>

</body>

</html>
