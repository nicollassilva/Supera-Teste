<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Dashboard\{
    Attestation,
    Contract
};
use App\Http\Controllers\Controller;

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
     * @param  \App\Http\Requests\StoreUpdateMember  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateMember $request)
    {
        if (!$contract = Contract::where('cnpj', $request->cnpj)->first())
            return redirect()->route('home')->with('error', 'Contrato não existe ou CNPJ inválido.');

        if ($member = $this->repository->where([['cpf', $request->cpf], ['contract_id', $contract->id]])->first())
            return redirect()->route('home')->with('error', 'Usuário já foi registrado nesse contrato.');

        $data = $request->all();
        $data['contract_id'] = $contract->id;
        $this->repository->create($data);

        return redirect()->route('home')->with('success', 'Usuário criado com sucesso.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateMember  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateMember $request, $id)
    {
        if ($user = $this->repository->where($id)->first())
            return redirect()->route('home')->with('error', 'Usuário já foi registrado nesse contrato.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$member = $this->repository->find($id))
            return redirect()->route('home')->with('error', 'Usuário não encontrado.');

        $member->delete();
        return redirect()->route('home')->with('success', 'Usuário deletado com sucesso!');
    }

    /**
     * Search members.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $this->repository->search($request->all());
        if($search['error'])
            return redirect()->route('home')->with('error', 'Usuário não encontrado ou CNPJ inválido.');

        return view('dashboard', [
            'memberData' => $search,
            'filters' => $request->except("_token")
        ]);
    }
}
