<?php
    include 'classes/Conn.php';
    include 'classes/User.php';
    include 'includes/func.inc.php';

    open_session();

    $connection = new Conn('localhost', 'root', '', 'auto_salon');
    $connection->connect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
                <a class="nav-home-item nav-item nav-link active font-weight-bolder" href="http://localhost/auto-salon%20di%20Ale%20e%20Vi/index.php"><!-- inserire l'href alla home -->
                    <label for="nav" class="nav-label">Home</label>
                </a>
                <a class="nav-cars-item nav-item nav-link hvr-sweep-to-top disabled" href="#insert-car">
                    <label for="nav" class="nav-label">Enter ad</label><!-- inserire l'href che porta a inserimento annunci -->
                </a>
            </div>
        </div>
    </nav>
<!--/ Navbar -->

<!-- Register Form -->
    <div class="container register-container" style="margin: 60px auto 80px;">
        <form action="" method="POST">
            <h2 class="text-uppercase text-center">Sign In</h2>
            <div class="input-area-register">
                <div class="input">
                    <label for="car-model" class="mb-2">Username:</label>
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon-space">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="JohnDoe10">
                    </div>
                </div>

                <div class="input">
                    <label for="car-brand" class="mb-2">First Name:</label>
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon-space">
                            <i class="fas fa-user-alt prefix grey-text"></i>
                        </div>
                        <input type="text" name="first_name" class="form-control" placeholder="John">
                    </div>
                </div>

                <div class="input">
                    <label for="car-brand" class="mb-2">Last Name:</label>
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon-space">
                            <i class="fas fa-user-alt prefix grey-text"></i>
                        </div>
                        <input type="text" name="last_name" class="form-control" placeholder="Doe">
                    </div>
                </div>

                <div class="input">
                    <label for="car-brand" class="mb-2">Email:</label>
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon-space">
                            <i class="fas fa-envelope prefix grey-text"></i>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="JohnDoe10@gmail.com">
                    </div>
                </div>
                
                <div class="input">
                    <label for="car-model" class="mb-2">Password:</label>
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon-space">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Your Password">
                    </div>
                </div>

                <div class="input">
                    <label for="car-model" class="mb-2">Confirm Your Password:</label>
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon-space">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="password" name="password-confirm" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
                <!-- UNA VOLTA REGISTRATO L'UTENTE DEVE ESSERE AUTO LOGGATO -->
                <button type="submit" name="register" class="btn btn-grad btn-file">Register</button>
                <?php
                    if(isset($_POST['register'])) {
            
                        if(!empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['first_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

                            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                echo "<div class='alert alert-danger input mt-0 text-center' role='alert'>
                                        Invalid Email Format
                                    </div>";
                            } else { //Se la mail è valida

                                if($_POST['password'] === $_POST['password-confirm']) { //Se le pw coincidono

                                    $new_user = new User($_POST['username'], $_POST['email'], $_POST['password'], $_POST['first_name'], $_POST['last_name']); //restituisce il nuovo oggetto user
                        
                                    $user = $connection->insert_user('users', $new_user); //restituisce true o false

                                } else {
                                    echo "<div class='alert alert-danger input mt-0 text-center' role='alert'>
                                            Passwords not matching
                                        </div>";
                                }
                            }

                        } else {
                            echo "<div class='alert alert-danger input mt-0 text-center' role='alert'>
                                    Take a look, some fields are empty!
                                </div>";
                        }
                    }
                ?>
            </div>
        </form>
    </div>
<!-- Register Form -->

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