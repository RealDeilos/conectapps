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
        $this->log = Log::channel('transactions');
    }
    /**
     * List json posts limit by 10. 
     * Route get, url=/posts?page={x}
     * @return json
     */
    public function index(Post $post)
    {
        $this->log->info("Display all Posts");

        return json_encode($post->paginate(10));
    }
    /**
     * Store json posts in DB table posts. 
     * Route post, url=/posts
     * @return Response
     */
    public function store(Post $post)
    {
        $this->log->info("Fetching Posts");
        try {
            $response = $post->GetPosts();
            $statusCode = $response->status();

            if ($response->failed()) 
            {
                $this->log->error("Failed request " . $statusCode);
                return response("Failed", 400);
            } 
            else 
            {
                $this->log->info("Successful request");
                $post->SavePosts($response->collect());
                return response("Success", $statusCode);
            }
        } catch (\Exception $e) {

            $this->log->error($e->getMessage() . $e->getCode());

            return response($e->getMessage(), 400);
        }
    }
    /**
     * Show single post record filtered by id
     *  Route get, url=/posts/{id}
     * @return json 
     */
    public function show(Post $post)
    {
        $this->log->info("Showing Post with id : " . $post->id);

        return json_encode($post);
    }
}
