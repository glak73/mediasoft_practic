<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function blockUser(Request $request, $id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }
        User::where('id', $id)->update(['is_active' => false]);
        return response()->json(['message' => 'User blocked successfully'], 200);
    }
    public function unblockUser(Request $request, $id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }
        User::where('id', $id)->update(['is_active' => true]);
        return response()->json(['message' => 'User blocked successfully'], 200);
    }

    public function assignAdmin(Request $request)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action');
        }

        $admin = User::find($request->input('user_id'));
        $admin->role = 'admin';
        $admin->save();
        return response()->json(['message' => 'Admin assigned successfully'], 200);
    }

    public function updateChecklistsLimit(Request $request)
    {
        $id = $request->input('id'); // Получаем id пользователя из запроса
        if (!$id) {
            return response()->json(['error' => 'ID пользователя не указан'], 400);
        }

        $user = User::findOrFail($id);
        if (auth()->user()->role !== 'super_admin') {
            return response()->json(['error' => 'Только суперадминистратор может обновлять лимит чеклиста'], 403);
        }

        $user->checklists_limit = $request->input('checklists_limit');
        $user->save();

    return redirect()->back()->with('success', 'Лимит чеклистов обновлен');
    }
}
