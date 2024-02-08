<?php

namespace App\Repositories;

use App\Models\universitie;
use App\Models\University; 
use Illuminate\Support\Facades\DB;  
use App\Repositories\Interfaces\UniversityRepositoryInterface;

class UniversityRepository implements UniversityRepositoryInterface
{

    public function allUniversity()
    {
        return universitie::latest()->paginate(10);
    }

    public function storeUniversity($request)
    {
        return  DB::table("universities")->insert([
            'name' => $request->name,
            'active' => $request->active 
        ]);
    }

    public function findUniversity($id)
    {
        return universitie::where('id',$id)->get();
    }

    public function updateUniversity($request)
    {
        $updates = universitie::where('id', $request->id)->update([
            'name' => $request->name,
            'active' => $request->active
        ]);
        return $updates;
    }

    public function destroyUniversity($id)
    {
        $category = universitie::find($id);
        $category->delete();
    }
}