<?php

namespace app\controllers;

use Yii;
use app\models\Students;
use app\models\StudentsSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * StudentsController implements the CRUD actions for Students model.
 */
class StudentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Students models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new StudentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'model'        => new Students()
        ]);
    }

    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Students();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'   => 'user_' . $model->id,
                'value'  => 1,
                'expire' => time() + 315360000.0042889 // ten years
            ]));

            Yii::$app->session->addFlash("success", "New student successfully added");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
