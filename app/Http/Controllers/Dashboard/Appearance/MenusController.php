<?php
//
//namespace App\Http\Controllers\Dashboard\Appearance;
//
//use App\Http\Controllers\Controller;
//use App\Http\Requests\Dashboard\Appearance\Menus\CreateMenuRequest;
//use App\Http\Requests\Dashboard\Appearance\Menus\UpdateMenuRequest;
//use App\Models\Dashboard\Appearance\Menus;
//use Illuminate\Contracts\Foundation\Application;
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
//use Illuminate\Routing\Redirector;
//use Illuminate\Support\Facades\View;
//
//class MenusController extends Controller
//{
//
//    public function __construct()
//    {
//        $this->folder = $this->folderPath . ".appearance.menus.";
//    }
//
//    /**
//     * Display a listing of the resource.
//     *
//     * @return Application|Factory|\Illuminate\Contracts\View\View
//     */
//    public function index()
//    {
//        $data = [
//            'title' => 'Menus'
//        ];
//        return view($this->folder . "index",$data);
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return Application|Factory|\Illuminate\Contracts\View\View
//     */
//    public function create()
//    {
//        $data = [
//            'title' => 'Create Menu'
//        ];
//        return view($this->folder . "create",$data);
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param CreateMenuRequest $request
//     * @param Menus $menu
//     * @return Application|RedirectResponse|Redirector
//     */
//    public function store(CreateMenuRequest $request, Menus $menu)
//    {
//        $menu->create($request->all());
//
//        return redirect(route("menus.index"))
//            ->with("success","Menus was created successfully");
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return Response
//     */
//    public function show($id)
//    {
//        return abort(404);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param Menus $menu
//     * @return Application|Factory|\Illuminate\Contracts\View\View
//     */
//    public function edit(Menus $menu)
//    {
//        $data = [
//            'title' => 'Edit '. $menu->title,
//            'menu' => $menu,
//        ];
//        return view($this->folder . "update",$data);
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param UpdateMenuRequest $request
//     * @param Menus $menus
//     * @return Application|Redirector|RedirectResponse
//     */
//    public function update(UpdateMenuRequest $request, Menus $menu)
//    {
//        $menu->update($request->all());
//
//        return redirect(route("menus.index"))
//            ->with("success","Slider was updated successfully");
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param Menus $menu
//     * @return JsonResponse
//     */
//    public function destroy(Menus $menu) : JsonResponse
//    {
//        $menu->delete();
//
//        return  response()->json(['status' => 1]);
//    }
//
//
//    public function jsonIndex(Request  $request)
//    {
//        if ($request->ajax()) {
//            return datatables()->of(Menus::all())
//                ->addIndexColumn()
//                ->addColumn('title', function ($data) {
//                    return $data->title;
//                })
//                ->addColumn('submenu', function ($data) {
//                    return  $data->parent != null ? '<p class="text-primary">Submenu</p>' : '-';
//                })
//                ->addColumn('link', function ($data) {
//                    return $data->link;
//                })
//                ->addColumn('description', function ($data) {
//                    return substr($data->description,0,60);
//                })
//                ->addColumn('action', function($data) use ($request){
//                    $route = route("menus.edit",$data->id);
//                    $btn = "<a class='btn btn-primary mr-1' title='Edit Slider' href='$route'><i class='fa fa-edit'></i></a>";
//                    $btn .= btn_delete("menus",$data,"title");
//                    return $btn;
//                })
//                ->rawColumns(['action','submenu'])
//                ->make(true);
//        }//end if cond
//        return abort(404);
//    }
//}
