<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;
        if ($q) {
            $promotions = Promotion::where('title', 'like', '%' . $q . '%')->get();
        } else {
            $promotions = Promotion::all();
        }
        return view('pages.promotion', compact('promotions', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.promotion-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:100',
                'discount' => 'required|numeric',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'title.required' => 'Kolom title tidak boleh kosong om !',
                'title.min' => 'Kolom title terlalu pendek !',
                'title.max' => 'Kolom title terlalu panjang !',
                'discount.required' => 'Kolom discount tidak boleh kosong om !',
                'discount.min' => 'Kolom discount terlalu pendek !',
                'discount.max' => 'Kolom discount terlalu panjang !',
                'picture.required' => 'Kolom picture tidak boleh kosong !',
                'picture.image' => 'Kolom picture harus file image !',
                'picture.mimes' => 'File pada kolom picture harus jpeg, png, gif atau svg !',
                'picture.max' => 'File pada kolom picture terlalu besar !',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/promotions/'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Promotion::create([
            'title' => $request->title,
            'discount' => $request->discount,
            'picture' => $filename,
            'status' => $status,
        ]);

        return redirect('/promotion')->with('success', $request->title . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('pages.promotion-edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:30',
                'discount' => 'required|numeric',
                // 'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'title.required' => 'Kolom title tidak boleh kosong om !',
                'title.min' => 'Kolom title terlalu pendek !',
                'title.max' => 'Kolom title terlalu panjang !',
                'discount.required' => 'Kolom discount tidak boleh kosong om !',
                'discount.min' => 'Kolom discount terlalu pendek !',
                'discount.max' => 'Kolom discount terlalu panjang !',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';
        if ($request->has('picture')) {
            unlink(public_path('/img/promotions/' . $promotion->picture));
            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/heroes/'), $filename);
            Promotion::where('id', $promotion->id)->update([
                'title' => $request->title,
                'discount' => $request->discount,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {
            Promotion::where('id', $promotion->id)->update([
                'title' => $request->title,
                'discount' => $request->discount,
                'status' => $status,
            ]);
        }

        return redirect('/promotion')->with('success', $request->title . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if (file_exists(asset('/img/promotions/' . $promotion->background))) {
            unlink(public_path('/img/promotions/' . $promotion->background));
        }
        Promotion::destroy('id', $promotion->id);
        // Hero::where('id', $hero->id)->delete();
        return redirect('/promotion')->with('success', $promotion->title . ' berhasil dihapus');
    }
}