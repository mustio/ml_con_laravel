<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Meli;
use Illuminate\Support\Facades\Config;

class LoginController extends Controller
{   
    private $meli;
    private function instanceMeli(){
        $this->meli = new Meli(Config::get('ml.api_key'), Config::get('ml.secret_key'));
    }

    protected function login(){
        $this->instanceMeli();
        $this->meli = new Meli(Config::get('ml.api_key'), Config::get('ml.secret_key'));        
        $url_auth = $this->meli->getAuthUrl(Config::get('ml.redirect'), Meli::$AUTH_URL[Config::get('ml.region')]);
        return redirect($url_auth);
        
    }

    protected function auth(Request $request)
    {
        $expire_session = $this->checkExpireSession();
        if ($expire_session === true) {
            $this->instanceMeli();
            if ($request->input('code')) {
                $array_response = ($this->meli->authorize($request->input('code'), Config::get('ml.redirect')));
                if ($array_response['httpCode'] === 200) {
                    session(['token'            => $array_response['body']->access_token]);
                    session(['expires_in'       => time() + $array_response['body']->expires_in]);
                    session(['refresh_token'    => $array_response['body']->refresh_token]);
                    return view('bienvenido')->with('store', session()->all());
                } else {

                    return ['error' => $array_response];
                }
            }
            return [$request->input('error'), $request->input('error_description')];
        } else {
            return $expire_session;
        }
    }

    /**
     * Evalua si la session expiro y actualiza el token em caso de se posible
     *
     * @return array|true
     */
    protected function checkExpireSession(){        
        if(session()->get('expires_in') && session()->get('expires_in') < time()) {                
                try {
                    $this->instanceMeli();
                    $refresh = $this->meli->refreshAccessToken();
                    session(['token'            => $refresh['body']->access_token]);
                    session(['expires_in'       => $refresh['body']->expires_in]);
                    session(['refresh_token'    => $refresh['body']->refresh_token]);
                } catch (\Exception $e) {
                    $refresh['decription'] = 'La Session expiró';
                   return ['error'=> $refresh];
                }
            } else {
                return true;
            }
    }
    
    protected function show()
    {
        $store = session()->all();
        return view('bienvenido')->with('store', $store); 
    }
}
                      