<?php

namespace App\Http\Utils\Database\Student\AdmisionDataManagement;

use App\Models\academic\sse\TipoAdjunto;
use Illuminate\Support\Facades\DB;

trait ManageTypeDocsUtils
{
    public function getList()
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.TIPO_ADJUNTO")
            ->orderByRaw("TI_ID")
            ->get()->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getDataById($tiId)
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.TIPO_ADJUNTO")
            ->where("TI_ID","=",$tiId)
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function getMaxId()
    {
        $data = DB::table("")->select(DB::raw("MAX(TI_ID) AS max"))
            ->fromRaw("SSE.TIPO_ADJUNTO")
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function updateRegister($tiId,$tiNombre)
    {
        $entity = TipoAdjunto::where("TI_ID","=",$tiId)->update(["TI_NOMBRE" => $tiNombre]);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function createRegister($tiNombre)
    {
        $max = ($this->getMaxId()["max"]+1);
       try{
           return TipoAdjunto::create(
               [
                   "TI_ID" => $max,
                   "TI_NOMBRE" => $tiNombre
               ]);
       }catch (\Exception $e){
           return false;
       }
    }

    public function deleteRegistrer($tiId)
    {
        try{
            return TipoAdjunto::where("TI_ID" ,"=",$tiId)->delete();
        }catch (\Exception $e){
            return false;
        }
    }

}
