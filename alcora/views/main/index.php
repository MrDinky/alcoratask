<?php
use frontend\modules\alcora\assets\MainAsset;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\alcora\models\AlcoraUser;
use frontend\modules\alcora\models\AlcoraUserPhoto;

/**
 * @var $model AlcoraUser
 * @var $modelPhoto AlcoraUserPhoto
 */
MainAsset::register($this);
?>
<div class="alcora-wrapper">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'],
    ]); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name', [
                    "template" => AlcoraUser::getTemplateForInput('glyphicon-user')
                    ])->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>
                <?= $form->field($model, 'age', [
                    "template" => AlcoraUser::getTemplateForInput('glyphicon-eye-open')
                    ])->textInput(['placeholder' => $model->getAttributeLabel('age')]) ?>
                <?= $form->field($model, 'weight', [
                    "template" => AlcoraUser::getTemplateForInput('glyphicon-oil')
                    ])->textInput(['placeholder' => $model->getAttributeLabel('weight')]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email', [
                    "template" => AlcoraUser::getTemplateForInput('glyphicon-book')
                    ])->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
                <?= $form->field($model, 'height', [
                    "template" => AlcoraUser::getTemplateForInput('glyphicon-arrow-up'
                    )])->textInput(['placeholder' => $model->getAttributeLabel('height')]) ?>
                <?= $form->field($model, 'city', [
                    "template" => AlcoraUser::getTemplateForInput('glyphicon-map-marker')
                    ])->textInput(['placeholder' => $model->getAttributeLabel('city')]) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'technique', [
                    "template" => "<span class='glyphicon glyphicon-knight'></span>" .  $model->getAttributeLabel('technique') . " {input}{error}{hint}"
                ])->radioList(AlcoraUser::getTechniqueList(), ['class' => 'technique-block']) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'english', [
                    "template" => "<span class='glyphicon glyphicon-education'></span>" .  $model->getAttributeLabel('english') . " {input}{error}{hint}"
                ])->radioList(AlcoraUser::getLanguageList(), ['class' => 'english-block'])?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><span class="glyphicon glyphicon-save-file add-photo-label"></span>Добавить фото(до 5 шт.)</div>
            <div class="col-md-8 text-right">
                <?= $form->field($modelPhoto, 'photo[]')->widget(FileInput::className(), [
                    'id' => 'file-upload',
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => true,
                    ],
                    'language' => 'ru',
                    'sortThumbs' => false,
                    'pluginOptions' => [
                        'showPreview' => true,
                        'showUpload' => false,
                        'showCaption' => false,
                        'dropZoneEnabled' => false,
                        'showUploadedThumbs' => true,
                        'initialPreviewFileType' => 'image',
                        'validateInitialCount' => true,
                        'maxFileCount' => 5,
                        'browseIcon' => '<i class="glyphicon glyphicon-plus"></i> ',
                        'browseLabel' =>  'Загрузить'
                    ]
                ])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group alcora-send-button-row">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
