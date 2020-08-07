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