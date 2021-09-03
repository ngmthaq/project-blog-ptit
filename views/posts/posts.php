<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài viết</title>

    <?php require_once('./views/parts/__head.php') ?>

    <style></style>
</head>

<body>
    <div class="main">
        <?php require_once('./views/parts/__header.php') ?>

        <h1 class="post-title text-center">NEWEST</h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <!-- First box -->
                    <?php if ($firstPost) : ?>
                        <div class="first-post-box">
                            <div class="card my-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4" style="padding: 1.25rem 0 1.25rem 1.25rem;">
                                        <img style="border-radius: 10px;" width="100%" src="<?php echo $firstPost['cover_path'] . MY_DIRECTORY_SEPARATOR . $firstPost['cover_name'] ?>" alt="<?php echo $firstPost['id'] ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="#" class="card-text">
                                                <small class="text-muted">
                                                    <?php echo $firstPost['category'] ?>
                                                </small>
                                            </a>
                                            <a href="#" class="text-reset mt-1">
                                                <h5 class="card-title"><?php echo html_entity_decode($firstPost['title']) ?></h5>
                                            </a>
                                            <p class="card-text"><?php echo html_entity_decode($firstPost['subtitle']) ?></p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Post at <?php echo date('d-m-Y', strtotime($firstPost['date'])) ?> by <?php echo $firstPost['user'] ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <p class="col-12 text-center mt-5">Không có bài viết</p>
                    <?php endif; ?>
                    <!-- Another box -->
                    <div class="posts-box row">
                        <?php if (count($posts) > 0) : ?>
                            <?php foreach ($posts as $post) : ?>
                                <div class="col-xl-4 col-md-6 col-12 mb-4">
                                    <div class="card">
                                        <div class="img">
                                            <img width="100%" src="<?php echo $post['cover_path'] . MY_DIRECTORY_SEPARATOR . $post['cover_name'] ?>" alt="<?php echo $post['id'] ?>" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <a href="index.php?action=posts&category=<?php echo $post['category_id'] ?>" class="card-text">
                                                <small class="text-muted">
                                                    <?php echo $post['category'] ?>
                                                </small>
                                            </a>
                                            <a href="#" class="text-reset mt-1">
                                                <h5 class="card-title title-posts"><?php echo html_entity_decode($post['title']) ?></h5>
                                            </a>
                                            <div class="card-text text-justify subtitle-posts">
                                                <?php echo html_entity_decode($post['subtitle']) ?>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Post at <?php echo date('d-m-Y', strtotime($post['date'])) ?> by <?php echo $post['user'] ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                </div>
            </div>
            <div class="row">
                <div class="text-center col-lg-12 my-5">
                    <a href="#" data-category="<?php echo $category_id ?>" data-page="<?php echo $page ?? 1 ?>" class="loadmore btn btn-outline-info">LOAD MORE</a>
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

            $('a.loadmore').click(function(e) {
                e.preventDefault();
                $.ajax({
                    method: "get",
                    url: "index.php?action=loadMorePosts",
                    data: {
                        page: parseInt($('a.loadmore').attr('data-page')) + 1,
                        category: $('a.loadmore').attr('data-category')
                    },
                    success: function(response) {
                        decode_response = JSON.parse(response)
                        $('a.loadmore').attr('data-page', decode_response.page);
                        if (decode_response.posts.length < 6) {
                            $('a.loadmore').css('display', 'none');
                        }
                        $.each(decode_response.posts, function(indexInArray, valueOfElement) {
                            $('.posts-box.row').append(
                                `<div class="col-xl-4 col-md-6 col-12 mb-4">
                                    <div class="card">
                                        <img width="100%" src="${valueOfElement.cover_path}/${valueOfElement.cover_name}" alt="${valueOfElement.id}" class="card-img-top">
                                        <div class="card-body">
                                            <a href="#" class="card-text">
                                                <small class="text-muted">
                                                    ${valueOfElement.category}
                                                </small>
                                            </a>
                                            <a href="#" class="text-reset mt-1">
                                                <h5 class="card-title text-justify">
                                                    ${valueOfElement.title}
                                                </h5>
                                            </a>
                                            <p class="card-text text-justify">
                                                ${valueOfElement.subtitle}
                                            </p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Post at ${valueOfElement.date} by ${valueOfElement.user}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        })
    </script>
</body>

</html>