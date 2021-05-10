<?php
    include 'classes/Conn.php';
    include 'classes/Car.php';
    include 'classes/User.php';
    include 'includes/func.inc.php';

    open_session();

    $connection = new Conn('localhost', 'root', '', 'auto_salon'); //connection contiene la connessione al db
    $connection->connect();

    $cars = $connection->select_cars('all_cars');

    $users = $connection->select_users('users');

    $error = '';
?>

<?php //SISTEMARE LA VALIDAZIONE DELLE IMMAGINI E INSERIRLE NELLE GALLERIE DELLE SINGLE PAGE CAR
    //SISTEMARE LE EDIT NELLA PAGINA DELLO USER SINGOLO
    //INSERIRE L'AUTOLOGIN UNA VOLTA CHE UN UTENTE SI è REGISTRATO
    

    /* if(isset($_FILES['file'])) { //TESTARE VALIDAZIONE
        //print_debug($_FILES['file']['name'][0]);
        //print_debug($_FILES['file']);
        $file_name = $_FILES['file']['name'][0];
        $file_tmp = $_FILES['file']['tmp_name'][0];
        $file_size = $_FILES['file']['size'][0];

        $my_array = array_values($_FILES['file']);

        for($i = 0; $i < count($my_array); $i++) {
            for($j = 0; $j < count($my_array[$i]); $j++){
                print_debug($my_array[$i][$j]);
            }
            
        }
        
        echo count($my_array);
        echo count($my_array[0]);
        for($i=0; $i < count($my_array); $i++) {
            for ($j=0; $j< count($my_array[$i]); $j++) {
                $image = image_upload($my_array[$i][$j]);
            }
        }
    } */

    if(!empty($_POST['license_plate']) && !empty($_POST['model']) && !empty($_POST['brand']) && !empty($_POST['description']) && !empty($_POST['conditions'])
        && !empty($_POST['registration']) && !empty($_POST['price']) && !empty($_POST['kilometers']) && !empty($_POST['car_CV']) && !empty($_POST['engine_displacement']) && !empty($_POST['fuel'])) {

        $license_plate = $_POST['license_plate'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $description = $_POST['description'];
        $conditions = $_POST['conditions'];
        $car_registration_date = $_POST['registration'];
        $price = $_POST['price'];
        $kilometers = $_POST['kilometers'];
        $car_CV = $_POST['car_CV'];
        $engine_displacement = $_POST['engine_displacement'];
        $fuel = $_POST['fuel'];

        if(isset($_FILES['file'])) { //TESTARE VALIDAZIONE
            $image = $_FILES['file'];
            $image = image_upload();
        }
        
        $my_car = new Car($license_plate, $brand, $model, $description, $conditions, $car_registration_date, $image, $price, $kilometers, $car_CV, $engine_displacement, $fuel);
        //my_car è istanza di Car e contiene tutte le sue proprietà, a cui assegna dei valori presi da $_POST
        $result = $connection->insert_car_in_db('all_cars', $my_car);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Salon</title>
    <link rel="stylesheet" href="assets/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#navbarResponsive" style="font-family: 'Chivo', sans-serif;">

    <div class="pre-container" id="home">
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

<!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="height: 50px; background-color: rgba(0,0,0,0.1); font-family: 'Syne', sans-serif;">
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
                <a class="nav-home-item nav-item nav-link active font-weight-bolder" href="#home">
                    <label for="nav" class="nav-label">Home</label>
                </a>
                <a class="nav-cars-item nav-item nav-link hvr-sweep-to-top" href="#insert-car">
                    <label for="nav" class="nav-label">Enter ad</label>
                </a>
                <a class="nav-contact-item nav-item nav-link hvr-sweep-to-top" href="#footer">
                    <label for="nav" class="nav-label">Contacts</label>
                </a>
                
                    <?php
                        if(!is_auth()) {
                            echo "<a class='nav-login nav-item nav-link hvr-sweep-to-top' href='http://localhost/auto-salon%20di%20Ale%20e%20Vi/login.php'>
                                    <label for='nav' class='btn' >Sign In</label> 
                                </a>";
                        } else if(is_auth()) {
                            echo "<a class='nav-contact-item nav-item nav-link hvr-sweep-to-top' href='http://localhost/auto-salon%20di%20Ale%20e%20Vi/loggedin_user.php?id={$_SESSION['user'][0]['id']}'>
                                    <label for='nav' class='nav-label'>Profile</label>
                                </a>";

                            echo "<form action='' method='POST' class='d-flex flex-row justify-content-center align-items-center logout-input-color'>
                                    <input class='nav-cars-item nav-item nav-link btn hvr-sweep-to-top text-uppercase h-100' type='submit' name='logout_submit' value='Logout'>
                                    </input>
                                </form>";

                                if(isset($_POST['logout_submit'])) {
                                    logout();
                                    header('Location: http://localhost/auto-salon%20di%20Ale%20e%20Vi/login.php');
                                }
                        }
                    ?>

            </div>
        </div>
    </nav>
<!--/.Navbar -->

<!-- Cousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 450px; width: 100%">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner h-100">
            <div class="carousel-item active">
                <img src="https://storage.googleapis.com/pneusnews-it/1/2020/08/Looking-for-Car-Dealers.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.motoringresearch.com/wp-content/uploads/2019/08/Online-reviews-vital-in-choosing-a-car-dealer.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="http://www.snowbound.com/blog/wp-content/uploads/2015/12/db347dfd06805db4fc6c30a5adc6c24fx.jpg" class="d-block w-100 " alt="...">
            </div>
            <!-- <div class="carousel-item">
                <img src="https://www.lawdonut.co.uk/sites/default/files/usedcardealer1_0.jpg" class="d-block w-100 h-100" alt="...">
            </div> -->
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
<!--/ Cousel -->

    <div class="container-fluid" style="margin-bottom: 150px;">

        <?php 
            if(is_auth()) { //c'è qualcosa che non quadra --> print_debug({$_SESSION['user'][0]['username']})
                echo "<div class='my-4'>
                        <h1>Welcome Back <?php print_debug({$_SESSION['user'][0]['username']}) ?></h1>
                    </div>";
            }
        ?>

        
        <!-- boxes info -->
        <div class="what-we-do">
            <div class="tip tip-1 hvr-grow-shadow ml-0">
                <div class="icon d-flex justify-content-center">
                    <i class="fas fa-car"></i>
                </div>
                <div class="phrase d-flex justify-content-center p-3 text-center mt-3">
                    <label for="">Here you can find the right car for you</label>
                </div>
            </div>
            <div class="tip tip-2 hvr-grow-shadow">
                <div class="icon d-flex justify-content-center">
                    <i class='fas fa-clipboard-check'></i>
                </div>
                <div class="phrase d-flex justify-content-center p-3 text-center mt-3">
                    <label for="">Each vehicle first passes by us to be checked, then it is shipped to you</label>
                </div>
            </div>
            <div class="tip tip-3 hvr-grow-shadow">
                <div class="icon d-flex justify-content-center">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="phrase d-flex justify-content-center p-3 text-center mt-3">
                    <label for="">You can rely on us to sell your used car</label>
                </div>
            </div>
            <div class="tip tip-4 hvr-grow-shadow mr-0">
                <div class="icon d-flex justify-content-center">
                    <i class="far fa-laugh"></i>
                </div>
                <div class="phrase d-flex justify-content-center p-3 text-center mt-3">
                    <label for="">Our goal is to make our customers satisfied</label>
                </div>
            </div>
        </div>
        <!--/ boxes info -->

        <!-- car preview -->
        <h1 class="text-uppercase text-center mb-4">Some of our cars</h1>
        <hr class="w-75 mx-auto mb-5" style="color: rgb(32, 103, 209);">
        <div class="card-container d-flex justify-content-between">
            <?php
                $i = 0;

                foreach($cars as $c => $car) {

                    if($i > 3) {
                        break;
                    } else {
                        echo "<div class='ale-card hvr-grow' id='ale-card'>
                                <div class='image' style='width: 100%; height: 150px;'>
                                    <img src='{$car['image']}' alt='' class='w-100 h-100'>
                                </div>
                                <div class='description'>
                                    <h4 class='car-price' style='font-size: 1.8rem;'>{$car['price']}€</h4>
                                    <h2 class='mb-0 mx-3 mt-2'>{$car['brand']}</h2>
                                    <span><i class='fas fa-clipboard-check mr-2' style='float: right; font-size: 25px; color: green; margin-top: -35px;'></i></span>
                                    <h3 class='mb-0 mx-3 mb-2'>{$car['model']}</h3>
                                    <div class='car-info d-flex my-3'>
                                        <div class='col-6 ml-3'>
                                            <div>{$car['fuel']}</div>
                                            <div>{$car['car_CV']}CV</div>
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
                    $i++;
                }
            ?>

        </div>
        
        <div class="show-all-container d-flex justify-content-center" style="margin: 60px auto 80px;">
            <button class="btn btn-outline-info text-uppercase w-50 font-weight-bold mb-5" onclick="window.open('all_car.php')">Show All Cars</button>
        </div>
        <!-- / car preview -->

        <!-- car insertion AGGIUNGERE LA CILINDRATA-->
        <form action="" method="POST" id="insert-car" class="form-class" enctype="multipart/form-data">
            <h2 class="text-uppercase text-center mb-3">Are you ready to sell your car?</h2>
            <?php 
                if(!is_auth()) {
                    echo "<div class='d-flex justify-content-center align-items-center'>
                            <h4 class='text-uppercase font-weight-lighter text-center mb-0'>we just need you to log in</h4>
                            <i class='fas fa-external-link-alt ml-3'></i>
                        </div>";
                }
            ?>
            
            <div class="input-area">
                <div class="input">
                    <label for="car-model">License plate:</label>
                    <?php
                        if(is_auth()) {
                            echo "<input type='text' name='license_plate' class='form-control' placeholder='DA346BN'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='license_plate' class='form-control' placeholder='DA346BN' disabled>";
                        }

                        if(isset($_POST['submit']) && empty($_POST['license_plate'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-brand">Brand:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='brand' class='form-control' placeholder='FIAT'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='brand' class='form-control' placeholder='FIAT' disabled>";
                        }

                        if(isset($_POST['submit']) && empty($_POST['brand'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>
                
                <div class="input">
                    <label for="car-model">Model:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='model' class='form-control' placeholder='Punto'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='model' class='form-control' placeholder='Punto' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['model'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-model">Conditions:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='conditions' class='form-control' placeholder='New/Used'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='conditions' class='form-control' placeholder='New/Used' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['conditions'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-date">Registration Date:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='registration' class='form-control' placeholder='2010-09-23'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='registration' class='form-control' placeholder='2010-09-23' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['registration'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-price">Price:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='price' class='form-control' placeholder='4.600'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='price' class='form-control' placeholder='4.600' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['price'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-km">Car kilometers:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='kilometers' class='form-control' placeholder='120.000'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='kilometers' class='form-control' placeholder='120.000' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['kilometers'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-cv">CV:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='car_CV' class='form-control' placeholder='100'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='car_CV' class='form-control' placeholder='100' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['brand'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-fuel">Fuel Type:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='fuel' class='form-control' placeholder='Diesel'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='fuel' class='form-control' placeholder='Diesel' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['fuel'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="engine_displacement">Engine:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<input type='text' name='engine_displacement' class='form-control' placeholder='1500'>";
                        } else if(!is_auth()) {
                            echo "<input type='text' name='engine_displacement' class='form-control' placeholder='1500' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['engine_displacement'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="input">
                    <label for="car-description">Description:</label>
                    <?php 
                        if(is_auth()) {
                            echo "<div class='form-group'>
                                    <textarea class='form-control' type='text'  name='description' id='exampleFormControlTextarea1 insert-car' rows='3'></textarea>
                                </div>";
                        } else if(!is_auth()) {
                            echo "<div class='form-group'>
                                    <textarea class='form-control' type='text'  name='description' id='exampleFormControlTextarea1 insert-car' rows='3' disabled></textarea>
                                </div>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['description'])) {
                            $error = "<span style='color: red; font-size: 12px'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <div class="file-upload">
                    <?php 
                        if(is_auth()) {
                            echo "<input type='file' name='file' class='input-file' multiple>";
                        } else if(!is_auth()) {
                            echo "<input type='file' name='file' class='input-file' disabled>";
                        }
                        
                        if(isset($_POST['submit']) && empty($_POST['file'])) {
                            $error = "<span style='color: red; font-size: 12px; display: flex'>Required field</span>";
                            echo $error;
                        }
                    ?>
                </div>

                <?php 
                    if(is_auth()) {
                        echo "<input type='submit' name='submit' value='Submit' class='btn btn-grad btn-file'>";
                    } else if(!is_auth()) {
                        echo "<input type='submit' name='submit' value='Submit' class='btn btn-grad btn-file' disabled>";
                    }
                ?>

            </div>
            <?php
                if(!empty($_POST)) {
                    if(empty($result)) {
                        echo "<div class='alert alert-danger' role='alert'>
                                Ops! Something gone wrong...
                            </div>";
                    } else {
                        echo "<div class='alert alert-success' role='alert'>
                                Ad inserted correctly!
                            </div>";
                    }
                }
            ?>

        </form>

        <!--/ car insertion -->

    </div>

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