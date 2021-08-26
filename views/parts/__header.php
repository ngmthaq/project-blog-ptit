<!-- Search -->
<div class="search-modal">
    <div class="close-search-modal">
        <i class="fas fa-times"></i>
    </div>
    <form class="form form-inline" action="" method="post">
        <input type="text" name="search-input" class="form-control" id="search-input" placeholder="Search here ...">
        <!-- <button type="submit" class="btn btn-outline-dark text-light"><i class="fas fa-search"></i></button> -->
    </form>
</div>

<!-- Sidebar -->


<!-- Header -->
<header>
    <nav>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <button class="btn btn-sm btn-out-line-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="col-lg-8 text-center">
                    <ul class="nav-list">
                        <li>
                            <a href="index.php" class='my-active'>Home</a>
                        </li>
                        <li>
                            <a href="#">Posts</a>
                        </li>
                        <li>
                            <a href="#">Categories</a>
                        </li>
                        <li>
                            <a href="#">About us</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 text-right">
                    <button class="header-search-button btn btn-sm btn-outline-none">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    $(function() {
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
    })
</script>