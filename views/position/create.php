<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Position $model */

$this->title = 'Add Position';
$this->params['breadcrumbs'][] = ['label' => 'Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Begin breadcrumb -->
<nav aria-label="breadcrumb" style="width: 80%;" class="mx-auto">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/position/index">Position</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
    </ol>
</nav>




<div class="position-create">
    <div class="row">
        <div class="col-md-9 pt-3  mx-auto bg-white rounded-3">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>