<?php
session_start();
require 'connect.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formupdate'] = sha1('' . microtime());
if (isset($_SESSION['quantity'])) {
    $meQty = 0;
    foreach ($_SESSION['quantity'] as $meItem) {
        $meQty = $meQty + $meItem;
    }
} else {
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0) {
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId) {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $sqlproduct = "SELECT * FROM productst WHERE productst_id in ({$inputItems})";
    $queryproduct = mysqli_query($sqlConnect,$sqlproduct);
    $meCount = mysqli_num_rows($queryproduct);
} else {
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
    <script type="text/javascript">
    function updateSubmit(){
        if(document.formupdate.order_fullname.value == ""){
            alert('โปรดใส่ชื่อนามสกุล');
            document.formupdate.order_fullname.focus();
            return false;
        }
            if(document.formupdate.order_address.value == ""){
            alert('โปรดใส่ที่อยู่');
            document.formupdate.order_address.focus();
            return false;
        }
            if(document.formupdate.order_phone.value == ""){
            alert('โปรดใส่หมายเลขโทรศัพท์');
            document.formupdate.order_phone.focus();
            return false;
        }
        document.formupdate.submit();
        return false;
    }
</script>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>Order</title>
</head>
<body>
        <div class="logohead"><a href=""><img src="img/logo_ver2_01.png"></a></div>

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

            <form action="updateorder.php" method="post" name="formupdate" role="form" id="formupdate" >

             <?php
                            $total_price = 0;
                            $num = 0;
                            while ($resultproduct = mysqli_fetch_assoc($queryproduct))
                            {
                                $key = array_search($resultproduct['productst_id'], $_SESSION['cart']);
                                $total_price = $total_price + ($resultproduct['price_pst'] * $_SESSION['quantity'][$key]);
                                ?>

            <div class="width80">
                <div class="w80">
                    <div class="left_w80"><h1>รายการที่ต้องชำระ</h1></div>
                </div>
            </div><!-- end width80 -->

            <div class="width80">
                <div class="w80_02">
                    <div class="left_w80"><p>ชื่ออาหาร</p></div>
                    <div class="left_w80_02" style="margin-left: 35%;"><p><?php echo ($resultproduct['name_code_pst']); ?></p></div>
                    <div class="left_w80"><p>ค่าอาหาร</p></div>
                    <div class="left_w80_02" style="margin-left: 35%;"><p><?php echo ($resultproduct['price_pst']); ?> บาท</p></div>
                    <div class="left_w80"><p>จำนวน</p></div>
                    <div class="left_w80_02" style="margin-left: 35%;"><p><?php echo $_SESSION['quantity'][$key]; ?></p></div>
                    <h6 style="color: #828282;">
                        <input type="hidden" name="quantity[]" value="<?php echo $_SESSION['quantity'][$key]; ?>" />
                        <input type="hidden" name="product_id[]" value="<?php echo $resultproduct['productst_id']; ?>" />
                        <input  type="hidden" name="price_pst[]" value="<?php echo $resultproduct['price_pst']; ?>" />
                    </h6>

                    
                </div>

             <?php
                                $num++;
                                }
                            ?>
                <div class="w80_02">
                    <div class="left_w80"><h1>ค่าอาหารทั้งหมด</h1></div>
                    <div class="left_w80_02" style="margin-left: 35%;"><h1><?php echo ($total_price); ?> บาท</h1></div>
                </div>
            </div>

            <div class="width80">
                <div class="w80">
                    <!-- <div class="left_w80"><h1>เลือกชำระเงิน</h1></div> -->
                </div>
                
            </div><!-- end width80 -->

                <div class="width80">
                    <div class="w80">
                    <br>
                    <br>
                        ชื่อจริง&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="order_name"><br>
                        ที่อยู่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="order_address"><br>
                        เบอร์โทร &nbsp;&nbsp;<input type="text" name="order_tel">
                    </div>
                </div><!-- end width80 -->

                <div class="btn">
                    <input type="submit" name="submit" value="ตกลง">
                </div>
            </form>
                
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
<?php
mysqli_close($sqlConnect);
?>