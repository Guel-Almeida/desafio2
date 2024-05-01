<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Province extends Model
{
    use HasFactory;

    public function getProvinces()
    {
        $provincesJson = File::get(__DIR__ . '/province.json');
        $provincesData = json_decode($provincesJson, true);
        $provinces = $provincesData['Angola']['Provincias'];

        return $provinces;

    }
}
