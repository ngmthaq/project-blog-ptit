<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unna:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./public/css/toolbar.css">
    <link rel="stylesheet" href="./public/css/menuButton.css">
    <link rel="stylesheet" href="./public/css/animation.css">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <style></style>
</head>

<body>
    <div class="main">
        <?php require_once('./views/parts/__header.php') ?>

        <?php require_once('./views/parts/__footer.php') ?>
    </div>
    <script src="./public/vendor/jquery/jquery-3.6.0.min.js"></script>
    <script src="./public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./public/vendor/fontawesome/js/all.min.js"></script>
    <script src="./public/js/FontMenu.js"></script>
    <script src="./public/js/FontMenuButton.js"></script>
    <script src="./public/js/FontMenuItem.js"></script>
    <script src="./public/js/FormatToolbar.js"></script>
    <script src="./public/js/FormatToolbarItem.js"></script>
    <script src="./public/js/SpinButton.js"></script>
    <script src="./public/js/main.js"></script>
    <script>
        $(function() {
            $('.header-search-button').click(function (e) { 
                e.preventDefault();
                $('.search-modal').css('display','block');
                $('.close-search-modal').css('display','flex');
            });

            $('.close-search-modal').click(function (e) { 
                e.preventDefault();
                $('.search-modal').css('display','none');
                $(this).css('display','none');
            });
        })
    </script>
</body>

</html>