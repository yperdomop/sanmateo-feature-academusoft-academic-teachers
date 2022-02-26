<?php

namespace App\Http\Utils\Database\Student\AdmisionDataManagement;

use App\Models\academic\sse\TipoFormulario;
use Illuminate\Support\Facades\DB;

trait ManageTypeFormUtils
{
    public function getList()
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.TIPO_FORMULARIO")
            ->orderByRaw("TF_ID")
            ->get()->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getDataById($tfId)
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.TIPO_FORMULARIO")
            ->where("TF_ID","=",$tfId)
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function getMaxId()
    {
        $data = DB::table("")->select(DB::raw("MAX(TF_ID) AS max"))
            ->fromRaw("SSE.TIPO_FORMULARIO")
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function updateRegister($tfId,$tfNombre)
    {
        $entity = TipoFormulario::where("TF_ID","=",$tfId)->update(["TF_NOMBRE" => $tfNombre]);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function createRegister($tfNombre)
    {
        $max = ($this->getMaxId()["max"]+1);
       try{
           return TipoFormulario::create(
               [
                   "TF_ID" => $max,
                   "TF_NOMBRE" => $tfNombre
               ]);
       }catch (\Exception $e){
           return false;
       }
    }

    public function deleteRegistrer($tfId)
    {
        try{
            return TipoFormulario::where("TF_ID" ,"=",$tfId)->delete();
        }catch (\Exception $e){
            return false;
        }
    }

}
