<?php

use common\models\Header;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Headers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Header <i class="fa-solid fa-plus"></i>'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'img',
            // 'created_at',
            // 'updated_at',
            'title',
            [
                'attribute'=>'img',
                'format'=>'html',
                'value'=>function($data){
                    return html::img('/backend/web/images/header/'.$data->img,['width'=>'300px']);
                }
            ],

           'about_btn',
           'project_btn',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Header $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
