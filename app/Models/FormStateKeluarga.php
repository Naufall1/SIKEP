<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormStateKeluarga
{
    use HasFactory;

    /**
     * update session of formState from request object
     * @param Request $request
     * @return void
     */
    public static function update(Request $request)
    {
        session()->put('formState', $request->all());
    }
    /**
     * Get the formState data from session.
     * This will return empty array when session is not found
     * @return array
     */
    public static function get(): array
    {
        return session()->has('formState') ? session()->get('formState') : [];
    }
    /**
     * clear the formState data from session
     * @return void
     */
    public static function clear()
    {
        session()->put('formState', []);
    }
    /**
     * Initialize the Keluarga object and fill the attributes with data from formState session
     * @return Keluarga object
     */
    public static function getKeluarga(): Keluarga
    {
        $keluarga = new Keluarga();
        session()->has('formState') ? $keluarga->fill(session()->get('formState')) : null;
        return $keluarga;
    }

}
