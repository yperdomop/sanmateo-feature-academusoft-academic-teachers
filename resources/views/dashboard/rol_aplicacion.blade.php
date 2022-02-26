@extends('layouts.app')
@section('content')
<template>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label for="exampleRole" class="form-label">Roles</label>
            <input class="form-control" list="datalistRolApp" id="exampleRole" placeholder="Buscar rol..." v-model="selectedRole">
            <datalist id="datalistRolApp">
                @foreach($roles as $r)
                    <option data-value="{{ $r->rol_id }}" value="{{ $r->rol_nombre }}"></option>
                @endforeach
            </datalist>
            <input class="btn btn-primary mt-2" type="submit" value="Buscar" @click="searchAplicationsRole">
        </div>
    </div>
    <div class="row mt-5" v-show="!isHiddenApppBox">
        <div class="col-md-6">
            <label for="aplication"><b>APLICACIONES:</b></label>
            <ul class="list-group" v-for="app in applications" :key="app.id">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @{{ app.apli_nombre }}
                    <span class="delete_item" @click="deleteAppRole(app.id)"><i class="fas fa-times"></i></span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="row">
                <label for="aplication"><b>AGREGAR APLICACION:</b></label>
                <input class="form-control" list="datalistRol" id="exAplicacion" placeholder="Buscar..." v-model="selectedAplication">
                <datalist id="datalistRol">
                    @foreach($aplicaciones as $a)
                        <option data-value="{{ $a->apli_id }}" value="{{ $a->apli_nombre }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="row mt-2">
                <button type="button" class="btn btn-success btn-block" @click="addAppRole">Agregar</button>
            </div>
        </div>
    </div>
</div>
</template>
@endsection