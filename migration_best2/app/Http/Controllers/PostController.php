<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    protected $postRepository;
    protected $categoryRepository;
    public function __construct(PostRepository $postRepository,CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository= $categoryRepository;
    }

    public function index()
    {
//        $posts = $this->postRepository->getAll();

        $posts = Post::paginate(10);
        return view('backend.post.list',compact('posts'));

    }

    public function create()
    {
        if (!Gate::allows('add-new-post')) {
            abort(403);
        }
        $categories = $this->categoryRepository->getAll();
        return view("backend.post.create",compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $data = $request->only('title','content','user_id');
        $post = Post::create($data);
        $post->categories()->attach($request->category);
        toastr()->success('Create Successfully');
        return redirect()->route("posts.index");
    }

    public function edit($id)
    {
        $post=$this->postRepository->getById($id);
        $categories = $this->categoryRepository->getAll();
        return view('backend.post.update',compact('post',"categories"));
    }

    public function update(Request $request,$id)
    {
        $data = $request->only('title','content','user_id');
        $post = Post::findOrFail($id);
        $post->update($data);
        $post->categories()->sync($request->category);
        return redirect()->route("posts.index");
    }

    public function destroy($id)
    {
        $this->postRepository->destroy($id);
        return redirect()->route("posts.index");
    }

    public function addToFavorite($id)
    {
        $post = Post::findOrFail($id);
        $bookmark = session()->get('bookmark', []);
        if (!isset($bookmark[$id])) {
            $bookmark[$id] = array(
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'quantity' => 1
            );
        } else {
            $bookmark[$id]['quantity']++;
        }
        session()->put('bookmark', $bookmark);
        return redirect()->back();
    }



//    public function addToFavorite($id)
//    {
//        $post = Post::findOrFail($id);
//        $bookmark = session()->get('bookmark') ?? [];
//        $bookmark[$id] = array(
//            'id'=>$post->id,
//            'title'=>$post->title,
//            'content'=>$post->content
//        );
//        session()->put('bookmark',$bookmark);
//        return redirect()->back();
//    }

    public function showFavoriteList()
    {
        $books = session()->get('bookmark') ?? [];
        return view('backend.post.favorite-list',compact('books'));
    }

    public function deleteFavorite($id)
    {
        $books = session()->get('bookmark');
        if ($books[$id]['quantity'] > 1){
            $books[$id]['quantity']--;
        }else{
            unset($books[$id]);
        }
        session()->put('bookmark',$books);
//        return view("backend.post.favorite", compact("favorites"));
        return redirect()->back();
    }



}
