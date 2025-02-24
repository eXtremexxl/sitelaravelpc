<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;

class ComponentController extends Controller {
    public function index() {
        $components = Component::getGroupedComponents();
        return view('admin.components.index', compact('components'));
    }

    public function create() {
        return view('admin.components.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:components,name',
            'category' => 'required|string|max:255',
        ]);

        Component::create($data);
        return redirect()->route('admin.components')->with('success', 'Комплектующее добавлено');
    }
}
