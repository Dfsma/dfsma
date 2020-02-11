<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PruebasController extends Controller
{
    public function testOrm(){
        $posts = Post::all();
        
        foreach($posts as $post){
            echo "<h1>".$post->title."</h1>";
            echo "<h1>".$post->content."</h1>";
            
        }


        die();
    }
}
