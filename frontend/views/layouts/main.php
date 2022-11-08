<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

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
  right: 40px;
}

.searchTerm {
  width: 100%;
  border: 2px solid #635d5e;
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
  border: 1px solid #635d5e;
  background: #635d5e;
  text-align: center;
  color: #fff;
  border-radius: 0 20px 20px 0;
  cursor: pointer;
  font-size: 20px;
}

.wrap{
  width: 20%;
  position: absolute;
  top: 50%;
  left: 70%;
  transform: translate(-50%, -50%);
}

/* for movil devices */
@media (max-width: 1000px) {
.wrap{
    position: relative;
    left: 50%;
    width: 65%;
 }
.search {
  width: 100%;
  position: relative;
  display: flex;
  right: 0px;
}

}

.bg-custom-nav {
    /* background: #8c0606; */
    background: #c9c9c9;
}

</style>

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
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);


    if (str_contains($_SERVER['REQUEST_URI'], 'producto')) { 
    ?>

        <div class="wrap">
            <div class="search">
                <input type="text" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>


    <?php }?>

    <!-- Languaje selector -->
    <div class="nav-wrapper">
        <div class="sl-nav">
            <ul>
            <li><b>Español</b> <i class="fa fa-angle-down" aria-hidden="true"></i>
                <div class="triangle"></div>
                <ul>
                <li><i class="sl-flag flag-de"><div id="germany"></div></i> <span class="active">Español</span></li>
                <li><i class="sl-flag flag-usa"><div id="germany"></div></i> <span>English</span></li>
                </ul>
            </li>
            </ul>
        </div>
    </div>

    <?php

    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
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
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>

<script>

</script>

<?php $this->endPage();
