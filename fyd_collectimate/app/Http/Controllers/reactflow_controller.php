<?php

namespace App\Http\Controllers;

use App\Models\tb_crm_tr_script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class reactflow_controller extends Controller
{
    // Show the editor page
    public function editor($script_id)
    {
        $script = tb_crm_tr_script::findOrFail($script_id);

        // Pass script_id to blade so React can call API endpoints
        return view('reactflow.edit', [
            'script_id' => $script->id,
            'script'    => $script,
        ]);
    }

    // Load JSON content
    public function getJson($script_id)
    {
        $script = tb_crm_tr_script::findOrFail($script_id);
        $filePath = "scripts/{$script->json_file_path}";

        if (!Storage::exists($filePath)) {
            Storage::put($filePath, json_encode(['nodes' => [], 'edges' => []], JSON_PRETTY_PRINT));
        }

        return response()->json(json_decode(Storage::get($filePath), true));
    }

    // Save JSON content
    public function saveJson(Request $request, $script_id)
    {
        $script = tb_crm_tr_script::findOrFail($script_id);
        $filePath = "scripts/{$script->json_file_path}";

        Storage::put($filePath, json_encode($request->all(), JSON_PRETTY_PRINT));

        // Redirect back to script view page after saving
        return response()->json([
            'success' => true,
            'redirect' => route('scripts.edit', $script->id) // adjust to your actual route name
        ]);
    }
}
