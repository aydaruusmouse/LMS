<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\DepartmentLanguage;

class DepartmentRepository
{
    public function all()
    {
        return Department::with('language')->latest()->paginate(setting('pagination'));
    }

    public function activeDepartments()
    {
        return Department::where('status', 1)->get();
    }

    public function store($request)
    {
        $department = Department::create($request);
        $this->langStore($request, $department);

        return $department;
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $department = DepartmentLanguage::where('lang', 'en')->where('department_id', $id)->first();
        } else {
            $department = DepartmentLanguage::where('lang', $lang)->where('department_id', $id)->first();
            if (! $department) {
                $department                     = DepartmentLanguage::where('lang', 'en')->where('department_id', $id)->first();
                $department['translation_null'] = 'not-found';
            }
        }

        return $department;
    }

    public function find($id)
    {
        return Department::find($id);
    }

    public function update($request, $id)
    {
        $department = Department::find($id);
        $data       = $request;

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title'] = $department->title;
        }

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $department);
        }

        return $department->update($request);
    }

    public function destroy($id)
    {
        return Department::destroy($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return Department::find($id)->update($request);
    }

    public function langStore($request, $department)
    {
        return DepartmentLanguage::create([
            'department_id' => $department->id,
            'title'         => $request['title'],
            'lang'          => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return DepartmentLanguage::where('id', $request['translate_id'])->update([
            'lang'  => $request['lang'],
            'title' => $request['title'],
        ]);
    }
}
