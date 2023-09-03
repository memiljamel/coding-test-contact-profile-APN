<?php

namespace app\controllers\api;

use yii\helpers\ArrayHelper;

class ContactController extends \yii\rest\ActiveController
{

    public $modelClass = 'app\models\Contact';

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'pagination' => false,
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ],
                ],
            ],
        ]);
    }
}
