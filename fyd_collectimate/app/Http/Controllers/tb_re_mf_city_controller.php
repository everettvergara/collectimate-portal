<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_re_mf_city_request;
use App\Models\tb_re_mf_city;
use App\Models\tb_re_mf_province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_re_mf_city_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'cities';
        $this->route_var = 'city';
        $this->title = 'City';
        $this->view_path = 'tb_re_mf_city';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'CITIES');
        $name = $r['name'];
        $province_id = $r['province_id'];
        $provinces = tb_re_mf_province::limit(5)->get();
        $data = tb_re_mf_city::select('tb_re_mf_city.*', 'b.name as province')
            ->join('tb_re_mf_province as b', 'b.id', 'tb_re_mf_city.province_id')
            ->when(isset($name), function ($q) use ($name) {
                return $q->where('tb_re_mf_city.name', 'like', '%' . $name . '%');
            })->when(isset($province_id), function ($q) use ($province_id) {
                return $q->where('province_id', $province_id);
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $head = view($this->view_path . '.index.head')->render();
        $filters    = view($this->view_path . '.index.filters', ['name' => $name, 'provinces' => $provinces, 'province_id' => $province_id])->render();
        $tr_header  = view($this->view_path . '.index.tr_header')->render();
        $tr_body    = view($this->view_path . '.index.tr_body', [
            'data'      => $data,
            'route'     => $this->route,
            'route_var' => $this->route_var,
        ]);
        $scripts = view($this->view_path . '.index.scripts')->render();
        return view('base.header.index', [
            'route'         => $this->route,
            'head'          => $head,
            'filters'       => $filters,
            'title'         => $this->title,
            'tr_header'     => $tr_header,
            'tr_body'       => $tr_body,
            'scripts'       => $scripts,
            'data'          => $data,
        ]);
    }

    public function create()
    {
        $provinces = tb_re_mf_province::limit(5)->get();
        $head = view($this->view_path . '.index.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            'provinces'         => $provinces,
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

    public function store(tb_re_mf_city_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_re_mf_city();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_re_mf_city::findOrFail($id);
        $provinces = tb_re_mf_province::where('id', $datum->province_id)->limit(5)->get();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'provinces'         => $provinces,
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
        $datum = tb_re_mf_city::findOrFail($id);
        $provinces = tb_re_mf_province::limit(5)->get();
        $head = view($this->view_path . '.index.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'provinces'         => $provinces,
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

    public function update(tb_re_mf_city_request $r, $id)
    {
        $datum = tb_re_mf_city::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_re_mf_city::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }
}
