<?php
use yii\helpers\Url;
/** @var $model \common\models\Video */

?>

<div class="card m-3" style="width: 14rem;">
  <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
    <div class="embed-responsive embed-responsive-16by9">
      <video class="embed-responsive-item"
        src="<?php echo $model->getVideoLink() ?>"
        poster="<?php echo $model->getThumbnailLink() ?>">

        </video>
    </div>
  </a>
  <div class="card-body p-2">
    <h6 class="card-title mb-0"><?php echo $model->title ?></h6>
    <p class="card-text mb-0 text-muted"><?php echo $model->createdBy->username ?></p>
    <p class="card-text text-muted" style="font-size: 13px">
      <?php echo $model->getVideoViews()->count() ?> views . <?php echo yii::$app->formatter->asRelativeTime($model->created_at) ?></p>
  </div>
</div>
