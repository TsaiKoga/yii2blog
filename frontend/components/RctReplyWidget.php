<?php
namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 *
 */
class RctReplyWidget extends Widget
{
  public $recentComments;

  public function init()
  {
    parent::init();
  }

  public function run()
  {
    foreach($this->recentComments as $comment) { // 既可以使用$tag，也可以使用$weight
      $commentString = '<div class="post">
        <div class="title">' .
        '<p style="color:#777;font-style:italic;">'.nl2br($comment->content).'</p>'.
        '<p class="text"><span class="glyphicon glyphicon-user">'.Html::encode($comment->user->username).'</span></p>'.
        '<p style="font-size:8pt;color:blue">《<a href="'.$comment->post->url.'">'.$comment->post->title.'</a>》</p>'.
        '</div>
      </div>';
    }
    return $commentString;
  }
}

?>
