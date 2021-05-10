<?php 

    include 'classes/Conn.php';
    include 'classes/Car.php';
    include 'includes/func.inc.php';

    open_session();

    $connection = new Conn('localhost', 'root', '', 'auto_salon'); //connection contiene la connessione al db
    $connection->connect(); //attraverso $connection è possibile utilizzare tutte le funzioni al suo interno

    $id = $_GET['id'];

    $car_id = $connection->select_id_cars($id, 'all_cars');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Ad</title>
    <link rel="stylesheet" href="assets/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Chivo', sans-serif;">

    <div class="pre-container mt-0" id="home">
        <div class="logo">
            <img src="assets/images/logo.PNG" alt="logo" style="height: 80px;">
        </div>
        <div class="infos">
            <div class="d-flex align-items-center justify-content-center">
                <label for="">0831 66 59 95</label>
                <i class="fas fa-phone-square mx-2"></i>
            </div>
            <div class="d-flex mt-3">
                <ul class="list-unstyled d-flex flex-column align-items-end">
                    <li>
                        <label for="New York">London, England</label>
                        <span><i class="fas fa-map-marker-alt mx-2"></i></span>
                    </li>
                    <li>
                        <label for="Milan">Milan, Italy</label>
                        <span><i class="fas fa-map-marker-alt mx-2"></i></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="height: 50px; background-color: rgba(0,0,0,0.1); font-family: 'Syne', sans-serif;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse h-100" id="navbarResponsive" style="padding-right: 150px;">
            <div class="social-box d-flex">
                <a href="https://www.facebook.com/" class="mx-3">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="https://www.instagram.com/" class="mx-3">
                    <i class="fab fa-instagram-square"></i>
                </a>
                <a href="https://www.whatsapp.com/?lang=en" class="mx-3">
                    <i class="fab fa-whatsapp-square"></i>
                </a>
            </div>
            <div class="navbar-nav ml-auto text-uppercase h-100">
                <a class="nav-home-item nav-item nav-link active font-weight-bolder" href="http://localhost/auto-salon%20di%20Ale%20e%20Vi/index.php">
                    <label for="nav" class="nav-label">Home</label>
                </a>

                    <?php 
                    if(is_auth()) {
                        echo "<form action='' method='POST' class='d-flex flex-row justify-content-center align-items-center logout-input-color'>
                                <input class='nav-cars-item nav-item nav-link btn hvr-sweep-to-top text-uppercase h-100' type='submit' name='submit_out' value='Logout'>
                                </input>
                            </form>";

                        if(isset($_POST['submit_out'])) {
                            logout();
                            header('Location: http://localhost/auto-salon%20di%20Ale%20e%20Vi/login.php');
                        }

                    } else {
                        echo "<a class='nav-login nav-item nav-link hvr-sweep-to-top' href='http://localhost/auto-salon%20di%20Ale%20e%20Vi/login.php'>
                                <label for='nav' class='btn' >Sign In</label> 
                            </a>";
                    }
                    
                ?>
                
            </div>
        </div>
    </nav>
<!--/ Navbar -->

<!-- Photo Gallery -->
    <div class="container single-car-container mb-4 d-flex flex-row justify-content-center align-items-center" style="margin-top: 80px;">
        <div class="single-car-photo mx-3 h-100" style="width: 900px;">
            <!-- carousel CREARE TABELLA IN CUI INSERIRE PIù FOTO DELLE MACCHINE-->
            <div id="carouselExampleIndicators" class="carousel slide h-100" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                        <img class="d-block w-100 h-100" src="<?php echo $car_id['image'] ?>" alt="First slide">
                    </div>
                    <div class="carousel-item h-100">
                        <img class="d-block w-100 h-100" src="<?php echo $car_id['image'] ?>" alt="Second slide">
                    </div>
                    <div class="carousel-item  h-100">
                        <img class="d-block w-100 h-100" src="<?php echo $car_id['image'] ?>" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- / carousel -->
        </div>
        <div class="single-car-info h-100 d-flex flex-column justify-content-between">
            <div>
                <h1><?php echo $car_id['brand'] . ' ' . $car_id['model'] ?></h1>
                <h3 class='car-price my-3'><?php echo $car_id['price'] ?>€</h3>
                <p class="mt-3" style="font-size: 18px;"><?php echo $car_id['description'] ?></p>
            </div>
            <div>
                <a href="#footer">
                    <button class="btn btn-success w-100">Contacts for info in footer</button>
                </a>
            </div>
        </div>
    </div>
<!--/ Photo Gallery -->

<!-- car info -->
    <div class="container d-flex flex-row justify-content-center align-items-center"  style="margin-bottom: 80px;">
        <div class="car-features d-flex flex-row justify-content-around align-items-center w-100" style="margin: 0 15px 0; height: 100px;">
            <div class="conditions d-flex flex-column align-items-center">
                <h5 class="mb-1">Conditions:</h5>
                <i class="fas fa-hand-sparkles"></i>
                <label for="km"><?php echo $car_id['conditions'] ?></label>
            </div>
            <div class="fuel d-flex flex-column align-items-center">
                <h5 class="mb-1">Fuel: </h5>
                <span><i class="fas fa-gas-pump"></i></span>
                <label for="fuel"><?php echo $car_id['fuel'] ?></label>
            </div>
            <div class="engine d-flex flex-column align-items-center">
                <h5 class="mb-1">Engine CV: </h5>
                <span><i class="fas fa-bolt"></i></span>
                <label for="cv"><?php echo $car_id['car_CV'] ?>CV</label>
            </div>
            <div class="engine d-flex flex-column align-items-center">
                <h5 class="mb-1">Engine: </h5>
                <span><i class="fab fa-searchengin"></i></span>
                <label for="cv"><?php echo $car_id['engine_displacement'] ?>cm³</label>
            </div>
            <div class="kilometers d-flex flex-column align-items-center">
                <h5 class="mb-1">Kilometers:</h5>
                <span><i class="fas fa-road"></i></span>
                <label for="km"><?php echo $car_id['kilometers'] ?>Km</label>
            </div>
            <div class="date d-flex flex-column align-items-center">
                <h5 class="mb-1">Registration Date:</h5>
                <span><i class="far fa-calendar-alt"></i></span>
                <label for="date"><?php echo $car_id['registration_date'] ?></label>
            </div>
        </div>
    </div>
<!-- / car info -->

<!-- footer -->
    <footer id="footer" class="bg-info text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacts</h5>
                    <h6>Free Customer Care: 800 500 900</h6>
                    <h6>Customer Care for a fee: 0831 66 59 95</h6>
                    <p>Available 7 days a week from 09:00 to 18:00</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Talking About Us:</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-white">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 2</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">We Are Here:</h5>

                    <ul class="list-unstyled">
                        <li>
                            <label for="registered office">Registered Office:</label>
                            <a href="https://www.google.it/maps/place/Milano+MI/@45.4627124,9.1076924,12z/data=!3m1!4b1!4m5!3m4!1s0x4786c1493f1275e7:0x3cffcd13c6740e8d!8m2!3d45.4642035!4d9.189982" class="text-white">Milan, Italy</a>
                        </li>
                        <li>
                            <a href="https://www.google.it/maps/place/Londra,+Regno+Unito/@51.5285582,-0.2416812,11z/data=!3m1!4b1!4m5!3m4!1s0x47d8a00baf21de75:0x52963a5addd52a99!8m2!3d51.5073509!4d-0.1277583" class="text-white">London, England</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<!-- / footer -->


    <script src="assets/JqueryDownl/jquery-3.5.1.js"></script>
    <script src="assets/js/scroll_spy.js"></script>
    <script src="assets/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
    
</body>
</html>