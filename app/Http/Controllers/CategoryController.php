<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $categories = Category::where('user_id', '=', $user_id);
        //return view
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                "name" => 'required|string',
                "user_id" => 'required'
            ]);
            Category::create([
                'name' => $request->input('name'),
                // 'user_id' => $user_id,
                'user_id' => $request->input('user_id')
            ]);
            return response()->json(['status' => 'success', 'message' => 'Category created successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                "name" => 'required|string',
            ]);

            Category::where('id', $id)->update([
                'name' => $request->input('name'),
            ]);
            return response()->json(['status' => 'success', 'message' => 'Updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }    public function delete(Request $request, $id)
    {
        try {
            Category::where('id', $id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Delete Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
