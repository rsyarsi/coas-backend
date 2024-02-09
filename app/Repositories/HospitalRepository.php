<?php

namespace App\Repositories;

use App\Models\hospital;
use App\Models\Year; 
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class HospitalRepository implements HospitalRepositoryInterface
{

    public function allHospital()
    {
        return hospital::latest()->paginate(10);
    }

    public function storeHospital($request,$uuid)
    {
        return  DB::table("hospitals")->insert($request);
    }

    public function findHospital($id)
    {
        return hospital::where('id',$id)->get();
    }

    public function updateHospital($request)
    {
        $updates = hospital::where('id', $request['id'])->update([
            'name' => $request['name'],
            'active' => $request['active']
        ]);
        return $updates;
    }

    public function destroyHospital($id)
    {
        $category = hospital::find($id);
        $category->delete();
    }
}