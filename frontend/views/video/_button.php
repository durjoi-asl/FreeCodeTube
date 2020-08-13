<?php
use yii\helpers\Url;

 ?>

 <a href="<?php echo Url::to(['/video/like', 'id' => $model->video_id]) ?>"
   class="btn btn-sm
   <?php echo $model->isLikeBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary' ?>"
   data-pjax="1" data-method="post">
       <i class="fas fa-thumbs-up"></i> <?php echo $model->getVideoLikes()->getLikes()->count() ?>
 </a>

 <a href="<?php echo Url::to(['/video/dislike', 'id' => $model->video_id]) ?>"
   class="btn btn-sm
   <?php echo $model->isDislikeBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary' ?>"
   data-pjax="1" data-method="post">
      <i class="fas fa-thumbs-down"></i> <?php echo $model->getVideoLikes()->getDislikes()->count() ?>
 </a>

 </button>
