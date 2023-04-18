<?php

<<<<<<< HEAD
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */
=======
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<<<<<<< HEAD

    <?php
    $session = Yii::$app->session;

    if ($session->hasFlash('errorMessage')) {
        $errors = $session->getFlash('errorMessage');

        foreach ($errors as $error) {
            echo "<div class='alert alert-danger' role='alert'>$error[0]</div>";
        }
    }

    if ($session->hasFlash('successMessage')) {
        $success = $session->getFlash('successMessage');
        echo "<div class='alert alert-primary' role='alert'>$success</div>";
    }
    ?>

=======
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
<<<<<<< HEAD
        'action' => ['site/login'],
=======
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

<<<<<<< HEAD
    <?= $form->field($user, 'email')->input('email') ?>

    <?= $form->field($user, 'password')->passwordInput() ?>

    <?= $form->field($user, 'rememberMe')->checkbox([
        'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>

    <div class="form-group">
        <div class="offset-lg-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
=======
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941
