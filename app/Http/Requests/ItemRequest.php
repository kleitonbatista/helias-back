<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest {
 
    public function rules()
    {
        return [
            'name' => 'required',
            'pricePurch' => 'required',
            'priceSale' => 'required',
            'percent' => 'required',
            'count' => 'required',
            'codeHelias' => 'required',
            'code' => 'required',
            'catId' => 'required',
        ];
    }
    

    public function messages()
    {
        return [
            'name.required' => 'Nome da peça obrigatório',
            'pricePurch.required' => 'O preço de compra deve ser informado',
            'priceSale.required' => 'O preço de revenda deve ser informado',
            'percent.required' => 'A porcentagem deve ser informada',
            'count.required' => 'A quantiade de itens deve ser informada',
            'codeHelias.required' => 'O código Helias deve ser informada',
            'code.required' => 'O código do produto deve ser informado',
            'catId.required' => 'A categoria deve ser selecionada',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Ops! Algum campo obrigatório não foi preenchido ou está incorreto.',
                'status' => false,
                'errors' => $validator->errors()
            ], 403));
        }
    }
}