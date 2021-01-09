<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'nama_barang' => 'required|max:255',
            'kd_merek' => 'required|integer|exists:table_merek,kd_merek',
            'kd_distributor' => 'required|integer|exists:table_distributor,kd_distributor',
            'tanggal_masuk' => 'required|date',
            'harga_barang' => 'required|integer',
            'keterangan' => 'required',
            'stok_barang' => 'required|integer'
        ];
    }
}
