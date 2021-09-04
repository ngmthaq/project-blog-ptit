<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài viết</title>

    <?php require_once('./views/parts/__head.php') ?>

    <style>
        .box {
            width: inherit;
            padding: 24px 6px 6px;
        }

        .box img {
            width: 70%;
            display: flex;
            margin: 24px auto;
        }

        .breadcrumb-item.active {
            overflow: hidden;
            line-height: 24px;
            height: 24px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .newest-box {
            max-height: 640px;
            overflow-y: scroll;
            margin-bottom: 36px;
        }

        /* width */

        .newest-box::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */

        .newest-box::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 5px;
        }

        /* Handle */

        .newest-box::-webkit-scrollbar-thumb {
            background: #999;
            border-radius: 5px;
        }

        /* Handle on hover */

        .newest-box::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="main">
        <?php require_once('./views/parts/__header.php') ?>

        <h3 class="post-title text-center"></h3>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="index.php?action=posts">Bài viết</a></li>
                            <li class="breadcrumb-item"><a href="index.php?action=posts&category=<?php echo $post['category_id'] ?>"><?php echo $post['name'] ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo html_entity_decode($post['title']) ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="box">
                        <div>
                            <strong><?php echo html_entity_decode($post['title']) ?></strong>
                        </div>
                        <small>
                            Bởi <?php echo $post['user'] ?> - Ngày <?php echo date('d/m/Y', strtotime($post['date'])) ?>
                        </small>
                        <p class="text-justify">
                            <?php echo html_entity_decode($post['subtitle']) ?>
                        </p>
                        <img src="<?php echo $post['cover_path'] . MY_DIRECTORY_SEPARATOR . $post['cover_name'] ?>" alt="Ảnh bìa">
                        <br>
                    </div>
                    <div class="box">
                        <div class="text-justify">
                            <strong class="d-flex">1. <?php echo html_entity_decode($post['heading_1']) ?></strong>
                        </div>
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['paragraph_1_1']) ?>
                        </div>
                        <?php if ($images[1]['img_name'] != 'noname') : ?>
                            <img src="<?php echo $images[1]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[1]['img_name'] ?>" alt="ảnh">
                        <?php endif; ?>
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['paragraph_1_2']) ?>
                        </div>
                    </div>
                    <div class="box">
                        <div class="text-justify">
                            <strong class="d-flex">2. <?php echo html_entity_decode($post['heading_2']) ?></strong>
                        </div>
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['paragraph_2_1']) ?>
                        </div>
                        <?php if ($images[2]['img_name'] != 'noname') : ?>
                            <img src="<?php echo $images[2]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[2]['img_name'] ?>" alt="ảnh">
                        <?php endif; ?>
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['paragraph_2_2']) ?>
                        </div>
                    </div>
                    <div class="box">
                        <div class="text-justify">
                            <strong class="d-flex">3. <?php echo html_entity_decode($post['heading_3']) ?></strong>
                        </div>
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['paragraph_3_1']) ?>
                        </div>
                        <?php if ($images[3]['img_name'] != 'noname') : ?>
                            <img src="<?php echo $images[3]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[3]['img_name'] ?>" alt="ảnh">
                        <?php endif; ?>
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['paragraph_3_2']) ?>
                        </div>
                    </div>
                    <div class="box">
                        <div class="text-justify">
                            <?php echo html_entity_decode($post['last_paragraph']) ?>
                        </div>
                    </div>
                    <div class="box">
                        <a class="btn btn-sm btn-outline-primary mb-5" href="index.php?action=posts&category=<?php echo $post['category_id'] ?>"> &lt;&lt; Quay lại</a>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="mt-3" style="border-radius: 5px; border: 1px solid #ebebeb; padding: 8px;">
                        <h4 class="text-center">CATEGORIES</h4>
                        <ul class="post-categories">
                            <?php foreach ($categories as $category) : ?>
                                <li>
                                    <a <?php echo ($category['id'] == $category_id) ? 'style="color:#19c3dd;"' : '' ?> href="index.php?action=posts&category=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a>
                                    <small><?php echo ($category['posts'] > 99) ? '99+' : $category['posts'] ?> <?php echo ($category['posts'] > 1) ? 'posts' : 'post' ?></small>
                                </li>
                            <?php endforeach; ?>
                            <li>
                                <a href="index.php?action=posts">Tất cả bài viết</a>
                                <small>
                                    <?php
                                    $totalPosts = 0;
                                    foreach ($categories as $category) {
                                        $totalPosts += $category['posts'];
                                    }
                                    echo ($totalPosts > 99) ? '99+' : $totalPosts;
                                    echo ($totalPosts > 1) ? ' posts' : ' post';
                                    ?>
                                </small>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-header mt-5">
                        <h4 class="text-dark">SOCIAL</h4>
                        <div class="sidebar-header-img">
                            <img src="public\assets\img\homestay-about-me.jpg" alt="ABOUT ME">
                        </div>
                        <small class="sidebar-header-desc text-dark">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid minus quibusdam
                            repellendus error impedit !
                        </small>
                        <ul class="d-md-flex d-none social">
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fab fa-tiktok"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="far fa-envelope"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fas fa-phone"></i></a></li>
                        </ul>
                        <ul class="d-flex d-md-none social social-sm">
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fab fa-tiktok"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="far fa-envelope"></i></a></li>
                            <li><a class="text-decoration-none text-dark" href="#"><i class="fas fa-phone"></i></a></li>
                        </ul>
                    </div>
                    <div class="sidebar-header mt-5">
                        <h4 class="text-dark">SUBSCRIBE</h4>
                        <small class="sidebar-header-desc text-dark">
                            Subscribe to our newsletter and get our newest updates right on your inbox.
                        </small>
                        <form action="" method="post">
                            <div class="form-row">
                                <input class="form-control" type="email" name="sub-email" id="sub-email" placeholder="Your email ...">
                            </div>
                            <div class="form-row">
                                <div class="form-check-inline">
                                    <input class="form-check-input my-1" type="checkbox" name="agree-condition" id="agree-condition-posts">
                                    <label class="form-check-label text-dark" for="agree-condition-posts" style="font-family: 'Poppins', serif; font-size: 12px;">
                                        I agree to the terms & conditions
                                    </label>
                                </div>
                            </div>
                            <div class="form-row my-3">
                                <button type="submit" class="my-btn my-btn-lg">SUBSCRIBE</button>
                            </div>
                        </form>
                    </div>
                    <?php if (count($sixPosts) > 0) : ?>
                        <h4 class="mt-5">CÙNG THỂ LOẠI</h4>
                        <div class="newest-box">
                            <?php foreach ($sixPosts as $newPost) : ?>
                                <div class="card mb-1">
                                    <div class="img">
                                        <img width="100%" src="<?php echo $newPost['cover_path'] . MY_DIRECTORY_SEPARATOR . $newPost['cover_name'] ?>" alt="<?php echo $newPost['id'] ?>" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <a href="index.php?action=posts&category=<?php echo $newPost['category_id'] ?>" class="card-text">
                                            <small class="text-muted">
                                                <?php echo $newPost['category'] ?>
                                            </small>
                                        </a>
                                        <a href="index.php?action=post&id=<?php echo $newPost['id'] ?>" class="text-reset mt-1">
                                            <h5 class="card-title title-posts"><?php echo html_entity_decode($newPost['title']) ?></h5>
                                        </a>
                                        <div class="card-text subtitle-posts">
                                            <?php echo html_entity_decode($newPost['subtitle']) ?>
                                        </div>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Post at <?php echo date('d-m-Y', strtotime($newPost['date'])) ?> by <?php echo $newPost['user'] ?>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif;  ?>
                </div>
            </div>
        </div>


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
        })
    </script>
</body>

</html>