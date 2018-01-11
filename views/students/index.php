<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Students */
/* @var $searchModel app\models\StudentsSearch */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <?php Pjax::begin() ?>
        <?
            if (isset($test)) echo $test;
        ?>
        <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'first_name',
                'last_name',
                'group',
                'points',
            ],
            'emptyText' => '',
            'summary' => '',
        ]); ?>
    <?php Pjax::end() ?>
</div>
