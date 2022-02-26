<?php

namespace App\Http\Utils\Database\Student\AdmisionDataManagement;

use App\Models\academic\sse\Causa;
use Illuminate\Support\Facades\DB;

trait ManageCausesUtils
{
    public function getCausesList()
    {
        $data = DB::table("")->select(DB::raw("CAU_ID,CAU_NOMBRE"))
            ->fromRaw("SSE.CAUSA")
            ->orderByRaw("CAU_ID")
            ->get()->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getCauseById($cauId)
    {
        $data = DB::table("")->select(DB::raw("CAU_ID,CAU_NOMBRE"))
            ->fromRaw("SSE.CAUSA")
            ->where("CAU_ID","=",$cauId)
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function getMaxIdCause()
    {
        $data = DB::table("")->select(DB::raw("MAX(CAU_ID) AS max"))
            ->fromRaw("SSE.CAUSA")
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function updateCause($cauId,$cauName)
    {
        $entity = Causa::where("CAU_ID","=",$cauId)->update(["CAU_NOMBRE" => $cauName]);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function createCause($cauName)
    {
        $maxCause = ($this->getMaxIdCause()["max"]+1);
       try{
           return Causa::create(
               [
                   "CAU_ID" => $maxCause,
                   "CAU_NOMBRE" => $cauName
               ]);
       }catch (\Exception $e){
           return false;
       }
    }
}
