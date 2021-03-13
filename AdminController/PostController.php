<?php


namespace AdminController;


use Clue\React\Buzz\Browser;
use Lib\Cache;
use Lib\Helper;
use Model\Anime;
use Model\Cat;
use Model\CatPost;
use Model\Comment;
use Model\GodWip;
use Model\Post;
use Model\PostType;
use Model\Rating;
use Model\Stud;
use Model\Title;
use Model\Tv;
use Model\View;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Factory;
use Traits\Helper AS THelper;

require_once 'Lib/phpQuery.php';

class PostController extends AdminController
{
    use THelper;
    protected $postDB;

    public function __construct()
    {
        $this->postDB = new Post();
        parent::__construct();
    }

    public function index($page)
    {
        $page = $page ? $page : 1;
        $posts = $this->postDB->getPostsList($page, '/dashboard/post');
        foreach ($posts['items'] as $key => $val) {
            $disLike = $this->postDB->getDisLike($posts['items'][$key]['id']);
            $posts['items'][$key]['postLike'] = $posts['items'][$key]['postLike'] - $disLike['dis'];
        }
        $this->index = $this->app->view()->fetch('dashboard/posts.tpl.php', [
            'posts' => $posts,
            'helper' => Helper::getInstance(),
            'uri' => $this->getUri(),
        ]);

        $this->display();

    }

    public function add()
    {
        $cat = new Cat();
        $typeBD = new PostType();
        $types = $typeBD->getPostType();
        $cats = $cat->getCategories();
        $this->index = $this->app->view()->fetch('dashboard/addPost.tpl.php', [
            'cats' => $cats,
            'types' => $types,
            'app' => $this->app
        ]);
        $this->display();
    }

    public function addPost()
    {

        $formData = $this->decompileData($_POST['formData']);
        $year = trim($formData['god_wip']);
        if (is_numeric($year) && strlen($year) == 4) {
            $postDB = new Post();
            $year_id = $this->getId($year, new GodWip());
            $tv_id = $this->getId(trim($formData['sezon']), new Tv());
            $alt_title = trim($formData['alt_title']);
            $post = $postDB->add([
                'id_god_wip' => $year_id,
                'image' => $this->downloadImage($formData['image'], $alt_title),
                'title' => trim($formData['title']),
                'alias' => $alt_title,
                'date' => time(),
                'body' => $formData['description'],
                'id_tv' => $tv_id,
                'rating' => 0,
                'id_user' => $_SESSION['id'],
                'id_type_post' => $formData['type'],
            ]);
            if ($post) {
                $viewsDB = new View();
                $cats = json_decode($_POST['cats']);
                $post_id = $postDB->driver->lastInsertId();
                $catPostDB = new CatPost();
                $viewsDB->add(['id_post' => $post_id]);
                for ($i = 0; $i < count($cats); $i++) {
                    $catPostDB->add(['id_post' => $post_id, 'id_cat' => $cats[$i]]);
                }
            }
            $cache = new Cache();
            $cache->delete('dorams');
            $cache->delete('newPosts');
            $cache->delete('posts');
            echo json_encode(['status' => 200]);

        }
    }

    public function getId($title, $DB)
    {
        $godDB = $DB;

        $godWip = $godDB->one('id', ['title' => $title]);

        if (!empty($godWip['id'])) {
            return $godWip['id'];
        } else {
            $godDB->add(['title' => $title]);
            return $godDB->driver->lastInsertId();
        }

    }

    protected function display()
    {
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }

    public function searchAjax()
    {
        $posts = $this->postDB->searchPostsList($_POST['title']);
        foreach ($posts as $key => $val) {
            $disLike = $this->postDB->getDisLike($posts[$key]['id']);
            $posts[$key]['postLike'] = $posts[$key]['postLike'] - $disLike['dis'];
        }
        $result = '';
        $i = 0;
        foreach ($posts as $post) {
            $result .= $this->app->view()->fetch('dashboard/table.tpl.php', [
                'post' => $post,
                'helper' => Helper::getInstance(),
                'uri' => $this->getUri(),
                'i' => $i++
            ]);
        }
        echo $result;
        exit();

    }

    public function edit($params)
    {
        $studDB = new Stud();
        $typeBD = new PostType();
        $post = $this->postDB->getPost($params['post'], $params['alias']);
        $animeDB = new Anime();
        $catDB = new Cat();
        $cats = $catDB->getCategories();
        $types = $typeBD->getPostType();
        $postCats = $catDB->getCatPost($post['id_post']);
        $post['type'] = $params['alias'];
        $anime = $animeDB->getSeria($post['id_tv'], $post['title']);
        $studs = $studDB->row('id, title');
        $this->index = $this->app->view()->fetch('dashboard/editPost.tpl.php', [
            'post' => $post,
            'anime' => $anime,
            'studs' => $studs,
            'cats' => $cats,
            'postCats' => $postCats,
            'types' => $types
        ]);
        $this->display();
    }

    public function delete()
    {
        $animeDB = new Anime();
        $comment = new Comment();
        $views = new View();
        $rating = new Rating();
        if ($animeDB->delete($_POST['id'])) {
            if ($comment->deleteCommentsPost($_POST['id'])) {
                if ($views->deleteViewsPost($_POST['id'])) {
                    if ($rating->deleteRatingPost($_POST['id'])) {
                        $this->postDB->deletePost($_POST['id']);
                        $cache = new Cache();
                        $cache->delete('dorams');
                        $cache->delete('newPosts');
                        $cache->delete('posts');
                        echo json_encode(['status' => 200]);
                        exit();
                    }
                }
            }
        }
        $cache = new Cache();
        $cache->delete('dorams');
        $cache->delete('newPosts');
        $cache->delete('posts');
        echo json_encode(['status' => 500]);
        exit();
    }

    public function update()
    {
        $formData = $this->decompileData($_POST['formData']);
        $year = trim($formData['god']);
        if (is_numeric($year) && strlen($year) == 4) {
            $postDB = new Post();
            $title = trim($formData['title']);
            $tv_id = $this->getId(trim($formData['sezon']), new Tv());
            $year_id = $this->getId($year, new GodWip());
            $title_id = $this->getId($title, new Title());
            $old_post = $postDB->one('image, title, id_tv, id', ['id' => $_POST['id_post']]);
            if (!file_exists($formData['image'])) {
                $image = $this->downloadImage($formData['image'], $formData['alt_title']);
                $old_post = $postDB->one('image, title, id_tv, id', ['id' => $_POST['id_post']]);
                $this->deleteImage($old_post['image']);
            } else {
                $image = $formData['image'];
            }

            $post = $postDB->update([
                'title' => $title,
                'alias' => $formData['alt_title'],
                'id_god_wip' => $year_id,
                'image' => $image,
                'body' => $formData['body'],
                'id_tv' => $tv_id,
                'id_type_post' => $formData['type']
            ], $_POST['id_post']);
            if ($post) {
                $catPostDB = new CatPost();
                $catPostDB->delete(['id_post' => $old_post['id']]);
                $cats = json_decode($_POST['cats']);
                for ($i = 0; $i < count($cats); $i++) {
                    $catPostDB->add(['id_post' => $old_post['id'], 'id_cat' => $cats[$i]]);
                }
                $old_id_title = $this->getId($old_post['title'], new Title());
                $animeDB = new Anime();
                $animeDB->update(
                    ['id_tv' => $tv_id, 'id_title' => $title_id],
                    ['id_tv' => $old_post['id_tv'], 'id_title' => $old_id_title]
                );
            }

        }
        $cache = new Cache();
        $cache->delete('dorams');
        $cache->delete('newPosts');
        $cache->delete('posts');
        echo json_encode(['status' => 200]);
    }

    public function editSeria()
    {
        $animeDB = new Anime();
        $seria = json_decode($_POST['seria']);
        if ($_POST['type'] == 1) {
            $animes = $animeDB->getAnimeIn($seria);
            $changeSeria = $this->changeSrc($animes);
            $countCorrect = count($changeSeria);
            $change = $animeDB->getAnimeIn($changeSeria);
            echo json_encode(['status' => 200, 'countCorrect' => $countCorrect, 'type' => 1, 'change' => $change]);
        } elseif ($_POST['type'] == 3) {

            if ($animeDB->deleteIn($seria)) {
                echo json_encode(['status' => 200, 'type' => 3]);
            }
        } elseif ($_POST['type'] == 2) {
            foreach ($seria as $value) {
                $animeDB->update(['id_stud' => $_POST['stud']], $value);
            }
            $studDB = new Stud();
            $stud = $studDB->one('title', ['id' => $_POST['stud']]);
            echo json_encode(['status' => 200, 'stud' => $stud['title'], 'type' => 2]);
        } elseif ($_POST['type'] == 4) {
            if ($_POST['input'] == 1) {
                if ($animeDB->update(['seria' => $_POST['data']], $_POST['id'])) {
                    echo json_encode(['status' => 200, "id" => $_POST['id']]);
                }
            } elseif ($_POST['input'] == 3) {

                if ($animeDB->updateSrc($_POST['id'], $_POST['data'])) {
                    echo json_encode(['status' => 200, "id" => $_POST['id']]);
                }
            }
        }

        $cache = new Cache();
        $cache->delete('dorams');
        $cache->delete('newPosts');
        $cache->delete('posts');
    }

    public function globalCorrect()
    {
        $animeDB = new Anime();
        $anime = $animeDB->getAnimeGlobalCorrect();
        $countAnime = $this->changeSrc($anime);
        echo $countAnime;
    }

    public function changeSrc(array $anime)
    {
        $animeDB = new Anime();
        $i = 0;
        $changeSeria = [];
        foreach ($anime as $val) {
            if (($src = $this->autoCorrectMix($val['rly_path'], $val['src'])) != false) {
                $animeDB->updateSrc($val['id'], $src);
                $changeSeria[$i] = $val ['id'];
                $animeDB->update(['status_parse' => 1], ['id' => $val['id']]);
                $i++;
            }
        }
        return $changeSeria;
    }

    public function autoCorrectMix($href, $oldSrc)
    {

        $href = explode('/', $href);
        $embed = $this->getContent('http://mix.tj/embed/' . $href[2]);
        $embed = \phpQuery::newDocument($embed);
        $src = '';
        if ($embed->find('script')) {
            $vid = $embed->find('script')->text();
            $src = $this->getSrc($vid);
        }
        if (!empty($src)) {
            if ($oldSrc != $src) {
                return $src;
            }
            return false;

        } else {

            return false;
        }


    }




    public function getContent($site)
    {
        $loop = Factory::create();
        $client = new Browser($loop);
        $client->get($site)
            ->then(function (ResponseInterface $response) use ($loop) {
                $this->content = $response->getBody();
                $loop->stop();
            });
        $loop->run();

        return $this->content;
    }
}
