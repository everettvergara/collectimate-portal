<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\tb_sys_mf_mod_request;
use App\Models\tb_sys_mf_access_type;
use App\Models\tb_sys_mf_mod;
use App\Models\tb_sys_mf_mod_access_type;
use App\Models\tb_sys_mf_mod_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_sys_mf_mod_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'mods';
        $this->route_var = 'mod';
        $this->title = 'Modules';
        $this->view_path = 'tb_sys_mf_mod';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'MODULES');
        $name = $r['name'];
        $code = $r['code'];
        $data = tb_sys_mf_mod::select('tb_sys_mf_mod.*', 'b.name as mod_group')
            ->leftJoin('tb_sys_mf_mod_group as b', 'b.id', 'tb_sys_mf_mod.mod_group_id')
            ->when(isset($name), function ($q) use ($name) {
                return $q->where('tb_sys_mf_mod.name', 'like', '%' . $name . '%');
            })
            ->when(isset($code), function ($q) use ($code) {
                return $q->where('tb_sys_mf_mod.code', 'like', '%' . $code . '%');
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', ['name' => $name, 'code' => $code])->render();
        $tr_header  = view($this->view_path . '.index.tr_header')->render();
        $tr_body    = view($this->view_path . '.index.tr_body', [
            'data'      => $data,
            'route'     => $this->route,
            'route_var' => $this->route_var,
        ]);
        return view('base.header.index', [
            'route'         => $this->route,
            'filters'       => $filters,
            'title'         => $this->title,
            'tr_header'     => $tr_header,
            'tr_body'       => $tr_body,
            'data'          => $data,
        ]);
    }

    public function create()
    {
        $mod_groups = tb_sys_mf_mod_group::where('is_active', '=', 1)->get();
        $head = view($this->view_path . '.create.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            'mod_groups'    => $mod_groups
        ])->render();
        $scripts = view($this->view_path . '.create.scripts')->render();
        return view('base.header.create', [
            'route'         => $this->route,
            'title'         => $this->title,
            'head'          => $head,
            'form_fields'   => $form_fields,
            'scripts'       => $scripts,
        ]);
    }

    public function store(tb_sys_mf_mod_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_sys_mf_mod();
        $datum->fill($validatedData);
        $datum->save();
        $mod_access = new tb_sys_mf_mod_access_type();
        $full_access = tb_sys_mf_access_type::where('code', 'FA')->first();
        $mod_access->fill([
            'mod_id'    => $datum->id,
            'access_type_id' => $full_access->id,
        ]);
        $mod_access->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_sys_mf_mod::findOrFail($id);
        $mod_groups = tb_sys_mf_mod_group::where('id', '=', $datum->mod_group_id)->get();
        $details = $this->get_details($datum->id);
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'mod_groups'        => $mod_groups,
        ])->render();
        $form_details = view($this->view_path . '.show.form_details', [
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'mod_access_types'  => $details['mod_access_types'],
        ])->render();
        return view('base.header.show', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
            'form_details'  => $form_details,
        ]);
    }

    public function edit($id)
    {
        $datum = tb_sys_mf_mod::findOrFail($id);
        $mod_groups = tb_sys_mf_mod_group::where('is_active', '=', 1)->get();
        $details = $this->get_details($datum->id);
        $head = view($this->view_path . '.edit.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'mod_groups'        => $mod_groups,
        ])->render();
        $form_details = view($this->view_path . '.edit.form_details', [
            'route_var'                 => $this->route_var,
            'route_val'                 => $datum->id,
            'mod_access_types'          => $details['mod_access_types'],
        ])->render();
        $scripts = view($this->view_path . '.edit.scripts')->render();
        return view('base.header.edit', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'head'          => $head,
            'form_fields'   => $form_fields,
            'form_details'  => $form_details,
            'scripts'       => $scripts,
        ]);
    }

    public function update(tb_sys_mf_mod_request $r, $id)
    {
        $datum = tb_sys_mf_mod::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_sys_mf_mod::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }

    private function get_details($mod_id)
    {
        return [
            'mod_access_types' => tb_sys_mf_mod_access_type::select('tb_sys_mf_mod_access_type.*', 'tb_sys_mf_access_type.name as access_type')
                ->join('tb_sys_mf_access_type', 'tb_sys_mf_access_type.id', 'tb_sys_mf_mod_access_type.access_type_id')
                ->where('tb_sys_mf_mod_access_type.mod_id', '=', $mod_id)->get(),
        ];
    }
}
