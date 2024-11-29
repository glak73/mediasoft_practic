<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
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
        return view('checklist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $userId = auth()->id();

        if (auth()->user()->checklists()->count() >= auth()->user()->checklists_limit) {
            abort(403, 'превышен лимит чеклистов');
        }
        // Создаем новый чеклист с привязкой к текущему пользователю
        $checklist = Checklist::create([
            'title' => $validatedData['title'],
            'user_id' => $userId,
        ]);
        return redirect()->route('checklist.show', $checklist->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Checklist $checklist)
    {
        $checklist->load('actions'); // Загружаем все действия для этого чеклиста
    return view('checklist.show', ['checklist' => $checklist]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checklist $checklist)
    {
        return view('checklist.edit', ['checklist' => $checklist]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $checklist)
    {
        //
    }
    public function storeAction(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'checklist_id' => 'required|exists:checklists,id',
        ]);

        $action = Action::create($validatedData);

        return response()->json(['data' => $action], 201);
    }

    public function destroyAction(Request $request, string $id)
    {
        $action = Action::findOrFail($id);
        $action->delete();

        return response()->json([], 204);
    }
}
