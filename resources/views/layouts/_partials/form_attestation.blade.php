<form action="{{ route('attestations.search') }}" method="post" class="form justify-content-center">
    @csrf
    <label class="form-control-label" for="filter">Filtro</label>
    <div class="form-group focused justify-content-center d-flex">
        <input type="text" name="cnpj" id="filter" class="form-control form-control-alternative" placeholder="Filtre por CNPJ" value="{{ $contractDta->cnpj ?? old('cnpj') }}">
        <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
    </div>
</form>
<form method="post" action="{{ route('attestations.store') }}" autocomplete="off">
    @csrf
    <h6 class="heading-small text-muted mb-4">Dados Contrato</h6>
    <div class="pl-lg-4">
        <div class="form-group focused row">
            <div class="col">
                <label class="form-control-label" for="cnpj">*CNPJ</label>
                <input type="text" name="cnpj_attestation" id="cnpj" class="form-control form-control-alternative" placeholder="CNPJ" value="{{ $contractDta->cnpj ?? old('cnpj_attestation') }}" readonly>
            </div>
            <div class="col">
                <label class="form-control-label" for="fantasy-name">*Nome Fantasia</label>
                <input type="text" name="fantasy_name_attestation" id="fantasy-name" class="form-control form-control-alternative" placeholder="Nome Fantasia" value="{{ $contractDta->fantasy_name ?? old('fantasy_name_attestation') }}" readonly>
            </div>
        </div>
        <hr>
        <div class="form-group focused">
            <label class="form-control-label" for="pacient">Usuário</label>
            <select id="pacient" class="custom-select" name="pacient">
            @if (isset($contractDta) && $contractDta->members->count() > 0)
                @foreach ($contractDta->members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            @else
                <option selected>Sem usuários</option>
            @endif
            </select>
        </div>
        <div class="form-group focused">
            <label class="form-control-label" for="companion">Acompanhante</label>
            <select id="companion" class="custom-select" name="companion">
                <option value="Maria">Maria</option>
                <option value="João">João</option>
                <option value="Carlos">Carlos</option>
                <option value="Regina" selected>Regina</option>
                <option value="Familiares">Familiares</option>
                <option>Nenhum deles</option>
            </select>
        </div>
        <div class="form-group row focused">
            <div class="col">
                <label class="form-control-label" for="demise">Óbito</label>
                <select id="demise" class="custom-select" name="demise">
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