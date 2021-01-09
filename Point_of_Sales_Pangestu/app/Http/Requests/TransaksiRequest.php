<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kd_barang' => 'required|integer|exists:table_barang,kd_barang',
            'kd_user' => 'required|integer|exists:users,kd_user',
            'jumlah_beli' => 'required|integer',
            'tanggal_beli' => 'required|date'
        ];
    }
}
