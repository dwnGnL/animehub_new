<?php


namespace AdminController;


use App\Models\Anime;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class AnimeController extends AdminController
{
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $post){
            echo $post->id.'</br>';
            $anime = Anime::whereHas('title', function (Builder $builder)use ($post){
                $builder->where('title', $post->title);
                $builder->where('id_tv', $post->id_tv);
            })->where('post_id', 0)
            ->get();

            if (empty($anime)){
                continue;
            }
            foreach ($anime as $item){
                $item->post_id = $post->id;
                $item->save();
            }

        }
    }

}
