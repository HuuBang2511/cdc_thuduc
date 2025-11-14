<?php

namespace app\modules\quanly\models\danhmuc;

use Yii;

/**
 * This is the model class for table "dm_xacdinhodich".
 *
 * @property int $id
 * @property string|null $ten
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Odich[] $odiches
 */
class DmXacdinhodich extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_xacdinhodich';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten'], 'string'],
            [['status', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Ten',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Odiches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOdiches()
    {
        return $this->hasMany(Odich::className(), ['xacdinhodich_id' => 'id']);
    }
}
