<?php

namespace frontend\modules\alcora\controllers;

use frontend\modules\alcora\models\AlcoraUser;
use frontend\modules\alcora\models\AlcoraUserPhoto;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new AlcoraUser();
        $modelPhoto = new AlcoraUserPhoto();
        $model->english = AlcoraUser::LANGUAGE_BASIC;
        $model->technique = AlcoraUser::TECHNIQUE_NO;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images = UploadedFile::getInstances($modelPhoto, 'photo');
            foreach ($images as $image) {
                $modelPhoto = new AlcoraUserPhoto();
                $name = self::generateUniquePictureName($image->getExtension());
                if ($image->saveAs(Yii::getAlias(Yii::$app->params['userPhotosUploadPath']) . $name)) {
                    $modelPhoto->photo = $name;
                }
                $modelPhoto->user_id = $model->id;
                $modelPhoto->save();
            }
            self::sendMessage($model);
            $this->redirect(['main/index']);
        } else {
            return $this->render('index', [
                'model' => $model,
                'modelPhoto' => $modelPhoto
            ]);
        }
    }

    /**
     * Generate unique name for save image
     * @param $ext
     * @return string
     */
    public static function generateUniquePictureName($ext)
    {
        do {
            $fileName = Yii::$app->security->generateRandomString().'.'.$ext;
        } while (file_exists(Yii::getAlias(Yii::$app->params['userPhotosUploadPath']) . $fileName));
        return $fileName;
    }

    /**
     * Send message to email
     * @param $model
     * @return bool
     */
    public static function sendMessage($model) {
        return Yii::$app->mailer->compose()
            ->setFrom('from@alcora.com')
            ->setTo($model->email)
            ->setSubject('Данные с формы')
            ->setHtmlBody("
                        <ol>
                            <li>Имя - $model->name</li>
                            <li>Email - $model->email</li>
                            <li>Возраст - $model->age</li>
                            <li>Вес - $model->weight</li>
                            <li>Рост - $model->height</li>
                            <li>Место проживания - $model->city</li>
                        </ol>
                    ")
            ->send();
    }
}

