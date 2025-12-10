<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Faker\Provider\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $residentId = Auth::user()->resident->id ?? null;
        $complaints = Complaint::when(Auth::user()->role_id == 2, function ($query) use ($residentId) {
            $query->where('resident_id', $residentId);
        })->paginate(5);

        return view('pages.complaint.index', compact(
            'complaints',
        ));
    }

    public function create()
    {
        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'akun anda belum terhubung dengan data penduduk manapun');
        }

        return view('pages.complaint.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg, jpeg', 'max:2048']
        ]);

        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'akun anda belum terhubung dengan data penduduk manapun');
        }


        $complaint = new Complaint();
        $complaint->resident_id = $resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil menyimpan aduan');
    }

    public function edit($id)
    {   
        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);

        return view('pages.complaint.edit', compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg, jpeg', 'max:2048']
        ]);

        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::FindOrFail($id);

        if($complaint->status != 'new')
        {
           return redirect('/complaint')->with('error', "gagal mengubah aduan, status aduan anda saat ini adalah $complaint->status.");
        }

        $complaint->resident_id = $resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            if(isset($complaint->photo_proof)){
                Storage::delete($complaint->photo_proof);
            }
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil mengubah aduan');
    }

    public function destroy($id)
    {
        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::FindOrFail($id);

        if($complaint->status != 'new')
        {
            return redirect('/complaint')->with('error', "gagal mengubah aduan, status aduan anda saat ini adalah $complaint->status.");
        }

        $complaint->delete();

        return redirect('/complaint')->with('success', 'Berhasil menghapus aduan');
    }

    public function update_status(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['new', 'processing', 'completed'])]
        ]);

        $resident = Auth::user()->resident;
        if (Auth::user()->role_id ==2 && !$resident) {
            return redirect('/complaint')->with('error', 'akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::FindOrFail($id);
        $complaint->status = $request->input('status');

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil mengubah status');
    }
}
