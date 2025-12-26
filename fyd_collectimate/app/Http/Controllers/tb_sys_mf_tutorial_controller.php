<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_sys_mf_tutorial_request;
use App\Models\tb_sys_mf_tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_sys_mf_tutorial_controller extends Controller
{
    public function index()
    {
        store_audit(Auth::user()->id, 'TUTORIALS');
        $datum = tb_sys_mf_tutorial::first() ?? tb_sys_mf_tutorial::create(['description' => '']);
        return view('tb_sys_mf_tutorial.index.index', [
            'datum'             => $datum,
        ]);
    }

    public function edit()
    {
        $datum = tb_sys_mf_tutorial::first() ?? tb_sys_mf_tutorial::create(['description' => '']);
        return view('tb_sys_mf_tutorial.edit.edit', [
            'datum'             => $datum,
        ]);
    }

    public function update(tb_sys_mf_tutorial_request $r)
    {
        $datum = tb_sys_mf_tutorial::first() ?? tb_sys_mf_tutorial::create(['description' => '']);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route('tutorials.index')->with('status', 'Success!');
    }
}
