<?php 
	use yii\bootstrap5\Html;
    use yii\helpers\Url;
?>

<!-- Products display -->
<!DOCTYPE html>

<style>
.bg-custom {
    background: #969696;
}
.title-container{
    height: 50px;
    display: flex;
    justify-content: center; /* align horizontal */
    align-items: center;
}

.ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
    font-size: 11px;
    padding-top: 1rem;
    padding-bottom: 1rem;
    padding-left: 20px;
    padding-right: 20px;
    font-weight: 500;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
    opacity: 1 !important;
}
</style>

<?php 
    $pathToImg = '@web/../../../../backend/web/';
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

        <!-- Main css -->
        <!-- <link href="@web/../../../../frontend/web/css/mediumish.css" rel="stylesheet"/> -->

    </head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7NBEWDZBWY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-7NBEWDZBWY');
    </script>

    <!-- Begin Site Title ================================================== -->
    <div class="mainheading">
        <h1 class="sitetitle"><?= $titulo ?></h1>
        <p class="lead">
            <?= $subtitulo ?>
        </p>
    </div>
    <!-- End Site Title ================================================== -->

	<!-- Begin Featured ================================================== -->
	<section class="featured-posts">
	<div class="section-title">
		<h2><span>Featured</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">

        <?php
        if(!empty($dataArticulos)){
            foreach($dataArticulos as $articulo){
        ?>
            <!-- begin post -->
            <div class="card">
                <div class="row">
                    <div class="col-md-5 wrapthumbnail">
                        <a href="">
                            <?= Html::a( '', ['site/article', ['id' => $articulo['id']]], [
                                'class' => "thumbnail", 
                                'style' => "background-image:url(" . $articulo['imagen'] . ");"
                                ]) ?>
                        </a>
                    </div> 
                    <div class="col-md-7">
                        <div class="card-block">
                            <h2 class="card-title">
                                <a href="">
                                    <?= Html::a( $articulo['titulo'], ['site/article', ['id' => $articulo['id']]]) ?>
                                </a>
                            </h2>
                            <h4 class="card-text"> <?php echo $articulo['subtitulo'];?> </h4>
                            <div class="metafooter">
                                <div class="wrapfooter">
                                    <span class="meta-footer-thumb">
                                    <a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
                                    </span>
                                    <span class="author-meta">
                                    <span class="post-name"><a href="author.html"> <?php echo $articulo['autor'];?> </a></span><br/>
                                    <span class="post-date"> <?php echo $articulo['fecha'];?> </span><span class="dot"></span><span class="post-read">6 min read</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end post -->

        <?php } } else { ?>
            <h2 class="card-title">
                <a href="">There are no articles</a>
            </h2>
        <?php } ?>

	</div>
	</section>
	<!-- End Featured ================================================== -->

    <!-- filtering navbar -->
    <nav class="navbar bg-custom navbar-expand-md">
        <div class="container">
            <button class="navbar-toggler d-none" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">

            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container-fluid">
	    
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav m-auto">
	        	<li class="nav-item active">
                    <?= Html::a( 'Computers', ['site/filter-products', ['target' => 'es']], ['class' => "nav-link"]); ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cellphones</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Page 1</a>
                        <a class="dropdown-item" href="#">Page 2</a>
                        <a class="dropdown-item" href="#">Page 3</a>
                        <a class="dropdown-item" href="#">Page 4</a>
                    </div>
                </li>
	        	<li class="nav-item">
                    <?= Html::a( 'Headphones', ['site/filter-products', ['target' => 'es']], ['class' => "nav-link"]); ?>
                </li>
	        	<li class="nav-item">
                    <?= Html::a( 'Smart Watches', ['site/filter-products', ['target' => 'es']], ['class' => "nav-link"]); ?>
                </li>
	            <li class="nav-item">
                    <?= Html::a( 'Speakers', ['site/filter-products', ['target' => 'es']], ['class' => "nav-link"]); ?>
                </li>
	        </ul>
	      </div>
        </div>
    </nav>
    
    <!---------- Product card begin ------------>
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
                            <!-- <img src="<?php echo $pathToImg;?>uploads/<?php echo $row['imagen'];?>" alt="Product Image"/> -->
                            <img src="<?php echo $row['imagen'];?>" alt="Product Image"/>

                            <!-- <div class="product-price">
                                <span>$<?php echo $row['precio'];?></span>
                            </div> -->
                        </div>
                        <div class="product-content">
                            <div class="product-title title-container">
                                <h2><a href=""><?php echo $row['nombre'];?></a></h2>
                            </div>
                            <!-- <div class="product-ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div> -->
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
    <!---------- Product card end ------------>
</html>

<script>

    function viewArticle(){
        $.get("http://localhost/affilliateapp/frontend/web/index.php/site/article", function (result, status, xhr) {
                // var obj = JSON.parse(result);
                // console.log(obj)
                if (status == "success") {
                    // location.reload();
                    console.log("funciona!!")
                    // if (obj.transaccion) {
                    //     alert('Anulado correctamente');
                    //     location.reload();
                    //     // alert('Se genero de manera correcta'); // alert(obj.url); location.href=obj.url; $( "#loadButton" ).removeClass( "ld ld-ring ld-spin" ); //window.open(obj.url) }else{ alert('No se pudo generar, intente más tarde' ); $( "#loadButton" ).removeClass( "ld ld-ring ld-spin" );
                    // } else {
                    //     alert('Error al procesar la solicitud 1');
                    // }

                } else if (status == "error") {//status puede ser también:"success", "notmodified", "error", "timeout", or "parsererror"
                    alert('Error al procesar la solicitud 2');
                }
        }).fail(function () {
            alert('Error al procesar la solicitud 3');
        });
    }

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

