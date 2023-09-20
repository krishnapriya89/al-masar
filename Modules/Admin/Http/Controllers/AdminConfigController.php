<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\AdminConfig;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminConfigController extends Controller
{
    public function index()
    {
        $config = AdminConfig::all();

        return view('admin::config.index', compact('config'));
    }

    public function edit($id)
    {
        $config = AdminConfig::find(base64_decode($id));
        return view('admin::config.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'value' => [
                ($request->type == 0 || $request->type == 2) ? 'required' : 'nullable',
            ],
        ]);

        $config = AdminConfig::find($request->id);

        if ($request->hasFile('value')) {
            $config->deleteImage('value');
            $value          = $request->file('value');
            $config->value  = $config->uploadImage($value, $config->getImageDirectory());
        } else {
            if ($request->type == 0 || $request->type == 2) {
                $config->value = $request->value;
            }
        }

        if ($config->update()) {
            return to_route('config.index')->with('success', 'Config updated successfully!');
        } else {
            return to_route('config.index')->with('error', 'Failed to update Config.');
        }
    }
}
