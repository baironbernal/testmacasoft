@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Modo Administrador:</h1>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      Crear usuario
                    </button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                      Crear rol
                    </button>
                </div>
            </div>
            
            @include('users.partials.modal-create')
            @include('users.partials.modal-create-role')
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <hr>
            <div id="table_users">
                <user-table>
                     
                </user-table>

                
            </div>
        </div>
    </div>
</div>
@endsection
