<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Voter $model */

$this->title = 'Update Voter: ' . $model->first_name . ' '.$model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Voters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'username' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>

<!-- Begin breadcrumb -->
<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>

<div class="voter-update">
    <div class="row">
        <div class="col-md-9 pt-3  mx-auto bg-white rounded-3">
            <?= $this->render('_form_update', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
