<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\User;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motors = Motor::query()->where("id_pemilik", auth()->id())->get();
        return view("pemilik.motor.index", compact("motors"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pemiliks = User::query()->where("role", "pemilik")->get();
        return view("pemilik.motor.create", compact("pemiliks"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "id_pemilik" => "required|exists:users,id",
            "merk" => "required|string",
            "tipe_cc" => "required|in:100,125,150",
            "photo" => "required|image|mimes:png,jpeg,jpg,webp|max:5120",
            "no_plat" => "required|string|max:9",
            "dokumen_kepemilikan" =>
                "required|file|mimes:pdf,jpg,jpeg,png,webp|max:10240",
        ]);
        $validated["photo"] = $request
            ->file("photo")
            ->store("motors/photos", "public");
        $validated["dokumen_kepemilikan"] = $request
            ->file("dokumen_kepemilikan")
            ->store("motors/dokumen", "public");

        $validated["status"] = "menunggu";

        Motor::create($validated);

        return redirect()->route("pemilik.motor");
    }

    /**
     * Display the specified resource.
     */
    public function show(Motor $motor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motor $motor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motor $motor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motor $motor)
    {
        //
    }
}
