<?php

namespace App\Repositories;
 
use App\Models\SpecialistGroup;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface; 

class SpecialistGroupRepository implements SpecialistGroupRepositoryInterface
{
    public function allSpecialistGroup()
    {
        return SpecialistGroup::latest()->paginate(10);
    }

    public function storeSpecialistGroup($request)
    {
        return  DB::table("specialistgroups")->insert([
            'name' => $request->name,
            'active' => $request->active 
        ]);
    }

    public function findSpecialistGroup($id)
    {
        return SpecialistGroup::find($id);
    }

    public function updateSpecialistGroup($request)
    {
        $updates = SpecialistGroup::where('id', $request->id)->update([
            'name' => $request->name,
            'active' => $request->active 
        ]);
        return $updates;
    }

    public function destroySpecialistGroup($id)
    {
        $category = SpecialistGroup::find($id);
        $category->delete();
    }
}