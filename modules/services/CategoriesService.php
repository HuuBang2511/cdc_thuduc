<?php
namespace app\modules\services;


use app\modules\quanly\models\Giaothong;
use app\modules\quanly\models\danhmuc\DmGioitinh;
use app\modules\quanly\models\danhmuc\DmDantoc;
use app\modules\quanly\models\danhmuc\DmLoaicabenh;
use app\modules\quanly\models\danhmuc\DmLoaichandoan;
use app\modules\quanly\models\Truonghoc;
use app\modules\quanly\models\Phuongxa;
use app\modules\quanly\models\Khupho;
use app\modules\quanly\models\Tinhthanh;
use app\modules\quanly\models\BenhVien;

class CategoriesService
{
    public static function getCategoriesCabenh()
    {
        $categories = [];
        $categories['giaothong'] = Giaothong::find()->select(['id', 'name'])->orderBy('name')->asArray()->all();
        $categories['phuong'] = Phuongxa::find()->select(['ma_dvhc', 'ten_dvhc'])->where(['status'=>1])->orderBy('ten_dvhc')->asArray()->all();
        $categories['dm_dantoc'] = DmDantoc::find()->where(['status'=>1])->orderBy('ten')->asArray()->all();
        $categories['dm_gioitinh'] = DmGioitinh::find()->where(['status'=>1])->orderBy('ten')->asArray()->all();
        $categories['dm_loaicabenh'] = DmLoaicabenh::find()->where(['status'=>1])->orderBy('ten')->asArray()->all();
        $categories['dm_loaichandoan'] = DmLoaichandoan::find()->where(['status'=>1])->orderBy('ten')->asArray()->all();
        $categories['truonghoc'] = Truonghoc::find()->select(['gid', 'ten_dv'])->orderBy('ten_dv')->asArray()->all();
        $categories['khupho'] = Khupho::find()->select(['id', 'ten_dvhc'])->orderBy('ten_dvhc')->asArray()->all();
        $categories['benhvien'] = BenhVien::find()->select(['id', 'tenbenhvien'])->orderBy('tenbenhvien')->asArray()->all();
        $categories['hinhthuc_dieutri'] = [
            'Nội trú' => 'Nội trú', 
            'Ngoại trú' => 'Ngoại trú',
        ];
        $categories['chon'] = [
            0 => 'Không',
            1 => 'Có'
        ];
        return $categories;
    }
}