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
    <h1>About Us</h1>
    <br>

    <p class="paragraph-about">
        BitAdvice is a site focused on sharing the most interesting stuff that you can buy online. We are constantly searching
        for cool things online so that you can see them all in one place.<br><br>

        The products listed on this site may receive a commission for product referral, this is a small help to keep BitAdvice
        as cool as always, but this is not the main motivation, our goal is to create a helpful place where people can find items
        for their needs. We appreciate your visit to our web site and hope we see you around again.
    </p>

</div>


<div id="contactSection" class="site-contact">
    <h1>Contact Us</h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
    <br>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
