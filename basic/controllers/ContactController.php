<?php

namespace app\controllers;

use app\models\Contact;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Contact models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $client = new Client();

        $response = $client->createRequest()
            ->setUrl('http://localhost/basic/web/index.php/api/contacts')
            ->setMethod('GET')
            ->addHeaders(['content-type' => 'application/json'])
            ->send();

        $data = $response->getData();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contact model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $client = new Client();

        $response = $client->createRequest()
            ->setUrl('http://localhost/basic/web/index.php/api/contacts/' . $id)
            ->setMethod('GET')
            ->addHeaders(['content-type' => 'application/json'])
            ->send();

        $data = $response->getData();

        return $this->render('view', [
            'model' => $data,
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Contact();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $client = new Client();

                $response = $client->createRequest()
                    ->setUrl('http://localhost/basic/web/index.php/api/contacts')
                    ->setMethod('POST')
                    ->setData([
                        'name' => $model->name,
                        'email' => $model->email,
                        'phone_number' => $model->phone_number,
                        'address' => $model->address,
                        'created_at' => date('Y-d-m h:i:s'),
                    ])
                    ->addHeaders(['content-type' => 'application/json'])
                    ->send();

                if ($response->isOk) {
                    $data = $response->getData();

                    return $this->redirect(['view', 'id' => $data['id']]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $client = new Client();

            $response = $client->createRequest()
                ->setUrl('http://localhost/basic/web/index.php/api/contacts/' . $model->id)
                ->setMethod('PATCH')
                ->setData([
                    'name' => $model->name,
                    'email' => $model->email,
                    'phone_number' => $model->phone_number,
                    'address' => $model->address,
                    'updated_at' => date('Y-d-m h:i:s'),
                ])
                ->addHeaders(['content-type' => 'application/json'])
                ->send();

            if ($response->isOk) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $client = new Client();

        $client->createRequest()
            ->setUrl('http://localhost/basic/web/index.php/api/contacts/' . $id)
            ->setMethod('DELETE')
            ->addHeaders(['content-type' => 'application/json'])
            ->send();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
