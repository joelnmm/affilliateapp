<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

?>

<style>
.site-contact{
    background: #fdf7f7;
    padding: 50px;
}

.site-about{
    padding-right: 50px;
    padding-left: 50px;
    padding-top: 20px;
    padding-bottom: 20px;
}

.paragraph-about{
    padding-right: 30px;
    padding-left: 30px;
}

</style>

<div class="site-about">
    <h1><?= $title ?></h1>
    <br>

    <p class="paragraph-about">
        <?=$paragraph?>
    </p>

</div>


<div id="contactSection" class="site-contact">
    <h1><?=$title2?></h1>

    <p>
        <?=$paragraph2?>
    </p>
    <br>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'date')->hiddenInput(['value'=> date('d-m-y h:i:s')])->label(false) ?>

                <!-- $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])  -->

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
