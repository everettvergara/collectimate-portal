<?php

namespace App\Http\Controllers;

use App\Models\tb_sys_mf_user;
use App\Models\tb_sys_mf_user_access_type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tb_sys_mf_user_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'users';
        $this->route_var = 'user';
        $this->title = 'Users';
        $this->view_path = 'tb_sys_mf_user';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'USERS');
        $name = $r['name'];
        $email = $r['email'];
        $data = tb_sys_mf_user::when(isset($name), function ($q) use ($name) {
            return $q->where('name', 'like', '%' . $name . '%');
        })
            ->when(isset($email), function ($q) use ($email) {
                return $q->Where('email', 'like', '%' . $email . '%');
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', ['name' => $name, 'email' => $email])->render();
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
        $scripts = view($this->view_path . '.create.scripts')->render();
        return view('base.header.create', [
            'route'         => $this->route,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
            'scripts'       => $scripts,
        ]);
    }

    public function store(Request $r)
    {
        $validation = $this->get_custom_validation($r->id, 0);
        $validated = $this->validate($r, $validation['store_validation']);
        $validated['password'] = Hash::make($r['password']);
        unset($validated["cf_password"], $validated["profile_photo"]);
        $datum = new tb_sys_mf_user();
        $datum->fill($validated);
        $datum->save();
        $this->upload_photo($r, $datum);
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show(Request $r, $id)
    {
        $datum = tb_sys_mf_user::findOrFail($id);
        $details = $this->get_details($datum->id);
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
        ])->render();
        $form_details = view($this->view_path . '.show.form_details', [
            'route_var'             => $this->route_var,
            'route_val'             => $datum->id,
            'user_access_types'     => $details['user_access_types'],
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

    public function edit(Request $r, $id)
    {
        $datum = tb_sys_mf_user::findOrFail($id);
        $details = $this->get_details($datum->id);
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
        ])->render();
        $form_details = view($this->view_path . '.edit.form_details', [
            'route_var'             => $this->route_var,
            'route_val'             => $datum->id,
            'user_access_types'     => $details['user_access_types'],
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

    public function update(Request $r, $id)
    {
        $datum = tb_sys_mf_user::findOrFail($id);
        $validation = $this->get_custom_validation($r->id, $datum->id);
        $validated = $r->validate($validation['update_validation']);
        unset($validated["profile_photo"]);
        $datum->fill($validated);
        $datum->update();
        $this->upload_photo($r, $datum);
        return redirect()->route($this->route . '.show', [$this->route_var => $datum])->with('status', 'User was updated!');
    }

    public function destroy(Request $r, $id)
    {
        return redirect()->back()->with('alert', 'Action not allowed!');
    }

    public function profile_edit(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403);
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        $details = $this->get_details($datum->id);
        return view('tb_sys_mf_user.profile_edit', [
            'datum'             => $datum,
            'user_access_types' => $details['user_access_types'],
        ]);
    }

    public function profile_edit_password(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403);
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        return view('tb_sys_mf_user.profile_edit_password', [
            'datum' => $datum,
        ]);
    }

    public function account_edit_password(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403);
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        return view('frontend.account_information.account_edit_password', [
            'datum' => $datum,
        ]);
    }

    public function profile_reset_password(Request $r, $id)
    {
        $datum = tb_sys_mf_user::findOrFail($id);
        $validated['password'] = Hash::make('@dmin2023!');
        $datum->fill($validated);
        $datum->update();
        return redirect()->back()->with('status', 'User password was reset!');
    }

    public function account_update_password(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        $validation = $this->get_custom_validation($r->id, 0);
        $validated = $this->validate($r, $validation['profile_update_password_validation']);
        $validated['password'] = Hash::make($r['password']);
        unset($validated["cf_password"]);
        $datum->fill($validated);
        $datum->update();
        return redirect()->route('users.myaccount', ['id' => Auth::id()])->with('status', 'User password was updated!');
    }

    public function profile_update_password(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        $validation = $this->get_custom_validation($r->id, 0);
        $validated = $this->validate($r, $validation['profile_update_password_validation']);
        $validated['password'] = Hash::make($r['password']);
        unset($validated["cf_password"]);
        $datum->fill($validated);
        $datum->update();
        return redirect()->back()->with('status', 'User password was updated!');
    }

    public function profile_show(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        $details = $this->get_details($datum->id);
        return view('tb_sys_mf_user.profile_show', [
            'datum'                 => $datum,
            'user_access_types'     => $details['user_access_types'],
        ]);
    }

    public function profile_update(Request $r, $id)
    {
        if (Auth::id() <> $id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
        $datum = tb_sys_mf_user::findOrFail($id);
        $validation = $this->get_custom_validation(0, $datum->id);
        $validated = $r->validate($validation['profile_update_validation']);
        unset($validated["profile_photo"]);
        $datum->update([
            'code'          => $validated['code'],
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'mobile_no'     => $validated['mobile_no'],
        ]);
        $this->upload_photo($r, $datum);
        return redirect()->route($this->route . '.profile-show', [$this->route_var => $datum])->with('status', 'User was updated!');
    }

    private function upload_photo(&$r, &$model)
    {
        if (isset($r->profile_photo)) {
            $new_attachment_name = time() . '-' . preg_replace('/\s+/', '', $r->profile_photo->getClientOriginalName());
            $r->profile_photo->move(public_path('storage/attachments/user'), $new_attachment_name);
            $datum = tb_sys_mf_user::findOrFail($model->id);
            $datum->profile_photo = $new_attachment_name;
            $datum->update();
        }
    }

    private function get_details($user_id)
    {
        return [
            'user_access_types' => tb_sys_mf_user_access_type::select('a.*', 'b.name as access_type')
                ->from('tb_sys_mf_user_access_type as a')
                ->join('tb_sys_mf_access_type as b', 'b.id', 'a.access_type_id')
                ->where('a.user_id', '=', $user_id)
                ->get(),
        ];
    }

    private function get_custom_validation($r_id, $user_id)
    {
        return [
            'store_validation'                          =>  [
                'code'          => ['required', 'max:30', Rule::unique('tb_sys_mf_user', 'code')->ignore($r_id)],
                'name'          => 'required|max:255',
                'email'         => 'required|string|email|max:255|unique:tb_sys_mf_user',
                'password'      => 'required|string|min:8',
                'cf_password'   => 'required|string|min:8|same:password',
                'is_active'     => 'nullable',
                'mobile_no'     => 'nullable',
                'profile_photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            ],
            [
                'cf_password.required'  => 'Confirm password is required',
                'cf_password.same'      => 'Passwords did not match',
                'cf_password.string'    => 'Confirm Password should be string',
                'cf_password.min'       => 'Confirm Password should be atleast 8 characters',
            ],
            'update_validation'                         =>  [
                'code'          => ['required', 'max:30', Rule::unique('tb_sys_mf_user', 'code')->ignore($r_id)],
                'name'          => 'required',
                'email'         => "required|unique:tb_sys_mf_user,email,$user_id,id",
                'mobile_no'     => 'nullable',
                'is_active'     => 'nullable',
                'profile_photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            ],
            'profile_update_password_validation'        =>  [
                'password'      => 'required|string|min:8',
                'cf_password'   => 'required|string|min:8|same:password',
            ],
            [
                'cf_password.required'  => 'Confirm password is required',
                'cf_password.same'      => 'Passwords did not match',
                'cf_password.string'    => 'Confirm Password should be string',
                'cf_password.min'       => 'Confirm Password should be atleast 8 characters',
            ],
        ];
    }
}
