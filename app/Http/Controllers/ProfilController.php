<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfilRequest $request)
    {
        $profil = Auth::user()->profil;

        $profil->name = $request->validated('name') ?? $profil->name;
        $profil->birth_date = $request->validated('birth_date') ?? $profil->birth_date;
        $profil->gender = $request->validated('gender') ?? $profil->gender;
        $profil->bio = ($request->validated('bio') == null || $request->validated('bio') == '') ? '' : $request->validated('bio');
        $profil->save();
        return response()->json($profil);
    }
}
