<?php
use yii\helpers\Html;
use yii\widgets\ListView;
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
       右侧内容
     </div>

   </div>
 </div>
