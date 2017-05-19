<?php

namespace frontend\modules\alcora\models;

use Yii;

/**
 * This is the model class for table "alcora_user_photo".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $photo
 *
 * @property AlcoraUser $alcoraUser
 */
class AlcoraUserPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alcora_user_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required', 'message' => 'Поле не может быть пустым'],
            [['user_id'], 'integer'],
            [['photo'], 'required', 'message' => 'Выберите хотя бы одну фотографию'],
            [['photo'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlcoraUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlcoraUser()
    {
        return $this->hasOne(AlcoraUser::className(), ['id' => 'user_id']);
    }
}
