<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài viết</title>

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
                <div class="col-12">
                    <a href="index.php?controller=admin&action=manager" class="btn btn-primary my-5"> &lt;&lt; Quay lại</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-12">
                    <form action="index.php?controller=admin&action=edit&post_id=<?php echo $post['id'] ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-row">
                            <!-- Chọn danh mục -->
                            <div class="form-group col-6">
                                <label for="category">Danh mục</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <?php foreach ($categories as $category) : ?>
                                        <?php if ($category['id'] == $post['category_id']) : ?>
                                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($categories as $category) : ?>
                                        <?php if ($category['id'] == $post['category_id']) : ?>
                                            <option class='d-none' value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo (isset($err['category_id'])) ? '<small class="text-danger d-block">' . $err['category_id'] . '</small>' : '' ?>
                            </div>

                            <!-- Chọn ngày đăng -->
                            <div class="form-group col-6">
                                <label for="date">Ngày đăng</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?php echo $post['date'] ?? "" ?>">
                                <small class="d-block text-danger">Nếu dùng Chrome hoặc Cốc Cốc sẽ hiển thị định dạng "Tháng - Ngày - Năm"</small>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="box">
                            <div>
                                <small><strong>Tên bài viết</strong></small>
                                <textarea name="title" id="title"><strong><?php echo html_entity_decode($post['title']) ?></strong></textarea>
                                <?php echo (isset($err['title'])) ? '<small class="text-danger d-block">' . $err['title'] . '</small>' : '' ?>
                            </div>
                            <small class="d-block mt-4">Đoạn mở đầu</small>
                            <textarea name="subtitle" id="subtitle"><?php echo html_entity_decode($post['subtitle']) ?></textarea>
                            <?php echo (isset($err['subtitle'])) ? '<small class="text-danger d-block">' . $err['subtitle'] . '</small>' : '' ?>

                            <!-- Ảnh 0 -->
                            <?php if ($images[0]['img_name'] != 'noname') : ?>
                                <div class="mt-4">
                                    <strong><small>Ảnh bìa</small></strong><br>
                                    <button type="button" id="reset_img_0" class="btn btn-outline-dark" style="display: none;">Khôi phục ảnh</button>
                                    <button type="button" id="change_img_0" class="btn btn-outline-dark">Thay đổi ảnh</button>
                                    <button type="button" id="delete_img_0" class="btn btn-outline-danger">Xoá ảnh</button>
                                </div>
                                <div id="change_img_0_input" class="form-group mt-4" style="display: none;">
                                    <input type="file" name="nofile_0" class="form-controller-file">
                                    <small class="d-block text-danger">Nếu bạn để trống thì ảnh cũ sẽ bị xoá</small>
                                    <?php echo (isset($err['img_0'])) ? '<small class="text-danger d-block">' . $err['img_0'] . '</small>' : '' ?>
                                </div>
                                <img id="image_0" src="<?php echo $images[0]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[0]['img_name'] ?>" alt="ảnh">
                            <?php else : ?>
                                <div id="change_img_0_input" class="form-group mt-4">
                                    <strong><small>Thêm ảnh</small></strong><br>
                                    <input type="file" name="img_0" class="form-controller-file">
                                    <?php echo (isset($err['img_0'])) ? '<small class="text-danger d-block">' . $err['img_1'] . '</small>' : '' ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Heading_1 -->
                        <div class="box">
                            <small><strong>Tiêu đề 1</strong></small>
                            <textarea name="heading_1" id="heading_1"><?php echo html_entity_decode($post['heading_1']) ?></textarea>
                            <?php echo (isset($err['heading_1'])) ? '<small class="text-danger d-block">' . $err['heading_1'] . '</small>' : '' ?>

                            <small class="d-block mt-4">Đoạn 1.1</small>
                            <textarea name="paragraph_1_1" id="paragraph_1_1"><?php echo html_entity_decode($post['paragraph_1_1']) ?></textarea>
                            <?php echo (isset($err['paragraph_1_1'])) ? '<small class="text-danger d-block">' . $err['paragraph_1_1'] . '</small>' : '' ?>

                            <!-- Ảnh 1 -->
                            <?php if ($images[1]['img_name'] != 'noname') : ?>
                                <div class="mt-4">
                                    <strong><small>Ảnh 1</small></strong><br>
                                    <button type="button" id="reset_img_1" class="btn btn-outline-dark" style="display: none;">Khôi phục ảnh</button>
                                    <button type="button" id="change_img_1" class="btn btn-outline-dark">Thay đổi ảnh</button>
                                    <button type="button" id="delete_img_1" class="btn btn-outline-danger">Xoá ảnh</button>
                                </div>
                                <div id="change_img_1_input" class="form-group mt-4" style="display: none;">
                                    <input type="file" name="nofile_1" class="form-controller-file">
                                    <small class="d-block text-danger">Nếu bạn để trống thì ảnh cũ sẽ bị xoá</small>
                                    <?php echo (isset($err['img_1'])) ? '<small class="text-danger d-block">' . $err['img_1'] . '</small>' : '' ?>
                                </div>
                                <img id="image_1" src="<?php echo $images[1]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[1]['img_name'] ?>" alt="ảnh">
                            <?php else : ?>
                                <div id="change_img_1_input" class="form-group mt-4">
                                    <strong><small>Thêm ảnh</small></strong><br>
                                    <input type="file" name="img_1" class="form-controller-file">
                                    <?php echo (isset($err['img_1'])) ? '<small class="text-danger d-block">' . $err['img_1'] . '</small>' : '' ?>
                                </div>
                            <?php endif; ?>

                            <small class="d-block mt-4">Đoạn 1.2</small>
                            <textarea name="paragraph_1_2" id="paragraph_1_2"><?php echo html_entity_decode($post['paragraph_1_2']) ?></textarea>
                            <?php echo (isset($err['paragraph_1_2'])) ? '<small class="text-danger d-block">' . $err['paragraph_1_2'] . '</small>' : '' ?>
                        </div>

                        <!-- Heading_2 -->
                        <div class="box">
                            <small><strong>Tiêu đề 2</strong></small>
                            <textarea name="heading_2" id="heading_2"><?php echo html_entity_decode($post['heading_2']) ?></textarea>
                            <?php echo (isset($err['heading_2'])) ? '<small class="text-danger d-block">' . $err['heading_2'] . '</small>' : '' ?>

                            <small class="d-block mt-4">Đoạn 2.1</small>
                            <textarea name="paragraph_2_1" id="paragraph_2_1"><?php echo html_entity_decode($post['paragraph_2_1']) ?></textarea>
                            <?php echo (isset($err['paragraph_2_1'])) ? '<small class="text-danger d-block">' . $err['paragraph_2_1'] . '</small>' : '' ?>

                            <!-- Ảnh 2 -->
                            <?php if ($images[2]['img_name'] != 'noname') : ?>
                                <div class="mt-4">
                                    <strong><small>Ảnh 2</small></strong><br>
                                    <button type="button" id="reset_img_2" class="btn btn-outline-dark" style="display: none;">Khôi phục ảnh</button>
                                    <button type="button" id="change_img_2" class="btn btn-outline-dark">Thay đổi ảnh</button>
                                    <button type="button" id="delete_img_2" class="btn btn-outline-danger">Xoá ảnh</button>
                                </div>
                                <div id="change_img_2_input" class="form-group mt-4" style="display: none;">
                                    <input type="file" name="nofile_2" class="form-controller-file">
                                    <small class="d-block text-danger">Nếu bạn để trống thì ảnh cũ sẽ bị xoá</small>
                                    <?php echo (isset($err['img_2'])) ? '<small class="text-danger d-block">' . $err['img_2'] . '</small>' : '' ?>
                                </div>
                                <img id="image_2" src="<?php echo $images[2]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[2]['img_name'] ?>" alt="ảnh">
                            <?php else : ?>
                                <div id="change_img_2_input" class="form-group mt-4">
                                    <strong><small>Thêm ảnh</small></strong><br>
                                    <input type="file" name="img_2" class="form-controller-file">
                                    <?php echo (isset($err['img_2'])) ? '<small class="text-danger d-block">' . $err['img_2'] . '</small>' : '' ?>
                                </div>
                            <?php endif; ?>


                            <small class="d-block mt-4">Đoạn 2.2</small>
                            <textarea name="paragraph_2_2" id="paragraph_2_2"><?php echo html_entity_decode($post['paragraph_2_2']) ?></textarea>
                            <?php echo (isset($err['paragraph_2_2'])) ? '<small class="text-danger d-block">' . $err['paragraph_2_2'] . '</small>' : '' ?>
                        </div>

                        <!-- Heading_3 -->
                        <div class="box">
                            <small><strong>Tiêu đề 3</strong></small>
                            <textarea name="heading_3" id="heading_3"><?php echo html_entity_decode($post['heading_3']) ?></textarea>
                            <?php echo (isset($err['heading_3'])) ? '<small class="text-danger d-block">' . $err['heading_3'] . '</small>' : '' ?>

                            <small class="d-block mt-4">Đoạn 3.1</small>
                            <textarea name="paragraph_3_1" id="paragraph_3_1"><?php echo html_entity_decode($post['paragraph_3_1']) ?></textarea>
                            <?php echo (isset($err['paragraph_3_1'])) ? '<small class="text-danger d-block">' . $err['paragraph_3_1'] . '</small>' : '' ?>

                            <!-- Ảnh 3 -->
                            <?php if ($images[3]['img_name'] != 'noname') : ?>
                                <div class="mt-4">
                                    <strong><small>Ảnh 3</small></strong><br>
                                    <button type="button" id="reset_img_3" class="btn btn-outline-dark" style="display: none;">Khôi phục ảnh</button>
                                    <button type="button" id="change_img_3" class="btn btn-outline-dark">Thay đổi ảnh</button>
                                    <button type="button" id="delete_img_3" class="btn btn-outline-danger">Xoá ảnh</button>
                                </div>
                                <div id="change_img_3_input" class="form-group mt-4" style="display: none;">
                                    <input type="file" name="nofile_3" class="form-controller-file">
                                    <small class="d-block text-danger">Nếu bạn để trống thì ảnh cũ sẽ bị xoá</small>
                                    <?php echo (isset($err['img_3'])) ? '<small class="text-danger d-block">' . $err['img_3'] . '</small>' : '' ?>
                                </div>
                                <img id="image_3" src="<?php echo $images[3]['img_path'] . MY_DIRECTORY_SEPARATOR . $images[3]['img_name'] ?>" alt="ảnh">
                            <?php else : ?>
                                <div id="change_img_3_input" class="form-group mt-4">
                                    <strong><small>Thêm ảnh</small></strong><br>
                                    <input type="file" name="img_3" class="form-controller-file">
                                    <?php echo (isset($err['img_3'])) ? '<small class="text-danger d-block">' . $err['img_3'] . '</small>' : '' ?>
                                </div>
                            <?php endif; ?>


                            <small class="d-block mt-4">Đoạn 3.2</small>
                            <textarea name="paragraph_3_2" id="paragraph_3_2"><?php echo html_entity_decode($post['paragraph_3_2']) ?></textarea>
                            <?php echo (isset($err['paragraph_3_2'])) ? '<small class="text-danger d-block">' . $err['paragraph_3_2'] . '</small>' : '' ?>
                        </div>

                        <!-- Đoạn kết -->
                        <div class="box">
                            <small class="d-block mt-4"><strong>Đoạn kết</strong></small>
                            <textarea name="last_paragraph" id="last_paragraph"><?php echo html_entity_decode($post['last_paragraph']) ?></textarea>
                            <?php echo (isset($err['last_paragraph'])) ? '<small class="text-danger d-block">' . $err['last_paragraph'] . '</small>' : '' ?>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary my-4" value="submit">Sửa bài</button>
                        </div>
                    </form>

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
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#title'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#subtitle'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#heading_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#heading_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#heading_3'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_1_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_1_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_2_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_2_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_3_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_3_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#last_paragraph'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(function() {
            $(window).scroll(function() {
                $('test').css('top', 'calc(40% + ' + $(this).scrollTop() * 1.1 + 'px)');
            });

            // img_0
            $('#change_img_0').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#change_img_0_input').slideDown();
                $('#change_img_0_input').find('input[type="file"]').attr('name', 'change_file_0');
                $('#reset_img_0').slideDown();
                $('#image_0').slideUp();
                $('#delete_img_0').slideUp();
            });

            $('#delete_img_0').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_0').slideUp();
                $('#change_img_0').slideUp();
                $('#change_img_0_input').slideUp();
                $('#change_img_0_input').find('input[type="file"]').attr('name', 'img_0');
                $('#reset_img_0').slideDown();
            });

            $('#reset_img_0').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_0').slideDown();
                $('#change_img_0_input').slideUp();
                $('#change_img_0_input').find('input[type="file"]').attr('name', 'nofile_0');
                $('#change_img_0').slideDown();
                $('#delete_img_0').slideDown();
            });

            // img_1
            $('#change_img_1').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#change_img_1_input').slideDown();
                $('#change_img_1_input').find('input[type="file"]').attr('name', 'change_file_1');
                $('#reset_img_1').slideDown();
                $('#image_1').slideUp();
                $('#delete_img_1').slideUp();
            });

            $('#delete_img_1').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_1').slideUp();
                $('#change_img_1').slideUp();
                $('#change_img_1_input').slideUp();
                $('#change_img_1_input').find('input[type="file"]').attr('name', 'img_1');
                $('#reset_img_1').slideDown();
            });

            $('#reset_img_1').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_1').slideDown();
                $('#change_img_1_input').slideUp();
                $('#change_img_1_input').find('input[type="file"]').attr('name', 'nofile_1');
                $('#change_img_1').slideDown();
                $('#delete_img_1').slideDown();
            });

            // img_2
            $('#change_img_2').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#change_img_2_input').slideDown();
                $('#change_img_2_input').find('input[type="file"]').attr('name', 'change_file_2');
                $('#reset_img_2').slideDown();
                $('#image_2').slideUp();
                $('#delete_img_2').slideUp();
            });

            $('#delete_img_2').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_2').slideUp();
                $('#change_img_2').slideUp();
                $('#change_img_2_input').slideUp();
                $('#change_img_2_input').find('input[type="file"]').attr('name', 'img_2');
                $('#reset_img_2').slideDown();
            });

            $('#reset_img_2').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_2').slideDown();
                $('#change_img_2_input').slideUp();
                $('#change_img_2_input').find('input[type="file"]').attr('name', 'nofile_2');
                $('#change_img_2').slideDown();
                $('#delete_img_2').slideDown();
            });

            // img_3
            $('#change_img_3').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#change_img_3_input').slideDown();
                $('#change_img_3_input').find('input[type="file"]').attr('name', 'change_file_3');
                $('#reset_img_3').slideDown();
                $('#image_3').slideUp();
                $('#delete_img_3').slideUp();
            });

            $('#delete_img_3').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_3').slideUp();
                $('#change_img_3').slideUp();
                $('#change_img_3_input').slideUp();
                $('#change_img_3_input').find('input[type="file"]').attr('name', 'img_3');
                $('#reset_img_3').slideDown();
            });

            $('#reset_img_3').click(function(e) {
                e.preventDefault();
                $(this).css('display', 'none');
                $('#image_3').slideDown();
                $('#change_img_3_input').slideUp();
                $('#change_img_3_input').find('input[type="file"]').attr('name', 'nofile_3');
                $('#change_img_3').slideDown();
                $('#delete_img_3').slideDown();
            });
        })
    </script>
</body>

</html>