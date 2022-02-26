<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class MigratePasswordsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $results = DB::table('GENERAL.USUARIO')->select('USUA_ID','USUA_CONTRASENA','PASSWORD')->get();
        // foreach ($results as $result){
        //     DB::table('GENERAL.USUARIO')
        //         ->where('USUA_ID',$result->usua_id)
        //         ->update([
        //             "PASSWORD" => Hash::make($result->usua_contrasena)
        //     ]);
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
