<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    // {
    //     $services = Service::all();
    //     return view('pages.service', compact('services'));
    // }

    {
        // pencarian index/view
        $q = $request->q;
        $pagination = $request->has('pagination') ? $request->pagination : 10;
        if ($q) {
            // pencarian all
            // $services = Service::where('title', 'like', '%'.$q.'%')->get();
            // pencarian pagination
            $services = Service::where('title', 'like', '%' . $q . '%')->paginate($pagination);
        } else {
            // menampilkan seluruh data index/view
            // $services = Service::all();
            // menampilkan pagination data index/view
            $services = Service::paginate($pagination);
        }
        //vardump cek data didalam tabel database
        // return $services;
        return view('pages.service', compact('services', 'q', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.service-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'title' => 'required|min:5|max:20',
                'price' => 'required|numeric',
                'description' => 'required|min:5|max:500000'
            ],
            [
                'logo.required' => 'Kolom LOGO Tidak Boleh Kosong !',
                'logo.image' => 'Kolom LOGO harus format jpeg, png, jpg, gif, svg !',
                'logo.max' => 'File pada Kolom LOGO terlalu besar maksimal 2MB !',
                'title.required' => 'Kolom TITLE Tidak Boleh Kosong !',
                'title.min' => 'kolom TITLE tertalu pendek !',
                'title.max' => 'kolom TITLE tertalu panjang !',
                'price.required' => 'Kolom PRICE Tidak Boleh Kosong !',
                'price.numeric' => 'kolom PRICE harus angka !',
                'description.required' => 'Kolom DESCRIPTION Tidak Boleh Kosong !',
                'description.min' => 'kolom DESCRIPTION tertalu pendek !',
                'description.max' => 'kolom DESCRIPTION tertalu panjang !'
            ]
        );

        $logo = $request->file('logo');
        $filename = time() . '-' . rand() . '-' . $logo->getClientOriginalName(); //untuk insert file logo
        $logo->move(public_path('/img/services/'), $filename); // kedalam folder public/img/heroes (sesuaikan dgn folder anda masing2)

        // insert data dummy massal
        // for($i=2;$i<101;$i++)
        // {
        //     Service::create([
        //         'logo' => $filename,
        //         'title' => $request->title.'-'.$i,
        //         'price' => $request->price.$i,
        //         'description' => $request->description.'-'.$i,
        //     ]);
        // }

        Service::create([
            'logo' => $filename,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect('/service')->with('success', $request->title . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        // return $promotion;
        return view('pages.service-edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // return $request;
        $request->validate(
            [
                // 'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'title' => 'required|min:5|max:20',
                'price' => 'required|numeric',
                'description' => 'required|min:5|max:50'
            ],
            [
                // 'logo.required' => 'Kolom LOGO Tidak Boleh Kosong !',
                // 'logo.image' => 'Kolom LOGO harus format jpeg, png, jpg, gif, svg !',
                // 'logo.max' => 'File pada Kolom LOGO terlalu besar maksimal 2MB !',
                'title.required' => 'Kolom TITLE Tidak Boleh Kosong !',
                'title.min' => 'kolom TITLE tertalu pendek !',
                'title.max' => 'kolom TITLE tertalu panjang !',
                'price.required' => 'Kolom PRICE Tidak Boleh Kosong !',
                'price.numeric' => 'kolom PRICE harus angka !',
                'description.required' => 'Kolom DESCRIPTION Tidak Boleh Kosong !',
                'description.min' => 'kolom DESCRIPTION tertalu pendek !',
                'description.max' => 'kolom DESCRIPTION tertalu panjang !'
            ]
        );

        if ($request->has('logo')) {
            unlink(public_path('/img/services/' . $service->logo));
            $logo = $request->file('logo');
            $filename = time() . '-' . rand() . '-' . $logo->getClientOriginalName();
            $logo->move(public_path('/img/services/'), $filename);

            Service::where('id', $service->id)->update([
                'logo' => $filename,
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        } else {
            Service::where('id', $service->id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        }

        return redirect('/service');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if (file_exists(public_path('img/services/' . $service->logo))) {
            unlink(public_path('/img/services/' . $service->logo));
        }
        Service::destroy('id', $service->id);
        // Service::where('id', $service->id)->delete();
        return redirect('/service');
    }
}
