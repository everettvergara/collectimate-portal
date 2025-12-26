<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\tb_sys_mf_user_access_type_request;
use App\Models\tb_sys_mf_access_type;
use App\Models\tb_sys_mf_user_access_type;
use Illuminate\Http\Request;

class tb_sys_mf_user_access_type_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $header_route;
    protected $header_route_var;
    protected $title;
    protected $view_path;
    protected $pk_var;
    protected $pk_val;

    public function __construct()
    {
        $this->route = 'user-access-types';
        $this->route_var = 'user_access_type';
        $this->header_route = 'users';
        $this->header_route_var = 'user';
        $this->title = 'USER ACCESS TYPES';
        $this->view_path = 'tb_sys_mf_user_access_type';
        $this->pk_var = 'user_id';
        $this->pk_val = 'user';
    }

    public function create(Request $r){
        $access_types = tb_sys_mf_access_type::where('is_active', '=', 1)->get();
        $head = view($this->view_path.'.create.head')->render();
        $form_fields = view($this->view_path.'.create.form_fields',[
            $this->pk_var       => $r->{$this->pk_val},
            'access_types'      => $access_types,
        ])->render();
        $scripts = view($this->view_path.'.create.scripts')->render();
        return view('base.detail.create', [
            'route'             => $this->route,
            'header_route'      => $this->header_route,
            'header_route_var'  => $this->header_route_var,
            'header_route_val'  => $r->{$this->pk_val},
            'title'             => $this->title,
            'head'              => $head,
            'form_fields'       => $form_fields,
            'scripts'           => $scripts,
        ]);
    }

    public function store(tb_sys_mf_user_access_type_request $r){
        $validatedData = $r->validated();
        $datum = new tb_sys_mf_user_access_type();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route.'.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id){
        $datum = tb_sys_mf_user_access_type::findOrFail($id);
        $access_types = tb_sys_mf_access_type::where('id', '=', $datum->access_type_id)->get();
        $form_fields = view($this->view_path.'.show.form_fields',[
            'datum'             => $datum,
            'access_types'      => $access_types,
        ])->render();
        return view('base.detail.show', [
            'route'             => $this->route,
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'header_route'      => $this->header_route,
            'header_route_var'  => $this->header_route_var,
            'header_route_val'  => $datum->{$this->pk_var},
            'title'             => $this->title,
            'form_fields'       => $form_fields,
        ]);
    }

    public function edit($id){
        $datum = tb_sys_mf_user_access_type::findOrFail($id);
        $access_types = tb_sys_mf_access_type::where('is_active', '=', 1)->get();
        $head = view($this->view_path.'.edit.head')->render();
        $form_fields = view($this->view_path.'.edit.form_fields',[
            'datum'             => $datum,
            'access_types'      => $access_types,
        ])->render();
        $scripts = view($this->view_path.'.edit.scripts')->render();
        return view('base.detail.edit', [
            'route'             => $this->route,
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'header_route'      => $this->header_route,
            'header_route_var'  => $this->header_route_var,
            'header_route_val'  => $datum->{$this->pk_var},
            'title'             => $this->title,
            'head'              => $head,
            'form_fields'       => $form_fields,
            'scripts'           => $scripts,
        ]);
    }

    public function update(tb_sys_mf_user_access_type_request $r, $id){
        $datum = tb_sys_mf_user_access_type::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route.'.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id){
        $datum = tb_sys_mf_user_access_type::findOrFail($id);
        $pk = $datum->{$this->pk_var};
        $datum->delete();
        return redirect()->route($this->header_route.'.show', [$this->header_route_var => $pk])->with('status', 'Success!');
    }
}
