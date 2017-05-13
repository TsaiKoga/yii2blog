<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Commentstatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建评论', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'post.title',
            [
              'attribute' => 'content',
              'value' => 'beginning' // 因为已经将$searchModel赋值filterModel了，所以直接用字符串引用属性和方法。
              // 'value' => function($model) {
              //     $tmpStr = strip_tags($model->content); // 去掉html标签
              //     $tmpLen = mb_strlen($tmpStr);
              //     return mb_substr($tmpStr, 0, 20, 'utf-8').($tmpLen>20 ? "..." : '');
              // }
            ],
            [
              'attribute' => 'status',
              'value' => 'status0.name',
              'filter' => Commentstatus::find()->select(['name','id'])->indexBy('id')->orderBy('position')->column(),
            ],
            'create_time',
            'email:email',
            'url:url',
            [
              'attribute' => 'user.username',
              'label' => '作者',
              'value' => 'user.username'
            ],
            // 'post_id',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
