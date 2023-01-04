<?php 
	use yii\bootstrap5\Html;
    use yii\helpers\Url;
?>
<style>
.containerFoot{
	height: 300px;
}

@media (max-width: 500px) {
    .containerFoot {
		height: 550px;
    } 
}
</style>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon.ico">
	<link rel="icon" type="image/png" href="./assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,700" rel="stylesheet">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	
	<!-- Jquery library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7NBEWDZBWY"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-7NBEWDZBWY');
</script>

<!-- <body> -->
<!--------------------------------------
HEADER
--------------------------------------->
<div class="container">
	<div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
		<div class="tofront">
			<div class="row justify-content-between">
				<div class="col-md-6 pt-6 pb-6 pr-6 align-self-center">
					<p class="text-uppercase font-weight-bold">
						<a class="text-danger" href="./category.html">Stories</a>
					</p>
					<h1 class="display-4 secondfont mb-3 font-weight-bold"> <?php echo $model['titulo'];?> </h1>
					<p class="mb-3">
						<?php echo $model['subtitulo'];?>
					</p>
					<!-- <div class="d-flex align-items-center">
						<img class="rounded-circle" src="assets/img/demo/avatar2.jpg" width="70">
						<small class="ml-2">Jane Seymour <span class="text-muted d-block">A few hours ago &middot; 5 min. read</span>
						</small>
					</div> -->
				</div>
				<div class="col-md-6 pr-0">
					<img src="<?php echo $model['imagen'];?>">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->
    
<!--------------------------------------
MAIN
--------------------------------------->
<div class="container pt-4 pb-4">
	<div class="row justify-content-center">

		<div class="col-lg-2 pr-4 mb-4 col-md-12">
			<div class="sticky-top text-center">
				<div class="text-muted">
					Share this
				</div>
				<div class="share d-inline-block">
					<!-- AddToAny BEGIN -->
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
					</div>
					<script async src="https://static.addtoany.com/menu/page.js"></script>
					<!-- AddToAny END -->
				</div>
			</div>
		</div>
		
		<div class="col-md-12 col-lg-8">
			<article class="article-post">
	
				<?php echo $model['texto'];?>

			</article>
			<div class="border p-5 bg-lightblue">
				<div class="row justify-content-between">
					<div class="col-md-5 mb-2 mb-md-0">
						<h5 class="font-weight-bold secondfont">Become a member</h5>
						 Get the latest news right in your inbox. We never spam!
					</div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="Enter your e-mail address">
							</div>
							<div class="col-md-12 mt-2">
								<button type="submit" class="btn btn-success btn-block">Subscribe</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
    
<?php if(isset($nextArticle)){ ?>
	<div class="containerFoot pt-4 pb-4">
		<h5 class="font-weight-bold spanborder"><span>Read next</span></h5>
		<div class="row">
			<div class="mb-3 d-flex align-items-center">
				<img height="200" src="<?php echo $nextArticle['imagen'];?>" >
				
				<!-- for tablets/pc -->
				<div id="pc" class="pl-3">
					<h2 class="h4 font-weight-bold">
						<a class="text-dark" href="<?= Url::to(array('site/article', 'id' => $nextArticle['id'])); ?>" > <?php echo $nextArticle['titulo'];?> </a> 
					</h2>
					<p class="card-text">
						<?php echo $nextArticle['subtitulo'] ?>
					</p>
					<div>
						<small class="d-block"><a class="text-muted" href="./author.html"><?php echo $nextArticle['autor'] ?></a></small>
						<small class="text-muted"><?php echo $nextArticle['fecha'] ?></small>
					</div>
				</div>
					
			</div>
		</div>

		<!-- for movil devices -->
		<div id="movil" class="pl-3">
			<h2 class="h4 font-weight-bold">
				<a class="text-dark" href="<?= Url::to(array('site/article', 'id' => $nextArticle['id'])); ?>" > <?php echo $nextArticle['titulo'];?> </a> 
			</h2>
			<p class="card-text">
				<?php echo $nextArticle['subtitulo'] ?>
			</p>
			<div>
				<small class="d-block"><a class="text-muted" href="./author.html"><?php echo $nextArticle['autor'] ?></a></small>
				<small class="text-muted"><?php echo $nextArticle['fecha'] ?></small>
			</div>
		</div>

	</div>
<?php } ?>
<!-- End Main -->
    
<script>
	$(document).ready(function() {
		changeFooterPos();
	});

	$(window).on("orientationchange",function(){
		changeFooterPos();
	});

	function changeFooterPos(){
		if(screen.width > 500){
			$('#pc').show();
			$('#movil').hide();
		}else{
			$('#pc').hide();
			$('#movil').show();
		}
	}
</script>

</html>