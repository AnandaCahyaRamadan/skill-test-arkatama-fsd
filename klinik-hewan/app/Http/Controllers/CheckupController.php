<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Treatement;
use Illuminate\Http\Request;

class CheckupController extends Controller
{
    public function index()
    {
        $checkups = Checkup::with('treatment.pet')->get();
        return view('pages.checkups.index', compact('checkups'));
    }

    public function create()
    {
        $treatements = Treatement::doesntHave('checkup')
            ->with('pet')
            ->get();

        return view('pages.checkups.create', compact('treatements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tratement_id' => 'required|exists:tratements,id',
            'catatan_pemeriksaan' => 'required',
        ]);

        Checkup::create([
            'tratement_id' => $request->tratement_id,
            'catatan_pemeriksaan' => $request->catatan_pemeriksaan,
        ]);

        return redirect()->route('checkups.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan');
    }

    public function edit(Checkup $checkup)
    {
        return view('pages.checkups.edit', compact('checkup'));
    }

    public function update(Request $request, Checkup $checkup)
    {
        $request->validate([
            'catatan_pemeriksaan' => 'required',
        ]);

        $checkup->update([
            'catatan_pemeriksaan' => $request->catatan_pemeriksaan,
        ]);

        return redirect()->route('checkups.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    public function destroy(Checkup $checkup)
    {
        $checkup->delete();

        return redirect()->route('checkups.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}
