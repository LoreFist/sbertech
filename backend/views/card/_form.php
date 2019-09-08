<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin([
        'options'              => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'image_url')->widget(FileInput::classname(), [
        'options'       => ['accept' => 'image/jpg, image/jpeg, image/png'],
        'pluginOptions' => [
            'maxFileCount'   => 1,
            'showUpload'     => false,
            'initialPreview' => ($model->image_url) ? [Html::img($model->cardimage, ['class' => 'file-preview-image kv-preview-data'])] : [],
        ],

    ]); ?>

    <div class="form-group btn">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
