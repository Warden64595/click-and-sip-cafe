<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Click And Sip Cafe</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2Hhh_14Uam62GXGaTMcXWhhVkYg0EbDY&callback=initMap" async defer></script>

        <!-- Custom CSS File Link -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/convo.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><!-- font awesome cdn link -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->
    </head>
    <body>
        <!-- HEADER SECTION -->
        <header class="header">
            <a href="#" class="logo">
                <img src="assets/images/logo.jpg" class="img-logo" alt="Click and Sip">
            </a>

            <!-- MAIN MENU FOR SMALLER DEVICES -->
            <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="#home" class="text-decoration-none">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#menu" class="text-decoration-none">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="text-decoration-none">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="users/login.php" class="text-decoration-none">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="icons">
                <div class="fas fa-search" id="search-btn"></div>
                <div class="fas fa-shopping-cart" id="cart-btn" onclick="redirectCart()"></div>
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>

            <!-- SEARCH TEXT BOX -->
            <div class="search-form">
                <input type="search" id="search-box" class="form-control" placeholder="search here...">
                <label for="search-box" class="fas fa-search"></label>
            </div>

            <!-- CART SECTION -->
            <div class="cart">
                <h2 class="cart-title">Your Cart:</h2>
                <div class="cart-content">
                    
                </div>
                <div class="total">
                    <div class="total-title">Total: </div>
                    <div class="total-price">₱0</div>
                </div>
                <!-- BUY BUTTON -->
                <button type="button" class="btn-buy">Order Now</button>
            </div>
        </header>

        <!-- HERO SECTION -->
        <section class="home" id="home">
            <div class="content">
                <h3>Click And Sip Cafe</h3>
                <p>
                    <strong>"LASAPANG SARAP"</strong>
                </p>
                <a href="#menu" class="btn btn-dark text-decoration-none">Buy Now!</a>
            </div>
        </section>

<!-- MENU SECTION -->
<section class="menu" id="menu">
    <h1 class="heading">Our <span>Menu</span></h1>

    <div class="box-container">
        <div class="container">

            <!-- ROW 1 -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="box text-center">
                        <img src="assets/images/cart-item-1.png" class="product-img img-fluid">
                        <h3 class="product-title">Americano - Hot Espresso (12 OZ)</h3>
                        <div class="price">₱45.00</div>
                        <a class="btn add-cart" onclick="redirectCart()">Add to Cart</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box text-center">
                        <img src="assets/images/cart-item-2.png" class="product-img img-fluid">
                        <h3 class="product-title">Colombian Supremo Cup (12 OZ)</h3>
                        <div class="price">₱40.00</div>
                        <a class="btn add-cart" onclick="redirectCart()">Add to Cart</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box text-center">
                        <img src="assets/images/cart-item-3.png" class="product-img img-fluid">
                        <h3 class="product-title">Nitro Cold Brew w/ Straw (12 OZ)</h3>
                        <div class="price">₱50.00</div>
                        <a class="btn add-cart" onclick="redirectCart()">Add to Cart</a>
                    </div>
                </div>
            </div>

            <!-- HIDDEN ROW -->
            <div class="row g-4 row-to-hide mt-3">
                <div class="col-md-4">
                    <div class="box text-center">
                        <img src="assets/images/cart-item-10.png" class="product-img img-fluid">
                        <h3 class="product-title">Ethiopian Yirgacheffe Cup (12 OZ)</h3>
                        <div class="price">₱55.00</div>
                        <a class="btn add-cart" onclick="redirectCart()">Add to Cart</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box text-center">
                        <img src="assets/images/cart-item-11.png" class="product-img img-fluid">
                        <h3 class="product-title">Cold Brew Tonic In a Cup (12 OZ)</h3>
                        <div class="price">₱35.00</div>
                        <a class="btn add-cart" onclick="redirectCart()">Add to Cart</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box text-center">
                        <img src="assets/images/cart-item-12.png" class="product-img img-fluid">
                        <h3 class="product-title">Caramel Cold Foam Cold Brew (12 OZ)</h3>
                        <div class="price">₱55.00</div>
                        <a class="btn add-cart" onclick="redirectCart()">Add to Cart</a>
                    </div>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="text-center mt-4">
                <button id="showHideBtn" class="btn btn-dark">SHOW MORE</button>
            </div>

        </div>
    </div>
</section>

        <!-- CONTACT US SECTION -->
        <section class="contact" id="contact">
            <h1 class="heading"><span>Contact</span> Us</h1>
            <div class="row">
                <div id="map" class="map pull-left"></div>
                <form name="contact" method="POST" action="">
                    <h3> Get in touch with us!</h3>
                    <div class="inputBox">
                        <span class="fas fa-envelope"></span>
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="inputBox">
                        <textarea name="message" placeholder="Enter your message..."></textarea>
                    </div>
                    <button type="submit" class="btn">Contact Now</button>
                </form>
            </div>
        </section>
          <!-- FOOTER SECTION -->
        <section class="footer">
            <div class="footer-container">
                <div class="logo">
                    <img src="assets/images/logo.jpg" class="img"><br />
                    <i class="fas fa-envelope"></i>
                    <p>clickandsip@gmail.com</p><br />
                    <i class="fas fa-phone"></i>
                    <p>+422</p><br />
                    <i class="fab fa-facebook-messenger"></i>
                    <p>click</p><br />
                </div>
            </div>
        </section>

     
        <!-- CHAT BAR BLOCK -->
        <div class="chat-bar-collapsible">
            <button id="chat-button" type="button" class="collapsible">Chat with us! &nbsp;
                <i id="chat-icon" style="color: #fff;" class="fas fa-comments"></i>
            </button>
            <div class="content">
                <div class="full-chat-block">
                    <!-- Message Container -->
                    <div class="outer-container">
                        <div class="chat-container">
                            <!-- Messages -->
                            <div id="chatbox">
                                <h5 id="chat-timestamp"></h5>
                                <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                            </div>
                            <!-- User input box -->
                            <div class="chat-bar-input-block">
                                <div id="userInput">
                                    <input id="textInput" class="input-box" type="text" name="msg"
                                        placeholder="Tap 'Enter' to send a message">
                                    <p></p>
                                </div>
                                <div class="chat-bar-icons">
                                    <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-paper-plane"
                                        onclick="sendButton()"></i>
                                </div>
                            </div>
                            <div id="chat-bar-bottom">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JS File Link -->
        <script src="assets/js/responses.js"></script>
        <script src="assets/js/convo.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
            // CODE FOR THE FORMSPREE
            window.onbeforeunload = () => {
                for(const form of document.getElementsByTagName('form')) {
                    form.reset();
                }
            }

            // CODE FOR THE GOOGLE MAPS API
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 14.4793, lng: 120.8969},
        zoom: 14
    });

    var marker = new google.maps.Marker({
        position: {lat: 14.4793, lng: 120.8969},
        map: map,
        title: 'Parañaque, Philippines'
    });
            }

            // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN MENU
            $(document).ready(function() {
                $(".row-to-hide").hide();
                $("#showHideBtn").text("SHOW MORE");
                $("#showHideBtn").click(function() {
                    $(".row-to-hide").toggle();
                    if ($(".row-to-hide").is(":visible")) {
                        $(this).text("SHOW LESS");
                    } else {
                        $(this).text("SHOW MORE");
                    }
                });
            });

            // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN GALLERY
            $(document).ready(function() {
                $(".pic-to-hide").hide();
                $("#showBtn").text("SHOW MORE");
                $("#showBtn").click(function() {
                    $(".pic-to-hide").toggle();
                    if ($(".pic-to-hide").is(":visible")) {
                        $(this).text("SHOW LESS");
                    } else {
                        $(this).text("SHOW MORE");
                    }
                });
            });

            // CODE FOR THE REDIRECT CART
            function redirectCart() {
                // Check if the user is logged in
                if(!"<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : '' ?>") {
                    // Redirect the user to the login page
                    alert("You are not logged in. Please log into your account and try again.");
                    window.location.href = "users/login.php";
                }
            }
        </script> 
    </body>
</html>
