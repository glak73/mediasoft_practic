<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'checklist_id' => 'required|numeric',
        ]);

        // Изменим обработку поля is_completed
        if ($request->has('is_completed')) {
            $is_completed = true;
        } else {
            $is_completed = false;
        }
        // $is_completed = $request->input('is_completed') ?? false;

        $action = Action::create([
            'name' => $validatedData['name'],
            'checklist_id' => $validatedData['checklist_id'],
            'is_completed' => $is_completed
        ]);

        if (!$action) {
            return back()->withInput()->withErrors(['title' => 'Ошибка при создании действия']);
        }

        return redirect()->route('checklist.edit', $request->input('checklist_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Action $action)
    {
        //
    }
}
