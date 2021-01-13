<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Product;
use App\ProductInterest;

class ProductInterestController extends Controller {
    
    public function index($product_id) {
        // $interests = ProductInterest::where('product_id', $product_id)->get();
        // return response()->json($products, 200);

        try {
            $product = Product::findOrFail($product_id);
            $interests = $product->interests()->get();
            return response()->json($interests, 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => "Produto não encontrado"], 404);
        }
    }

    public function show($product_id, $id) {
        try {
            $interest = ProductInterest::findOrFail($id);
            return response()->json($interest, 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => "Interesse não encontrado"], 404);
        }
    }

    public function create(Request $request, $product_id) {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];

        $messages = [
            'product_id.required' => 'O atributo product_id é obrigatório',
            'product_id.exists' => 'O atributo product_id deve conter um ID de produto válido',
            'name.required' => 'O atributo name é obrigatório',
            'email.required' => 'O atributo email é obrigatório',
            'message.required' => 'O atributo message é obrigatório'
        ];

        $this->validate($request, $rules, $messages);

        $interest = new ProductInterest();

        $interest->product_id = $request->input('product_id');
        $interest->name = $request->input('name');
        $interest->email = $request->input('email');
        $interest->message = $request->input('message');

        $interest->save();

        return response()->json(['message' => 'Interesse cadastrado com sucesso'], 201);
    }

    public function update(Request $request, $id) {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];

        $messages = [
            'product_id.required' => 'O atributo product_id é obrigatório',
            'product_id.exists' => 'O atributo product_id deve conter um ID de produto válido',
            'name.required' => 'O atributo name é obrigatório',
            'email.required' => 'O atributo email é obrigatório',
            'message.required' => 'O atributo message é obrigatório'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $interest = ProductInterest::findOrFail($id);

            $interest->product_id = $request->input('product_id');
            $interest->name = $request->input('name');
            $interest->email = $request->input('email');
            $interest->message = $request->input('message');

            $interest->save();

            return response()->json(['message' => 'Interesse atualizado com sucesso'], 200);

        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => "Interesse não encontrado"], 404);
        }
    }

    public function destroy($id) {
        try {
            $interest = ProductInterest::findOrFail($id);
            $interest->delete();
            return response()->json(['message' => 'Interesse removido com sucesso'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['message' => "Interesse não encontrado"], 404);
        }
    }

}
