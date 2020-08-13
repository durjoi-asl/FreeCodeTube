<?php
use yii\helpers\Url;
/**
* User: Mehedi Hassan Durjoi
* Date: 13/8/2020
* Time: 11:22 Am
*/
/** @var $model \common\models\Video */
?>

<div class="row">
  <div class="col-md-8">
    <div class="embed-responsive embed-responsive-16by9">
      <video class="embed-responsive-item"
        src="<?php echo $model->getVideoLink() ?>"
        poster="<?php echo $model->getThumbnailLink() ?>" controls>

        </video>
    </div>
    <h6 class="mt-2"><?php echo $model->title ?></h6>
    <div class="d-flex justify-content-between align-items-center">
      <div class="">
        <p class="text-muted"><?php echo $model->getVideoViews()->count() ?> views . <?php echo Yii::$app->formatter->asDate($model->created_at) ?></p>
      </div>
      <div class="">
          <button id="videoLike"
            class="btn btn-sm btn-outline-primary" data="<?php echo $model->video_id ?>">
                <i class="fas fa-thumbs-up"></i> 10
          </button>

          <button class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-thumbs-down"></i> 3
          </button>
      </div>
    </div>

  </div>
  <div class="col-md-4">

  </div>
</div>
