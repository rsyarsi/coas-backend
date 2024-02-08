<?php

namespace App\Repositories;

use App\Models\Year;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\YearRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class YearRepository implements YearRepositoryInterface
{

    public function allYears()
    {
        return Year::latest()->paginate(10);
    }

    public function storeYears($request)
    {
        return  DB::table("years")->insert([
            'name' => $request->name,
            'active' => $request->active 
        ]);
    }

    public function findYears($id)
    {
        return Year::where($id)->get();
    }

    public function updateYears($request)
    {
        $updates = Year::where('id', $request->id)->update([
            'name' => $request->name,
            'active' => $request->active
        ]);
        return $updates;
    }

    public function destroyYears($id)
    {
        $category = Year::find($id);
        $category->delete();
    }
}