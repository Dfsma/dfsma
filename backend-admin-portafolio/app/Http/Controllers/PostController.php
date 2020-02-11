<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function pruebas(Request $request){
        return "Accion de pruebas PostController";
    }

    public function index(){

        $posts = Post::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'posts' => $posts


        ], 200);
    }
    public function store(Request $request){
        
        //Recoger datos del post
        $json = $request->input('json', null);
        $params = json_decode($json); //Objeto
        $params_array = json_decode($json,true); //arreglo


        if(!empty($params) && !empty($params_array)){

            //Limpiar datos 
            $params_array = array_map('trim', $params_array);
            //Validar datos
            $validate = \Validator::make($params_array, [
                'title' => 'required',
                'content' => 'required'
            ]);

            if($validate->fails()){
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El post no se ha creado',
                    'errors' => $validate->errors()
                );
                
            }else{
                //Crear el post
                $post = new Post();
                $post->title = $params->title;
                $post->content = $params->content;

                $post->save();

                $data = [
                    'status' => 'succes',
                    'code' => 200,
                    'message' => 'El post se ha creado correctamente'
                ];
            }
        }else{
            $data = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function show($id){

        $post = Post::find($id);

        if(is_object($post)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'posts' => $post
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La entrada no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }


}
