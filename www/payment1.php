<?php
  session_start();
  //ini_set('curl.cainfo', "c:\\xampp\\cacert.pem");
  //phpinfo();exit;
  
  include ('db.php');
  $sql = mysql_query("select * from clients where company_name = '".$_SESSION['comname1']."'");
  $res1 = mysql_fetch_array($sql);
	
	
	//Dynamic Amount Goes Here
	
	$cart_amt = $_SESSION['amount1'];
	$_SESSION['amount1'] = $res1['amount'] = number_format((float)$cart_amt, 2, '.', '');; 

?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">


<link href="style/user-stylesheet.css" rel="stylesheet" />
<link href="style/fonts/fonts.css" rel="stylesheet" />
<link href="style/payment.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="style/settings.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style/style1.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen" />
      <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>
  <!--   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <!--webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='js/jquery-1.8.1.js'></script>
<script type="text/javascript" src="js/PIE.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="html5lightbox.js"></script>





<meta name="author" content="IMZWEB.com" />
<meta name="description" content="" />
<meta name="keywords" content="" />
</head>
<body>
  <script>
            $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
              type: 'inline',
              fixedContentPos: false,
              fixedBgPos: true,
              overflowY: 'auto',
              closeBtnInside: true,
              preloader: false,
              midClick: true,
              removalDelay: 300,
              mainClass: 'my-mfp-zoom-in'
            });
                                            
            });
        </script>
        <!--header wrapper-->
        <div class="header-wrapper1">
            <!-- navbar -->
          <div class="navbar-wrapper">

      <div class="navbar">
            <a href="http://www.toonexplainers.com"  target=_blank class="logo"> <img src="images/logo.png" /> </a>
          <div class="navbar">
            
              <ul class="r nav-links">
        				<p style="margin-top:40px;float: right;font-family:arial;font-weight:bold;color:#333;">Call us : +91 8220000769</p>
</ul>

        		</div>
        		

            </div>

    
                <!-- slider -->


            <!-- slider End -->
          </div>
             <!-- end navbar -->

      </div>
            <section class="header-bgg">
<div class="container">
      <h1 class="pay" style="padding-top:40px;font-family:'Raleway', sans-serif;text-decoration:none;text-align:center;font-size:60px;   color: #333;">Online Payment</h1>
</div>      
</section>




<div style="margin:0px auto;">
<?php

require  "instamojo.php";
//use Instamojo;
$api = new \Instamojo\Instamojo('cec9db1e1c62ce472500321f2ef94803', '953574f66cac0640f33c084ac21178cd');
$already_payment_link_exist = false;

//<!-- this code copy from instamojo api -- >
//$api = new Instamojo('[API_KEY]', '[AUTH_TOKEN]');
$payment_url = "";
try {
    $response = $api->linksList();
    //echo "<pre>";print_r($response);
	foreach ($response as $index => $instamojo_link) {
		//Assumption [currency] => INR
		if ($instamojo_link['base_price'] == $res1['amount']) {
			$payment_url = $instamojo_link['url'];
			$already_payment_link_exist = true;			
			break;
		}			
	}
}
catch (\Exception $e) {
    print('Error: ' . $e->getMessage());
}

if ($already_payment_link_exist == false) {
	try {
		$response = $api->linkCreate(array(
			'title'=>'Toonexplainers',
			'description'=>'Toonexplainers payment',
			'base_price'=> $cart_amt,
			/* To do the following logics */
			
			'redirect_url' => 'http://tooninner2.maduramaha.com/tooninner2/success.php',

			'webhook_url' => 'http://tooninner2.maduramaha.com/tooninner2/index1.php',
			
			'cover_image'=>'./images/logo.png'
			));
		//echo "<pre>";print_r($response);
		$payment_url = $response['url'];
	}
	catch (\Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}

?>
<!-- end api end -->
<! -- This bellow code for instamojo button with rs.10 -->
<?php if ($payment_url != "") {  ?>
<div class="container">

      <h3 class="pay" style="padding-top:40px;font-family:'Raleway', sans-serif;text-decoration:none;   color: #333;font-weight:bold;font-size:30px;">Your Amount : <strong style="font-size:60px;"><?php echo $res1['amount']; ?></strong></h3>
      
<h3 class="pay" style="padding-top:40px;font-family:'Raleway', sans-serif;text-decoration:none; color: #FFD306;font-size: 30pt;">Provided Details<h3>
<h4 class="pay" style="padding-top:20px;font-family:'Raleway', sans-serif;text-decoration:none; color: #333;font-size: 16pt;">Company Name: <?php echo $res1['company_name']; ?></h4>
<h4 class="pay" style="padding-top:20px;font-family:'Raleway', sans-serif;text-decoration:none; color: #333;font-size: 16pt;">Your  Name: <?php echo $res1['name']; ?></h4>
<h4 class="pay" style="padding-top:20px;font-family:'Raleway', sans-serif;text-decoration:none; color: #333;font-size: 16pt;">Your Email: <?php echo $res1['email']; ?></h4>
</div>
               <div class="container ">
                              
                <br><br>
                <a href="<?php echo $payment_url;?>" rel="im-checkout" data-behaviour="remote" data-style="light" data-text="Checkout " data-token="3e4a5cfe9e483a347f19807d73dc4e23"></a>
                <script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>

               
              </div>
              </div>
            </div>
            </div>
              <div class="clear"> </div>
              <!--pop-up-grid-->
           
                <!--pop-up-grid-->
              </div>
            <div class="clear"> </div>

          </div>
         </div>
        </div>
<?php } ?>
<div class="container">
<!-- <h1> Static Payment Links </h1>
<a href="https://www.instamojo.com/joyson/tour-94d41/" rel="im-checkout" data-behaviour="remote" data-style="light" data-text="Checkout With Instamojo" data-token="7e4474345c2b488780886f44a01857ca"></a>
<script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script> -->
</div>


<!-- end -->

<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="business" value="payment@toonexplainers.com">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PXNW96GKKHED2">
<input type="hidden" name="Amount" value="<?php echo $res1['amount']; ?>">
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form> -->





<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post">


  <input type="hidden" name="business" value="payment@toonexplainers.com">

 
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="hosted_button_id" value="PXNW96GKKHED2">


  <input type="hidden" name="item_name" value="<?php echo $res1['company_name']; ?>">
  <input type="hidden" name="amount" value="<?php echo $res1['amount']; ?>">
  <input type="hidden" name="currency_code" value="USD">



  <h3 style="margin-left:px;">Pay Now With Paypal</h3></br></br>

  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif"
  alt="PayPal - The safer, easier way to pay online">

  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif">

</form>  -->

</div>
        <div id="footer" style="bottom:0;">
  <div id="innerfooter" style="height:180px;">
    <h2 style="text-decoration:underline;padding:2px;font-size:30px;">Reach us</h2>
  <p style="font-family:arial;color:#fff;">
  Toon ExplainersNo.3, Raja Street, Kallimadai,Trichy Road, Singanallur,Tamilnadu, Coimbatore - 641005 <br>Mobile: +91 8220000769 , Email : info@toonexplainers.com
  </p>
  <ul class="social">
<li>
<a href="https://www.facebook.com" target=_blank><img src="images/Top-head-icon-1.png" class="img-responsive hvr-pop"></a>
</li>
<li>
<a href="https://twitter.com/" target=_blank><img src="images/Top-head-icon-2.png" class="img-responsive hvr-pop"></a>
</li>
<li>
<a href="https://plus.google.com/" target=_blank><img src="images/Top-head-icon-3.png" class="img-responsive hvr-pop"></a>
</li>
<li>
<a href="https://www.youtube.com/channel/" target=_blank><img src="images/yt.png" class="img-responsive hvr-pop" style="width:25px;"></a>
</li>
</ul>

  </div>

        <div class="copyright" style="font-family:arial;">
            <p>All rights reserved to <a href="#">ToonExplainers</a></p>
         </div>
</div>
</body>
</html>