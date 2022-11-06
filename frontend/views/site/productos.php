<!-- Products display -->
<!DOCTYPE html>

<style>
.bg-custom {
    background: #969696;
}
</style>

<?php 

    if (str_contains($_SERVER['REQUEST_URI'], 'affilliateapp')) { 
        $pathToImg = '@web/../../../../backend/web/';
    }else{
        $pathToImg = '@web/../../../backend/web/';
    }
?>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>HTML Product Grid View</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="img/favicon.ico" rel="icon">
        <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
        
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800&display=swap" rel="stylesheet"> 

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Jquery library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Nav bar dropdown -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    </head>

    <!-- Begin Site Title ================================================== -->
    <div class="mainheading">
        <h1 class="sitetitle">Explore</h1>
        <p class="lead">
            The most interesting items in technology these days
        </p>
    </div>
    <!-- End Site Title ================================================== -->

	<!-- Begin Featured ================================================== -->
	<section class="featured-posts">
	<div class="section-title">
		<h2><span>Featured</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">

		<!-- begin post -->
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="post.html">
						<div class="thumbnail" style="background-image:url(<?php echo $pathToImg;?>uploads/iphone14pro.jpg);">
						</div>
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title"><a href="post.html">Why move to iPhone 14?</a></h2>
						<h4 class="card-text">The all new iPhone 14 has a lot of cool features that can make you choose this device as you next phone.</h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="author.html">Steve</a></span><br/>
								<span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end post -->

		<!-- begin post -->
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="post.html">
						<div class="thumbnail" style="background-image:url(<?php echo $pathToImg;?>uploads/macbook-pro-14-and-16_overview__fz0lron5xyuu_og.png);">
						</div>
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title"><a href="post.html">The beauty of this world is in your heart</a></h2>
						<h4 class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="author.html">Jane</a></span><br/>
								<span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end post -->

		<!-- begin post -->
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="post.html">
						<div class="thumbnail" style="background-image:url(<?php echo $pathToImg;?>uploads/default-img.jpg);">
						</div>
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title"><a href="post.html">Dreaming of Las Vegas Crazyness</a></h2>
						<h4 class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="author.html">Mary</a></span><br/>
								<span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end post -->

		<!-- begin post -->
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="post.html">
						<div class="thumbnail" style="background-image:url(<?php echo $pathToImg;?>uploads/161591-laptops-review-apple-macbook-pro-review-image7-7y54imelrt.jpg);">
						</div>
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title"><a href="post.html">San Francisco at its best view in all seasons</a></h2>
						<h4 class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="author.html">Sal</a></span><br/>
								<span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end post -->

	</div>
	</section>
	<!-- End Featured ================================================== -->

    <!-- filtering navbar -->
    <nav class="navbar bg-custom navbar-expand-md">
        <div class="container">
            <button class="navbar-toggler d-none" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">

                <ul class="nav navbar-nav w-100 justify-content-between">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">New listings</a>
                        <!-- <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="#">This is a very very long dropdown item and it may overflow the viewport</a>
                            <a class="dropdown-item" role="presentation" href="#">Second Item</a>
                            <a class="dropdown-item" role="presentation" href="#">Third Item</a>
                        </div> -->
                    </li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Trending</a>
                        <!-- <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="#">This is a very very long dropdown item and it may overflow the viewport</a>
                            <a class="dropdown-item" role="presentation" href="#">Second Item</a>
                            <a class="dropdown-item" role="presentation" href="#">Third Item</a>
                        </div> -->
                    </li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" data-display="static" aria-expanded="false" href="#">Best price</a>
                        <!-- <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="#">This is a very very long dropdown item and it may overflow the viewport</a>
                            <a class="dropdown-item" role="presentation" href="#">Second Item</a>
                            <a class="dropdown-item" role="presentation" href="#">Third Item</a>
                        </div> -->
                    </li>
                    <!-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" data-display="static" aria-expanded="false" href="#">Navbar link 4</a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="#">This is a very very long dropdown item and it may overflow the viewport</a>
                            <a class="dropdown-item" role="presentation" href="#">Second Item</a>
                            <a class="dropdown-item" role="presentation" href="#">Third Item</a>
                        </div>
                    </li> -->
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" data-display="static" aria-expanded="false" href="#">Navbar link 5</a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="#">This is a very very long dropdown item and it may overflow the viewport</a>
                            <a class="dropdown-item" role="presentation" href="#">Second Item</a>
                            <a class="dropdown-item" role="presentation" href="#">Third Item</a>
                            <a class="dropdown-item" id="dropdown2-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown2.1</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown2-1">
                                    <li class="dropdown-item" href="#"><a>Action 2.1 A</a></li>
                                    <li class="dropdown-item" href="#"><a>Action 2.1 B</a></li>
                                    <li class="dropdown-item" href="#"><a>Action 2.1 C</a></li>
                                </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown2</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown2">
                    <li class="dropdown-item" href="#"><a>Action 2 A</a></li>
                    <li class="dropdown-item" href="#"><a>Action 2 B</a></li>
                    <li class="dropdown-item" href="#"><a>Action 2 C</a></li>
                    <li class="dropdown-item dropdown">
                        <a class="dropdown-toggle" id="dropdown2-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown2.1</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown2-1">
                            <li class="dropdown-item" href="#"><a>Action 2.1 A</a></li>
                            <li class="dropdown-item" href="#"><a>Action 2.1 B</a></li>
                            <li class="dropdown-item" href="#"><a>Action 2.1 C</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    
    <body>
        <div class="grid-title">
            <h2>Today's choice</h2>
        </div>

        <div class="product-grid grid-3">

            <?php
            if(!empty($data)){
                foreach($data as $row){
            ?>

                <div class="product-item">
                    <div class="product-single">
                        <div class="product-img">
                            <img src="<?php echo $pathToImg;?>uploads/<?php echo $row['imagen'];?>" alt="Product Image"/>
                            <div class="product-price">
                                <span>$<?php echo $row['precio'];?></span>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-title">
                                <h2><a href=""><?php echo $row['nombre'];?></a></h2>
                            </div>
                            <div class="product-ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="product-description">
                                <?php echo $row['descripcion'];?>
                            </div>
                            <div class="product-action">
                                <a href=""><i class="fa fa-eye"></i> See product</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } 
            }else{ ?>

                <div class="grid-title">
                    <h2>There's no products to show :(</h2>
                </div>

            <?php } ?>    
        
        </div>
    </body>
</html>

<script>
    var $maxWidthElement = $('.navbar'),
    maxWidth = $maxWidthElement.width();

    function positionDropdowns() {
    $('.dropdown-menu').each(function() {
        $(this).removeClass('dropdown-menu-right');
        var $navItem = $(this).closest('.dropdown'),
        dropdownWidth = $(this).outerWidth(),
        dropdownOffsetLeft = $navItem.offset().left,
        dropdownOffsetRight = maxWidth - (dropdownOffsetLeft + dropdownWidth),
        linkCenterOffsetLeft = dropdownOffsetLeft + $navItem.outerWidth() / 2,
        outputCss = {
            left: 0,
            right: '',
            width: ''
        };

        if ((linkCenterOffsetLeft - dropdownWidth / 2 > 0) & (linkCenterOffsetLeft + dropdownWidth / 2 < maxWidth)) {
        // center the dropdown menu if possible
        outputCss.left = -(dropdownWidth / 2 - $navItem.outerWidth() / 2);
        } else if ((dropdownOffsetRight < 0) & (dropdownWidth < dropdownOffsetLeft + $navItem.outerWidth())) {
        // set the dropdown menu to left if it exceeds the viewport on the right
        $(this).addClass('dropdown-menu-right');
        outputCss.left = '';
        } else if (dropdownOffsetLeft + dropdownWidth > maxWidth) {
        // full width if the dropdown is too large to fit on the right
        outputCss.left = 0;
        outputCss.right = 0;
        outputCss.width = maxWidth + 'px';
        }
        $(this).css({
        left: outputCss.left,
        right: outputCss.right,
        width: outputCss.width
        });
    });
    }

    var resizeTimer;

    $(window).on("resize", function(e) {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        maxWidth = $maxWidthElement.width();
        positionDropdowns();
    }, 250);
    });
</script>

