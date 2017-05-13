<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            'email:email',
            // 'profile:ntext',
            // 'password_hash',
            // 'password_reset_token',
            // 'auth_key',
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update} {delete} {resetpwd}',
              'buttons' => [
                'resetpwd' => function($url) {
                  $options = [
                    'title' => Yii::t('yii', '重置密码'),
                    'aria-label' => Yii::t('yii', '重置密码'),
                    'data-confirmation' => Yii::t('yii', '确定要重置?'),
                    'data-method' => 'post',
                    'data-pjax' => '0'
                  ];
                  return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, $options);
                }
              ],
            ],
        ],
    ]); ?>
</div>
