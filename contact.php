<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM pizzaproduct WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["code"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <title>
        Store
    </title>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Select item</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
            
    <div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <ul class="list-group border border-primary mr-10 p-5 text-center">
  <li class="list-group-item font-weight-bold">Name: Cecilia Chapman</li>
  <li class="list-group-item font-weight-bold">Address: 711-2880 Nulla St.</li>
  <li class="list-group-item font-weight-bold">PO: Mankato Mississippi 96522</li>
  <li class="list-group-item font-weight-bold">Phone: (257) 563-7401</li>
  <li class="list-group-item font-weight-bold">Email: cecilia.c@online.delivery.com</li>
</ul>
  </div>
</div>

    <div>
        <p style="font-style: italic; font-family: 'Cedarville Cursive', cursive; text-align: center; font-size: 5em; color: CornflowerBlue;">
            Love your pizza!</p>
    </div>


    <div>
        <p style="text-align: center; font-size: 150%;">Join Our 115+ Followers on Social Media</p>
    </div>
    <div>
        <p style="text-align: center; font-size: 150%;">& Share Your Pizza Love! <span style="font-size: 100%; color: CornflowerBlue;">#Pizzalove</span></p>
    </div>
    <br />
    <br />
    <br />
    <div class="d-flex justify-content-center">
        <i class="fa fa-facebook-square img-rounded img-responsive mr-2" style="font-size:48px;color:red"></i>
        <i class="fa fa-instagram img-rounded img-responsive mr-2" style="font-size:48px;color:red"></i>
        <i class="fa fa-twitter-square img-rounded img-responsive mr-2" style="font-size:48px;color:red"></i>
        <i class="fa fa-pinterest-square img-rounded img-responsive mr-2" style="font-size:48px;color:red"></i>
        <i class="fa fa-youtube-square img-rounded img-responsive mr-2" style="font-size:48px;color:red"></i>
    </div>
    <br />
    <br />
    <br />
    <div>
        <p style="text-align: center; font-size: 150%;">Looking to learn More? <span style="font-weight: bold">Call</span>, <span style="font-weight: bold">Text</span> or <span style="font-weight: bold">Email us</span>!</p>


        <p style="text-align: center; font-size: 150%;">Ready to Order? Visit <span style="font-weight: bold">PizzaPlace.com</span> or give us a call.</p>
    </div>
    <br />
    <br />
    <br />

    <div>
        <p style="color:CornflowerBlue; text-align: center; font-size:300%;">1-800-350-4170</p>
    </div>

    <br />
    <br />
    <br />
    <div class="container">
        <div class="row offset-md-2">
            <div class="col-sm text-primary">Update Subscription</div>
            <div class="col-sm text-primary">Unsubscribe</div>
            <div class="col-sm text-primary">View Online</div>
        </div>
    </div>

    <br />
    <br />
    <br />


    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Pizza Place 2020</p>
            <p class="m-0 text-center text-white">1976 Aspen Circle Pueblo, Colorado 81006</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>