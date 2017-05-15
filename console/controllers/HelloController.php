<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\Post;

/**
 *
 */
class HelloController extends Controller
{
  // public $rev;
  // public function options()
  // {
  //     return ['rev'];
  // }
  // public function actionOptionsAliases()
  // {
  //   return ['r' => 'rev'];
  // }


  public function actionIndex()
  {
    // if ($this->rev == 1) {
    //   echo (strrev('Hello World!')."\n");
    // } else {
      echo ("Hello World!\n");
    // }
  }

  public function actionList()
  {
    $posts = Post::find()->all();
    foreach($posts as $post) {
      echo $post->id.' - '.$post->title."\n";
    }
  }

  public function actionWho($name)
  {
    echo ("Hello ".$name.".\n");
  }

  public function actionAll(array $names) {
    var_dump($names);
  }
}


?>
