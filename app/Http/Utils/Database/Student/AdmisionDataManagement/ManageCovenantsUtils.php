<?php

namespace App\Http\Utils\Database\Student\AdmisionDataManagement;

use App\Models\academic\sse\Causa;
use App\Models\academic\sse\Convenio;
use Illuminate\Support\Facades\DB;

trait ManageCovenantsUtils
{
    public function getCovenants()
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.CONVENIO")
            ->orderByRaw("CON_ID")
            ->get()->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getCovenById($conId)
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.CONVENIO")
            ->where("CON_ID","=",$conId)
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function getMaxId()
    {
        $data = DB::table("")->select(DB::raw("MAX(CON_ID) AS max"))
            ->fromRaw("SSE.CONVENIO")
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function updateCoven($conId,$conName)
    {
        $entity = Convenio::where("CON_ID","=",$conId)->update(["CON_NOMBRE" => $conName]);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function createCoven($conName)
    {
        $maxCause = ($this->getMaxId()["max"]+1);
       try{
           return Convenio::create(
               [
                   "CON_ID" => $maxCause,
                   "CON_NOMBRE" => $conName
               ]);
       }catch (\Exception $e){
           return false;
       }
    }

    public function deleteCoven($conId)
    {
        try{
            return Convenio::where("CON_ID" ,"=",$conId)->delete();
        }catch (\Exception $e){
            return false;
        }
    }

}
