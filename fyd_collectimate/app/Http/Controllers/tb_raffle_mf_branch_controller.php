<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_raffle_mf_branch_request;
use App\Models\tb_raffle_mf_branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_raffle_mf_branch_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'branches';
        $this->route_var = 'branch';
        $this->title = 'Branch';
        $this->view_path = 'tb_raffle_mf_branch';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'BRANCHES');
        $name = $r['name'];
        $code = $r['code'];
        $tin = $r['tin'];
        $data = tb_raffle_mf_branch::when(isset($name), function ($q) use ($name) {
            return $q->where('tb_raffle_mf_branch.name', 'like', '%' . $name . '%');
        })->when(isset($code), function ($q) use ($code) {
            return $q->where('tb_raffle_mf_branch.code', 'like', '%' . $code . '%');
        })->when(isset($tin), function ($q) use ($tin) {
            return $q->where('tb_raffle_mf_branch.tin', 'like', '%' . $tin . '%');
        })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', [
            'name' => $name,
            'code'  => $code,
            'tin'   => $tin,
        ])->render();
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
        $form_fields = view($this->view_path . '.create.form_fields', [])->render();
        return view('base.header.create', [
            'route'         => $this->route,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
        ]);
    }

    public function store(tb_raffle_mf_branch_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_raffle_mf_branch();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_raffle_mf_branch::findOrFail($id);
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
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
        $datum = tb_raffle_mf_branch::findOrFail($id);
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
        ])->render();
        return view('base.header.edit', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
        ]);
    }

    public function update(tb_raffle_mf_branch_request $r, $id)
    {
        $datum = tb_raffle_mf_branch::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_raffle_mf_branch::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }
}
