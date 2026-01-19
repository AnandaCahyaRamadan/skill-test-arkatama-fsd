<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('owner')->latest()->get();
        return view('pages.pets.index', compact('pets'));
    }

    public function create()
    {
        $owners = Owner::where('phone_verified', true)->get();
        return view('pages.pets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        return $this->savePet($request);
    }

    public function edit(Pet $pet)
    {
        $owners = Owner::where('phone_verified', true)->get();

        $petText = "{$pet->nama} {$pet->jenis} {$pet->usia}Th {$pet->berat}kg";

        return view('pages.pets.edit', compact('pet', 'owners', 'petText'));
    }

    public function update(Request $request, Pet $pet)
    {
        return $this->savePet($request, $pet);
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pets.index')
            ->with('success', 'Data hewan berhasil dihapus');
    }

    /* ================= SHARED LOGIC ================= */
    private function savePet(Request $request, Pet $pet = null)
    {
        $request->validate([
            'hewan' => 'required|string',
            'owner_id' => 'required|exists:owners,id'
        ]);

        // normalize spaces
        $raw = preg_replace('/\s+/', ' ', trim($request->hewan));
        $parts = explode(' ', $raw);

        if (count($parts) < 4) {
            return back()->withErrors('Format input hewan tidak valid')->withInput();
        }

        [$nama, $jenis, $usiaRaw, $beratRaw] = array_slice($parts, 0, 4);

        // usia
        if (!preg_match('/(\d+)/', $usiaRaw, $u)) {
            return back()->withErrors('Format usia salah')->withInput();
        }
        $usia = (int) $u[1];

        // berat
        $beratRaw = str_replace(',', '.', strtoupper($beratRaw));
        if (!preg_match('/(\d+(\.\d+)?)/', $beratRaw, $b)) {
            return back()->withErrors('Format berat salah')->withInput();
        }
        $berat = (float) $b[1];

        $nama  = strtoupper($nama);
        $jenis = strtoupper($jenis);

        // validasi duplikat
        $check = Pet::where('owner_id', $request->owner_id)
            ->where('nama', $nama)
            ->where('jenis', $jenis);

        if ($pet) {
            $check->where('id', '!=', $pet->id);
        }

        if ($check->exists()) {
            return back()->withErrors('Hewan dengan nama & jenis sama sudah ada')->withInput();
        }

        DB::beginTransaction();
        try {
            // generate kode jika create
            if (!$pet) {
                $time = now()->format('Hi');
                $owner = str_pad($request->owner_id, 4, '0', STR_PAD_LEFT);
                $urut = str_pad(Pet::count() + 1, 4, '0', STR_PAD_LEFT);
                $kode = $time . $owner . $urut;
            }

            ($pet ?? new Pet)->fill([
                'kode_hewan' => $pet ? $pet->kode_hewan : $kode,
                'nama' => $nama,
                'jenis' => $jenis,
                'usia' => $usia,
                'berat' => $berat,
                'owner_id' => $request->owner_id
            ])->save();

            DB::commit();

            return redirect()->route('pets.index')
                ->with('success', 'Data hewan berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
