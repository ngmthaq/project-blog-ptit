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
            
        </section>
        <?php require_once('./views/parts/__footer.php') ?>
    </div>

    <?php require_once('./views/parts/__script.php') ?>

    <script>
        $(function() {
            
        })
    </script>
</body>

</html>