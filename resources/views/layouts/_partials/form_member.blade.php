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
@if(isset($memberData))
    <form action="{{ route('members.destroy', $memberData->id) }}" method="post" class="form w-100 d-flex justify-content-center mt-2">
        @csrf
        @method("DELETE")
        <button class="btn btn-danger ml-lg-4 " type="submit">Excluir</button>
    </form>
@endif