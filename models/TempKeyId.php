<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "temp_key_id".
 *
 * @property integer $id
 * @property string $uniqid
 * @property integer $key_id
 */
class TempKeyId extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_key_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniqid', 'key_id'], 'required'],
            [['key_id'], 'integer'],
            [['uniqid'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniqid' => 'Uniqid',
            'key_id' => 'Key ID',
        ];
    }
}
