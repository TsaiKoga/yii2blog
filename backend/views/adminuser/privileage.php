<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '权限设置';
$this->params['breadcrumbs'][] = ['label' => '权限设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adminuser-privileage-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="adminuser-form">
      <?php $form = ActiveForm::begin(); ?>

      <?= Html::checkboxList('newPri', $AuthAssignmentArray, $allPrivileageArray); ?>

      <div class="form-group">
          <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>


</div>
