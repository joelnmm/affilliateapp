<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\controllers\SiteController;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;


AppAsset::register($this);

?>

<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 100%;
  position: relative;
  display: flex;
  right: 80px;
}

.searchTerm {
  width: 100%;
  border: 1px solid #000000;
  border-right: none;
  padding: 10px;
  height: 36px;
  border-radius: 20px 0 0 20px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #000000;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 0.5px solid #000000;
  background: #323232;
  text-align: center;
  color: #fff;
  border-radius: 0 20px 20px 0;
  cursor: pointer;
  font-size: 20px;
  padding-right: 20px;
}

.wrap{
  width: 250px;
  position:absolute;
  top: 50%;
  left: 70%;
  transform: translate(-50%, -50%);
}

/* for bigger screens */
@media (min-width: 1800px) {
.wrap{
    left: 65%;
 }
}

/* for movil devices */
@media (max-width: 1000px) {
.wrap{
    position: absolute;
    left: 60%;
 }
.search {
  width: 100%;
  position: relative;
  display: flex;
  right: 0px;
}
.fa-search {
    margin-right: 50px;
}

}

.bg-custom-nav {
    background: #f3f6f4;
}

</style>

<?php 
    if(!isset($actualLenguaje)){
        $actualLenguaje = 'English';
    }
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title> <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => ['/site/productos'],
        'options' => [
            'class' => 'navbar navbar-expand-md bg-custom-nav fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/productos']],
        ['label' => 'About us', 'url' => ['/site/contact']],
    ];
    // if (Yii::$app->user->isGuest) {
    //     $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    // }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    $id = '';
    if (SiteController::$ACTUAL_VIEW == 'productos') { ?>

        <div class="wrap">
            <div class="search">
                <input id="searchBox" type="text" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton" onclick="searchProducts($('#searchBox').val())">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>

    <?php } elseif (SiteController::$ACTUAL_VIEW == 'article') {

        if(str_contains($_SERVER['REQUEST_URI'], '=')){
            $urlArr = explode('=',$_SERVER['REQUEST_URI']);
            $id = $urlArr[sizeof($urlArr)-1];
        }else{
            $urlArr = explode('/',$_SERVER['REQUEST_URI']);
            $id = $urlArr[sizeof($urlArr)-1];
        }

    }?>
    <!-- Languaje selector -->
    <div class="nav-wrapper">
        <div class="sl-nav">
            <ul>
            <li><b id="activeLenguaje">Language</b> <i class="fa fa-angle-down" aria-hidden="true"></i>
                <div class="triangle"></div>
                <ul>
                <li href=""><i class="sl-flag flag-de"><div id="spain"></div></i> 
                    <span class="active">
                    <a class="thumbnail" onclick="changeLanguaje('Spanish')" href="<?= Url::to(array('site/translated-view', 'target' => 'es', 'view' => SiteController::$ACTUAL_VIEW, 'id' => $id)); ?>">Spanish</a>
                    </span>
                </li>

                <li href=""><i class="sl-flag flag-usa"><div id="usa"></div></i>
                    <span>
                    <a class="thumbnail" onclick="changeLanguaje('English')" href="<?= Url::to(array('site/translated-view', 'target' => 'en', 'view' => SiteController::$ACTUAL_VIEW, 'id' => $id)); ?>">English</a>
                    </span>
                </li>
                </ul>
            </li>
            </ul>
        </div>
    </div>

    <?php

    // if (Yii::$app->user->isGuest) {
    //     echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    // } else {
    //     echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
    //         . Html::submitButton(
    //             'Logout (' . Yii::$app->user->identity->username . ')',
    //             ['class' => 'btn btn-link logout text-decoration-none']
    //         )
    //         . Html::endForm();
    // }
    NavBar::end();
    ?>
</header>

<main id="body" role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?> & <img src="@web/../../../../frontend/web/logos/LOGO_VS1.1.PNG" height="30px" width="30px"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>

<script>

    $(document).ready(function() {
	});

    $(document).on('keypress',function(e) {
        onKeyPressSearch(e);
    });

    function onKeyPressSearch(e){
        var word = $('#searchBox').val();
        if(e.which == 13 && word !== '') {
            searchProducts(word);
        }
    }

    function searchProducts(word){

        var server = <?php echo json_encode($_SERVER['REQUEST_URI']); ?>;
        var currentUrl = "http://localhost/affilliateapp/frontend/web/site/search";

        if(!server.includes('affilliateapp')){
            currentUrl = "http://www.bittadvice.com/frontend/web/site/search";
        }
        // window.location.href = currentUrl + '?1%5Bword%5D=' + String(word);
        window.location.href = currentUrl + '?query=' + String(word);

    }

    function changeLanguaje(languaje) {
        console.log(languaje);
        // $('#activeLenguaje').html(languaje);
    }

</script>

<?php $this->endPage();
