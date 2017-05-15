<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;
use yii\helpers\HtmlPurifier;
use common\models\Comment;
 ?>

 <div class="container">
   <div class="row">
     <div class="col-md-9">
       <ol class="breadcrumb">
         <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
         <li><a href="<?= Yii::$app->homeUrl;?>?r=post/index">文章列表</a></li>
         <li><a href="<?= Yii::$app->homeUrl;?>?r=post/detail">文章详细</a></li>
       </ol>

       <div class="post">
         <div class="title">
           <h2><a href="<?= $model->url;?>"><?= Html::encode($model->title);?></a></h2>
           <div class="author">
             <span class="glyphicon glyphicon-time" aria-hidden="true"><?= $model->create_time ?></span>&nbsp;&nbsp;
             <span class="glyphicon glyphicon-user" aria-hidden="true"><?= $model->author->nickname ?></span>
           </div>
         </div>

         <br/>

         <div class="content">
           <?= HtmlPurifier::process($model->content)?>
         </div>

         <br/>

         <div class="nav">
           <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
           <?= implode(',', $model->tagLinks) ?>
           <br/>
           <?=Html::a("评论({$model->commentCount})", $model->url.'#comments'); ?> |
           最后修改于<?= $model->update_time ?>

         </div>

       </div>

       <div id="comments">
         <?php if ($added){ ?>
           <div class="alert alert-warning alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label=""></button>
             <h4>谢谢您的回复，我们会尽快审核后发布的！</h4>
           </div>
         <?php } ?>

         <?php if ($model->commentCount > 0) { ?>
           <h5><?= $model->commentCount.'条评论'?></h5>
           <?= $this->render('_comment', array(
             'post' => $model,
             'comments' => $model->activeComments,
           ))  ?>
         <?php } ?>

         <h5>发表评论</h5>
         <?php $postComment = new Comment(); echo $this->render('_guestform', array('id' => $model->id, 'postComment' => $postComment,)); ?>
       </div>
     </div>

     <div class="col-md-3">
       <div class="searchbox">
         <ul class="list-group">
           <li class="list-group-item">
             <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查找文章
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
             <?= TagsCloudWidget::widget(['tags' => $tags])?>
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
