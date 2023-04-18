<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Voter $model */

$this->title = 'Add Voter';
$this->params['breadcrumbs'][] = ['label' => 'Voters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Begin breadcrumb -->

<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>

<div class="voter-create">
    <div class="row">
        <div class="col-md-9 pt-3  mx-auto bg-white rounded-3">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>