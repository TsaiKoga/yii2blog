<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;
use common\models\Post;
use yii\caching\DbDependency;
 ?>

 <div class="container">
   <div class="row">
     <div class="col-md-9">
       <?= ListView::widget([
         'id' => 'postList',
         'dataProvider' => $dataProvider,
         'itemView' => '_listitem', //子视图
         'layout' => '{items} {pager}',
         'pager' => [
           'maxButtonCount' => 10,
           'nextPageLabel' => Yii::t('app', '下一页'),
           'prevPageLabel' => Yii::t('app', '上一页'),
         ],
         ]) ?>
     </div>

     <div class="col-md-3">
       <div class="searchbox">
         <ul class="list-group">
           <li class="list-group-item">
             <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查找文章
             <?php
             $postCount = Yii::$app->cache->get('postCount');
             if (!$postCount) {
               $postCount = Post::find()->count();
               $dependency = new DbDependency(['sql'=>'select count(id) from post;']);

               Yii::$app->cache->set('postCount', $postCount, 600, $dependency); // 600为缓存过期时间，$dependency为缓存依赖条件（这里用的是DbDependency）
               sleep(5);
             }
             echo $postCount;
             ?>
           </li>
           <li class="list-group-item">
             <form class="form-inline" action="index.php?r=post/index" method="get">
               <div class="form-group">
                 <input type="text" class="form-control" name="PostSearch[title]" placeholder="按标题">
               </div>
               <button type="submit" class="btn btn-default">搜索</button>
             </form>
           </li>
         </ul>
       </div>

       <div class="tagcloudbox">
         <ul class="list-group">
           <li class="list-group-item">
             <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 标签云
           </li>
           <li class="list-group-item">
             <!-- <?php $dependency = new DbDependency(['sql' => 'select count(id) from post']);
              if ($this->beginCache('cache', ['duration' => 600], ['dependency' => $dependency]))
              {
                echo TagsCloudWidget::widget(['tags' => $tags]);
                sleep(3);
                $this->endCache();
              }
             ?> -->
           </li>
         </ul>
       </div>

       <div class="commentbox">
         <ul class="list-group">
           <li class="list-group-item">
             <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
           </li>
           <li class="list-group-item">
             <?= RctReplyWidget::widget(['recentComments' => $recentComments])?>
           </li>
         </ul>
       </div>
     </div>

   </div>
 </div>
