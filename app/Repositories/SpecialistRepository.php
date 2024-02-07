<?php

namespace App\Repositories;

use App\Models\specialist;
use App\Models\SpecialistGroup;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;

class SpecialistRepository implements SpecialistRepositoryInterface
{
    public function allSpecialist()
    {
        return specialist::latest()->paginate(10);
    }

    public function storeSpecialist($request)
    {
        return  DB::table("specialists")->insert([
            'specialistname' => $request->specialistname,
            'groupspecialistID' => $request->groupspecialistID, 
            'active' => $request->active 
        ]);
    }

    public function findSpecialist($id)
    {
        return specialist::find($id);
    }

    public function updateSpecialist($request)
    {
        $updates = specialist::where('id', $request->id)->update([
            'specialistname' => $request->specialistname,
            'groupspecialistID' => $request->groupspecialistID, 
            'active' => $request->active
        ]);
        return $updates;
    }

    public function destroySpecialist($id)
    {
        $category = specialist::find($id);
        $category->delete();
    }
}