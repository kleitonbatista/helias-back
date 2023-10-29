<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use DateTime;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class ItemController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function list()
    {
        $item = Item::all();
        return response()->json($item, Response::HTTP_OK);
    }
    public function store(ItemRequest $request)
    {

        try {
            if ($request->input('id')) {
                $item = Item::find($request->input("id"));
            } else {
                $item = new Item();
            }
            $dataAtual = new DateTime();

            $item->name = $request->input('name');
            $item->createdAt = $request->input('createdAt');
            $item->status = $request->input('status');
            $item->description = $request->input('description');
            $item->pricePurch = $request->input('pricePurch');
            $item->priceSale = $request->input('priceSale');
            $item->percent = $request->input('percent');
            $item->count = $request->input('count');
            $item->status = $request->input('status');
            $item->code = $request->input('code');
            $item->codeHelias = $request->input('codeHelias');
            $item->catId = $request->input('catId');

            $item->createdAt = $dataAtual->format('Y-m-d H:i:s');
            $item->status = true;

            // Salve o registro no banco de dados
            $item->save();

            return response()->json(['message' => 'Item criado com sucesso'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => 'erro ao salvar', "err" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(['teste' => $request->toArray()], Response::HTTP_OK);
    }
    public function destroy(int $id){
        try{
            $item = Item::findOrFail($id);
            $item->delete();
            return response()->json(['message'=>'item deletado com sucesso'],Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json(['message'=>'erro ao deletar', 'err'=>$e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function findCode(string $code){
        try{
            $item = Item::where('code', '=', $code)->first();
            return response()->json($item,Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json(['message'=>'erro ao pesquisar', 'err'=>$e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function findCodeHelias(string $code){
        try{
            $item = Item::where('codeHelias', '=', $code)->first();
            return response()->json($item,Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json(['message'=>'erro ao pesquisar', 'err'=>$e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function findByid(int $id){
        try{
            $item = Item::findOrFail($id);
            return response()->json($item,Response::HTTP_OK);
        }catch(Exception $e){   
            return response()->json(['message'=>'erro ao recuperar id', 'err'=>$e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
