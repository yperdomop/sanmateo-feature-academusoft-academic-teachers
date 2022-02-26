@extends('layouts.app')
@section('content')
<template>
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="exAplicacion_2" class="form-label">Aplicaciones</label>
            <input class="form-control" list="datalistAplications" id="exAplicacion_2" placeholder="Buscar..." v-on:change="changeFuncAplication" v-model="selectedFuncAplication">
            <datalist id="datalistAplications">
                @foreach($aplicaciones as $a)
                    <option data-value="{{ $a->apli_id }}" value="{{ $a->apli_nombre }}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exFuncionalidad" class="form-label">Funcionalidades</label>
            <input class="form-control" list="datalistFuncionalidad" id="exFuncionalidad" placeholder="Buscar..." v-model="selectedFunc">
            <datalist id="datalistFuncionalidad">
                
            </datalist>
            <input class="btn btn-primary mt-2" type="submit" value="Buscar" @click="searchFuncApplicationRol">
        </div>
    </div>
    <div class="row mt-5" v-show="!isHiddenBlockRol">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <span><b>FUNCION ROLES</b></span>
                </div>
                <div class="card-body">
                    <ul class="list-group" v-for="rol in roles_funcion" :key="rol.rpaf_id">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @{{ rol.rol_nombre }}
                            <span class="delete_item" @click="deleteFuncRol(rol.rpaf_id, rol.rpap_id)"><i class="fas fa-times"></i></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                        <span><b>AGREGAR ROL</b></span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input class="form-control" list="datalistRol" id="exampleRole" placeholder="Buscar..." v-model="selectedRole">
                            <datalist id="datalistRol">
                                @foreach($roles as $r)
                                    <option data-value="{{ $r->rol_id }}" value="{{ $r->rol_nombre }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div>
                            <button type="button" class="btn btn-success btn-block" @click="addRoleFunction">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
@endsection