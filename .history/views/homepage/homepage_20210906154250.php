<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M2Tech | Trang thông tin về công nghệ thông tin, hệ thống thông tin, marketing thương mại điện tử</title>

    <?php require_once('./views/parts/__head.php') ?>

    <style></style>
</head>

<body>
    <div class="main">
        <?php require_once('./views/parts/__header.php') ?>
        
        <?php require_once('./views/parts/__first-video.php') ?>

        <section class="section-container" id="second-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center text-light my-5">MỚI NHẤT</h3>
                    </div>
                </div>
                <div class="row">
                    <?php if (count($posts) > 0) : ?>
                        <?php $i = 0 ?>
                        <?php foreach ($posts as $post) : ?>
                            <?php $i++; ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="post <?php echo ($i > 3) ? 'd-none d-md-flex' : '' ?>" style="background-image: url('<?php echo $post['cover_path'] . MY_DIRECTORY_SEPARATOR . $post['cover_name'] ?>');">
                                    <div class="post-content text-decoration-none text-center d-none d-lg-flex">
                                        <h5><a href="#" class="title-homepage text-reset"><?php echo html_entity_decode($post['title']) ?></a></h5>
                                        <p><?php echo $post['category'] ?></p>
                                        <div class="subtitle-homepage">
                                            <?php echo html_entity_decode($post['subtitle']) ?>
                                        </div>
                                        <p>
                                            <small>Đăng ngày <?php echo date('d-m-Y', strtotime($post['date'])) ?> bởi <?php echo $post['user'] ?></small>
                                        </p>
                                    </div>
                                    <div class="post-content text-decoration-none text-center d-flex d-lg-none" style="background-color: rgba(0, 0, 0, 0.7); color: #f5f5f5;">
                                        <h5><a href="#" class="title-homepage text-light"><?php echo html_entity_decode($post['title']) ?></a></h5>
                                        <p><?php echo $post['category'] ?></p>
                                        <div class="subtitle-homepage">
                                            <?php echo html_entity_decode($post['subtitle']) ?>
                                        </div>
                                        <p>
                                            <small>Đăng ngày <?php echo date('d-m-Y', strtotime($post['date'])) ?> bởi <?php echo $post['user'] ?></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12 text-center">
                            <a href="index.php?action=posts" class="btn btn-dark my-2">MORE POSTS</a>
                        </div>
                    <?php else : ?>
                        <div class="col-12">We don't have any post in this page</div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="layout-pagination" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(./public/assets/img/layout-pagination-1.jpg);">
            <h1>Danh mục</h1>
        </section>
        
        <div class="categories-list my-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel owl-theme">
                            <?php if (count($categories) > 0) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <div class="item" style="background-image: url(<?php echo $category['image'] ?>)">
                                        <a href="index.php?action=posts&category=<?php echo $category['id'] ?>" class="text-decoration-none text-dark text-center d-lg-none d-flex">
                                            <p><?php echo $category['name'] ?></p>
                                            <p>
                                                <small>
                                                    <?php echo $category['posts'] - $category['deleted'] ?>
                                                    <?php echo $category['posts'] - $category['deleted'] > 1 ? 'posts' : 'post' ?>
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
                $('test').css('top', 'calc(40% + ' + $(this).scrollTop() * 1.1 + 'px)');
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            $('.subtitle-homepage a').addClass('text-reset');
        })
    </script>
</body>

</html>