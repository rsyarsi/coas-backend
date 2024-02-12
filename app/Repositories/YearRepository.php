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
    public function allYearswithoutPaging()
    {
        return Year::where('active','1')->get();
    }
    public function storeYears($request,$uuid)
    {
        return  DB::table("years")->insert($request);
    }

    public function findYears($id)
    {
        return Year::where('id',$id)->get();
    }

    public function updateYears($request)
    {
        $updates = Year::where('id', $request['id'])->update($request);
        return $updates;
    }

    public function destroyYears($id)
    {
        $category = Year::find($id);
        $category->delete();
    }
}