<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Team */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Teams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="team-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'name',
            // 'img',
            [
                'attribute'=>'img',
                'format'=>'html',
                'value'=>function($data){
                    return html::img("/backend/web/images/team/".$data->img,['width'=>'100px']);
                }
            ],
            'field',
            'twitter',
            'telegram',
            'ok',
            'linkedin',
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
