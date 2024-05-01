<?php
namespace App\Enum;

use App\Models\Province;
class ProvinceEnum
{
    const PROVINCES = [
        "Bengo", "Benguela", "Bié", "Cabinda", "Cuando Cubango", "Cuanza Norte",
        "Cuanza Sul", "Cunene", "Huambo", "Huíla", "Luanda", "Lunda Norte",
        "Lunda Sul", "Malanje", "Moxico", "Namibe", "Uíge", "Zaire"
    ];



    public static function getValues()
    {
        $provinces = new Province();
        $provinceNames = array_column($provinces->getProvinces(), 'nome');
        return implode(',', $provinceNames);
    }
}
