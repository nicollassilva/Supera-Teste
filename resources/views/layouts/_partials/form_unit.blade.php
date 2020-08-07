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