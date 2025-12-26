<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_sys_lr_img_style_request;
use App\Models\tb_sys_lr_img;
use App\Models\tb_sys_lr_img_style;
use App\Models\tb_sys_mf_style;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class tb_sys_lr_img_style_controller extends Controller
{
    public function destroy(Request $r, $id){
        $datum = tb_sys_lr_img_style::findOrFail($id);
        $pk = $datum->img_id;
        $image = tb_sys_lr_img::findOrFail($datum->img_id);
        $style = tb_sys_mf_style::findOrFail($datum->style_id);
        $file_path = public_path('storage/images/'.$style->path.'/'.$image->filename);
        if (is_file($file_path)) {
            unlink($file_path);
        }
        $datum->delete();
        return redirect()->route('imgs.show', ['img' => $pk])->with('status', 'Success!');
    }
}
