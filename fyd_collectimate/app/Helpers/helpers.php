<?php

use App\Models\tb_crm_mf_license_history;
use App\Models\tb_sys_lr_img;
use App\Models\tb_sys_lr_img_style;
use App\Models\tb_sys_mf_style;
use App\Models\tb_sys_tr_audit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;


//IMAGE PROCESSING
function store_image($image, $table_name)
{
    if (isset($image)) {
        $new_attachment_name = time() . '-' . preg_replace('/\s+/', '', $image->getClientOriginalName());
        $image->move(public_path('storage/images/Original'), $new_attachment_name);
        $data = [
            'filename'      => $new_attachment_name,
            'path'          => 'Original',
            'table_name'    => $table_name,
        ];
        $img = new tb_sys_lr_img();
        $img->fill($data);
        $img->save();
        cache_image($img->id);
        return $img->id;
    }
}

function cache_image($img_id)
{
    try {
        $image = tb_sys_lr_img::findOrFail($img_id);
        $originalImage = public_path('storage/images/' . $image->path . '/' . $image->filename);
        if (!File::exists($originalImage)) {
            Log::debug([
                'process' => 'store',
                'error'   => 'Image ' . $originalImage . ' not found.'
            ]);
            return;
        }
        $styles = tb_sys_mf_style::get();
        foreach ($styles as $style) {
            $datum = new tb_sys_lr_img_style();
            $validatedData['style_id'] = $style->id;
            $datum->fill([
                'style_id'  => $style->id,
                'img_id'    => $img_id,
            ]);
            $datum->save();
            // Create the directory if it does not exist
            $resizePath = public_path('storage/images/' . $style->path);
            if (!File::exists($resizePath)) {
                File::makeDirectory($resizePath, 0755, true);
            }
            // Resize the image
            $resizedImage = Image::make($originalImage)->resize($style->width, $style->height, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Save the resized image
            $resizedImage->save($resizePath . '/' . basename($originalImage));
        }
    } catch (\Throwable $th) {
        Log::debug([
            'process' => 'store',
            'error'   => $th->getMessage()
        ]);
    }
}

function delete_cached_image($img_id)
{
    $img_styles = tb_sys_lr_img_style::select('a.*', 'b.filename', 'c.path')
        ->from('tb_sys_lr_img_style as a')
        ->join('tb_sys_lr_img as b', 'b.id', 'a.img_id')
        ->join('tb_sys_mf_style as c', 'c.id', 'a.style_id')
        ->where('a.img_id', $img_id)
        ->get();
    foreach ($img_styles as $img) {
        $file_path = public_path('storage/images/' . $img->path . '/' . $img->filename);
        if (is_file($file_path)) {
            unlink($file_path);
        }
        tb_sys_lr_img_style::where('id', $img->id)->delete();
    }
}

function delete_image($img_id)
{
    if (isset($img_id)) {
        $img = tb_sys_lr_img::where('id', $img_id)->first();
        $file_path = public_path('storage/images/' . $img->path . '/' . $img->filename);
        if (is_file($file_path)) {
            unlink($file_path);
        }
        $img->delete();
    }
}

// ENUM HELPER
function get_enum_values($table, $column)
{
    $type = DB::select(DB::raw("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'"))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enum = array_map(function ($value) {
        return trim($value, "'");
    }, explode(',', $matches[1]));

    return $enum;
}

function format_mobile_no($mobile_no)
{
    // Remove non-digit characters
    $mobile_no = preg_replace('/\D/', '', $mobile_no);

    // Check if the phone number starts with '63' (international format for PH)
    if (strpos($mobile_no, '63') === 0) {
        $mobile_no = substr($mobile_no, 2); // Remove '63'
    } elseif (strpos($mobile_no, '0') === 0) {
        $mobile_no = substr($mobile_no, 1); // Remove leading '0'
    }

    // Ensure the number is now 10 digits long
    if (strlen($mobile_no) !== 10) {
        throw new \InvalidArgumentException("Invalid phone number format.");
    }

    return $mobile_no;
}


function encrypt_text($text)
{
    $key = hash('sha256', config('services.encryption.key'), true);
    $iv = random_bytes(16);

    $ciphertext = openssl_encrypt(
        $text,
        'AES-256-CBC',
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    // Combine IV and ciphertext, then encode
    $encrypted = base64_encode($iv . $ciphertext);

    return $encrypted;
}


function store_audit($user_id, $module, $remarks = null)
{
    tb_sys_tr_audit::create([
        'user_id'   => $user_id,
        'module'    => $module,
        'remarks'   => $remarks,
        'timestamp' => now(),
    ]);
}

function store_license_history($datum)
{
    tb_crm_mf_license_history::create([
        'license_id'          => $datum->id,
        'device_id'           => $datum->device_id,
        'expiration_date'     => $datum->cache_expiration_date,
        'license_type_id'     => $datum->cache_license_type_id,
        'no_of_license'       => $datum->cache_no_of_license,
    ]);
}
