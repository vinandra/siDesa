<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    public function index()
    {   
        $residents = Resident::with('user')->paginate(10);

        return view('pages.residents.index', ['residents' => $residents]);
    }

    public function create()
    {
        return view('pages.residents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|size:16',
            'name' => 'required|max:100',
            'gender' => 'required', Rule::in(['male', 'female']),
            'birth_date' => 'required|date',
            'birth_place' => 'required|max:100',
            'address' => 'required|max:500',
            'religion' => 'nullable|max:50',
            'marital_status' => 'required', Rule::in(['single', 'married', 'divorced', 'widowed']),
            'occupation' => 'nullable|max:100',
            'phone' => 'nullable|max:15',
            'status' => 'required', Rule::in(['active', 'inactive']),
        ]);

        Resident::create($validated);

        return redirect('/resident')->with('success', 'Berhasil menambahkan data warga.');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);

        return view('pages.residents.edit', ['resident' => $resident]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik' => 'required|size:16',
            'name' => 'required|max:100',
            'gender' => 'required', Rule::in(['male', 'female']),
            'birth_date' => 'required|date',
            'birth_place' => 'required|max:100',
            'address' => 'required|max:500',
            'religion' => 'nullable|max:50',
            'marital_status' => 'required', Rule::in(['single', 'married', 'divorced', 'widowed']),
            'occupation' => 'nullable|max:100',
            'phone' => 'nullable|max:15',
            'status' => 'required', Rule::in(['active', 'inactive']),
        ]);

        Resident::findOrFail($id)->update($validatedData);

        return redirect('/resident')->with('success', 'Berhasil mengubah data warga.');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect('/resident')->with('success', 'Berhasil menghapus data warga.');
    }
}
