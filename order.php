<?php
session_start();
require 'connect.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['quantity']))
{
    $meQty = 0;
    foreach ($_SESSION['quantity'] as $meItem)
    {
        $meQty = $meQty + $meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $sqlproduct = "SELECT * FROM productst WHERE productst_id in ({$inputItems})";
    $queryproduct = mysqli_query($sqlConnect,$sqlproduct);
    $meCount = mysqli_num_rows($queryproduct);

} else
{

    $meCount = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/index-style.css">
    <link rel="stylesheet" href="js/mdl/material.min.css">
    <script src="js/mdl/material.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="./js/jquery.filer.min.js"></script>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>Order</title>
</head>
<body>
        <div class="logohead"><a href="index.php"><img src="img/logo_ver2_01.png"></a></div>

        <div class="con-menu">
            <div class="menu">
                <ul>
                    <li><a href="index.php">Menu</a></li>
                    <li><a href="#">Check order</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="menu02" style="left: 40%;">
                <ul>
                    <li><a href="index.html">Username</a></li>
                    <li><a href="index.html">Log in</a></li>
                    <li><img src="img/icon_food.png" style="width: 5%;"><?php echo $meQty; ?></li>
                </ul>
            </div>

        </div><!-- end con-menu -->
        
        <div class="content">

        <?php
           
            if ($meCount == 0)
            {
                echo "<center><div class=\"order-pay\" style=\"width: 80%; height: 300px; font-family: 'Prompt', sans-serif; font-size: 22px; padding-top: 10%;\">ไม่มีสินค้าอยู่ในตะกร้า</div></center>";
            } else
            {
                ?>
        <form class="input" action="payment.php" method="post">
        

        <div class="width80">
            <div class="w80">
                <div class="left_w80"><h1>รายการอาหารที่สั่ง</h1></div>
                <div class="left_w80" >
                    <div class="btn3">
                    <a href="index.php">เพิ่มรายการอาหาร</a>&nbsp;
                    <img src="img/plus.png">
                    </div>
                </div>
            </div>
            </div><!-- end width80 -->

             <?php
                            $total_price = 0;
                            $num = 0;
                            while ($resultproduct = mysqli_fetch_assoc($queryproduct))
                            {
                                $key = array_search($resultproduct['productst_id'], $_SESSION['cart']);
                                $total_price = $total_price + ($resultproduct['price_pst'] * $_SESSION['quantity'][$key]);
                                ?>

        <div class="width80">

                    <div class="width25_02">
                        <div class="pic-menu_02" style="background-image: url(img/images/<?php echo $resultproduct['name_pst']; ?>);"></div>
                        
                        <div class="height50">
                            <div class="content-menu_02">
                                <h1><?php echo $resultproduct['name_code_pst']; ?></h1>
                                <p><?php echo $resultproduct['detail']; ?></p>
                            </div>
                            <div class="content-menu_02">
                                <h1><?php echo $resultproduct['price_pst']; ?> บาท</h1>
                                จำนวน&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="number" name="quantity[<?php echo $num; ?>]" value="<?php echo $_SESSION['quantity'][$key]; ?>" min="1" max="50"  />
                                <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                            </div>
                        </div>

                        <a href="removeproduct.php?itemId=<?php echo $resultproduct['productst_id']; ?>" role="button">
                        <div class="btn2"><img src="img/minus.png"></div>
                        </a>
                        <div class="height50_02">
                            <div class="content-menu_02">
                                <h1>รวมทั้งหมด</h1>
                            </div>
                            <div class="content-menu_02">
                                <h1><?php echo ($total_price); ?> บาท</h1>
                            </div>
                        </div>
                    </div><!-- end width25_02 -->
                    

        </div><!-- end width80 -->

        <?php
                                $num++;
                            }
                            ?>




        <div class="btn4">
            <input type="submit" name="submit" value="ยกเลิก" style="border:1px solid #cccccc; background-color: #ffffff; color: #cccccc;">
            <a href="payment.php"><input type="submit" name="submit" value="ตกลง"></a>
        </div>

        </form>
        
        <?php
            }
            ?>
        </div><!-- end content -->
        <div class="foot">
            <div class="foot-menu">
                <img src="img/face.png"><br>
                <ul><li><a href="#">Sanong_thaifood/</a></li></ul>
            </div>

            <div class="foot-menu">
                <img src="img/twitter.png"><br>
                <ul><li><a href="#">@Sanong_thaifood</a></li></ul>
            </div>

            <div class="foot-menu">
                <img src="img/instagram.png"><br>
                <ul><li><a href="#">@Sanong_thfastfood</a></li></ul>
            </div>

            <div class="foot-menu02">
                <img src="img/symbol03.png"><br>
                <!-- <ul><li><a href="#">Sanong_thaifood/</a></li></ul> -->
            </div>
        </div>

</body>
</html>