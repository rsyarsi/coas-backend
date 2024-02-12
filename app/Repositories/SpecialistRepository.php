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
    public function viewallwithotpaging()
    {
        return specialist::where('active','1')->get();
    }
    public function storeSpecialist($request,$uuid)
    {
        return  DB::table("specialists")->insert($request);
    }

    public function findSpecialist($id)
    {
        return specialist::where('id',$id)->get();
    }

    public function updateSpecialist($request)
    {
        $updates = specialist::where('id', $request['id'])->update([
            'specialistname' => $request['specialistname'],
            'groupspecialistid' => $request['groupspecialistid'], 
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroySpecialist($id)
    {
        $category = specialist::find($id);
        $category->delete();
    }
}