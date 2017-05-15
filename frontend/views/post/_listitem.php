<?php
use yii\helpers\Html;
?>

<div class="post">
  <div class="title">
    <h2><a href="<?= $model->url ?>"><?= Html::encode($model->title); ?></a></h2>

    <div class="author">
      <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= $model->create_time;?></em>&nbsp;&nbsp;
      <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= $model->author->nickname;?></em>
    </div>
  </div>

  <div class="content">
    <?= $model->beginning; ?>
  </div>

  <div class="nav">
    <span class="glyphicon glyphicon-tag" aira-hidden="true"></span>
    <?= implode(',', $model->taglinks) ?>
    <br/>
    <?= Html::a("评论 ({$model->Commentcount})", $model->url."#comments" )?> | 最后修改于 <?= $model->update_time ?>
  </div>
</div>
