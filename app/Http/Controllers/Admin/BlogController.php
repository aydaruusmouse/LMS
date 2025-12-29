<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use App\Repositories\LanguageRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(BlogRepository $blog)
    {
        $this->blog = $blog;
    }

    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.blog.index');
    }

    public function create(BlogCategoryRepository $blogCategory): View|Factory|RedirectResponse|Application
    {
        try {
            $data = [
                'categories' => $blogCategory->activeCategories(),
            ];

            return view('backend.admin.blog.create', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(Request $request): JsonResponse
    {

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'title'             => 'required',
            'blog_category_id'  => 'required',
            'status'            => 'required',
            'short_description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $this->blog->store($request->all());

            Toastr::success(__('create_successful'));

            DB::commit();

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('blogs.index'),
            ]);

        } catch (\Exception $e) {
            //            dd($e);
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id, Request $request, LanguageRepository $language, BlogCategoryRepository $blogCategory): View|Factory|RedirectResponse|Application
    {

        try {
            $lang = $request->lang ?? app()->getLocale();
            $data = [
                'languages'     => $language->all(),
                'categories'    => $blogCategory->activeCategories(),
                'lang'          => $lang,
                'blog'          => $this->blog->find($id),
                'blog_language' => $this->blog->getByLang($id, $lang),
            ];

            return view('backend.admin.blog.edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id)
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'title'            => 'required|unique:blogs,title,'.$id,
            'slug'             => 'required|unique:blogs,slug,'.$id,
            'blog_category_id' => 'required',
            'status'           => 'required',
        ]);
        DB::beginTransaction();
        try {
            $this->blog->update($request->all(), $id);
            Toastr::success(__('update_successful'));
            DB::commit();

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('blogs.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->blog->destroy($id);
            Toastr::success(__('delete_successful'));
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }

    public function filterBlog(Request $request)
    {
        //        dd($request->all());
        try {
            $blogs = Blog::withCount('comments')->where('status', 'published')->with('user')
                ->when($request->categories, function ($query) use ($request) {
                    $query->whereIn('blog_category_id', $request->categories);
                })
                ->when($request->all_blog == '1', function ($query) {
                    $query->orderBy('title', 'asc');
                })
                ->paginate(setting('paginate'));
            $data  = [
                'html'    => view('frontend.blogs.category_component', compact('blogs'))->render(),
                'success' => true,
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
            ];

            return response()->json($data);
        }
    }

    public function showAllBlog(Request $request)
    {
        try {
            $blogs                = Blog::withCount('comments')->where('status', 'published')->with('user')->latest()->paginate(setting('paginate'));
            if ($blogs->previousPageUrl()) {
                $input['total_results'] = $request->page * $blogs->perPage();
            }

            if ($blogs->onFirstPage()) {
                $input['total_results'] = $blogs->count();
            }
            $input['total_blogs'] = $blogs->total();
            if (request()->ajax()) {
                return response()->json($this->ajaxFilter($blogs, $input));
            }
            $data                 = [
                'blogs'           => $blogs,
                'featured_blogs'  => Blog::withCount('comments')->where('status', 'published')->with('user')->where('is_featured', 1)->latest()->paginate(setting('paginate')),
                'blog_categories' => BlogCategory::where('status', '1')->latest()->get(),
                'total_posts'     => Blog::where('status', 'published')->count(),
            ];

            return view('frontend.blogs.blog', $data);
        } catch (\Exception $e) {
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    public function showAllBlogFeature(Request $request)
    {
        try {
            $blogs                = Blog::where('status', 'published')->with('user')->where('is_featured', 1)->latest()->paginate(setting('paginate'));
            if ($blogs->previousPageUrl()) {
                $input['total_results'] = $request->page * $blogs->perPage();
            }

            if ($blogs->onFirstPage()) {
                $input['total_results'] = $blogs->count();
            }
            $input['total_blogs'] = $blogs->total();
            if (request()->ajax()) {
                return response()->json($this->ajaxFilter($blogs, $input, true));
            }
            $data                 = [
                'blogs'           => $blogs,
                'featured_blogs'  => Blog::withCount('comments')->where('status', 'published')->with('user')->where('is_featured', 1)->latest()->paginate(setting('paginate')),
                'blog_categories' => BlogCategory::where('status', '1')->latest()->get(),
                'total_posts'     => Blog::where('status', 'published')->count(),
            ];

            return view('frontend.blogs.blog', $data);
        } catch (\Exception $e) {
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    public function blogDetails($slug): View|Factory|RedirectResponse|Application
    {
        try {
            $blog = Blog::withCount('comments')->where('slug', $slug)->where('status', 'published')->with('user')->first();
            $data = [
                'blog'           => $blog,
                'blogs'          => Blog::withCount('comments')->where('status', 'published')->with('user')->latest()->take(3)->get(),
                'featured_blogs' => Blog::withCount('comments')->where('status', 'published')->with('user')->where('is_featured', 1)->latest()->take(3)->get(),
                'comment'        => $this->blog->isCommented([
                    'user_id' => auth()->id(),
                    'blog_id' => $blog->id,
                ]),
            ];

            return view('frontend.blogs.blog_details', $data);
        } catch (\Exception $e) {
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    protected function ajaxFilter($blogs, $input, $is_featured = false): array
    {
        try {
            $blog_view = '';
            foreach ($blogs as $key => $blog) {
                $vars = [
                    'blog' => $blog,
                    'key'  => $key,
                ];
                if ($is_featured) {
                    $blog_view .= view('frontend.blogs.featured_blog_load_more', $vars)->render();
                } else {
                    $blog_view .= view('frontend.blogs.blog_load_more', $vars)->render();

                }
            }

            return [
                'blogs'     => $blog_view,
                'next_page' => $blogs->nextPageUrl(),
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function comment(Request $request): JsonResponse
    {
        $request->validate([
            'comment' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);
        try {
            $this->blog->comment([
                'comment' => $request->comment,
                'user_id' => auth()->id(),
                'blog_id' => $request->blog_id,
            ]);

            return response()->json([
                'success'      => __('commented_successfully'),
                'get_comments' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function comments($id, Request $request): JsonResponse
    {
        try {
            $data = [
                'comments' => $this->blog->comments($id, ['user']),
            ];

            return response()->json([
                'success' => __('comment_fetched_successfully'),
                'html'    => view('frontend.blogs.comments', $data)->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function reply(Request $request): JsonResponse
    {
        $request->validate([
            'reply'           => 'required',
            'blog_id'         => 'required|exists:blogs,id',
            'blog_comment_id' => 'required|exists:blog_comments,id',
        ]);
        try {
            $this->blog->reply([
                'reply'           => $request->reply,
                'user_id'         => auth()->id(),
                'blog_id'         => $request->blog_id,
                'blog_comment_id' => $request->blog_comment_id,
            ]);

            $replies = $this->blog->commentReplies($request->blog_comment_id, ['user']);

            return response()->json([
                'success' => __('replied_successfully'),
                'html'    => view('frontend.blogs.replies', compact('replies'))->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function replies(Request $request): JsonResponse
    {
        try {
            $replies = $this->blog->commentReplies($request->comment_id, ['user']);

            return response()->json([
                'success' => true,
                'html'    => view('frontend.blogs.replies', compact('replies'))->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
