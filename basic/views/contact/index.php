<?php

use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contact', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            'phone_number',
            'address:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, array $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model['id']]);
                 }
            ],
        ],
    ]); ?>


</div>
