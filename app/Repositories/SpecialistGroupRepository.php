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
    public function viewallwithotpaging()
    {
        return SpecialistGroup::where('active','1')->get();
    }

    public function storeSpecialistGroup($request,$uuid)
    {
        return  DB::table("specialistgroups")->insert($request);
    }

    public function findSpecialistGroup($id)
    {
        return SpecialistGroup::where('id',$id)->get();
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