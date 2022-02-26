@extends('layouts.app')
@section('content')
<template>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <span><b>APLICACION</b></span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exAplicacion" class="form-label">Aplicaciones</label>
                        <input class="form-control" list="datalistOptions" id="exAplicacion" placeholder="Buscar..." v-on:change="changeAplication" v-model="selectedAplication">
                        <datalist id="datalistOptions">
                            @foreach($aplicaciones as $a)
                                <option data-value="{{ $a->apli_id }}" value="{{ $a->apli_nombre }}"></option>
                            @endforeach
                        </datalist>
                        <button type="button" class="btn btn-primary btn-sm mt-2" v-on:click="clearElement('exAplicacion')">Limpiar</button>
                    </div>
                    <input type="hidden" v-model="aplication.id">
                    <div class="mb-3">
                        <label for="nombreApli" class="form-label">Nombre Aplicación</label>
                        <input type="text" class="form-control" id="nombreApli" v-model="aplication.name_aplication">
                    </div>
                    <div class="mb-3">
                        <label for="descAplicacion" class="form-label">Descripción aplicación</label>
                        <textarea class="form-control" id="descAplicacion" rows="2" v-model="aplication.desc_aplication"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="urlApli" class="form-label">URL</label>
                        <input type="text" class="form-control" id="urlApli" v-model="aplication.url_aplication">
                    </div>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group col-5 mx-auto" role="group" aria-label="First group">
                            <button class="btn btn-danger" type="button" @click="deleteAplication">Eliminar</button>
                        </div>
                        <div class="btn-group col-5 mx-auto" role="group" aria-label="Second group">
                            <button class="btn btn-success" type="button" @click="saveAplication">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                    <span><b>ROL</b></span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleRole" class="form-label">Roles</label>
                        <input class="form-control" list="datalistRol" id="exampleRole" placeholder="Buscar..." v-on:change="changeRole" v-model="selectedRole">
                        <datalist id="datalistRol">
                            @foreach($roles as $r)
                                <option data-value="{{ $r->rol_id }}" value="{{ $r->rol_nombre }}"></option>
                            @endforeach
                        </datalist>
                        <button type="button" class="btn btn-primary btn-sm mt-2" v-on:click="clearElement('exampleRole')">Limpiar</button>
                    </div>
                    <input type="hidden" v-model="rol.id">
                    <div class="mb-3">
                        <label for="nombreApli" class="form-label">Nombre Rol</label>
                        <input type="text" class="form-control" id="nombreApli" v-model="rol.nombre_rol">
                    </div>
                    <div class="mb-3">
                        <label for="descAplicacion" class="form-label">Descripción Rol</label>
                        <textarea class="form-control" id="descAplicacion" rows="2" v-model="rol.desc_rol"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exaTipo" class="form-label">Tipo Rol</label>
                        <input class="form-control" list="datalistTipos" id="exaTipo" placeholder="Buscar..." v-model="rol.tipo_rol">
                        <datalist id="datalistTipos">
                            <option value="ADMINISTRADOR">
                            <option value="GENERAL">
                            <option value="ESTUDIANTE">
                            <option value="DOCENTE">
                            <option value="TRABAJADOR">
                        </datalist>
                    </div>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group col-5 mx-auto" role="group" aria-label="First group">
                            <button class="btn btn-danger" type="button"  @click="deleteRol">Eliminar</button>
                        </div>
                        <div class="btn-group col-5 mx-auto" role="group" aria-label="Second group">
                            <button class="btn btn-success" type="button" @click="saveRol">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span><b>FUNCIONALIDAD</b></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exAplicacion_2" class="form-label">Aplicaciones</label>
                            <input class="form-control" list="datalistAplications" id="exAplicacion_2" placeholder="Buscar..." v-on:change="changeFuncAplication" v-model="selectedFuncAplication">
                            <datalist id="datalistAplications">
                                @foreach($aplicaciones as $a)
                                    <option data-value="{{ $a->apli_id }}" value="{{ $a->apli_nombre }}"></option>
                                @endforeach
                            </datalist>
                            <button type="button" class="btn btn-primary btn-sm mt-2" v-on:click="clearElement('exAplicacion_2')">Limpiar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exFuncionalidad" class="form-label">Funcionalidades</label>
                            <input class="form-control" list="datalistFuncionalidad" id="exFuncionalidad" placeholder="Buscar..." v-on:change="changeFunc" v-model="selectedFunc">
                            <datalist id="datalistFuncionalidad">
                                
                            </datalist>
                            <button type="button" class="btn btn-primary btn-sm mt-2" v-on:click="clearElement('exFuncionalidad')">Limpiar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombreFunc" class="form-label">Nombre Función</label>
                            <input type="text" class="form-control" id="nombreFunc" v-model="funApl.name_funcion">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nombreFuncUrl" class="form-label">URL Función</label>
                            <input type="text" class="form-control" id="nombreFuncUrl" v-model="funApl.url_func">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="orderFunc" class="form-label">Orden</label>
                            <input type="text" class="form-control" id="orderFunc" v-model="funApl.order">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="descFunc" class="form-label">Descripción Funcionalidad</label>
                            <input type="text" class="form-control" id="descFunc" v-model="funApl.desc_funcion">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="idFunc" class="form-label">ID</label>
                            <input type="text" class="form-control" id="idFunc" v-model="funApl.id" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-danger btn-block" type="button" @click="deleteFunction">Eliminar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-success btn-block" type="button" @click="saveFunction">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
@endsection