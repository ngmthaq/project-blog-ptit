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
                            <span style="font-size: 42px;">Technology</span><span style="font-size: 42px;">Blog</span>
                        </h1>
                    </h6>
                    <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-12 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold my-4">
                        Categories
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
                        Useful links
                    </h6>
                    <p>
                        <a href="index.php" class="text-reset">Home</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Posts</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">About us</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Help</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-12 col-lg-3 col-xl-3 mx-auto mb-lg-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold my-4">
                        Contact
                    </h6>
                    <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
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
        <a class="text-reset fw-bold" href="index.php">homestayblog.com</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->