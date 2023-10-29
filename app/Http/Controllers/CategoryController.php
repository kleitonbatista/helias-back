<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function list()
    {
        $category = Category::all();
        return response()->json($category, Response::HTTP_OK);
    }
    public function listAtivos()
    {
        $categories = Category::where('status', '=', true)->get();
        return response()->json($categories, Response::HTTP_OK);
    }

    public function store(CategoryRequest $request)
    {
        if ($request->input('id')) {
            $category = Category::find($request->input('id'));
        } else {
            $category = new Category();
        }
        $category->name = $request->input('name');
        $category->save();
        return response()->json($category, Response::HTTP_OK);
    }
    public function find(int $id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao recuperar', 'err' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function destroy(int $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['category' => $category], Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro', 'err' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
