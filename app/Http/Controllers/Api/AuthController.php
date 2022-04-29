<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new Client;

        try {

            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);

            $data = json_decode((string) $response->getBody(), true);
            
            return response()->json(['access_token' => $data['access_token']]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            if ($e->getCode() === 400) {
                return response()->json('Usuario o contraseña incorrectos.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Credenciales incorrectas. Intenta de nuevo', $e->getCode());
            }

            return response()->json('Algo ha salido mal en el servidor.');
        }
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Sesión cerrada correctamente', 200);
    }
}
