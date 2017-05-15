<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Comment;

class SmsController extends Controller
{
    public function actionSend()
    {
      $newCommentCount = Comment::find()->where(['remind' => 0])->count();
      if ($newCommentCount > 0) {
        $content = "有".$newCommentCount."条评论待审核";
        $result = $this->vendorSmsService($content);
        if ($result['status'] == 'success') {
          Comment::updateAll(['remind' => 1]);
          echo '['.date("Y-m-d H:i:s", $result['dt']).']'.$content.'['.$result['length'].']'."\r\n";
        }
      }
      return 0; // 控制台命令程序0代表退出代码 （和c一样）
    }

    protected function vendorSmsService($content)
    {
      $result = array("status" => "success", "dt" => time(), "length" => 43);
      return $result;
    }
  }

?>
