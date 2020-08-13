<?php
use yii\widgets\ListView;
/* @var $this yii\web\View */
/** @var $dataProvider ActiveDataProvider */
?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
      'tag' => false
    ]
  ]) ?>
