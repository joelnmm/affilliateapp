<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Articulos $model */

$this->title = 'Create Articulos';
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>