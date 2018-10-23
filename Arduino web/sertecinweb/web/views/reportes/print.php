 <?php require "../../../controller/session.php" ?>
 <?php require "../../../controller/funciones.php" ?>
 <?php 


    // if ( isset($_POST['print']) ) {
    //   	include_once('ver.php');
    // }
    
    if ( isset($_POST['excel']) ) {
       header("Location: excel.php");
    }
    if ( isset($_POST['word']) ) {
       header("Location: word.php");
    }
     if ( isset($_POST['pdf']) ) {
       header("Location: pdf.php");
    }
  ?>
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>Sertecinweb</title>
      <!--meta tags -->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="Excess Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
         Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
      <script>
         addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
            window.scrollTo(0, 1);
         }
      </script>
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="../../css/font-awesome2.css" rel="stylesheet">
      <!-- //font-awesome icons -->
      <!-- Nav-CSS -->  
      <link rel="stylesheet" href="../../css/main.css">
      <!-- //Nav-CSS -->
      <link href="../../css/popup-box.css" rel="stylesheet" type="text/css" media="all" />
      <!-- //pop-ups-->
      <!--popup-box-->
      <link href="../../css/owl.carousel.css" rel="stylesheet">
      <!--clients-->
      <!--lightbox slider-->
      <link rel="stylesheet" href="../../css/lightbox.css">
      <!-- lightbox slider-->
      <!--stylesheets-->
      <link href="../../css/style2.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
   </head>
   <body>
      <div class="header-outs" id="home">
     
         <div class="header-w3layouts">
           
 <div class="agileits_w3layouts_nav">
<div id="toggle_m_nav">
  <div id="m_nav_menu" class="m_nav">
    <div class="m_nav_ham" id="m_ham_1"></div>
    <div class="m_nav_ham" id="m_ham_2"></div>
    <div class="m_nav_ham" id="m_ham_3"></div>
  </div>
</div>

<!-- This is the general container and content that makes up the navbar itself
 -->
<div id="m_nav_container" class="m_nav">
  <ul id="m_nav_list" class="m_nav">
   <li class="m_nav_itemm" id="m_nav_item_1">
      <a href="../acciones.php" >Acciones</a>
   </li>
   <li class="m_nav_item" id="moble_nav_item_2"><a href="#about" class="scroll">Imprimir</a></li>
   <li class="m_nav_item" id="moble_nav_item_3"> <a href="#services" class="scroll">Estadisticas</a></li>
   <li class="m_nav_item" id="moble_nav_item_4"><a href="#gallery" class="scroll">Contactos</a></li>
   <li class="m_nav_item" id="moble_nav_item_4">
      <a href="../../../controller/logout.php" class="scroll">Desloguearse</a>
   </li>
   <!--<li class="m_nav_item" id="moble_nav_item_6"> <a href="#blog" class="scroll">Blog</a></li>
   <li class="m_nav_item" id="moble_nav_item_7"> <a href="#contact" class="scroll">Contact</a></li>-->
  </ul>
</div>
               </div>
             <div class="container">
               <div class="hedder-logo">
                  <h1><a href="index.php">Sertecinweb</a></h1>
                  <h4 class="text-light">Usuario Logueado: <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']."<br>"."Cédula: V-".$_SESSION['cedula'] ?> </h4>
               </div>
            </div>
            <div class="clearfix"> </div>
         </div>
         <!-- Slideshow 4 -->
         <div class="slider">
            <div class="callbacks_container">
               <ul class="rslides" id="slider4">
                  <li>
                     <div class="slider-img">
                        <div class="container">
                           <div class="slider-info">
                              <h4>Para cualquier duda con el sistema<br>Llamar inmediatamente:
                              </h4>
                              <p>0414 291 1635 / 0416 615 9037
                              </p>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="slider-img ">
                        <div class="container">
                           <div class="slider-info">
                              <h4>Notificar al cliente cuando se haya realizado el rescate
                              </h4>
                              <p> Luego notificar al director general.
                              </p>
                           </div>
                        </div>
                     </div>
                  </li>                   
               </ul>
            </div>
            <div class="clearfix"> </div>
         </div>
      </div>
                        </div>
                        <div class="clearfix"> </div>
                     </div>
                     <div class="clearfix"> </div>
                  </div>
               </div>
               <div class="clearfix"> </div>
            </div>
         </div>
      </div>
      <div class="blog" id="blog">
         <div class="container">
            <h4 class="title ">
            	Comandos ejecutados por
			<?php 
			echo $_SESSION['nombre']." ".$_SESSION['apellido']." CI: V-".$_SESSION['cedula'] ;
			?>
			</h4>      
               <div class="col mb-4">
               	<?php 

               	if ( isset($_POST['print']) ) {
			      	include_once('ver.php');
			    }

               	 ?>
                  <div class="inner-info-w3ls"></div>                  
               </div>
               <div class="clearfix"></div>
            </div>
            
      <footer>
         <div class="container">
            <div class="agileits-contact-addrss">
               <div class="top-gap">
                  <div class="header-side">
                     <p> 
                        © 2018 Todos los derechos reservados Sertecin 1118
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </footer>

      <!--js working-->
      <!-- <script src='../../js/jquery-2.2.3.min.js'></script> -->
      <script src='../../js/jquery-3.3.1.min.js'></script>

      <!--//js working-->
            <!--  light box js -->
      <script src="../../js/lightbox-plus-jquery.min.js"> </script> 
      <!-- //light box js--> 

      <!--responsiveslides banner-->
      <script src="../../js/responsiveslides.min.js"></script>
      <script>
         // You can also use "$(window).load(function() {"
         $(function () {
            // Slideshow 4
            $("#slider4").responsiveSlides({
               auto: true,
               pager:false,
               nav:true,
               speed: 900,
               namespace: "callbacks",
               before: function () {
                  $('.events').append("<li>before event fired.</li>");
               },
               after: function () {
                  $('.events').append("<li>after event fired.</li>");
               }
            });
         
         });
      </script>
      <!--// responsiveslides banner-->     
     
      <!-- testimonial-plugin -->
      <script src="../../js/owl.carousel.js"></script>
      <script>
         $(document).ready(function () {
            $("#owl-demo").owlCarousel({
               items: 1,
               lazyLoad: true,
               autoPlay: true,
               navigation: true,
               navigationText: true,
               pagination: true,
            });
         });
      </script>
      <!-- //testimonial-plugin -->

      <!--pop-up-box video-->
      <script src="../../js/jquery.magnific-popup.js"></script>
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
      <!-- //pop-up-box video -->
     
      <!-- start-smoth-scrolling -->
      <script src="../../js/move-top.js"></script>
                 <!-- menu -->
      <script src="../../js/main.js"></script>
      <!-- //menu -->
     
      <!--bootstrap working-->
  <script src="../../js/bootstrap.min.js"></script>
      <!-- //bootstrap working-->
      <script src="../../js/easing.js"></script>
      <script>
         jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
               event.preventDefault();
               $('html,body').animate({
                  scrollTop: $(this.hash).offset().top
               }, 1000);
            });
         });
      </script>
      <!-- start-smoth-scrolling -->
      <!-- for-bottom-to-top smooth scrolling -->
      <script>
         $(document).ready(function () {
            /*
               var defaults = {
               containerID: 'toTop', // fading element id
               containerHoverID: 'toTopHover', // fading element hover id
               scrollSpeed: 1200,
               easingType: 'linear' 
               };
            */
            $().UItoTop({
               easingType: 'easeOutQuart'
            });
         });
      </script>
      <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
  

   </body>
</html>