<?php

namespace App\Http\Controllers\Dashboard\Appearance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Utils\MediaControllers;
use App\Http\Requests\Dashboard\Appearance\Pages\CreateRequest;
use App\Http\Requests\Dashboard\Appearance\Pages\UpdateRequest;
use App\Models\Appearance\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->permName = "pages";

        $this->middleware(['role:superAdmin']);

        $this->folder = $this->dPath . ".appearance.pages.";
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->can("read");

        $data = [
            'title' => trans('Page')
        ];
        return view($this->folder . "index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     *
     */
    public function create()
    {
        $this->can("create");

        $data = [
            'title' => trans( 'Create Page')
        ];
        return view($this->folder . "create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @param Page $page
     * @return JsonResponse
     */

    public function store(CreateRequest $request, Page $page)
    {
        $this->can("create");


        $request->merge([
            'is_reviewed' => checkbox_val_bool($request->is_reviewed),
            'has_comments' => checkbox_val_bool($request->has_comments),
            'published_at' => $request->published_at ?? now(),
            'user_id' => auth()->id(),
        ]);

        $data = $page->create($request->all());

        MediaControllers::addMedia($request,$data);

        return response()->json(['status' => 1,'data' => $data,'message' => ucfirst($request->title) . " was Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \never
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return Application|Factory|View
     */
    public function edit(Page $page)
    {
        $data = [
            'title' => 'Edit '. $page->title,
            'page' => $page,
        ];
        return view($this->folder . "update",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Page $page)
    {
        if ($request->media) {
            MediaControllers::addMedia($request,$page);
        }
        $request->merge([
            'is_reviewed' => checkbox_val_bool($request->is_reviewed),
            'has_comments' =>  checkbox_val_bool($request->has_comments),
            'published_at' => $request->published_at ?? $page->published_at,
        ]);

        $page->update($request->all());

        return response()->json(['status' => 1,'message' => trans(ucfirst($request->title) . "  was updated successfully")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function destroy(Page $page): JsonResponse
    {
        $page->delete();

        return  response()->json(['status' => 1]);
    }


    public function json(Request  $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Page::orderByDesc("id")->get())
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return "<a class='text-primary' href='".route("pages.edit",$data->id)."'>".$data->title."</a>";
                })
                ->addColumn('image', function ($data) {
                    return  "<img src='" .asset($data->featured_image). "' alt='page image' class='w-25'>";
                })
                ->addColumn('parent', function ($data) {
                    $class = $data->parent != null ? "text-info":"text-muted";
                    return "<span class='$class'>".$data->parent."</span>";
                })
                ->addColumn('status', function ($data) {
                    $class = $data->status == "publish" ? "text-cyan":"text-muted";

                    return "<span class='$class'>".$data->status."</span>";
                })
                ->addColumn('user', function ($data) {
                    return "";
//                    return "<a href='".route("users.show",$data->user->id)."' class='text-blue'>".$data->user->name."</a>";
                })
                ->addColumn('action', function($data) use ($request){
                    $route = route("pages.edit",$data->id);
                    $btn = "<a class='btn btn-primary mr-1' title='Edit Page' href='$route'><i class='fa fa-edit'></i></a>";
                    $btn .= btn_delete("pages",$data,"title");
                    return $btn;
                })
                ->rawColumns(['action','title','image','status','user','parent'])
                ->make(true);
        }//end if cond
        return abort(404);
    }
}
