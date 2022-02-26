@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Bienvenido ' . Auth::user()->usua_nombre }} </div>
                <div class="card-body">
                    <label><b>ROL</b></label><br>
                    <select class="form-select w-50" v-model="selected_rol" v-on:change="loadApplications">
                        @foreach($roles as $r)
                            <option value="{{ $r->rol_id }}">{{ $r->rol_nombre }}</option>
                        @endforeach
                    </select><br><br>
                    <label><b>APLICACION</b></label><br>
                    <select class="form-select w-50" v-model="selected_apli">
                        <option value="">Seleccione aplicación</option>
                        <option v-for="app in applications" v-bind:value="app.apli_id">
                            @{{ app.apli_nombre }}
                        </option>
                    </select><br><br>
                    <button type="button" class="btn btn-success w-50" v-on:click="redirect_page">Seleccionar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection