@extends('layouts.app2')
@section('title', 'Lista de Inquilos')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Inquilos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Inquilos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createTenancy"><i class="fa fa-check"></i> Crear Inquilino</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Subdominio</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Encargado(a)</th>
                                        <th scope="col">Base de Datos</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $countDomains = 1;
                                    @endphp
                                    @foreach($tenants as $domain)
                                        <tr class="text-center">
                                            <th scope="row" style="width: 50px;">{{$countDomains}}</th>
                                            <td>{{$domain->id . '.' .config('tenancy.central_domains')[1]}}</td>
                                            <td>{{ $domain->company  }}</td>
                                            <td>{{ $domain->name  }}</td>
                                            <td>{{ $domain->tenancy_db_name  }}</td>
                                            <td style="width: 100px;">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="modal" data-target="#editTenancy_{{$loop->iteration}}" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                                    <a style="margin-left: 5px" title="Eliminar" onclick="document.getElementById('eliminarTenancy_{{ $loop->iteration }}').submit()" class="btn btn-danger ">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $countDomains++;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal fade" id="createTenancy"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-check-circle"></i> Nuevo Inquilino</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('admin.tenancies.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div style="max-height: 365px; overflow-y: scroll; overflow-x: hidden">
                                    <div class="d-flex justify-content-end">
                                        <span class="text-danger mt-1">* </span><span>Campo requerido.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"><span class="text-danger">*</span> Empresa:</label>
                                        <input type="text" name="company" required class="form-control form-control-border" id="company" placeholder="Empresa">
                                    </div>
                                    @error('company')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror


                                    <div class="form-group">
                                        <label for="domain"><span class="text-danger">*</span> Dominio:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="domain" id="domain" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.{{config('tenancy.central_domains')[1]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('domain')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror


                                    <div class="form-group">
                                        <label for="name"><span class="text-danger">*</span> Nombre:</label>
                                        <input type="text" name="name" required class="form-control form-control-border" id="name" placeholder="Nombre del usuario">
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                    <div class="form-group">
                                        <label for="email"><span class="text-danger">*</span> Correo:</label>
                                        <input type="email" name="email" required class="form-control form-control-border" id="email" placeholder="Correo del usuario">
                                    </div>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                    <div class="form-group">
                                        <label for="password"><span class="text-danger">*</span> Contraseña:</label>
                                        <input type="password" name="password" required class="form-control form-control-border" id="password" placeholder="Contraseña del usuario">
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </section>
@endsection
