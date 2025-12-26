<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_re_mf_brg_request;
use App\Models\tb_re_mf_brg;
use App\Models\tb_re_mf_city;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_re_mf_brg_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'brgs';
        $this->route_var = 'brg';
        $this->title = 'Barangay';
        $this->view_path = 'tb_re_mf_brg';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'BRGS');
        $name = $r['name'];
        $city_id = $r['city_id'];
        $cities = tb_re_mf_city::limit(5)->get();
        $data = tb_re_mf_brg::select('tb_re_mf_brg.*', 'b.name as city')
            ->leftJoin('tb_re_mf_city as b', 'b.id', 'tb_re_mf_brg.city_id')
            ->when(isset($name), function ($q) use ($name) {
                return $q->where('tb_re_mf_brg.name', 'like', '%' . $name . '%');
            })->when(isset($city_id), function ($q) use ($city_id) {
                return $q->where('city_id', $city_id);
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $head = view($this->view_path . '.index.head')->render();
        $filters    = view($this->view_path . '.index.filters', ['name' => $name, 'cities' => $cities, 'city_id' => $city_id])->render();
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
        $cities = tb_re_mf_city::limit(5)->get();
        $head = view($this->view_path . '.index.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            'cities'         => $cities,
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

    public function store(tb_re_mf_brg_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_re_mf_brg();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_re_mf_brg::findOrFail($id);
        $cities = tb_re_mf_city::where('id', $datum->city_id)->limit(5)->get();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'cities'         => $cities,
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
        $datum = tb_re_mf_brg::findOrFail($id);
        $cities = tb_re_mf_city::limit(5)->get();
        $head = view($this->view_path . '.index.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'cities'         => $cities,
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

    public function update(tb_re_mf_brg_request $r, $id)
    {
        $datum = tb_re_mf_brg::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_re_mf_brg::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }
}
