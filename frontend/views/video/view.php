<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
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
      <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]) ?>
      <div class="">

          <?php echo $this->render('_button', [
            'model' => $model
            ]) ?>


      </div>
      <?php Pjax::end() ?>
    </div>

  </div>
  <div class="col-md-4">

  </div>
</div>
