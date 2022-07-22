<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public $log;

    public function __construct()
    {
        $this->log=Log::channel('transactions');
    }

    public function index(Post $post)
    {
        $this->log->info("Display all Posts");

        return json_encode($post->all());
    }

    public function store(Post $post)
    {
        $this->log->info("Fetching Posts");
        try {
            $response=$post->GetPosts();

            if($response->failed())
            {
                $this->log->error("Failed response with error: ".$response->status());
    
                $response->throw();
            }
            if($response->successful())
            {
                $this->log->info("Succesful request");
    
                $post->SavePosts($response->collect());

                return $response->status();
            }
      
        } catch (\Exception $e) {

            return response($e->getMessage(),400);
        }
      
    }

    public function show(Post $post)
    {
        $this->log->info("Showing Post with id : ".$post->id);

        return json_encode($post);
    }


}
