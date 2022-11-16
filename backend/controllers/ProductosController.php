<?php

namespace backend\controllers;

use common\models\Productos;
use common\models\SearchProductos;
use common\AWS\S3;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchProductos();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productos model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Productos();

        $categorias = [ 
                'computers' => 'computers', 
                'cellphones' => 'cellphones',  
                'headphones' => 'headphones',
                'watches' => 'watches',
                'speakers' => 'speakers'
            ];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $image = UploadedFile::getInstance($model, 'imagen');
                $url = S3::subirArchivoS3($image->baseName . '.' . $image->extension, 'Productos');
                $model->imagen = $url;

                if($model->validate()){
                    // $model->imagen->saveAs('uploadsArticle/' . $model->imagen->baseName . '.' . $model->imagen->extension);
                    
                    $model->save();
                    return $this->redirect(['view', 
                        'id' => $model->id,
                    ]);
                }else{
                    return var_dump($model->errors);
                }
            }

        } else {
            
            if(empty($model->errors)){
                $model->loadDefaultValues();
            }else{
                return var_dump($model->errors);            
            }

        }

        return $this->render('create', [
            'model' => $model,
            'categorias' => $categorias
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categorias = [ 
            'computers' => 'computers', 
            'cellphones' => 'cellphones',  
            'headphones' => 'headphones',
            'watches' => 'watches',
            'speakers' => 'speakers'
        ];

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categorias' => $categorias
        ]);
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        S3::eliminarArchivoS3($model->imagen);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
