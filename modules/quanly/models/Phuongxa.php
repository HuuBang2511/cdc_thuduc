<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "phuongxa".
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
 * @property int|null $tinhthanh_id
 *
 * @property Tinhthanh $tinhthanh
 */
class Phuongxa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phuongxa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_dvhc', 'ma_dvhc', 'geom'], 'string'],
            [['status', 'created_by', 'updated_by', 'tinhthanh_id'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'tinhthanh_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tinhthanh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tinhthanh::className(), 'targetAttribute' => ['tinhthanh_id' => 'id']],
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
            'tinhthanh_id' => 'Tinhthanh ID',
        ];
    }

    /**
     * Gets query for [[Tinhthanh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTinhthanh()
    {
        return $this->hasOne(Tinhthanh::className(), ['id' => 'tinhthanh_id']);
    }
}
