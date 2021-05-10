<?php
    include 'classes/Conn.php';
    include 'classes/Car.php';

    open_session();

    $connection = new Conn('localhost', 'root', '', 'auto_salon'); //connection contiene la connessione al db
    $connection->connect();

    $cars = $connection->select_cars('all_cars');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Cars</title>
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
                        echo "<form action='' method='POST' class='d-flex flex-row justify-content-center align-items-center logout-input logout-input-color'>
                                <input class='nav-cars-item nav-item nav-link btn text-uppercase h-100 logout-input' type='submit' name='submit_out' value='Logout'>
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
<!-- / Navbar -->

<!-- car cards -->
    <div class="container-fluid" style="margin: 90px auto 50px;">
        <div class="card-container d-flex flex-wrap">
            <?php
                foreach($cars as $c => $car) {

                    echo "<div class='ale-card hvr-grow mx-4 mb-5' id='ale-card'>
                            <div class='image' style='width: 100%; height: 150px;'>
                                <img src='{$car['image']}' alt='' class='w-100 h-100'>
                            </div>
                            <div class='description'>
                                <h4 class='car-price' style='font-size: 1.8rem;'>{$car['price']}€</h4>
                                <h2 class='mb-0 mx-3 mt-2'>{$car['brand']}</h2>
                                <h3 class='mb-0 mx-3 mb-2'>{$car['model']}</h3>
                                <div class='car-info d-flex my-3'>
                                    <div class='col-6 ml-3'>
                                        <div>{$car['fuel']}</div>
                                        <div>{$car['engine_displacement']}cm³</div>
                                    </div>
                                    <div class='col-6 mr-3'>
                                        <div>{$car['kilometers']}km</div> 
                                        <div>{$car['registration_date']}</div>
                                    </div>
                                </div>
                                <a class='btn btn-grad more-info-btn w-100' href='http://localhost/auto-salon%20di%20Ale%20e%20Vi/single_car_page.php?id={$car['id']}'>More info</a>
                            </div>
                        </div>";
                }
            ?>
        </div>
    </div>
<!-- / car cards -->

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

</body>
</html>