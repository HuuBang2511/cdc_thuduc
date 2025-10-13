<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "tinhthanh".
 *
 * @property int $id
 * @property string|null $ten_dvhc
 * @property string|null $ma_dvhc
 * @property string|null $geom
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Phuongxa[] $phuongxas
 */
class Tinhthanh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tinhthanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_dvhc', 'ma_dvhc', 'geom'], 'string'],
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
            'ten_dvhc' => 'Ten Dvhc',
            'ma_dvhc' => 'Ma Dvhc',
            'geom' => 'Geom',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Phuongxas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhuongxas()
    {
        return $this->hasMany(Phuongxa::className(), ['tinhthanh_id' => 'id']);
    }
}
