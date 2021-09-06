<!-- Footer -->
<a href="#" id="scroll-to-top" title="Go to top">
    <i class="fas fa-chevron-up"></i>
</a>
<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Get connected with us:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="" class="me-4 text-reset d-inline-block mx-2">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset d-inline-block mx-2">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset d-inline-block mx-2">
                <i class="fab fa-tiktok"></i>
            </a>
            <a href="" class="me-4 text-reset d-inline-block mx-2">
                <i class="far fa-envelope"></i>
            </a>
            <a href="" class="me-4 text-reset d-inline-block mx-2">
                <i class="fas fa-phone"></i>
            </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-12 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <h1 class="logo mb-2" style="font-size: 32px; padding-top: 0;">
                            <span style="font-size: 42px;">M2</span><span style="font-size: 42px;">Tech</span>
                        </h1>
                    </h6>
                    <p>
                        Trang blog của chúng mình chuyên cung cấp các thông tin hữu ích dành cho các bạn quan tâm đến
                        các kiến thức về công nghệ thông tin, hệ thống thông tin, thương mại điện tử, marketing, ...
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-12 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold my-4">
                        Danh mục
                    </h6>
                    <?php foreach ($categories as $category) : ?>
                        <p>
                            <a href="#!" class="text-reset"><?php echo $category['name'] ?></a>
                        </p>
                    <?php endforeach; ?>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-12 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold my-4">
                        Đường dẫn
                    </h6>
                    <p>
                        <a href="index.php" class="text-reset">Trang chủ</a>
                    </p>
                    <p>
                        <a href="index.php?action=posts" class="text-reset">Bài viết</a>
                    </p>
                    <p>
                        <a href="index.php?action=about-us" class="text-reset">Giới thiệu</a>
                    </p>
                    <p>
                        <a href="index.php?action=contact" class="text-reset">Liên hệ</a>
                    </p>
                    <?php if (empty($_SESSION['user'])) : ?>
                        <p>
                            <a  class="text-reset" href="index.php?controller=admin">Đăng nhập</a>
                        </p>
                    <?php else : ?>
                        <p>
                            <a  class="text-reset" href="index.php?controller=admin&action=manager">Quản lý</a>
                        </p>
                    <?php endif; ?>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-12 col-lg-3 col-xl-3 mx-auto mb-lg-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold my-4">
                        Contact
                    </h6>
                    <p><i class="fas fa-home me-3"></i>Km10, Đường Nguyễn Trãi, Q.Hà Đông, Hà Nội</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        ngmthaq12@gmail.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 84 522 </p>
                    <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="index.php">M2Tech</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->