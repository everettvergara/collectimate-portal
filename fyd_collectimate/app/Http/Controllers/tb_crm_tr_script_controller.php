<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_crm_tr_script_request;
use App\Models\tb_crm_mf_client;
use App\Models\tb_crm_mf_license_type;
use App\Models\tb_crm_tr_script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_crm_tr_script_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'scripts';
        $this->route_var = 'script';
        $this->title = 'Scripts';
        $this->view_path = 'tb_crm_tr_script';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, $this->title);
        $name = $r['name'];
        $data = tb_crm_tr_script::select('tb_crm_tr_script.*', 'b.name as client', 'c.name as license_type')
            ->leftJoin('tb_crm_mf_client as b', 'b.id', 'client_id')
            ->leftJoin('tb_crm_mf_license_type as c', 'c.id', 'license_type_id')
            ->when(isset($name), function ($q) use ($name) {
                return $q->where('tb_crm_tr_script.name', 'like', '%' . $name . '%');
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', ['name' => $name])->render();
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
        $dropdowns = $this->get_dropdowns();
        $head = view($this->view_path . '.create.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            'clients'           => $dropdowns['clients'],
            'license_types'     => $dropdowns['license_types'],
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

    public function store(tb_crm_tr_script_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_crm_tr_script();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_crm_tr_script::findOrFail($id);
        $dropdowns = $this->get_dropdowns();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'clients'           => $dropdowns['clients'],
            'license_types'     => $dropdowns['license_types'],
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
        $datum = tb_crm_tr_script::findOrFail($id);
        $dropdowns = $this->get_dropdowns();
        $head = view($this->view_path . '.edit.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'clients'           => $dropdowns['clients'],
            'license_types'     => $dropdowns['license_types'],
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

    public function update(tb_crm_tr_script_request $r, $id)
    {
        $datum = tb_crm_tr_script::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_crm_tr_script::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }

    public function get_dropdowns()
    {
        return [
            'clients' => tb_crm_mf_client::get(),
            'license_types' => tb_crm_mf_license_type::get(),
        ];
    }
}
