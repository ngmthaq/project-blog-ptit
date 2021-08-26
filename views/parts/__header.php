<!-- Search -->
<div class="search-modal">
    <div class="close-search-modal">
        <i class="fas fa-times"></i>
    </div>
    <form class="form form-inline d-lg-flex d-none" action="" method="post">
        <input type="text" name="search-input" class="form-control" id="search-input" placeholder="Search here ..." autocomplete="off">
        <!-- <button type="submit" class="btn btn-outline-dark text-light mr-2"><i class="fas fa-search"></i></button> -->
    </form>

    <form class="form form-sm form-inline d-flex d-lg-none" action="" method="post">
        <input type="text" name="search-input" class="form-control" id="search-input" placeholder="Search here ..." autocomplete="off">
        <button type="submit" class="btn btn-outline-dark text-light mr-2"><i class="fas fa-search"></i></button>
    </form>
</div>

<!-- Sidebar -->
<div class="sidebar ">
    <div class="close-sidebar">
        <i class="fas fa-times"></i>
    </div>
    <h1 class="logo d-md-block d-none">
        <span>Homestay</span><span class="sidebar-title">Blog</span>
    </h1>
    <h1 class="logo logo-sm d-block d-md-none">
        <span>Homestay</span><span class="sidebar-title">Blog</span>
    </h1>
    <ul class="nav-sidebar">
        <li>
            <a href="index.php" class='my-active'>Home</a>
        </li>
        <li>
            <a href="#">Posts</a>
        </li>
        <li>
            <a href="#">Categories</a>
        </li>
        <li>
            <a href="#">About us</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
    <div class="sidebar-header">
        <h5>Social</h5>
        <div class="sidebar-header-img">
            <img src="public\assets\img\homestay-about-me.jpg" alt="ABOUT ME">
        </div>
        <small class="sidebar-header-desc">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid minus quibusdam
            repellendus error impedit !
        </small>
        <ul class="d-md-flex d-none social">
            <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-tiktok"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="far fa-envelope"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="fas fa-phone"></i></a></li>
        </ul>
        <ul class="d-flex d-md-none social social-sm">
            <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-tiktok"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="far fa-envelope"></i></a></li>
            <li><a class="text-decoration-none text-light" href="#"><i class="fas fa-phone"></i></a></li>
        </ul>
    </div>
    <div class="sidebar-header">
        <h5>SUBSCRIBE</h5>
        <small class="sidebar-header-desc">
            Subscribe to our newsletter and get our newest updates right on your inbox.
        </small>
        <form action="" method="post">
            <div class="form-row">
                <input class="form-control" type="email" name="sub-email" id="sub-email" placeholder="Your email ...">
            </div>
            <div class="form-row">
                <div class="form-check-inline">
                    <input class="form-check-input my-1" type="checkbox" name="agree-condition" id="agree-condition">
                    <label class="form-check-label text-light" for="agree-condition" style="font-family: 'Poppins', serif; font-size: 12px;">
                        I agree to the terms & conditions
                    </label>
                </div>
            </div>
            <div class="form-row my-3">
                <button type="submit" class="my-btn my-btn-lg">SUBSCRIBE</button>
            </div>
        </form>
    </div>
</div>

<div class="my-modal"></div>

<!-- Header -->
<header>
    <nav>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-6">
                    <button class="open-sidebar btn btn-sm btn-out-line-none text-light">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="col-lg-8 d-none d-lg-block text-center">
                    <ul class="nav-list">
                        <li>
                            <a href="index.php" <?php echo ($whichPage == 'home') ? 'class="my-active"' : ''; ?>>Home</a>
                        </li>
                        <li>
                            <a href="#" <?php echo ($whichPage == 'posts') ? 'class="my-active"' : ''; ?>>Posts</a>
                        </li>
                        <li>
                            <a href="#" <?php echo ($whichPage == 'categories') ? 'class="my-active"' : ''; ?>>Categories</a>
                        </li>
                        <li>
                            <a href="#" <?php echo ($whichPage == 'about_us') ? 'class="my-active"' : ''; ?>>About us</a>
                        </li>
                        <li>
                            <a href="#" <?php echo ($whichPage == 'contact') ? 'class="my-active"' : ''; ?>>Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 text-right">
                    <button class="header-search-button btn btn-sm btn-outline-none text-light">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>