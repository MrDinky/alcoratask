<?php

namespace frontend\modules\alcora\models;

use Yii;

/**
 * This is the model class for table "alcora_user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $age
 * @property string $city
 * @property integer $height
 * @property integer $weight
 * @property string $english
 * @property string $technique
 *
 * @property AlcoraUserPhoto[] $photo
 */
class AlcoraUser extends \yii\db\ActiveRecord
{
    const TECHNIQUE_NO = 'no';
    const TECHNIQUE_CAMERA = 'camera';
    const TECHNIQUE_CAMERA_COMP = 'camera_comp';

    const LANGUAGE_NO = 'no';
    const LANGUAGE_BASIC = 'basic';
    const LANGUAGE_MIDDLE = 'middle';
    const LANGUAGE_HIGH = 'high';
    const LANGUAGE_EXCELLENT = 'excellent';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alcora_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'age', 'city', 'height', 'weight'], 'required', 'message' => 'Поле не может быть пустым'],
            [['age', 'height', 'weight'], 'integer'],
            [['age'], 'number', 'max' => 99, 'min' => 1, 'tooSmall' => 'Поле должно быть больше 0', 'tooBig' => 'Поле должно быть меньше 100'],
            [['height', 'weight'], 'number', 'max' => 999, 'min' => 1, 'tooSmall' => 'Поле должно быть больше 0', 'tooBig' => 'Поле должно быть меньше 1000'],
            [['city', 'english', 'technique'], 'string'],
            [['name', 'email'], 'string', 'max' => 100, 'tooLong' => 'Максимальная длина 100 символов'],
            [['email'], 'email', 'message' => 'Не правильный формат email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'E-mail',
            'age' => 'Возраст(полных лет)',
            'city' => 'Город проживания',
            'height' => 'Рост',
            'weight' => 'Вес',
            'english' => 'Знание английского',
            'technique' => 'Нужна ли техника в аренду',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasMany(AlcoraUserPhoto::className(), ['user_id' => 'id']);
    }

    public static function getTechniqueList() {
        return [
            self::TECHNIQUE_NO => 'нет',
            self::TECHNIQUE_CAMERA => 'да, только камера',
            self::TECHNIQUE_CAMERA_COMP => 'да, компъютер и камера',
        ];
    }

    /**
     * Get list of language status
     * @return array
     */
    public static function getLanguageList() {
        return [
            self::LANGUAGE_NO => 'без знания',
            self::LANGUAGE_BASIC => 'базовый',
            self::LANGUAGE_MIDDLE => 'средний',
            self::LANGUAGE_HIGH => 'высокий',
            self::LANGUAGE_EXCELLENT => 'превосходный',
        ];
    }

    /**
     * Get template for input buttons
     * @param $iconClass
     * @return string
     */
    public static function getTemplateForInput($iconClass) {
        return "<div class='input-group'>
                    <span class='input-group-addon'>
                        <span class='glyphicon $iconClass'></span>
                    </span>
                    {input}
                </div>
                {error}{hint}";
    }
}
