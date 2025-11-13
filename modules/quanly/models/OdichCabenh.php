<?php

namespace app\modules\quanly\models;
use app\modules\quanly\base\QuanlyBaseModel;
use Yii;

/**
 * This is the model class for table "odich_cabenh".
 *
 * @property int $id
 * @property int|null $odich_id
 * @property int|null $cabenh_id
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class OdichCabenh extends QuanlyBaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odich_cabenh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['odich_id', 'cabenh_id', 'status', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['odich_id', 'cabenh_id', 'status', 'created_by', 'updated_by'], 'integer'],
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
            'odich_id' => 'Odich ID',
            'cabenh_id' => 'Cabenh ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
