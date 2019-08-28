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

    protected function login(Request $request){
        $this->instanceMeli();
        $this->meli = new Meli(Config::get('ml.api_key'), Config::get('ml.secret_key'));        
        $url_auth = $this->meli->getAuthUrl(Config::get('ml.redirect'), Meli::$AUTH_URL[Config::get('ml.region')]);
        return redirect($url_auth);
        
    }
    
    protected function auth(Request $request){
        $this->instanceMeli();
        if($request->input('code')){
           return $this->meli->authorize($request->input('code'), Config::get('ml.redirect'));
        }
        return [$request->input('error'), $request->input('error_description')];        
    }
}
                      