<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;
        if ($q) {
            $partners = Partner::where('title', 'like', '%' . $q . '%')->get();
        } else {
            $partners = Partner::all();
        }
        return view('pages.partner', compact('partners', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.partner-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'title' => 'required|min:5|max:30',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Kolom title tidak boleh kosong om !',
                'title.min' => 'Kolom title terlalu pendek !',
                'title.max' => 'Kolom title terlalu panjang !',
                'logo.required' => 'Kolom logo tidak boleh kosong !',
                'logo.image' => 'Kolom logo harus file image !',
                'logo.mimes' => 'File pada kolom logo harus jpeg, png, gif atau svg !',
                'logo.max' => 'File pada kolom logo terlalu besar !',

            ]
        );

        $logo = $request->file('logo');
        $filename = time() . '-' . rand() . '-' . $logo->getClientOriginalName();
        $logo->move(public_path('/img/logo/'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Partner::create([
            'title' => $request->title,
            'logo' => $filename,
            'status' => $status
        ]);

        return redirect('/partner')->with('success', $request->title . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        // return $partner;
        return view('pages.partner-edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        // $request->validate(
        //     [
        //         'title' => 'required|min:5|max:30',
        //         'logo' => 'required|numeric',
        //         // 'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        //     ],
        //     [
        //         'title.required' => 'Kolom title tidak boleh kosong om !',
        //         'title.min' => 'Kolom title terlalu pendek !',
        //         'title.max' => 'Kolom title terlalu panjang !',
        //         'logo.required' => 'Kolom logo tidak boleh kosong !',
        //         'logo.image' => 'Kolom logo harus file image !',
        //         'logo.mimes' => 'File pada kolom logo harus jpeg, png, gif atau svg !',
        //         'logo.max' => 'File pada kolom logo terlalu besar !',
        //     ]
        // );

        $status = $request->has('status') ? 'show' : 'hide';
        if ($request->has('logo')) {
            unlink(public_path('/img/partners/' . $partner->picture));
            $logo = $request->file('logo');
            $filename = time() . '-' . rand() . '-' . $logo->getClientOriginalName();
            $logo->move(public_path('/img/partners/'), $filename);
            Partner::where('id', $partner->id)->update([
                'title' => $request->title,
                'logo' => $filename,
                'status' => $status
            ]);
        } else {
            Partner::where('id', $partner->id)->update([
                'title' => $request->title,
                'status' => $status
            ]);
        }

        return redirect('/partner')->with('success', $request->title . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        if (file_exists(public_path('/img/partners/' . $partner->background))) {
            unlink(public_path('/img/partners/' . $partner->background));
        }
        Partner::destroy('id', $partner->id);
        // Hero::where('id', $hero->id)->delete();
        return redirect('/partner')->with('success', $partner->title . ' berhasil dihapus');
    }
}
