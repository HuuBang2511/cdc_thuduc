<?php

namespace app\modules\quanly\models;
use app\modules\quanly\base\QuanlyBaseModel;
use Yii;

/**
 * This is the model class for table "giaothong".
 *
 * @property int $id
 * @property string|null $geom
 * @property string|null $name
 * @property int|null $id_kp
 * @property string|null $ten_kp
 * @property string|null $ma_dvhc
 */
class Giaothong extends QuanlyBaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'giaothong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['geom'], 'string'],
            [['id_kp'], 'default', 'value' => null],
            [['id_kp'], 'integer'],
            [['name', 'ma_dvhc'], 'string', 'max' => 254],
            [['ten_kp'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'geom' => 'Geom',
            'name' => 'Name',
            'id_kp' => 'Id Kp',
            'ten_kp' => 'Ten Kp',
            'ma_dvhc' => 'Ma Dvhc',
        ];
    }
}
