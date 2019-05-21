<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider*/

$this->title = Yii::t('app', 'List of Config Files');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="config-editor-index">
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => \yii\grid\SerialColumn::class,
            ],
            'path',
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $newUrl = ['edit', 'id' => \yii\helpers\ArrayHelper::getValue($model, 'path')];

                        return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil']), $newUrl);
                    },
                ],
            ],
        ],
    ]) ?>
</div>
