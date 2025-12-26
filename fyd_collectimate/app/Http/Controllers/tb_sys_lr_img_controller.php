<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_sys_lr_img_request;
use App\Models\tb_sys_lr_img;
use App\Models\tb_sys_lr_img_style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_sys_lr_img_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'imgs';
        $this->route_var = 'img';
        $this->title = 'IMAGES';
        $this->view_path = 'tb_sys_lr_img';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'IMAGES');
        $filename = $r['filename'];
        $data = tb_sys_lr_img::when(isset($name), function ($q) use ($filename) {
            return $q->where('tb_sys_lr_img.filename', 'like', '%' . $filename . '%');
        })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', ['filename' => $filename])->render();
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
        $form_fields = view($this->view_path . '.create.form_fields')->render();
        return view('base.header.create', [
            'route'         => $this->route,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
        ]);
    }

    public function store(tb_sys_lr_img_request $r)
    {
        $r->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $id = store_image($r->image, 'tb_sys_lr_img');
        return redirect()->route($this->route . '.show', [$this->route_var => $id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_sys_lr_img::findOrFail($id);
        $img_styles = tb_sys_lr_img_style::select('a.*', 'b.filename', 'b.filename as attachment', 'c.name as style', 'c.height', 'c.width', 'c.path')
            ->from('tb_sys_lr_img_style as a')
            ->join('tb_sys_lr_img as b', 'b.id', 'a.img_id')
            ->join('tb_sys_mf_style as c', 'c.id', 'a.style_id')
            ->where('a.img_id', $datum->id)
            ->get();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
        ])->render();
        $form_details = view($this->view_path . '.show.form_details', [
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'img_styles'        => $img_styles,
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
        $datum = tb_sys_lr_img::findOrFail($id);
        $img_styles = tb_sys_lr_img_style::select('a.*', 'b.filename', 'b.filename as attachment', 'c.name as style', 'c.height', 'c.width', 'c.path')
            ->from('tb_sys_lr_img_style as a')
            ->join('tb_sys_lr_img as b', 'b.id', 'a.img_id')
            ->join('tb_sys_mf_style as c', 'c.id', 'a.style_id')
            ->where('a.img_id', $datum->id)
            ->get();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
        ])->render();
        $form_details = view($this->view_path . '.edit.form_details', [
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'img_styles'        => $img_styles,
        ])->render();
        return view('base.header.edit', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
            'form_details'  => $form_details,
        ]);
    }

    public function update(tb_sys_lr_img_request $r, $id)
    {
        $datum = tb_sys_lr_img::findOrFail($id);
        if (isset($r->image)) {
            $id = store_image($r->image, 'tb_sys_lr_img');
        }
        return redirect()->route($this->route . '.show', [$this->route_var => $id ?? $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_sys_lr_img::findOrFail($id);
        $old_img_id = $datum->id;
        delete_cached_image($old_img_id);
        delete_image($old_img_id);
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }
}
