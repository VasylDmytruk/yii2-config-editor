<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $configPath \autoxloo\yii2\config\editor\models\ConfigFile */
/* @var $widgetClass string */
/* @var $widgetConfig array */

$this->title = Yii::t('app', 'Edit "{path}"', ['path' => $configPath->path]);

\autoxloo\yii2\config\editor\ConfigEditorAsset::register($this);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Config Editor'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="config-editor-update">

    <h3><?= $this->title ?></h3>

    <div class="warning">
        <p class="bg-danger text-warning">
            <?= Yii::t('app', 'Be carefull while editing config file, if you put wrong content, you will damage website and wont access it. Make sure you have file backup!') ?>
        </p>
    </div>

    <div class="path-form">
        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($configPath, 'content')->widget($widgetClass, $widgetConfig) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
