<?php
// ... inside the view file for the results page ...

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

Pjax::begin([
  'id' => 'results-pjax',
  'enablePushState' => false,
]);

echo GridView::widget([
  'dataProvider' => $dataProvider,
  'columns' => [
    'position',
    'candidate.name',
    'votes',
  ],
]);

$url = Url::to(['election/results']);
$script = <<< JS
    setInterval(function() {
        $.pjax.reload({container: '#results-pjax', url: '$url', timeout: false});
    }, 5000);
JS;

$this->registerJs($script);

Pjax::end();
