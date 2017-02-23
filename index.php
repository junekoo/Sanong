<?php
     session_start();
    require 'connect.php';

    $sqlproduct = "SELECT * FROM productst ";
    $queryproduct = mysqli_query($sqlConnect,$sqlproduct);

    $action = isset($_GET['a']) ? $_GET['a'] : "";
    $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    if(isset($_SESSION['quantity'])){
        $meQty = 0;
        foreach($_SESSION['quantity'] as $meItem){
            $meQty = $meQty + $meItem;
        }
    }else{
        $meQty=0;
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
	<title>Menu</title>
</head>
<body>
	<section class="header">
        <div class="logohead"><a href=""><img src="img/logo_ver2_01.png"></a></div>

        <div class="con-menu">
            <div class="menu">
                <ul>
                    <li><a href="index.php" style="color: #ee5824">Menu</a></li>
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
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
              <div class="mdl-tabs__tab-bar">
                  <!-- <a href="#starks-panel" class="mdl-tabs__tab is-active">เมนูข้าวกล่อง</a> -->
                  <a href="#lannisters-panel" class="mdl-tabs__tab">เมนูอาหาร</a>
              </div>

            <form class="input" action="updateproduct.php" method="post">
              <div class="mdl-tabs__panel is-active" id="starks-panel">
                <div class="width80">
                <?php
                    while ($resultproduct = mysqli_fetch_assoc($queryproduct))
                    {
                ?>
                    <div class="width25">
                        <div class="pic-menu" style="background-image: url(img/images/<?php echo $resultproduct['name_pst']; ?>);"></div>
                        <div class="content-menu">
                            
                            <!-- <input type="checkbox" name="name_code_pst" value="Bike"> -->
                            <a href="updateproduct.php?itemId=<?php echo $resultproduct['productst_id']; ?>" style="text-decoration: none;">
                            <img src="img/icon_plus.png" style="width: 20%;">
                            </a>
                            
                            <?php echo $resultproduct['name_code_pst']; ?><br>
                            <p><?php echo $resultproduct['detail']; ?></p>
                            <h1><?php echo $resultproduct['price_pst']; ?> บาท</h1>
                            จำนวน&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="number" name="quantity[<?php echo $num; ?>]" value="<?php echo $_SESSION['quantity'][$key]; ?>" min="1" max="50">
                        </div>
                    </div>
                    <?php } ?>


                </div><!-- end width80 -->
                <div class="btn">
                    <a href="updateproduct.php?itemId=<?php echo $resultproduct['productst_id']; ?>">
                        <input type="submit" name="submit" value="ตกลง">
                    </a>
                </div>
        
              </div><!-- end mdl-tabs__panel is-active -->
            </form>
           
        </div>
        
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

    </section><!-- end header -->

</body>
</html>