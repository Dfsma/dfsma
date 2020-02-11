<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\User;
class UserController extends Controller
{
    public function register(Request $request)
    {

        //Recoger los datos del usuario por post
        $json = $request->input('json', null);

        $params = json_decode($json); //objeto

        $params_array = json_decode($json, true); //array


        if (!empty($params) && !empty($params_array)) {

            //Limpiar datos
            $params_array = array_map('trim', $params_array);

            //Validar datos
            $validate = validator($params_array, [
                'name'      => 'required|alpha',
                'email'     => 'required|email|unique:users', //Comprobar si el usuario existe o no (UNIQUE)
                'password'  => 'required'
            ]);

            if ($validate->fails()) {
                //La validacion a Fallado
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se ha creado',
                    'errors' => $validate->errors()
                );
            } else {
                //Validacion pasda correctamente

                    //Cifrar Contraseña
                    $pwd = hash('sha256', $params->password);

                    //Crear el usuario
                    $user = new User();
                    $user->name = $params_array['name'];
                    $user->email = $params_array['email'];
                    $user->password = $pwd;

                    //Guardar el Usuario
                    $user->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se ha creado correctamente',
                    'user' => $user

                );
            }
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos',
                
            );
        }
        return response()->json($data, $data['code']);

    }

    public function login(Request $request)
    {
        $jwtAuth = new \JwtAuth();
        // Recibir datos por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = \json_decode($json, true);
        
        // Validar esos datos
        $validate = validator($params_array, [
            'email'     => 'required|email', //Comprobar si el usuario existe o no (UNIQUE)
            'password'  => 'required'
        ]);

        if ($validate->fails()) {
            //La validacion a Fallado
            $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()
            );
        }else{

            // Cifrar la contraseña
            $pwd = hash('sha256', $params->password);
            // Devolver token o datos
            $signup = $jwtAuth->signup($params->email, $pwd);
            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }
        }
        return response()->json($signup, 200);

    }
    
}
