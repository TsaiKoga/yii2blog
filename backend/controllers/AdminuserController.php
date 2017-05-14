<?php

namespace backend\controllers;

use Yii;
use common\models\Adminuser;
use common\models\AdminuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupForm;
use backend\models\ResetpwdForm;
use common\models\AuthItem;
use common\models\AuthAssignment;

/**
 * AdminuserController implements the CRUD actions for Adminuser model.
 */
class AdminuserController extends Controller
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
     * Lists all Adminuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adminuser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Adminuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
          $user = $model->signup();
          if ($user) {
            if (Yii::$app->user->login($user)) {
              return $this->goHome();
            }
          }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionResetpwd($id)
    {
        $model = new ResetpwdForm();

        if ($model->load(Yii::$app->request->post())) {

          if ($model->resetPassword($id)) {
            return $this->redirect(['index']);
          }
        }
        return $this->render('resetpwd', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Adminuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Adminuser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Adminuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adminuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adminuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrivileage($id)
    {
      // step1 显示全部角色 type=1是Role， type=2是权限
      $allPrivileage = AuthItem::find()->select(['name', 'description'])->where(['type' => 1])->orderBy('description')->all();
      foreach($allPrivileage as $pri) {
        $allPrivileageArray[$pri->name] = $pri->description;
      }

      // step2 当前用户角色
      $authAssignments = AuthAssignment::find()->select(['item_name'])->where(['user_id' => $id])->all();
      $authAssignmentArray = array();
      foreach($authAssignments as $authAssignment) {
        array_push($authAssignmentArray, $authAssignment->item_name);
      }

      // step3: 更新权限
      if (isset($_POST['newPri'])) {
        AuthAssignment::deleteAll('user_id=:id',['id' => $id]);

        $newPri = $_POST['newPri'];
        $arrLength = count($newPri);
        for ($x=0; $x<$arrLength; $x++) {
          $aPri = new AuthAssignment();
          $aPri->item_name = $newPri[$x];
          $aPri->user_id = $id;
          $aPri->save();
        }
        return $this->redirect(['index']);
      }

      // step4:
      return $this->render('privileage', [
        'id' => $id,
        'AuthAssignmentArray' => $authAssignmentArray,
        'allPrivileageArray' => $allPrivileageArray,
      ]);


    }
}
