<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="productos-form"

    <?= Html::csrfMetaTags() ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'marca')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'precio')->textInput(); ?>

    <?= $form->field($model, 'url')->textInput(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'categoria')->dropDownList($categorias, ['prompt' => 'Seleccione Uno' ]); ?>

    <?= $form->field($model, 'imagen')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
