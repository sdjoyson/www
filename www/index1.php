<?php
   
    include ('db.php');
    if(isset($_POST['submit1']))
    {
         session_start();
        $msg = "";
        $com_name = $_POST['company_name'];
        $website = $_POST['website'];
        $des = $_POST['description'];

        if ($_FILES['audios']['name'] =="") {
        $audios = "NULL";
        $target2 = "NULL";
        
        }else
        {
        $audios = $_FILES['audios']['name'];
        $audios1 = $_FILES['audios']['tmp_name'];
        $target2 = "./comp-info/".$audios;
        }

           
     
        $logo = $_FILES['logo']['name'];
        $logo1 = $_FILES['logo']['tmp_name'];
        $photo = $_FILES['photos']['name'];
        $photo1 = $_FILES['photos']['tmp_name'];
      
        $name = $_POST['name'];
        $email = $_POST['email'];

        $target = "./comp-info/".$logo;
        $target1 = "./comp-info/".$photo;
      
         $vid_cat = $_POST['cate_id'];
         $minutes = $_POST['minutes'];
         $voice = $_POST['voice'];
         $script = $_POST['script'];
         $script1 = $_POST['script1'];
         $script2 = $_POST['script2'];
         $script3= $_POST['script3'];
         $amount = $_POST['price'];;

         $sql1 = mysql_query("select v_name from prices where category_id='".$vid_cat."'");
        
         $res3 = mysql_fetch_array($sql1);
         $res4 = $res3['v_name'];

  
        if(move_uploaded_file($audios1 , $target2) || move_uploaded_file($logo1,$target) || move_uploaded_file($photo1,$target1))
        { 
                   
            $sql = "insert into clients values('','$com_name','$website','$des','$target','$target1','$target2','$name','$email','$vid_cat','$minutes','$voice','$script','$script1','$script2','$script3','$amount')";
            $res = mysql_query($sql);
            if($res ==1)
            {
               $msg =  "<font color=green>uploaded</font>";
               $_SESSION['comname1'] = $com_name;
               $_SESSION['amount1'] = $amount;

              
               require 'PHPMailer_5.2.4/class.phpmailer.php';
                 

              $email = new PHPMailer();
              $email->From      = 'sdjoyson@gmail.com';
              $email->FromName  = 'joyson';
              $email->isHTML(true);    
              $message = '<div><table border=2 style=background-color:grey;color:white;font-size:20pt;font-family:arial;border:1px soild pink;><tr><td>Company Name </td>'.'<td>'.$com_name.'</td>
                </tr>'.'<tr><td>Video Category</td>'.'<td>'.$res4.'</td></tr>'.'<tr><td>Minutes</td>'.'<td>'.$minutes.'</td></tr>'.'<tr><td>Voice</td>'.'<td>'.$voice.'</td></tr>'.
                '<tr><td>Script Writting</td>'.'<td>'.$script.'<td></tr>'.'<tr><td>Whatsapp Version</td>'.'<td>'.$script1.'<td></tr>'.'<tr><td>HD Quality</td>'.'<td>'.$script2.'<td></tr>'.'<tr><td>Revision</td>'.'<td>'.$script3.'<td></tr>'.'<tr><td>Amount                        </td>'.'<td>'.$amount.'</td></tr></table></div>'; 
              $email->Subject   = 'Client order';
               $email->Body    = $message ;  
              
               $email->AddAddress( 'mathi@toonexplainers.com' );
              $email->AddAddress( 'jabeer@toonexplainers.com' );


             

                $email->AddAttachment('comp-info/'.$_FILES['logo']['name']);
                $email->AddAttachment('comp-info/'.$_FILES['photos']['name']); 
                $email->AddAttachment('comp-info/'.$_FILES['audios']['name']);

             if(!$email->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $email->ErrorInfo;
                } else {
                    
                   die("<script>location.href = 'payment1.php'</script>");
                    
                }
                  
            }  
            else
            {
                $msg =  "<font color=red>Not uploaded</font>";
                
            }
        
           }     
        
    
}


?>

<!DOCTYPE html>
<html>
<head>


<link href="style/user-stylesheet.css" rel="stylesheet" />
<link href="style/fonts/fonts.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="style/settings.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style/style1.css" media="screen" />

<script type='text/javascript' src='js/jquery-1.8.1.js'></script>
<script type="text/javascript" src="js/PIE.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="html5lightbox.js"></script>




<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="IMZWEB.com" />
<meta name="description" content="" />
<meta name="keywords" content="" />

<script type="text/javascript">

</script>
<title>Toon Explainers</title>
</head>

<body>  
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
        			<ul class="r nav-links">
        				<li style="font-family:arial;font-weight:bold;color:#333;"><a  href="index1.php" name="home">home</a></li>
		                        <li style="font-family:arial;font-weight:bold;color:#333;"><a  href="payment1.php" name="order">order now</a></li>
		                        
                    		</ul>

        		</div>

		
                <!-- slider -->


            <!-- slider End -->
        	</div>
             <!-- end navbar -->

    	</div>

        <!-- End Header Wrapper -->

        <br class="clr" />
        <!-- about us -->
         <h1 style="font-family: 'Raleway', sans-serif;
    text-align: center;
    /* text-decoration: underline; */
    color: #474747;">Place Your Order</h1>
        <form method="post" action="" enctype="multipart/form-data">
        
                <div class="content">
            <h1>Step 1 : Video Informations</h1>
            <br class="clr" />
            
            <ul class="video-info">
                <li>
                    <span class="yellow-circle">1</span>
                    <label>Video Category :</label>
                   
                    <select  name="cate_id" id="cate_id" >
                                                
                        <option value="1" name="Text animation Style">Text Animation Style</option>
                        
                                                
                        <option value="2" name="Infographic Style">Infographic Style</option>
                        
                                                
                        <option value="3" name="Character animation Style">Character Animation Style</option>
                        
                                            </select>
                </li>
                
                
                <li>
                    <span class="yellow-circle">2</span>
                    <label>No of minutes :</label>
                   
                    <select id="min" name="minutes" style="margin-left: 9px;">
                        
                                                
                                                <option value="1"  selected >upto 1 minutes</option>
                                                <option value="1.5"  >1.5</option>
                                                <option value="2"  >2</option>
                                                <option value="2.25"  >2.5</option>
                                                <option value="2.5"  >3</option>
                                                <option value="2.75"  >3.5</option>
                                                <option value="3"  >4</option>
                                                <option value="3.25"  >4.5</option>
                                                <option value="3.5"  >5</option>
                                            </select>
                                         <div class="vid" value_of="10000">10000</div>
                     
                      
                     
                </li>
                 
                
                
                <li>
                    <span class="yellow-circle">3</span>
                    <label>Voice Over :</label>
                    <ul class="voice-over">
                              <input type="checkbox" name="voice" id="audio" Onchange="voice1();" />Yes , I have (select mp3 file)&nbsp;&nbsp;<input type="file" name="audios"/>
                              <br><br>
                              <li><p style="color:green;font-size:15pt;"><span style="color:red;font-size:15pt;">(or)</span> You can choose from below list.</p></li>   
                              <li><input type="radio" name="voice" id="audio1" value="Mark" onclick="voice2();" /><label>Male</label><audio style="margin-left:50px;background-color: green;" controls>
                              <source src="audio/01_Chip_Male.ogg" type="audio/ogg">
                              <source src="audio/01_Chip_Male.mp3" type="audio/mp3">
                              Your browser does not support the audio tag.
                            </audio></li>


                        <li><input type="radio" name="voice" id="audio2" value="Crystal" onclick="voice2();"/><label>Female</label><audio style="margin-left:30px;" controls>
                              <source src="audio/04_Meliara_Female.ogg" type="audio/ogg">
                              <source src="audio/04_Meliara_Female.mp3" type="audio/mp3">
                              Your browser does not support the audio tag.
                            </audio></li>
                        
                        
                        <li><input type="radio" name="voice" id="audio3" value="Mark2" onclick="voice2();"/><label>Male</label><audio  style="margin-left:50px;" controls>
                              <source src="audio/02_Matt_Male.ogg" type="audio/ogg">
                              <source src="audio/02_Matt_Male.mp3" type="audio/mp3">
                              Your browser does not support the audio tag.
                            </audio></li>
                        
                        
                        <li><input type="radio" name="voice" id="audio4" value="Linnea" onclick="voice2();"/><label>Female</label><audio style="margin-left:30px;" controls>
                              <source src="audio/03_Linnea_Female.ogg" type="audio/ogg">
                              <source src="audio/03_Linnea_Female.mp3" type="audio/mp3">
                              Your browser does not support the audio tag.
                            </audio></li>
                       
                    
                    </ul>

                     <div class="voi" value_of="5000">0</div>
                </li>
                
                <li>
                    <span class="yellow-circle">4</span>
                    <label>Script Writting :</label>
                    <ul class="script">
                        <li><input type="checkbox" class="src"  id="write" name="script" value="Script writting" Onchange="check();"/><label>Yes, i need new script.</label></li>
                       <!--  <li><input type="radio" class="no" name="script" value="0" onclick="voice2();" /><label>No , i have my own script.</label></li> -->
                        <!-- <li class="upload-script"><label>Upload your script file.</label><input type="file" name="script_file" />
<p style="font-size: 14px; margin: 10px 5px;color: #267CBF;">150 Words Per Min Maximum.</p></li> -->
                    </ul>

                    <div class="scr" value_of="">0</div>
                </li>
                
                <li>
                    <span class="yellow-circle">5</span>
                    <label>Whatsapp Version :</label>
                    <ul class="script">
                        <li><input type="checkbox" class="src"  id="write1" name="script1" value="Whatsapp version" Onchange="check();" /><label>Yes, i need Watsapp Version.</label></li>
                       <!--  <li><input type="radio" class="no1" name="script1" value="0" onclick="voice2();" /><label>No , i have my own script.</label></li> -->
                       <!--  <li class="upload-script1"><label>Upload your script file.</label><input type="file" name="script_file" />
<p style="font-size: 14px; margin: 10px 5px;color: #267CBF;">150 Words Per Min Maximum.</p></li> -->
                    </ul>

                    <div class="scr1" value_of="">0</div>
                </li>
				 
                <li>
                    <span class="yellow-circle">6</span>
                    <label>HD Quality:</label>
                    <ul class="script">
                        <li><input type="checkbox" class="src"  id="write2" name="script2" value="HD Quality" Onchange="check();" /><label>Yes, i need HD Quality.</label></li>
                        <!-- <li><input type="radio" class="no2" name="script2" value="0" onclick="voice2();" /><label>No , i have my own script.</label></li> -->
                        <!-- <li class="upload-script2"><label>Upload your script file.</label><input type="file" name="script_file" />
<p style="font-size: 14px; margin: 10px 5px;color: #267CBF;">150 Words Per Min Maximum.</p></li> -->
                    </ul>

                    <div class="scr2" value_of="">0</div>
                </li>
				 
                <li>
                    <span class="yellow-circle">7</span>
                    <label>Revision :</label>
                    <ul class="script">
                        <li><input type="checkbox" class="src"  id="write3"  name="script3" value="Two revision" Onchange="check();"/><label>Yes, i need two revision.</label></li>
                        <!-- <li><input type="radio" class="no3" name="script3" value="0" onclick="voice2();"/><label>No , i
                         have my own script.</label></li> -->
                        <!-- <li class="upload-script3"><label>Upload your script file.</label><input type="file" name="script_file" />
<p style="font-size: 14px; margin: 10px 5px;color: #267CBF;">150 Words Per Min Maximum.</p></li> -->
                    </ul>

                    <div class="scr3" value_of="">0</div>
                </li>
                
                <li>
                    <label style="font-weight:bold;">Total Price :</label>
                     <div class="tot" id="tot">10000</div>
                	 <input type="hidden" name="price" class="total"  id="total"/>		
                </li>
                
                
            </ul>
        </div>
         	
        
        
        <!-- about us End -->
        <br class="clr" />

        <!-- seperator -->
        <div class="seperator">
            <p class="sep"></p>
            <p class="sep-circles"></p>
        </div>

        <!-- sep end -->
        <br class="clr" />



        <div class="content">
            <h1>Step 2 : Business Informations</h1>
            <br class="clr" />
           
           <table class="bus-info l" cellspacing="15">
                <tr>
                    <td><span class="yellow-circle">1</span><label>Company Name :</label></td>
                    <td><input type="text" name="company_name" required/></td>
                </tr>
                <tr>
                    <td><span class="yellow-circle">2</span><label>Website :</label></td>
                    <td><input type="text" name="website" required/></td>
                </tr>
                <tr>
                    <td><span class="yellow-circle">3</span><label>Description :</label></td>
                    <td><textarea name="description" required></textarea></td>
                </tr>
                <tr>
                    <td><span class="yellow-circle">4</span><label>Images Upload : </label></td>
                    <td><input type="file" name="logo" required />
<span style="font-size: 14px; margin: 10px 5px;color: #267CBF;"></span>
</td>
                </tr>
                <tr>
                    <td><span class="yellow-circle">5</span><label>Voiceover Script (if any)</label></td>
                    <td><input type="file" name="photos" /></td>
                </tr>
                <tr>
                    <td><span class="yellow-circle">6</span><label>Your Name :</label></td>
                    <td><input type="text" name="name" required/></td>
                </tr>
                <tr>
                    <td><span class="yellow-circle">7</span><label>Your E-mail :</label></td>
                    <td><input type="text" name="email" required/></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit1" value="Confirm & Pay" class="yellow-btn l" style="font-family: 'Raleway', sans-serif;font-weight:bold;"/></td>
                    <td></td>
                </tr>
                
                
            </table>

           
            
        </div>
        </form>
        <!-- about us End -->
        <br class="clr" />

        <!-- seperator -->
        <div class="seperator">
            <p class="sep"></p>
            <p class="sep-circles"></p>
        </div>

        <!-- sep end -->
        <br class="clr" />

<!-- footer -->
        <div id="footer">
  <div id="innerfooter" style="height:140px;">
  <br>
    <h2 style="text-decoration:underline;padding:2px;">Reach us</h2>
<br>
	<p style="font-family:arial;color:#fff;">
	Toon ExplainersNo.3, Raja Street, Kallimadai,Trichy Road, Singanallur,Tamilnadu, Coimbatore - 641005 <br> <br>Mobile: +91 8220000769 , Email : info@toonexplainers.com
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
  <br> <br>
        <div class="copyright">
            <p>All rights reserved to <a href="#">ToonExplainers</a></a></p>
         </div>
</div>
		

        <!-- end footer -->
      
      
<script type="text/javascript">
    $(document).ready(function(){ 
            $('#show-sub').click(function(){
                $('.sub-menu').slideToggle('slow');
            });
        });
</script>

<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
<script type="text/javascript">
    $('#ca-container , #ca-container1 , #ca-container2 , #ca-container3 , #ca-container4 , #ca-container5').contentcarousel();
</script>

           
<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="js/jquery.cslider.js"></script>
<script type="text/javascript">
    $(function() {
            
        $('#da-slider').cslider();
             
    });
</script> 

<script type="text/javascript" src="js/popup.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.nav-links li a').click(function(){
			$('.nav-links li a').removeClass('active');
			$(this ).addClass('active');
		});
	});
</script>

<script>
    $(function () {
        var url = window.location.pathname;
        var activePage = url.substring(url.lastIndexOf('/') + 1);
        $('.nav-links li a').each(function () {
            var currentPage = this.href.substring(this.href.lastIndexOf('/') + 1);

            if (activePage == currentPage) {
                $(this).parent().addClass('active');
            }
        });
    })
</script>

<script type="text/javascript">
    // $(document).ready(function(){


      //   $('.no').click(function(){
      //       $('.upload-script').show('slow');
            
      //       var a = $('#min').val();
            // if(a > 0){
            //  var oo = $('.vid').attr('value_of');
            //  var tt = $('.voi').attr('value_of');
            //  var dd = 0;
            //  var vidoe = oo * a ;
            //  var voice = tt * a ;
            //  var script = dd * a ;
            //  var sum = vidoe  + voice + script ;  
            //  $('.vid').html(vidoe + ' ');
            //  $('.voi').html(voice + ' ');
            //  $('.scr').html(script + ' ');
            //  $('.tot').html(sum + ' ');
            //  $('.total').val(sum );
            // }
            
            
      //   });
// function check() {
//   var basic = 0;
//   var script = 0;  
//   if(document.getElementById("write").checked) {
//                          var a = $('#min').val();
                   
//                         var oo = $('.vid').attr('value_of');
//                         var tt = $('.voi').attr('value_of');
//                         var dd = $('.scr').attr('value_of');
//                         var vidoe = oo * a ;
//                         var voice = 5000 ;
//                         script += 3000;
//                         $('.vid').html(vidoe + ' ');
//                         $('.voi').html(voice + ' ');
//                         $('.scr').html(script + ' ');

//   }
//   if(document.getElementById("write1").checked) {
//                         var a = $('#min').val();
                   
//                         var oo = $('.vid').attr('value_of');
//                         var tt = $('.voi').attr('value_of');
//                         var dd = $('.scr').attr('value_of');
//                         var vidoe = oo * a ;
//                         var voice = 5000 ;
//                         script += 3000;
//                         $('.vid').html(vidoe + ' ');
//                         $('.voi').html(voice + ' ');
//                         $('.scr').html(script + ' ');

//   }
//   if(document.getElementById("write2").checked) {
//                          var a = $('#min').val();
                   
//                         var oo = $('.vid').attr('value_of');
//                         var tt = $('.voi').attr('value_of');
//                         var dd = $('.scr').attr('value_of');
//                         var vidoe = oo * a ;
//                         var voice = 5000 ;
//                         script += 3000;
//                         $('.vid').html(vidoe + ' ');
//                         $('.voi').html(voice + ' ');
//                         $('.scr').html(script + ' ');
//   }
//    if(document.getElementById("write3").checked) {
//                         var a = $('#min').val();
//                         var oo = $('.vid').attr('value_of');
//                         var tt = $('.voi').attr('value_of');
//                         var dd = $('.scr').attr('value_of');
//                         var vidoe = oo * a ;
//                         var voice = 5000 ;
//                         script += 3000;
//                         $('.vid').html(vidoe + ' ');
//                         $('.voi').html(voice + ' ');
//                         $('.scr').html(script + ' ');
//   }
//   var p = basic + script;
//   var price = p + "Rs."; 
  
//   document.getElementById('tot').innerHTML = price;  
//  }

// check();


$('#cate_id').on('change' , function(){
            var cat = $('#cate_id').val();
            var a = $('#min').val();
            
                $.get('get_prices.php?category='+cat, function(data){
                    arr = data.split('||');

                $('.vid').attr('value_of' , arr[0]) ;
                var oo = $('.vid').attr('value_of');
                
               if(document.getElementById("audio1").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
                if(document.getElementById("audio2").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
                if(document.getElementById("audio3").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
              if(document.getElementById("audio4").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
                              
                var vidoe = oo * a ;
                if(document.getElementById("write").checked) {
                                                
                                                 add = 5000;}
                                                 else {add =0;}
                    if(document.getElementById("write1").checked) {
                                                
                                                 add1 = 5000;}
                                                 else {add1 =0;}
                 if(document.getElementById("write2").checked) {
                                                
                                                 add2 = 5000;}
                                                 else {add2 =0;}
                 if(document.getElementById("write3").checked) {
                                                
                                                 add3 = 5000;}
                                                 else {add3 =0;}                               

                var tt = $('.voi').attr('value_of');
                var sum = vidoe + voice + add + add1 + add2 + add3;
                $('.vid').html(vidoe + ' ');
                $('.voi').html(voice + ' ');
                $('.tot').html(sum + ' ');
                $('.total').val(sum );
                 });
    
 });

                $('#min').change(function(){
                      var a = $('#min').val();
                       if(a > 0){
                         var oo = $('.vid').attr('value_of');
                             var tt = $('.voi').attr('value_of');
                                var vidoe = oo * a ;
                                 if(document.getElementById("audio1").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
                if(document.getElementById("audio2").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
                if(document.getElementById("audio3").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
              if(document.getElementById("audio4").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }else{voice = 0;}
                     if(document.getElementById("write").checked) {
                                                
                                                 add = 5000;}
                                                 else {add =0;}
                     if(document.getElementById("write1").checked) {
                                                
                                                 add1 = 5000;}
                                                 else {add1 =0;}
                     if(document.getElementById("write2").checked) {
                                                
                                                 add2 = 5000;}
                                                 else {add2 =0;}
                      if(document.getElementById("write3").checked) {
                                                
                                                 add3 = 5000;}
                                                 else {add3 =0;}                               


                      var sum = vidoe + voice + add + add1 + add2 + add3;
                             
                                $('.vid').html(vidoe + ' ');
                                  $('.voi').html(voice + ' ');
                                     $('.tot').html(sum + ' ');
                                    $('.total').val(sum );                                               
                                                                    
                                     }
                                   }); 
                function voice1()
                {
                         var a = $('#min').val();
                         var oo = $('.vid').attr('value_of');

                           if(document.getElementById("audio").checked) {
                              
                              voice = 0 ;jQuery('#audio1').attr('checked', false);
                              			 jQuery('#audio2').attr('checked', false);
                              			 jQuery('#audio3').attr('checked', false);
                              			 jQuery('#audio4').attr('checked', false);


                              			$('.voi').html(voice + ' ');

                            }else { voice = 0 ;alert('Please select one voice option');$('.voi').html(voice + ' ');}

                      if(document.getElementById("write").checked) {
                                                
                                                 add = 5000;}
                                                 else {add =0;}
                     if(document.getElementById("write1").checked) {
                                                
                                                 add1 = 5000;}
                                                 else {add1 =0;}
                     if(document.getElementById("write2").checked) {
                                                
                                                 add2 = 5000;}
                                                 else {add2 =0;}
                      if(document.getElementById("write3").checked) {
                                                
                                                 add3 = 5000;}
                                                 else {add3 =0;}                               

                       var vidoe = oo * a ;                          
                      var sum = vidoe + voice + add + add1 + add2 + add3;
                         
                        $('.vid').html(vidoe + ' ');
                        $('.voi').html(voice + ' ');
                        $('.tot').html(sum + ' ');
                        $('.total').val(sum );


                }
                function voice2()
                {

                  var a = $('#min').val();
                         var oo = $('.vid').attr('value_of');

                           if(document.getElementById("audio1").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }
                if(document.getElementById("audio2").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }
                if(document.getElementById("audio3").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }
              if(document.getElementById("audio4").checked) {
                        voice = 5000;
                        if(document.getElementById("audio").checked) {
                             voice = 0;}
               }

                      if(document.getElementById("write").checked) {
                                                
                                                 add = 5000;}
                                                 else {add =0;}
                     if(document.getElementById("write1").checked) {
                                                
                                                 add1 = 5000;}
                                                 else {add1 =0;}
                     if(document.getElementById("write2").checked) {
                                                
                                                 add2 = 5000;}
                                                 else {add2 =0;}
                      if(document.getElementById("write3").checked) {
                                                
                                                 add3 = 5000;}
                                                 else {add3 =0;}                               

                       var vidoe = oo * a ;                          
                      var sum = vidoe + voice + add + add1 + add2 + add3;
                         
                        $('.vid').html(vidoe + ' ');
                        $('.voi').html(voice + ' ');
                        $('.tot').html(sum + ' ');
                        $('.total').val(sum );

                }

                function check() {
                                            
                                                 var add = 0;  
                                                 var a = $('#min').val();
                                                 var oo = $('.vid').attr('value_of');
                                                 var vidoe = oo * a ;
                                                    
if(document.getElementById("audio1").checked || document.getElementById("audio2").checked || document.getElementById("audio3").checked || document.getElementById("audio4").checked){voice = 5000;} else {voice = 0;}

              
                                                 
                                               if(document.getElementById("write").checked) {

                                                
                                                 add = 5000;
                                                 $('.scr').html(add + ' ');
                                              
                                                
                                                 
                                                 
                                                
                                              }
                                              else
                                              {
                                                add = 0 ;
                                                $('.scr').html(add + ' ');
                                              }
                                              if(document.getElementById("write1").checked) {
                                                var add1 = 5000;
                                                
                                                 $('.scr1').html(add1 + ' ');
                                                
                                                
                                                 
                                                
                                              }
                                               else
                                              {
                                                add1 = 0 ;
                                                $('.scr1').html(add1 + ' ');
                                              }
                                              if(document.getElementById("write2").checked) {
                                                add2 = 5000;
                                                $('.scr2').html(add2 + ' ');
                                                
                                                
                                                 
                                                
                                              }
                                               else
                                              {
                                                add2 = 0 ;
                                                $('.scr2').html(add2 + ' ');
                                              }
                                               if(document.getElementById("write3").checked) {
                                                add3 = 5000;
                                                $('.scr3').html(add3 + ' ');
                                                
                                                 
                                                 
                                                 
                                              }
                                               else
                                              {
                                                add3 = 0 ;
                                                $('.scr3').html(add3 + ' ');
                                              }
                                            

                                                var c = vidoe+voice+add+add1+add2+add3;
                                                 $('.tot').html(c + ' ');
                                                 $('.total').val(c);
                                              
                                        }



































       
       // if(document.getElementById("write").onclick = function() {
           
       //      alert('working');
            
       //      var a = $('#min').val();
       //      if(a > 1){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = $('.scr').attr('value_of');
       //          alert(dd);
       //          var vidoe = oo * a ;
       //          var voice = 5000 ;
       //          var script = 3000 ;
       //          // var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
       //  };

       //  $('.yes1').click(function(){
       //      $('.upload-script1').hide('slow');
            
            
       //      var a = $('#min').val();
       //      if(a > 0){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = $('.scr').attr('value_of');
       //          var vidoe = oo * a ;
       //          var voice = tt * a ;
       //          var script = dd * a ;
       //          var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
       //  });

       //         $('.no1').click(function(){
       //      $('.upload-script1').show('slow');
            
       //      var a = $('#min').val();
       //      if(a > 0){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = 0;
       //          var vidoe = oo * a ;
       //          var voice = tt * a ;
       //          var script = dd * a ;
       //          var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
            
       //  });
        

       //       $('.no2').click(function(){
       //      $('.upload-script2').show('slow');
            
       //      var a = $('#min').val();
       //      if(a > 0){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = 0;
       //          var vidoe = oo * a ;
       //          var voice = tt * a ;
       //          var script = dd * a ;
       //          var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
            
       //  });
       //  $('.yes2').click(function(){
       //      $('.upload-script2').hide('slow');
            
            
       //      var a = $('#min').val();
       //      if(a > 0){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = $('.scr').attr('value_of');
       //          var vidoe = oo * a ;
       //          var voice = tt * a ;
       //          var script = dd * a ;
       //          var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
       //  });

       //   $('.no3').click(function(){
       //      $('.upload-script3').show('slow');
            
       //      var a = $('#min').val();
       //      if(a > 0){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = 0;
       //          var vidoe = oo * a ;
       //          var voice = tt * a ;
       //          var script = dd * a ;
       //          var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
            
       //  });
       //  $('.yes3').click(function(){
       //      $('.upload-script3').hide('slow');
            
            
       //      var a = $('#min').val();
       //      if(a > 0){
       //          var oo = $('.vid').attr('value_of');
       //          var tt = $('.voi').attr('value_of');
       //          var dd = $('.scr').attr('value_of');
       //          var vidoe = oo * a ;
       //          var voice = tt * a ;
       //          var script = dd * a ;
       //          var sum = vidoe  + voice + script ;  
       //          $('.vid').html(vidoe + ' ');
       //          $('.voi').html(voice + ' ');
       //          $('.scr').html(script + ' ');
       //          $('.tot').html(sum + ' ');
       //          $('.total').val(sum );
       //      }
            
       //  });

       //  });



    // $(document).ready(function(){
 
    // });
    // $(document).ready(function(){
       
    // });
    // $(document).ready(function(){
       
    // });
</script>


</body>



</html>