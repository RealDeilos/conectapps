<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_endpoint()
    {
        $this->post('/posts')->assertOk();
    }
    public function test_api_post()
    {
        $this->getJson(config("services.post_api.url"))->assertOk();
    }
    public function test_should_store()
    {
        Http::fake([
            config("services.post_api.url") =>Http::response([
                [
                    'id'=>102,
                    'userId'=>2,
                    'body'=>'lorem',
                    'title'=>'ipsum',
                ]
            ],200)
        ]);
        $this->post('/posts')->assertOk();
    }
    public function test_should_failed_server_error()
    {
        Http::fake([
            config("services.post_api.url") =>Http::response([
                [
                    'message'=>'Server Error'
                ]
            ],500)
        ]);
        $this->post('/posts')->assertStatus(Response::HTTP_BAD_REQUEST);
    }
    public function test_should_failed_client_error()
    {
        Http::fake([
            config("services.post_api.url") =>Http::response([
                [
                    'message'=>'Client Error'
                ]
            ],400)
        ]);
        $this->post('/posts')->assertStatus(Response::HTTP_BAD_REQUEST);
    }


}
