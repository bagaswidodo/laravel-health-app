<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FaskesRequest extends Request
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
            //
            'nama_faskes' => 'required|min:3',
            'tipe_id'  => 'required',
            'alamat' => 'required', //or ['required|date]
            'latitude'=>'required',
            'longitude' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_faskes.required'  => 'Kolom Nama Faskes tidak boleh kosong',
            'tipe_id.required'      =>'Tipe Fasilitas kesehatan belum dipilih',
            'alamat.required'       => 'Alamat tidak boleh kosong',
            'latitude.required'       => 'Latitude tidak boleh kosong',
            'longitude.required'    => 'Longitude tidak boleh kosong',
        ];
    }
}
