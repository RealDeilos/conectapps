<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.post_api.url');
    }
    function GetPosts(): Response
    {
        return Http::get($this->apiUrl);
    }
    function SavePosts(Collection $posts)
    {
        $posts->each(function ($post) {
            $this->firstOrCreate($post);
        });
    }
}
