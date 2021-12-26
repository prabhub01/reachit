<?php

namespace App\Repositories;


use App\Models\SiteSetting;

class SiteSettingRepository extends Repository
{
    public function __construct(SiteSetting $setting)
    {
        $this->model = $setting;
    }

     public function updateByField($field, $value){
        $update = $this->model->where('key', $field)->first();
        $update->fill(['value' => $value])->save();
        return $update;
    }

    public function findValueByKey($field){
        $value = $this->model->where('key', $field)->value('value');
        return $value;
    }



}
