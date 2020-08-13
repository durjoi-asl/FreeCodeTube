<?php
namespace frontend\controllers;

use Yii;
use common\models\Video;
use common\models\VideoView;
use common\models\VideoLike;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class VideoController extends \yii\web\Controller
{
    public function behaviors() {
      return [
        'access' => [
          'class' => AccessControl::className(),
          'only'  => ['like', 'dislike'],
          'rules' => [
            [
              'allow' => true,
              'roles' => ['@'],
            ]
          ]
        ],
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'like' => ['post'],
            'dislike' => ['post'],
          ]
        ],
      ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
          'query' => Video::find()->published()->latest()
        ]);
        return $this->render('index', [
          'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
      $this->layout = 'auth';

      $video = $this->findVideo($id);

      $videoView = new VideoView();
      $videoView->video_id = $id;
      $videoView->user_id = \Yii::$app->user->id;
      $videoView->created_at = time();
      $videoView->save();

      return $this->render('view', [
        'model' => $video
      ]);
    }

    public function actionLike($id) {
      $video = $this->findVideo($id);

      $userId = \Yii::$app->user->id;

      $videoLikeDislike = VideoLike::find()->userIdVideoId($userId, $id)->one();

      if(!$videoLikeDislike) {
        $videoLike = $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
      } else if($videoLikeDislike->type === VideoLike::TYPE_LIKE) {
        $videoLikeDislike->delete();
      } else {
        $videoLikeDislike->delete();
        $videoLike = $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
      }

      return $this->renderAjax('_button',[
        'model' => $video
      ]);
    }

    protected function findVideo($id) {
      $video = Video::findOne($id);

      if(!$video) {
        throw new NotFoundHttpException("Video does not exist");
      }

      return $video;
    }

    protected function saveLikeDislike($videoId, $userId, $type) {
      $videoLikeDislike = new VideoLike();
      $videoLikeDislike->video_id = $videoId;
      $videoLikeDislike->type = $type;
      $videoLikeDislike->user_id = $userId;
      $videoLikeDislike->created_at = time();
      $videoLikeDislike->save();
    }

}
