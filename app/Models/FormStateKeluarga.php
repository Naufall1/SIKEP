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
        $pengajuan = new Pengajuan();
        if ($pengajuan->keluarga->kepala_keluarga != null) {
            self::setKepalaKeluarga($pengajuan->keluarga->kepala_keluarga);
        } else {
            self::setKepalaKeluarga('');
        }
    }

    /**
     * update session of formState from request object or array
     * @param Request|array $request
     * @return void
     */
    public static function setKK(object $kartu_keluarga)
    {
        $form = session()->get('formState');
        $form['kartu_keluarga'] = $kartu_keluarga;
        session()->put('formState', $form);
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
     * Get kartu keluarga object.
     * @return (object) => [
                    'path' => $filenameSimpan,
                    'ext' => explode('.', $filenameSimpan)[1],
                    'base64' => base64_encode(Storage::disk('temp')->get($filenameSimpan))
                    ] | null
     */
    public static function getKartuKeluarga()
    {
        return isset(session()->get('formState')['kartu_keluarga']) ? session()->get('formState')['kartu_keluarga'] : null;
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
    public static function setKepalaKeluarga(string $kepala_keluarga)
    {
        if (session()->has('formState')) {
            $formState = session()->get('formState');
            $formState['kepala_keluarga'] = $kepala_keluarga;
            session()->put('formState', $formState);
        }
    }

}
