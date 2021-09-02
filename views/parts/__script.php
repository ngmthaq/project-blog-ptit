<script src="./public/vendor/jquery/jquery-3.6.0.min.js?v=<?php echo time(); ?>"></script>
<script src="./public/vendor/bootstrap/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
<script src="./public/vendor/fontawesome/js/all.min.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/FontMenu.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/FontMenuButton.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/FontMenuItem.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/FormatToolbar.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/FormatToolbarItem.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/SpinButton.js?v=<?php echo time(); ?>"></script>
<script src="./public/vendor/owlcarousel/dist/owl.carousel.min.js?v=<?php echo time(); ?>"></script>
<script src="./public/js/main.js?v=<?php echo time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.6.1/build/ol.js"></script>

<script type="text/javascript">
    // Map API
    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([105.7870061, 20.980955]),
            zoom: 17,
        })
    });
</script>

<script>
    $(function() {
        $('a[href="#subscribe"]').click(function() {
            $('.open-sidebar').click();
            $('input#sub-email').focus();
        })

        $('#category-header').hover(function() {
            // over
            $('.category-box').css('display', 'block');
        }, function() {
            // out
            $('.category-box').css('display', 'none');
        });

        $('#categories-list').click(function() {
            $('.categories-list').slideToggle();
        });

        $('.header-search-button').click(function(e) {
            e.preventDefault();
            $('.search-modal').css('display', 'block');
            $('.close-search-modal').css('display', 'flex');
            $('body').css('overflowY', 'hidden');
        });

        $('.close-search-modal').click(function(e) {
            e.preventDefault();
            $('.search-modal').css('display', 'none');
            $(this).css('display', 'none');
            $('body').css('overflowY', 'scroll');
        });

        $('.open-sidebar').click(function(e) {
            e.preventDefault();
            $('.sidebar').css('transform', 'translateX(0)');
            $('.my-modal').css('display', 'block');
            $('body').css('overflowY', 'hidden');
        });

        $('.close-sidebar').click(function(e) {
            e.preventDefault();
            $('.sidebar').css('transform', 'translateX(-120%)');
            $('.my-modal').css('display', 'none');
            $('body').css('overflowY', 'scroll');
        });

        $('.my-modal').click(function(e) {
            e.preventDefault();
            $('.sidebar').css('transform', 'translateX(-120%)');
            $('.my-modal').css('display', 'none');
            $('body').css('overflowY', 'scroll');
        });

        $('.header-search-button').click(function(e) {
            e.preventDefault();
            $('.search-modal').css('display', 'block');
            $('.close-search-modal').css('display', 'flex');
        });

        $('.close-search-modal').click(function(e) {
            e.preventDefault();
            $('.search-modal').css('display', 'none');
            $(this).css('display', 'none');
        });

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            //Get the button
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                $('header').css('background-color', 'rgba(0, 0, 0, .99)');
                $('header').css('margin', '0');
                $('header').css('box-shadow', '1px 5px 30px 5px rgba(255, 255, 255, 0.2)');
                $('#scroll-to-top').css('display', 'flex');
                <?php if ($whichPage == 'posts') : ?>
                    $('a[data-el="navbar"]').css('color', '#fff');
                    $('.header-button').addClass('text-light');
                    $('.header-button').removeClass('text-dark');
                    $('.my-active').css('color', '#19c3dd');
                <?php endif; ?>
            } else {
                $('header').css('background-color', 'transparent');
                $('header').css('margin', '24px 0');
                $('header').css('box-shadow', 'none');
                $('#scroll-to-top').css('display', 'none');
                <?php if ($whichPage == 'posts') : ?>
                    $('a[data-el="navbar"]').css('color', '#000');
                    $('.header-button').addClass('text-dark');
                    $('.header-button').removeClass('text-light');
                    $('.my-active').css('color', '#19c3dd');
                <?php endif; ?>
            }
        }
    })
</script>