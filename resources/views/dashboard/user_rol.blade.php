@extends('layouts.app')
@section('content')
<template>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar usuario..." aria-label="Username" v-model="txt_user">
                <input class="btn btn-primary" type="submit" value="Buscar" @click="searchUser">
            </div>
        </div>
        <div class="col-md-6" v-show="!isHiddenUsersBox">
            <div class="list-group" v-for="user in s_users" id="list_users">
                <a href="#" class="list-group-item list-group-item-action" :key="user.id" @click="showRolesUser(user.id, $event)">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><b>@{{ user.usua_nombre }}</b></h5>
                    </div>
                    <p class="mb-1">@{{ user.usua_usuario }} CC @{{ user.usua_documento }}</p>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-5" v-show="!isHiddenBlockRol">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <span><b>USARIO ROLES</b></span>
                </div>
                <div class="card-body">
                    <ul class="list-group" v-for="rol in roles_usuario" :key="rol.id">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @{{ rol.rol_nombre }}
                            <span class="delete_item" @click="deleteRoleUser(rol.id)"><i class="fas fa-times"></i></span>
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
                            <button type="button" class="btn btn-success btn-block" @click="addRoleUser">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
@endsection