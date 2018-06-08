<?php

namespace app\modules\tarefa\controllers;

use app\modules\tarefa\models\Tarefa;
use yii;
use yii\web\Controller;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

class TarefaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['getTarefas', 'setTarefa', 'updateTarefa', 'deletTarefas'],
                'rules' => [
                    [
                        'allow' => true,
                        'verbs' => ['POST', 'GET', 'PUT', 'DELETE'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        die();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionGetTarefas()
    {
        $model = Tarefa::find()->orderBy('prioridade', 'ASC')->all();

        $tarefas = [];
        foreach ($model as $key => $value) {
            $tarefas[] = $value->getAttributes();
        }

        Yii::$app->response->statusCode = 200;
        return json_encode($tarefas);
    }

    public function actionSetTarefa()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
 
        $student = new Student();
   
        $student->scenario = Student:: SCENARIO_CREATE;
   
        $student->attributes = \yii::$app->request->post();
        // $post_data = Yii::$app->request->post();
        // print_r($post_data);
        // $tarefa = new Tarefa();
        // $tarefa->titulo = '';
        // $tarefa->descricao = '';
        // $tarefa->prioridade = '';
        // $tarefa->save();

        // Yii::$app->response->statusCode = 201;        
        // return json_encode(['data' => $tarefa]);
    }

    public function actionUpdateTarefa()
    {
        $tarefa = Tarefa::find()->one();
        $tarefa->titulo = '';
        $tarefa->descricao = '';
        $tarefa->save();

        Yii::$app->response->statusCode = 202;        
        return json_encode(['data' => $tarefa]);
    }

    public function actionGetBooks()
    {
        if (!empty($_GET)) {
            $model = $this->getBooks();
            // transforma de objeto private para array
            $books = [];
            foreach ($model as $key => $value) {
                $books[] = $value->getAttributes();
            }

            return json_encode(['data' => $books]);
        }
        return json_encode(['data' => '']);
    }
}
