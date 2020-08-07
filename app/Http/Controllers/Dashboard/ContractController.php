<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Dashboard\Contract;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateContract;

class ContractController extends Controller
{
    private $repository;

    public function __construct(Contract $contract)
    {
        $this->repository = $contract;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateContract $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid())
            $data['image'] = $request->image->store('contracts');

        $this->repository->create($data);

        return redirect()
                    ->route('home')
                    ->with('success', 'Contrato criado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateContract $request, $id)
    {
        if (!$contract = $this->repository->find($id))
            return redirect()->route('home')->with('error', 'Contrato não encontrado.');

        $data = $request->except('social_reason', 'cnpj');

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($contract->image)) Storage::delete($contract->image);

            $data['image'] = $request->image->store("contracts");
        }

        $contract->update($data);

        return redirect()
                    ->route('home')
                    ->with('success', 'Contrato atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$contract = $this->repository->find($id))
            return redirect()->route('home')->with('error', 'Contrato não encontrado.');
        
        if($contract->units->count() > 0 || $contract->members->count() > 0)
            return redirect()->route('home')->with('error', 'Você não pode excluir um contrato que tem unidades e usuários vinculados a ele.');

        if (Storage::exists($contract->image)) Storage::delete($contract->image);

        $contract->delete();
        return redirect()
                        ->route('home')
                        ->with('success', 'Contrato deletado com sucesso!');
    }

    /**
     * Search contracts.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('cnpj_filter');
        if (!$contract = $this->repository->where('cnpj', $request->cnpj_filter)->first())
            return redirect()
                        ->back()
                        ->with('error', 'Contrato não encontrado.');

        return view('dashboard', [
            'contractData' => $contract,
            'filters' => $filters
        ]);
    }
}
