<?php

namespace App\Repositories\Dashboard\Department;

use App\Models\User;
use App\Models\Department;
use App\Repositories\Dashboard\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentInterface
{
    public function getModel()
    {
        return new Department();
    }



    public function index($request)
    {
        $data = $this->getModel()
        ->when($request->name != null,function ($q) use($request){
            return $q->where('name','like', '%'.$request->name.'%');
        })
        ->when($request->from_date != null,function ($q) use($request){
            return $q->whereDate('created_at', '>=', $request->from_date);
        })
        ->when($request->to_date != null,function ($q) use($request){
            return $q->whereDate('created_at', '<=', $request->to_date);
        })
        ->paginate(config('myConfig.paginationCount'))->appends(request()->query());

        return view('dashboard.departments.index')
        ->with([
            'data'      => $data,
            'name'      => $request->name,
            'from_date' => $request->from_date,
            'to_date'   => $request->to_date,
        ]);
    }

}
