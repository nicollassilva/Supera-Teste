<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Dashboard\{
    Contract,
    Unit
};
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUnit;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    private $repository;

    public function __construct(Unit $contract)
    {
        $this->repository = $contract;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUnit $request)
    {
        if(!$contract = Contract::where('cnpj', $request->cnpj_contract)->first())
            return redirect()->route('home')->with('error', 'Contrato não existe ou CNPJ inválido.');

        $data = $request->except('cnpj_contract');
        $data['contract_id'] = $contract->id;

        if ($request->hasFile('image') && $request->image->isValid())
            $data['image'] = $request->image->store('units');

        $this->repository->create($data);

        return redirect()
                    ->route('home')
                    ->with('success', 'Unidade criada com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUnit $request, $id)
    {
        if (!$unit = $this->repository->find($id))
            return redirect()->route('home')->with('error', 'Unidade não encontrada.');

        $data = $request->except('cnpj', 'fantasy_name');

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($unit->image)) Storage::delete($unit->image);

            $data['image'] = $request->image->store("units");
        }

        $unit->update($data);

        return redirect()
                    ->route('home')
                    ->with('success', 'Unidade atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$unit = $this->repository->find($id))
            return redirect()->route('home')->with('error', 'Unidade não encontrada.');

        if (Storage::exists($unit->image)) Storage::delete($unit->image);
        
        $unit->delete();
        return redirect()
                        ->route('home')
                        ->with('success', 'Unidade deletada com sucesso!');
    }

    /**
     * Search units.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('integration_number');

        if(!$unit = $this->repository->where('integration_number', $filters['integration_number'])->with('contract')->first())
            return redirect()->route('home')->with('error', 'Unidade não encontrada.');

        return view('dashboard', [
            'unitData' => $unit,
            'filters' => $filters
        ]);
    }
}
