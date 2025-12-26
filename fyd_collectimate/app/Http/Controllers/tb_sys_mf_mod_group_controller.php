<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\tb_sys_mf_mod_group_request;
use App\Models\tb_sys_mf_mod_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class tb_sys_mf_mod_group_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'mod-groups';
        $this->route_var = 'mod_group';
        $this->title = 'Module Groups';
        $this->view_path = 'tb_sys_mf_mod_group';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'MODULE GROUPS');
        $name = $r['name'];
        $code = $r['code'];
        $data = tb_sys_mf_mod_group::select('tb_sys_mf_mod_group.*', 'b.name as parent_mod_group')
            ->leftJoin('tb_sys_mf_mod_group as b', 'b.id', 'tb_sys_mf_mod_group.parent_mod_group_id')
            ->when(isset($name), function ($q) use ($name) {
                return $q->where('tb_sys_mf_mod_group.name', 'like', '%' . $name . '%');
            })
            ->when(isset($code), function ($q) use ($code) {
                return $q->where('tb_sys_mf_mod_group.code', 'like', '%' . $code . '%');
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
        $parent_mod_groups = (object) $this->get_mod_groups();
        $head = view($this->view_path . '.create.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            'parent_mod_groups'    => $parent_mod_groups
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

    public function store(tb_sys_mf_mod_group_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_sys_mf_mod_group();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_sys_mf_mod_group::findOrFail($id);
        $parent_mod_groups = (object) $this->get_mod_groups();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'parent_mod_groups'        => $parent_mod_groups,
        ])->render();
        return view('base.header.show', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
        ]);
    }

    public function edit($id)
    {
        $datum = tb_sys_mf_mod_group::findOrFail($id);
        $parent_mod_groups = (object) $this->get_mod_groups();
        $head = view($this->view_path . '.edit.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'parent_mod_groups'        => $parent_mod_groups,
        ])->render();
        $scripts = view($this->view_path . '.edit.scripts')->render();
        return view('base.header.edit', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'head'          => $head,
            'form_fields'   => $form_fields,
            'scripts'       => $scripts,
        ]);
    }

    public function update(tb_sys_mf_mod_group_request $r, $id)
    {
        $datum = tb_sys_mf_mod_group::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_sys_mf_mod_group::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }

    private function get_mod_groups()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            $parent_mod_groups_q = DB::select("select  a.id, CONCAT(REPEAT('-', (a.level) * 3), ' ', a.name) as name
                from	vw_sys_mf_mod_group_hierarchy as a
                order
                by		a.seq");
        } else {
            $parent_mod_groups_q = DB::select("SELECT a.id,
                REPLICATE('-', a.level * 3) + ' ' + a.name AS name
                FROM   vw_sys_mf_mod_group_hierarchy AS a
                ORDER  BY a.seq;");
        }
        return $parent_mod_groups_q;
    }
}
