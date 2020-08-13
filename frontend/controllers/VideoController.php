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

      $videoLike = new VideoLike();
      $videoLike->video_id = $id;
      $videoLike->user_id = $userId;
      $videoLike->created_at = time();
      $videoLike->save();


    }

    protected function findVideo($id) {
      $video = Video::findOne($id);

      if(!$video) {
        throw new NotFoundHttpException("Video does not exist");
      }

      return $video;
    }

}
