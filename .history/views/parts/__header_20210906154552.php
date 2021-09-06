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
        <span>M2</span><span class="sidebar-title">Tech</span>
    </h1>
    <h1 class="logo logo-sm d-block d-md-none">
        <span>M2</span><span class="sidebar-title">Tech</span>
    </h1>
    <ul class="nav-sidebar">
        <li>
            <a href="index.php" <?php echo ($whichPage == 'home') ? 'class="my-active"' : ''; ?>>Trang chủ</a>
        </li>
        <li>
            <a href="index.php?action=posts" <?php echo ($whichPage == 'posts' && $category_id == 0) ? 'class="my-active"' : ''; ?>>Bài viết</a>
        </li>
        <?php foreach ($categories as $category) : ?>
            <li>
                <a <?php echo ($whichPage == 'posts' && $category_id == $category['id']) ? 'class="my-active"' : ''; ?> href="index.php?action=posts&category=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a><br>
            </li>
        <?php endforeach; ?>
        <li>
            <a href="index.php?action=aboutUs" <?php echo ($whichPage == 'aboutUs') ? 'class="my-active"' : ''; ?>>Giới thiệu</a>
        </li>
        <li>
            <a href="index.php?action=contact" <?php echo ($whichPage == 'contact') ? 'class="my-active"' : ''; ?>>Liên hệ</a>
        </li>
    </ul>
    <div class="sidebar-header">
        <h5>Social</h5>
        <div class="sidebar-header-img">
            <img src="public\assets\img\about-us.jpg" alt="ABOUT ME">
        </div>
        <small class="sidebar-header-desc">
            Trang blog của chúng mình chuyên cung cấp các thông tin hữu ích dành cho các bạn quan tâm đến
            các kiến thức về công nghệ thông tin, hệ thống thông tin, thương mại điện tử, marketing, ...
        </small>
        <ul class="d-md-flex d-none social">
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fab fa-tiktok"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="far fa-envelope"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fas fa-phone"></i></a></li>
        </ul>
        <ul class="d-flex d-md-none social social-sm">
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fab fa-tiktok"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="far fa-envelope"></i></a></li>
            <li><a class="text-decoration-none text-light" href="javascript:void(0)"><i class="fas fa-phone"></i></a></li>
        </ul>
    </div>
    <div class="sidebar-header">
        <h5>Nhận thông báo</h5>
        <small class="sidebar-header-desc">
            Đăng ký để nhận thông báo về những bài viết mới nhất
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
                <button type="submit" class="my-btn my-btn-lg">Gửi</button>
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
                    <button class="header-button open-sidebar btn btn-sm btn-out-line-none <?php echo ($whichPage == 'posts') ? 'text-dark' : 'text-light' ?>">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="col-lg-8 d-none d-lg-block text-center">
                    <ul class="nav-list <?php echo ($whichPage == 'posts') ? 'nav-list-dark' : '' ?>">
                        <li>
                            <a data-el="navbar" href="index.php" <?php echo ($whichPage == 'home') ? 'class="my-active"' : ''; ?>>Trang chủ</a>
                        </li>
                        <li>
                            <a data-el="navbar" href="index.php?action=posts" <?php echo ($whichPage == 'posts' && $category_id == 0) ? 'class="my-active"' : ''; ?>>Bài viết</a>
                        </li>
                        <?php foreach ($categories as $category) : ?>
                            <li>
                                <a data-el="navbar" <?php echo ($whichPage == 'posts' && $category_id == $category['id']) ? 'class="my-active"' : ''; ?> href="index.php?action=posts&category=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                        <li>
                            <a data-el="navbar" href="index.php?action=aboutUs" <?php echo ($whichPage == 'aboutUs') ? 'class="my-active"' : ''; ?>>Giới thiệu</a>
                        </li>
                        <li>
                            <a data-el="navbar" href="index.php?action=contact" <?php echo ($whichPage == 'contact') ? 'class="my-active"' : ''; ?>>Liên hệ</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 text-right">
                    <button class="header-button header-search-button btn btn-sm btn-outline-none <?php echo ($whichPage == 'posts') ? 'text-dark' : 'text-light' ?>">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>