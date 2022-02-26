<?php

namespace App\Http\Utils\Database\Student\AdmisionDataManagement;

use App\Models\academic\sse\Causa;
use App\Models\academic\sse\Convenio;
use App\Models\academic\sse\Pago;
use Illuminate\Support\Facades\DB;

trait ManagePaymentMethodUtils
{
    public function getPayMethod()
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.PAGO")
            ->orderByRaw("PA_ID")
            ->get()->fromStdToArray();
        return ($data == null)?[]:$data;
    }

    public function getPayMethodById($paId)
    {
        $data = DB::table("")->select(DB::raw("*"))
            ->fromRaw("SSE.PAGO")
            ->where("PA_ID","=",$paId)
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function getMaxId()
    {
        $data = DB::table("")->select(DB::raw("MAX(PA_ID) AS max"))
            ->fromRaw("SSE.PAGO")
            ->get()->fromStdToArray()->first();
        return ($data == null)?[]:$data;
    }

    public function updatePayMethod($paId,$paName)
    {
        $entity = Pago::where("PA_ID","=",$paId)->update(["PA_NOMBRE" => $paName]);
        if($entity == 1){
            return true;
        }
        return false;
    }

    public function createPayMethod($paName)
    {
        $max = ($this->getMaxId()["max"]+1);
       try{
           return Pago::create(
               [
                   "PA_ID" => $max,
                   "PA_NOMBRE" => $paName
               ]);
       }catch (\Exception $e){
           return false;
       }
    }

    public function deletePayMethod($paId)
    {
        try{
            return Pago::where("PA_ID" ,"=",$paId)->delete();
        }catch (\Exception $e){
            return false;
        }
    }

}
