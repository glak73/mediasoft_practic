<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Action;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checklists = Checklist::latest()->get();
        return response()->json([
            'data' => $checklists,
            'message' => 'Список чек-листов успешно получен',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = Auth::guard('sanctum')->user();

    // Валидируем входные данные
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
    ]);
    $checklistLimit = $user->checklists_limit;
    $currentChecklistsCount = Checklist::where('user_id', $user->id)->count();

    if ($currentChecklistsCount >= $checklistLimit || !$user->is_active) {
        return response()->json([
            'error' => 'Превышен лимит создания чек-листов или вы были заблокированы',
        ], 403);
    }

    // Создаем новый чек-лист
    $checklist = Checklist::create([
        'title' => $validatedData['title'],
        'user_id' => $user->id,
    ]);

    return response()->json([
        'data' => $checklist,
        'message' => 'Чек-лист успешно создан',
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checklist = Checklist::findOrFail($id);

        return response()->json([
            'data' => $checklist,
            'message' => 'Чек-лист успешно получен',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::guard('sanctum')->user();

        // Проверяем, существует ли такой чеклист
        $checklist = Checklist::findOrFail($id);

        // Проверяем, соответствует ли API-токен владельцу чеклиста
        if ($user->id !== $checklist->user_id) {
            return response()->json([
                'error' => 'У вас нет прав на удаление этого чеклиста',
            ], 403);
        }

        // Удаляем чеклист
        $checklist->delete();
        Action::where('checklist_id', $id)->delete();
        return response()->json([
            'message' => 'Чеклист успешно удален',
        ], 200);

    }
    public function getChecklistWithActions(int $id)
    {
        $checklist = Checklist::findOrFail($id);

        $response = [
            'checklist' => $checklist,
            'actions' => Action::where('checklist_id', $id)->get(),
        ];

        return response()->json($response, 200);
    }
    public function toggleActionStatus(Request $request)
{
    //$token = $request->input('token');
    $actionId = $request->input('id');
    $user = Auth::guard('sanctum')->user();
    if (!$actionId) {
        return response()->json([
            'error' => 'Токен пользователя и ID действия обязательны для передачи',
        ], 400);
    }

    $action = Action::find($actionId);

    if (!$action) {
        return response()->json([
            'error' => 'Действие не найдено',
        ], 404);
    }

    $checklist = Checklist::findOrFail($action->checklist_id);
   // $userId = $token;

    if ($user->id !== $checklist->user_id) {
        return response()->json([
            'error' => 'У вас нет прав для изменения статуса этого действия',
        ], 403);
    }

    $action->update(['is_completed' => !$action->is_completed]);

    return response()->json([
        'data' => [
            'checklist_id' => $action->checklist_id,
            'name' => $action->name,
            'is_completed' => $action->is_completed,
        ],
        'message' => 'Статус действия успешно обновлен',
    ], 200);
}
public function addAction(int $id, Request $request)
    {

        $user = Auth::guard('sanctum')->user();

        // Проверяем, существует ли такой чеклист и является ли пользователь его создателем
        $checklist = Checklist::find($id);
        if (!$checklist) {
            return response()->json([
                'error' => 'чеклист не найден',
            ], 403);
        }
        if ($user->id !== $checklist->user_id) {
            return response()->json([
                'error' => 'У вас нет прав на добавление действий в этот чеклист',
            ], 403);
        }

        // Валидируем входные данные
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_completed' => 'boolean',
        ]);

        // Создаем новое действие
        Action::create([
            'name' => $validatedData['name'],
            'is_completed' => $validatedData['is_completed'] ?? false,
            'checklist_id' => $id,
        ]);

        return response()->json([
            'message' => 'Действие успешно добавлено в чеклист',
        ], 201);
    }
}
