<?php

namespace App\Repositories;

use App\Models\specialistgroup;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface; 

class SpecialistGroupRepository implements SpecialistGroupRepositoryInterface
{
    public function allSpecialistGroup()
    {
        return specialistgroup::orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function viewallwithotpaging()
    {
        return specialistgroup::all();
    }

    public function storeSpecialistGroup($request,$uuid)
    {
        return  DB::table("specialistgroups")->insert($request);
    }

    public function findSpecialistGroup($id)
    {
        return specialistgroup::where('id',$id)->get();
    }

    public function updateSpecialistGroup($request)
    {
        $updates = specialistgroup::where('id', $request->id)->update([
            'name' => $request->name,
            'active' => $request->active 
        ]);
        return $updates;
    }

    public function destroySpecialistGroup($id)
    {
        $category = specialistgroup::find($id);
        $category->delete();
    }
}