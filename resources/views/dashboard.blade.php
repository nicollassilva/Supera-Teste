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
                            <form action="{{ route('contracts.search') }}" method="post" class="form justify-content-center">
                                @csrf
                                <label class="form-control-label" for="cnpj_filter">Filtro</label>
                                <div class="form-group focused justify-content-center d-flex">
                                    <input type="text" name="cnpj_filter" id="cnpj_filter" class="form-control form-control-alternative" placeholder="Filtre por CNPJ" value="{{ $filters['cnpj_filter'] ?? old('cnpj_filter') }}">
                                    <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <form method="post" action="{{ !isset($contractData) ? route('contracts.store') : route('contracts.update', $contractData->id) }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                @if (isset($contractData))
                                    @method("PUT")
                                @endif
                                <h6 class="heading-small text-muted mb-4">Dados Contrato</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="cnpj">CNPJ</label>
                                        <input type="text" name="cnpj" id="cnpj" class="form-control form-control-alternative" placeholder="CNPJ" value="{{ $contractData->cnpj ?? old('cnpj') }}"{{ isset($contractData) ? ' readonly' : '' }}>
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="social-reason">Razão Social</label>
                                        <input type="text" name="social_reason" id="social-reason" class="form-control form-control-alternative" placeholder="Razão Social" value="{{ $contractData->social_reason ?? old('social_reason') }}"{{ isset($contractData) ? ' readonly' : '' }}>
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="fantasy-name">Nome Fantasia</label>
                                        <input type="text" name="fantasy_name" id="fantasy-name" class="form-control form-control-alternative" placeholder="Nome Fantasia" value="{{ $contractData->fantasy_name ?? old('fantasy_name') }}">
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="email">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control form-control-alternative" placeholder="E-mail" value="{{ $contractData->email ?? old('email') }}">
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="image">Logomarca</label>
                                        <input type="file" name="image" id="image" class="form-control form-control-alternative" accept="image/*">
                                        @if (isset($contractData['image']) && $contractData['image'] !== null)
                                            <a href="{{ asset('storage/' . $contractData['image']) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $contractData['image']) }}" class="img-fluid w-25 mt-2 ml-2 img-thumbnail">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" class="custom-select" name="status">
                                            <option value="1"{{ isset($contractData) && $contractData['status'] == '1' ? ' selected' : '' }}>Ativo</option>
                                            <option value="0"{{ isset($contractData) && $contractData['status'] == '0' ? ' selected' : '' }}>Inativo</option>
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">
                                            {{ !isset($contractData) ? 'Adicionar Contrato' : 'Finalizar edição' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if(isset($contractData))
                            <form action="{{ route('contracts.destroy', $contractData->id) }}" method="post" class="form w-100 d-flex justify-content-center mt-2">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger ml-lg-4 " type="submit">Excluir</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            <div class="col col-md-6 col-12 mt-3">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">Unidade {{ session()->get('contract_id') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('units.search') }}" method="post" class="form justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <label class="form-control-label" for="filter">Filtro</label>
                                <div class="form-group focused">
                                    <label class="form-control-label" for="integration_number">N° de Integração</label>
                                    <input type="number" name="integration_number" id="integration_number" class="form-control form-control-alternative" placeholder="Integração da Unidade" value="{{ $filters['integration_number'] ?? old('integration_number') }}" required>
                                </div>
                                <button class="btn btn-default col-12 mb-3" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                            <form method="POST" action="{{ !isset($unitData) ? route('units.store') : route('units.update', $unitData->id) }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                @if (isset($unitData))
                                    @method("PUT")
                                @endif
                                <h6 class="heading-small text-muted mb-4">Dados Contrato</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused row">
                                        <div class="col">
                                            <label class="form-control-label" for="cnpj">*CNPJ</label>
                                            <input type="text" name="cnpj" id="cnpj" class="form-control form-control-alternative" placeholder="CNPJ" value="{{ $unitData->contract->cnpj ?? '' }}" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-control-label" for="fantasy-name">*Nome Fantasia</label>
                                            <input type="text" name="fantasy_name" id="fantasy-name" class="form-control form-control-alternative" placeholder="Nome Fantasia" value="{{ $unitData->contract->fantasy_name ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    @if (!isset($unitData))
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="integration_number">N° de Integração</label>
                                        <input type="number" name="integration_number" id="integration_number" class="form-control form-control-alternative" placeholder="Integração da Unidade" value="{{ old('integration_number') }}">
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="integration_number">CNPJ</label>
                                        <input type="number" name="cnpj_contract" id="cnpj_contract" class="form-control form-control-alternative" placeholder="CPNJ do Contrato" value="{{ old('cnpj_contract') }}">
                                    </div>
                                    @else
                                    <div class="form-group focused justify-content-center d-flex">
                                        <label class="form-control-label">Visualizando unidade n° <strong>{{ $unitData->integration_number }}</strong></label>
                                    </div>
                                    @endif
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="email">E-mail</label>
                                        <input type="email" name="email" id="email_integration" class="form-control form-control-alternative" placeholder="E-mail" value="{{ $unitData->email ?? old('email') }}">
                                    </div>
                                    <div class="form-group focused row">
                                        <div class="col col-3">
                                            <label class="form-control-label" for="state">Estado</label>
                                            <input type="text" name="state" id="state" class="form-control form-control-alternative" placeholder="Ex: MG - SP - RJ" value="{{ $unitData->state ?? old('state') }}">
                                        </div>
                                        <div class="col col-9">
                                            <label class="form-control-label" for="city">Cidade</label>
                                            <input type="text" name="city" id="city" class="form-control form-control-alternative" placeholder="Ex: São Paulo" value="{{ $unitData->city ?? old('city') }}">
                                        </div>
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="image">Logomarca</label>
                                        <input type="file" name="image" id="image" class="form-control form-control-alternative" accept="image/*">
                                        @if (isset($unitData['image']) && $unitData['image'] !== null)
                                            <a href="{{ asset('storage/' . $unitData['image']) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $unitData['image']) }}" class="img-fluid w-25 mt-2 ml-2 img-thumbnail">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="form-group row focused">
                                        <div class="col">
                                            <label class="form-control-label" for="type">Tipo</label>
                                            <select id="type" class="custom-select" name="type">
                                                <option value="0"{{ isset($unitData) && $unitData['type'] == '0' ? ' selected' : '' }}>Json</option>
                                                <option value="1"{{ isset($unitData) && $unitData['type'] == '1' ? ' selected' : '' }}>Webview</option>
                                                <option value="2"{{ isset($unitData) && $unitData['type'] == '2' ? ' selected' : '' }}>XML</option>
                                                <option value="3"{{ isset($unitData) && $unitData['type'] == '3' ? ' selected' : '' }}>HL7</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-control-label" for="status">Status</label>
                                            <select id="status" class="custom-select" name="status">
                                                <option value="1"{{ isset($unitData) && $unitData['status'] == '1' ? ' selected' : '' }}>Ativo</option>
                                                <option value="0"{{ isset($unitData) && $unitData['status'] == '0' ? ' selected' : '' }}>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">
                                            {{ !isset($unitData) ? 'Adicionar Unidade' : 'Finalizar edição' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if(isset($unitData))
                            <form action="{{ route('units.destroy', $unitData->id) }}" method="post" class="form w-100 d-flex justify-content-center mt-2">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger ml-lg-4" type="submit">Excluir</button>
                            </form>
                            @endif
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
                            <form action="" method="post" class="form justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <label class="form-control-label" for="filter">Filtro</label>
                                <div class="form-group focused justify-content-center d-flex">
                                    <input type="text" name="name" id="filter" class="form-control form-control-alternative" placeholder="Filtre por CNPJ">
                                    <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <form method="post" action="https://argon-dashboard-laravel.creative-tim.com/profile" autocomplete="off">
                                <h6 class="heading-small text-muted mb-4">Dados Contrato</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused row">
                                        <div class="col">
                                            <label class="form-control-label" for="cnpj">*CNPJ</label>
                                            <input type="text" name="cnpj" id="cnpj" class="form-control form-control-alternative" placeholder="CNPJ" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="form-control-label" for="fantasy-name">*Nome Fantasia</label>
                                            <input type="text" name="fantasy-name" id="fantasy-name" class="form-control form-control-alternative" placeholder="Nome Fantasia" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="pacient">Paciente</label>
                                        <select id="pacient" class="custom-select" name="pacient">
                                            <option value="1" selected>Pacientes</option>
                                        </select>
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="companion">Acompanhante</label>
                                        <select id="companion" class="custom-select" name="companion">
                                            <option value="1" selected>Acompanhante</option>
                                        </select>
                                    </div>
                                    <div class="form-group row focused">
                                        <div class="col">
                                            <label class="form-control-label" for="status">Óbito</label>
                                            <select id="status" class="custom-select" name="status">
                                                <option value="0" selected>Não</option>
                                                <option value="1">Sim</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-control-label" for="attestation_id">N° do Atestado</label>
                                            <input type="number" name="attestation_id" id="attestation_id" class="form-control form-control-alternative" placeholder="Somente números">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">Incluir</button>
                                    </div>
                                </div>
                            </form>
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
                            <form action="{{ route('members.search') }}" method="post" class="form justify-content-center">
                                @csrf
                                <label class="form-control-label" for="filter">Filtro</label>
                                <div class="form-group focused row">
                                    <div class="col">
                                        <label class="form-control-label" for="cpf">CPF do Usuário</label>
                                        <input type="number" name="cpf_member" id="cpf" class="form-control form-control-alternative" placeholder="CPF" value="{{ $filters['cpf_member'] ?? old('cpf_member') }}">
                                    </div>
                                    <div class="col">
                                        <label class="form-control-label" for="cpf">CNPJ do Contrato</label>
                                        <input type="number" name="cnpj_member" id="cpf" class="form-control form-control-alternative" placeholder="CPF" value="{{ $filters['cnpj_member'] ?? old('cnpj_member') }}">
                                        <p class="text-muted" style="font-size: 12px;">Caso o usuário tiver sido registrado em mais de um contrato, por favor informe também o CNPJ do contrato.</p>
                                    </div>
                                </div>
                                <button class="btn btn-default col-12 mb-3" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                            <form method="post" action="{{ !isset($memberData) ? route('members.store') : route('members.update', $memberData->id) }}" autocomplete="off">
                                @csrf
                                <h6 class="heading-small text-muted mb-4">Dados Contrato</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="cnpj">*CNPJ do contrato</label>
                                        <input type="text" name="cnpj" id="cnpj" class="form-control form-control-alternative" placeholder="CNPJ" value="{{ $memberData->contract->cnpj ?? old('cnpj') }}"{{ isset($memberData) ? ' readonly' : '' }}>
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nome</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="Nome" value="{{ $memberData->name ?? old('name') }}">
                                    </div>
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="cpf">CPF</label>
                                        <input type="text" name="cpf" id="cpf" class="form-control form-control-alternative" placeholder="Somente números" value="{{ $memberData->cpf ?? old('cpf') }}">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ !isset($memberData) ? 'Adicionar usuário' : 'Finalizar edição' }}</button>
                                    </div>
                                </div>
                            </form>
                            <form action="" class="form w-100 d-flex justify-content-center mt-2">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger ml-lg-4 " type="submit">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @include('layouts.footers.auth')
    </div>
@endsection
