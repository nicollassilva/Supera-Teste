@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--10">
        <div class="container mt-2">
            @include('layouts._partials.alerts')
        </div>
        <div class="row ml-0 d-flex justify-content-around mt-5">
            <div class="col col-md-6 col-12 mt-3">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">Contrato</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('layouts._partials.form_contract')
                        </div>
                    </div>
                </div>
            <div class="col col-md-6 col-12 mt-3">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">Unidade</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('layouts._partials.form_unit')
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-12 mt-3">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">Atestado</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('layouts._partials.form_attestation')
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-12 mt-3">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">Usuário</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('layouts._partials.form_member')
                        </div>
                    </div>
                </div>
            </div>
        @include('layouts.footers.auth')
    </div>
@endsection
