<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Trading Screen</title>


    <!-- Additional CSS Files -->
    
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-breezed.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!-- <style>
        .sentiment_class{
            background-color: (38, 48, 64, 10);
            border: white;
            margin-right: 0%;
            border-right: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            text-align: right;
            width: 80%;
            color: white;
            align-content: right;
            z-index: 9;
        }
    </style> -->

    </head>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function call_flask_file(){
            alert("Trading has started");
            
            $.ajax({
                url: 'http://127.0.0.1:5000/start',
                
                success: function(data) {
                $('#console').append("Trading started! /n");
                }
            });
        }
        function get_sentiment(){
            $.ajax({
                url: 'get_sentiment_infy.php',
                
                success: function(data) {
                $('#infy').html(data);
                
                }
            });
            $.ajax({
                url: 'get_sentiment_TCS.php',
                
                success: function(data) {
                $('#tcs').html(data);
                
                }
            });
            $.ajax({
                url: 'get_sentiment_Accenture.php',
                
                success: function(data) {
                $('#acn').html(data);
                
                }
            });
            $.ajax({
                url: 'get_sentiment_ACC.php',
                
                success: function(data) {
                $('#acc').html(data);
                
                }
            });
            $.ajax({
                url: 'get_sentiment_ITC.php',
                
                success: function(data) {
                $('#itc').html(data);
                
                }
            });
        }
        function call_logs_updation(){
            
            $.ajax({
                url: 'logs_updation.php',
                
                success: function(data) {
                if(data!=""){
                    $.ajax({
                        url: 'logs_updation2.php',
                        
                        success: function(data) {
                        
                    }
                    });
                $("#console").append("\n" +data)
                
            }
            }
            });
           
        }
        function recall(){
        var start= window.setInterval(function(){
       /// call your function here
       
        call_logs_updation();
        }, 800);
    }
        function stop_flask_file(){
            
            
            $.ajax({
                url: 'http://127.0.0.1:5000/stop',
                
                success: function(data) {
                $('#console').append("stopping done!!");
                }
            });
            alert("Trading Stopped!");
            
        }
        function stop_recall(){
            window.clearInterval(start);
            return("trading stopped");
        }
        $(document).ready(function abc() {
            $.ajax({
                url: 'http://127.0.0.1:5002/get_sentiment',
                
                success: function(data) {
                
                    
                }
            });
            
        })
        function repeat(){
            var rr=window.setInterval(function(){
                get_sentiment();
                abc();
                
                
            }, 10000);
        }
    
    </script>
    <body onload="repeat()">
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            TRADING SCREEN
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="..\..\html\index.php
                            " class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="#projects">Projects</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Drop Down</a>
                                <ul>
                                    <li><a href="">About Us</a></li>
                                    <li><a href="">Features</a></li>
                                    <li><a href="">FAQ's</a></li>
                                    <li><a href="">Blog</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="#contact-us">Contact Us</a></li> 
                            
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner header-text" id="top">
        <div class="Modern-Slider">
          
          <!-- Item -->
          <div class="item">
            <div class="img-fill">
                <img src="assets/images/slide-03.jpg" alt="">
                <div class="text-content">
                  <h3>High Performance</h3>
                  <h5>Robust and Speedy Trading Bot</h5>
                  <a href="#" class="main-filled-button" id="start_trading" onclick="call_flask_file(); recall();">Start Trading</a>
                  <a href="#" class="main-stroked-button" id="stop_trading" onclick="stop_flask_file(); stop_recall();">Stop Trading</a>
                  <br><br>
                  <div style="background-color: (38, 48, 64, 10);
                            border-color: white;
                            
                            border-right: 0px;
                            padding: 50px;
                            padding-bottom:0px;
                            text-align: bottom;
                            width: 100%;
                            height: 30%;
                            color: white;
                            align-content: right;
                            z-index: 1;">
                        <h3>Social Media Sentiment:</h3>
                        <h6>Infosys : &nbsp; <span id="infy">getting data...</span></h6>
                        <h6>TCS : &nbsp; <span id="tcs">getting data...</span></h6>
                        <h6>Accenture : &nbsp; <span id="acn">getting data...</span></h6>
                        <h6>ACC : &nbsp; <span id="acc">getting data...</span></h6>
                        <h6>ITC : &nbsp; <span id="itc">getting data...</span></h6>
                    </div>
                    
                
                </div>
                
            </div>
            
          </div>
          
          <!-- // Item -->
        
    </div>
    
    
    <div class="scroll-down scroll-to-section"><a href="#about"><i class="fa fa-arrow-down"></i></a></div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>About Us</h6>
                            <h2>We work to improve your stocks trading experience!</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/service-item-01.png" alt="">
                                    <h4>Top Notch</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/service-item-01.png" alt="">
                                    <h4>Robust</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/contact-info-03.png" alt="">
                                    <h4>Reliable</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/contact-info-03.png" alt="">
                                    <h4>Up-to-date</h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="main-button-icon">
                                    Learn More <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="right-text-content">
                        <textarea rows="15" cols="60" id="console" disabled style="border: 5px;
                            
                            background-color: black;
                            color: #ffffff;
                            font-size: 20px;">Trading Console:</textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Area Ends ***** -->    
    <!-- python code of trading algorithm -->
    

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>