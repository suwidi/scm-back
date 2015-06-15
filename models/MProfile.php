<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "m_profile".
 *
 * @property integer $id
 * @property string $cd
 * @property integer $cb
 * @property string $ed
 * @property integer $eb
 * @property string $name
 * @property string $table_name
 * @property string $type
 * @property string $action
 *
 * @property LpseDetailProfile[] $lpseDetailProfiles
 * @property MLpseProfile[] $mLpseProfiles
 */
class MProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd', 'ed'], 'safe'],
            [['cb', 'eb'], 'integer'],
            [['name', 'action'], 'string'],
            [['table_name'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cd' => 'Cd',
            'cb' => 'Cb',
            'ed' => 'Ed',
            'eb' => 'Eb',
            'name' => 'Name',
            'table_name' => 'Table Name',
            'type' => 'Type',
            'action' => 'Action',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpseDetailProfiles()
    {
        return $this->hasMany(LpseDetailProfile::className(), ['profile_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMLpseProfiles()
    {
        return $this->hasMany(MLpseProfile::className(), ['profile_id' => 'id']);
    }
}
