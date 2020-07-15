<?php

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM pizzaproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
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
    <table align="center">
        <tr>
            <td class="box one text-center;">
                <img class="logo" src="images/Pizza logo.png" />
            </td>
        </tr>
    </table>
    <br />
    <table align="center">
        <tr>
            <td class="menu-color"><a href="">HOME</a></td>
            <td class="menu-padding">|</td>
            <td class="menu-color">CART</td>
            <td class="menu-padding">|</td>
            <td class="menu-color">ORDER</td>
        </tr>
    </table>
    <br />
    <table class="table-margin">
        <tr>
            <td>
                <p class="header-main">Pizza Place</p>
            </td>
        </tr>
    </table>
    <br />
    <table align="center">
        <tr>
            <td>
                <img src="images/Pizza types.jpg" class="types" />
            </td>
        </tr>
    </table>
    <div id="shopping-cart">
        <div class="txt-heading">Shopping Cart</div>

        <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
        <?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align:left;">Name</th>
                    <th style="text-align:left;">Code</th>
                    <th style="text-align:right;" width="5%">Quantity</th>
                    <th style="text-align:right;" width="10%">Unit Price</th>
                    <th style="text-align:right;" width="10%">Price</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
                <?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
                <tr>
                    <td><img src="<?php echo $item["image"]; ?>" class="cart-images" /><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                    <td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>"
                            class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

                <tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><?php echo $total_quantity; ?></td>
                    <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <?php
} else {
?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
}
?>
    </div>
    <br />
    <br />
    <br />
    <div class="container">
        <?php
	$product_array = $db_handle->runQuery("SELECT * FROM pizzaproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>

        <div class="box-width box one">
            <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <div class="subheadings"><?php echo $product_array[$key]["name"]; ?></div>
                <div class="product-image"><img class="subimages" src="<?php echo $product_array[$key]["image"]; ?>">
                </div>
                <div class="subparagraphs">
                    <p style="width:200px"><?php echo $product_array[$key]["description"]; ?></p>
                </div>
                <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                <div class="cart-action"><input type="text" class="subnumbers" name="quantity" value="1" size="2" />
                    <input type="submit" value="Add to Cart" class="subbuttons" /></div>



        </div>

        <?php
if($product_array[$key]['name']=="Meat Pizza")
{
    echo "<br/>";
}
		}
	}
    ?>

    </div>

    <br />
    <br />
    <br />

    <table align="center">
        <tr>
            <td class="box three" style="font-size: 100%; font-weight: bold; text-align: center; padding: 0 30px;">

                <p><img src="cc.png" /></p>


            </td>
            <td class="box four" style="font-size: 150%; font-weight: bold; text-align: center; padding: 0 30px;">
                <p style="color:gray;">
                    Limited Time Only*<br />
                </p>
                <p style="font-size:200%; color:khaki;">$11.99!

                </p>
                <p style="text-decoration: line-through;">$249</p>


                <p><button style="background-color: lightgreen; font-weight: bold; height: 4em; width: 8em;">GET
                        YOURS</button></p>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table align="center">
        <tr>
            <td class="box five" style="font-size: 100%; font-weight: bold; text-align: center; padding: 0 30px;">
                <p>
                    1 Royal Berkey System <br />
                    1 Flouride Reduction Filter <br />
                    1 Stainless Steel Spigot <br />
                    1 Stainless Steel Stand <br />
                    1 Water Carafe <br />
                    1-6 Pack Boroux Basics<br />
                    Bottles
                </p>
            </td>
            <td class="box six" style="font-size: 150%; font-weight: bold; text-align: center; padding: 0 30px;">


                <p><button style="background-color: lightgreen; font-weight: bold; height: 5em; width: 10em;">ENTER TO
                        WIN!</button></p>
                <p style="font-style:italic; font-size: 100%; font-weight: normal; color:black;">Like & Follow Us on</p>
                <p><img src="f.png" style="width: 30px; height: 30px;" /><img src="i.png"
                        style="width: 30px; height: 30px;" /><img src="t.png" style="width: 30px; height: 30px;" /></p>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <table align="center" style="background-color:lightgrey; padding:10 0px">
        <tr>
            <td class="box one" style="font-size: 150%; font-weight: bold; text-align: center; padding: 0 30px;">
                <p>
                    Boroux <br />
                    1-Liter Bottle
                </p>
                <p><img src="cc.png" /></p>
                <p>Limited Quantity</p>
                <p>$29.99</p>
                <p><button
                        style="background-color: lightgrey; font-weight: bold; height: 5em; width: 10em; border-width: :5px; border-color:CornflowerBlue;  border-radius: 25px">GET
                        YOURS>></button></p>
            </td>
            <td class="box two" style="font-size: 150%; font-weight: bold; text-align: center; padding: 0 30px;">
                <p>
                    Sport <br />
                    Berkey
                </p>
                <p><img src="dd.png" /></p>
                <p><br /></p>
                <p>$249</p>
                <p><button
                        style="background-color: lightgrey; font-weight: bold; height: 5em; width: 10em; border-width: :5px; border-color:CornflowerBlue;  border-radius: 25px">GET
                        YOURS>></button></p>
            </td>
            <td class="box one" style="font-size: 150%; font-weight: bold; text-align: center; padding: 0 30px;">
                <p>
                    Berkey Flouride <br />
                    Filters
                </p>
                <p><img src="cc.png" /></p>
                <p><br /></p>
                <p>$29.99</p>
                <p><button
                        style="background-color:lightgrey; font-weight: bold; height: 5em; width: 10em; border-width: :5px; border-color:CornflowerBlue; border-radius: 25px">GET
                        YOURS>></button></p>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table align="center">
        <tr>
            <td>
                <p
                    style="font-style: italic; font-family: 'Cedarville Cursive', cursive; text-align: center; font-size: 5em; color: CornflowerBlue;">
                    Love your pizza!</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center; font-size: 150%;">Join Our 115+ Followers on Social Media</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center; font-size: 150%;">& Share Your Pizza Love! <span
                        style="font-size: 100%; color: CornflowerBlue;">#Pizzalove</span></p>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table align="center">
        <tr>
            <td>
                <p>
                    <img src="f.png" style="width: 30px; height: 30px;" />
                    <img src="i.png" style="width: 30px; height: 30px;" />
                    <img src="t.png" style="width: 30px; height: 30px;" />
                    <img src="f.png" style="width: 30px; height: 30px;" />
                    <img src="f.png" style="width: 30px; height: 30px;" />
                </p>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table align="center">

        <tr>
            <td>
                <p style="text-align: center; font-size: 150%;">Looking to learn More? <span
                        style="font-weight: bold">Call</span>, <span style="font-weight: bold">Text</span> or <span
                        style="font-weight: bold">Email us</span>!</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center; font-size: 150%;">Ready to Order? Visit <span
                        style="font-weight: bold">PizzaPlace.com</span> or give us a call.</p>
            </td>
        </tr>
        <br />
        <br />
        <br />
    </table>
    <table align="center">
        <tr>
            <p style="color:CornflowerBlue; text-align: center; font-size:300%;">1-800-350-4170</p>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table align="center">
        <tr>
            <td style="color: CornflowerBlue;">Update Subscription</td>
            <td style="padding: 10px;">|</td>
            <td style="color: CornflowerBlue;">Unsubscribe</td>
            <td style="padding: 10px;">|</td>
            <td style="color: CornflowerBlue;">View Online</td>
        </tr>
    </table>
    <br />
    <br />
    <br />
    <table align="center">
        <tr>
            <td style="padding: 10px; text-align: center;">
                <p>Copyright &copy; Pizza Place</p>
                <p>1976 Aspen Circle Pueblo, Colorado 81006</p>
            </td>
        </tr>

    </table>
</body>

</html>