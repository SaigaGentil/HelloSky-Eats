<?php
require_once('connection_script.php');
require_once('lib/database.php');

$database = new Database();

$by = $_POST['type'];
$searchq = $_POST['search'];
$where[$by]="LIKE '%".$searchq."%'";
$results = $database->getRows("restoview", "*", $where);

$hotels = $database->getRows("restoview");
$hotels2 = $database->getRows ("image");
$set = $database->getRows("sitereview");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HS Restos Search Results</title>

  <!-- Font Awesome Icons -->
 <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="http://localhost/Restaurants/Index.php">HelloSky Restos</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
        </ul>
      </div>
    </div>
    
    <div class="collapse navbar-collapse" id="navbarResponsive">
    <form action="Search_results.php" method="post" class="form-inline ml-auto"> 
    <input type="text" name="search" placeholder="Search Restaurants faster"/>
    <font color="black" size="3">Search by: </font>
            <select class="form-control" id="exampleFormControlSelect1" name="type" required>
              <option value="Name" >Name</option>
              <option value="CityName" >City</option>
            </select>
    <input type="submit" value="Search" />
    </form> 
    <a href= "http://localhost/Restaurants/Login.php" class="btn btn-outline-success"> Login</a>
     </div>    
  </nav>

  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Hi There! You are in for a good treat</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">We help you find a suitable restaurant for you and your loved ones</p>
        </div>
      </div>
    </div>
  </header>
  <section class="page-section" id="services">
   <div class="container">
         <h2 class="text-center mt-0">Search results</h2>
         <hr class="divider my-4">
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
                <th scope="col">Web Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
                foreach($results as $result) {
                    $count++;
            ?>
            <tr>
                <td><?php echo $count?></td>
                <td><?php echo $result['Name']; ?></td>
                <td><?php echo $result['Description']; ?> </td>
                <td><?php echo $result['Address']; ?></td>
                <td><?php echo $result['Contact_Number']; ?></td>
                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $result['Restaurant_ID']; ?>">View details</button> </td>
            </tr>
            
            <div class="modal fade bd-example" id="myModal<?php echo $result['Restaurant_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $result['Name']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="card mb-3">
  <img class="card-img-top" src="uploads/<?php echo $result['File_Name']; ?>" image alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Description: <?php echo $result['Description']; ?></p>
    <p class="card-text">Address: <?php echo $result['Address']; ?></p>
    <p class="card-text">Phone: <?php echo $result['Contact_Number']; ?></p>
    <p class="card-text"><small class="text-muted"><?php echo "Last modified on " . date ("F d Y H:i:s.", getlastmod()); ?></small></p>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            <?php
                        }
            ?>
        </tbody>
    </table>

                  
              </div>
          </div>
      </div>
  </section>
  
  <!-- Reviews section -->
 
  <section class="page-section" id="reviews">
   <div class="container">
         <h2 class="text-center mt-0">What people say about us</h2>
         <hr class="divider my-4">
         <div class="card-columns">
           <?php 
    $count = 0;
    foreach($set as $output) {
        $count++;
        
        if ($output['Following_Ratings'] == 'Excellent') 
        {
            $output['Following_Ratings'] = '★★★★★';
        } elseif ($output['Following_Ratings'] == 'Very Good') 
        {
            $output['Following_Ratings'] = '★★★★☆';
        }elseif ($output['Following_Ratings'] == 'Good')
        {
            $output['Following_Ratings'] = '★★★☆☆';
        }elseif ($output['Following_Ratings'] == 'Acceptable')
        {
            $output['Following_Ratings'] = '★★☆☆☆';
        }elseif ($output['Following_Ratings'] == 'Bad')
        {
            $output['Following_Ratings'] = '★☆☆☆☆';
        }
    ?>
          <div class="card p-3">
    <blockquote class="blockquote mb-0 card-body">
      <p><?php echo $output['Comment']; ?></p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          By <cite title="Source Title"><?php echo $output['Reviewer_Name'];?></cite>
        </small>
        <p><?php echo $output['Following_Ratings']; ?></p>
      </footer>
    </blockquote>
  </div>
       <?php
    }
    ?>
      </div>
      </div>
  </section> 
  
  <!--Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">What's your opinion on us</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Feel free to tell us your experience with us, to help us serve you better</p>
        </div>
      </div>
      <form method="post" action="AddReview_Script.php">
          <!-- Review form -->
          <div class="form-group">
              <label for="examplename">Name</label>
              <input class="form-control" id="exampleReviewerName" required="" type="text" placeholder="Your names" name="exampleReviewerName">
          </div>
          <div class="form-group">
              <label for="exapleFormControlTextarea1">Review</label>
              <textarea class="form-control" id"exampleFormControlReview" required="" rows="3" name="exampleFormControlReview"></textarea>
          </div>
          
          <!-- Rating buttons -->
          <div class="form-group">
             <div class ="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="Rating" id="6Rating" value="Excellent">
             <label class="form-check-label" for="6Rating">Excellent</label>
             </div>
             
             <div class ="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="Rating" id="5Rating" value="Very Good">
             <label class="form-check-label" for="5Rating">Very Good</label>
             </div>
             
             <div class ="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="Rating" id="4Rating" value="Good">
             <label class="form-check-label" for="4Rating">Good</label>
             </div>
             
             <div class ="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="Rating" id="3Rating" value="Acceptable">
             <label class="form-check-label" for="3Rating">Acceptable</label>
             </div>
             
             <div class ="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="Rating" id="2Rating" value="Bad">
             <label class="form-check-label" for="2Rating">Bad</label>
             </div>
             
             <div class ="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="Rating" id="1Rating" value="Very Bad">
             <label class="form-check-label" for="1Rating">Very bad</label>
             </div>
              <small class="form-text text-muted" id="emailHelp">Please rate you experience with us</small>
          </div>
          <input class="btn btn-primary" type="submit" value = "Submit" >
      </form>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>00250788430000</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in anchor text AND the link below! -->
          <a class="d-block" href="mailto:contact.HSEats@hellosky.com">Send us an email</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2019 - HelloSky Developers</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

</body>

</html>
