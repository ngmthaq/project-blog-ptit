<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <?php require_once('./views/parts/__head.php') ?>

    <style></style>
</head>

<body>
    <div class="main">
        <?php require_once('./views/parts/__header.php') ?>
        <section id="first-video">
            <video src="public\assets\img\video-clound.mp4" muted autoplay loop></video>
            <div class="black-layout"></div>
            <h1 class="logo">
                <span>Homestay</span>
                <br>
                <span class="sidebar-title">Blog</span>
            </h1>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="social-box text-center">
                            <a href="#" class="btn btn-outline-info">SUBSCRIBE</a>
                            <ul class="social">
                                <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a class="text-decoration-none text-light" href="#"><i class="fab fa-tiktok"></i></a></li>
                                <li><a class="text-decoration-none text-light" href="#"><i class="far fa-envelope"></i></a></li>
                                <li><a class="text-decoration-none text-light" href="#"><i class="fas fa-phone"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <small style="text-align: justify;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium molestiae, culpa,
                            iste voluptatem maiores modi facilis quidem autem quibusdam nobis sunt quisquam possimus
                            hic in odit perferendis soluta enim ducimus!
                        </small>
                    </div>
                    <div class="col-lg-4">
                        <small style="text-align: justify;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium molestiae, culpa,
                            iste voluptatem maiores modi facilis quidem autem quibusdam nobis sunt quisquam possimus
                            hic in odit perferendis soluta enim ducimus!
                        </small>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-container" id="second-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center text-light my-5">NEWEST</h3>
                    </div>
                </div>
                <div class="row">
                    <?php if (count($posts) > 0) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <div class="col-lg-4">
                                <div class="post" style="background-image: url('<?php echo $post['cover_path'] . MY_DIRECTORY_SEPARATOR . $post['cover_name'] ?>');">
                                    <a href="#" class="post-content text-decoration-none text-center">
                                        <h5><?php echo $post['title'] ?></h5>
                                        <p><span>Homestay</span> <span>|</span> <span><?php echo $post['category'] ?></span></p>
                                        <p>
                                            <?php echo $post['subtitle'] ?>
                                        </p>
                                        <p>
                                            <small>Post at <?php echo $post['date'] ?> by <?php echo $post['user'] ?></small>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12 text-center">
                            <a href="#" class="btn btn-dark my-2">LOAD MORE</a>
                        </div>
                    <?php else : ?>
                        <div class="col-12">We don't have any post in this page</div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="layout-pagination" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(./public/assets/img/layout-pagination-1.jpg);">
            <h1>CATEGORY</h1>
        </section>
        <div class="categories-list my-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel owl-theme">
                            <?php if (count($categories) > 0) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <div class="item" style="background-image: url(<?php echo $category['image'] ?>)">
                                        <a href="#" class="text-decoration-none text-dark text-center">
                                            <p><?php echo $category['name'] ?></p>
                                            <p>
                                                <small>
                                                    <?php echo $category['posts'] ?>
                                                    <?php echo $category['posts'] > 1 ? 'posts' : 'post' ?>
                                                </small>
                                            </p>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h5>We don't have any categories in this page</h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="aboutUs">
            <?php require_once('./views/parts/__about-us.php') ?>
        </section>

        <?php require_once('./views/parts/__contact.php') ?>

        <div class="layout-pagination" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(./public/assets/img/layout-pagination-2.jpg);"></div>
        <!-- <section class="test"></section> -->
        <?php require_once('./views/parts/__footer.php') ?>
    </div>

    <?php require_once('./views/parts/__script.php') ?>

    <script>
        $(function() {
            $(window).scroll(function() {
                console.log($(this).scrollTop());
                $('test').css('top', 'calc(40% + ' + $(this).scrollTop() * 1.1 + 'px)');
            });
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        })
    </script>
</body>

</html>