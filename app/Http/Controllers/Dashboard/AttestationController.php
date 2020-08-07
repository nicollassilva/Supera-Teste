<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Dashboard\{
    Attestation,
    Contract,
    Member
};
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateAttestation;

class AttestationController extends Controller
{
    private $repository;

    public function __construct(Attestation $attestation)
    {
        $this->repository = $attestation;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateAttestation  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAttestation $request)
    {
        if (!$contract = Contract::where('cnpj', $request->cnpj_attestation)->first())
            return redirect()->route('home')->with('error', 'Contrato não existe ou CNPJ inválido.');

        if(!$member = Member::find($request->pacient)->where('contract_id', $contract->id)->first())
            return redirect()->route('home')->with('error', 'Usuário não existe nesse contrato.');

        $this->repository->create([
            'contract_id' => $contract->id,
            'pacient_id' => $member->id,
            'companion' => $request->companion,
            'demise' => $request->demise,
            'attestation_id' => $request->attestation_id
        ]);

        return redirect()->route('home')->with('success', 'Atestado inserido com sucesso!');

    }
    
    /**
     * Search members.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if (!$contract = Contract::where('cnpj', $request->cnpj)->with('members')->first())
            return redirect()->route('home')->with('error', 'Contrato não existe ou CNPJ inválido.');

        return view('dashboard', [
            'contractDta' => $contract
        ]);
    }
}
