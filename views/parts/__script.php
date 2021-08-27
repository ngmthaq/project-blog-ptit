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
<script>
    $(function() {
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
    })

    function scrollFunction() {
        //Get the button
        var mybutton = document.getElementById("scroll-to-top");
        let header = document.querySelector('header');
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            header.style.backgroundColor = "rgba(0, 0, 0, .99)";
            header.style.margin = "0";
            header.style.boxShadow = "1px 5px 30px 5px rgba(255, 255, 255, 0.2)";
            mybutton.style.display = "flex";
        } else {
            header.style.backgroundColor = "transparent";
            header.style.margin = "24px 0";
            header.style.boxShadow = "none";
            mybutton.style.display = "none";

        }
    }
</script>