<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update <i class="fa-solid fa-pen-to-square"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete <i class="fa-solid fa-trash"></i>'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // 'img',
            [
                'attribute'=>'img',
                'format'=>'html',
                'value'=>function($data){
                    return html::img('/backend/web/images/clents/'.$data->img,['width'=>'200px']);
                }
            ],
            'title',
            // 'created_at',
            // 'updated_at',
            [
                'attribute'=>'created_at',
                'format'=>'html',
                'value'=>function($data){
                    return date('d-M Y',$data->created_at); 
                }
            ],

            [
                'attribute'=>'updated_at',
                'format'=>'html',
                'value'=>function($data){
                    return date('d-M Y',$data->updated_at); 
                }
            ],
        ],
    ]) ?>

</div>
