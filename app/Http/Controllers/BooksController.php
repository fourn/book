<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use Auth;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'list']]);
    }

    public function list(){
        $categories = Category::all();
        return view('books.list', compact('categories'));
    }

    /**
     * 异步读取列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index(Request $request)
	{
	    $category_id = $request->category_id;
		$books = Book::ofSchool()
            ->forUser()
            ->when($category_id, function ($query) use ($category_id){
		        return $query->where('category_id', $category_id);
            })
            ->orderBy(
            $request->input('orderBy', 'updated_at'),
            $request->input('orderType', 'desc')
        )->paginate(6);
		return view('books.index', compact('books'));
	}

	public function my(Request $request){
        $user = Auth::user();
        $mybooks = $user->books()
            ->when($request->status, function ($query) use ($request){
                return $query->where('status', $request->status);
            })
            ->orderBy('created_at', 'desc')->get();
        $statuses = config('custom.book.status');
        return view('books.my', compact('statuses', 'mybooks'));
    }

    /**
     * 书本首页
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Book $book)
    {
        $user = $book->user;
        return view('books.show', compact('book', 'user'));
    }

	public function create(Book $book)
	{
	    $categories = Category::all();
	    $useds = config('custom.book.used');
		return view('books.create_and_edit', compact( 'book', 'categories', 'useds'));
	}

	public function uploadImage(Request $request, ImageUploadHandler $uploader){
        $data = [
            'code'=>0,
            'msg'=>'上传失败！',
            'file_path'=>'',
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($request->has('base_image')) {
            // 保存图片到本地
            $result = $uploader->saveBase($request->base_image, 'books', \Auth::id());
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "上传成功!";
                $data['code'] = 1;
            }
        }
        return $data;
    }

	public function store(BookRequest $request, Book $book)
	{
		$book->fill($request->all());
		$book->user_id = Auth::id();
		$book->school_id = session('school_id');
		$book->is_show = 1;//默认上架
		$book->save();
		return redirect()->route('books.show_self', $book->id)->with('message', '发布成功！请注意审核通知');
	}

	public function showSelf(Book $book){
        if($book->status == 3){
            session()->flash('danger', $book->admin_note);
        }
        return view('books.show_self', compact('book'));
    }

	public function edit(Book $book)
	{
        try {
            $this->authorize('update', $book);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有访问权限');
            return redirect()->to(route('index'));
        }
        $categories = Category::all();
        $useds = config('custom.book.used');
		return view('books.create_and_edit', compact('book', 'categories', 'useds'));
	}

	public function update(BookRequest $request, Book $book)
	{
        try {
            $this->authorize('update', $book);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有访问权限');
            return redirect()->to(route('index'));
        }
        $book->fill($request->all());
		$book->status = 1;
		$book->save();
		return redirect()->route('books.show_self', $book->id)->with('message', '编辑成功！请注意审核通知');
	}

	public function photo_clip(){
        return view('books.photo_clip');
    }

	public function toggleShow(Request $request){
        $id = $request->id;
        $book = Book::find($id);
        $this->authorize('toggleShow', $book);
        if($book->is_show == 1){
            $book->is_show = 2;
        }else{
            $book->is_show = 1;
        }
        $book->save();
        return ['status'=>1];
    }

	public function destroy(Book $book)
	{
        try {
            $this->authorize('destroy', $book);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有访问权限');
            return redirect()->to(route('index'));
        }
        $book->delete();
		return redirect()->route('books.my')->with('message', '删除成功！');
	}
}