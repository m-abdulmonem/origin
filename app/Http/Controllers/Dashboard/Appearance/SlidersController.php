<?php

namespace App\Http\Controllers\Dashboard\Appearance;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Dashboard\Appearance\Slider\CreateSliderRequest;

//use App\Http\Requests\Dashboard\Appearance\Slider\UpdateSliderRequest;
//use App\Models\Dashboard\Appearance\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


class SlidersController extends Controller
{



    public function __construct()
    {
       $this->folder = $this->dPath . ".appearance.slider.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $data = [
            'title' => 'Sliders'
        ];
        return view($this->folder . "index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        $data = [
            'title' => 'Create Slider'
        ];
        return view($this->folder . "create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSliderRequest $request
     * @param Slider $slider
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request, Slider $slider)
    {
        if ($request->title != null || $request->html != null) {
            $image = file_upload($request->image,'slider');
            $data = $slider->create($request->all());
            $data->image = $image;
            $data->save();
        }
        return redirect(route("sliders.index"))
            ->with("success","Slider was created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return never
     */
    public function show($id):never
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(Slider $slider):View
    {
        $data = [
            'title' => 'Edit '. $slider->title,
            'slider' => $slider,
        ];
        return view($this->folder . "update",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSliderRequest $request
     * @param Slider $slider
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateSliderRequest $request, SLider $slider)
    {
        if ($request->image) {
            $image = file_upload($request->image,'slider');
            $slider->image = $image;
            $slider->save();
        }

        if ($request->title != null || $request->html != null) {
            $slider->update($request->all());
        }

        return redirect(route("sliders.index"))
            ->with("success","Slider was created successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return JsonResponse
     */
    public function destroy(Slider $slider): JsonResponse
    {
        $slider->delete();

        return  response()->json(['status' => 1]);
    }


    public function jsonIndex(Request  $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Slider::all())
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    return "<img src='" . asset($data->image) . "' alt='Slider image' class='slider-image-thumbnail w-100'>";
                })
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('text', function ($data) {
                    return substr($data->text,0,60);
                })
                ->addColumn('status', function ($data) {
                    return  $data->status == "publish" ? '<p class="text-success">Published</p>' : '<p class="text-secondary">Draft</p>';
                })
                ->addColumn('buttons', function ($data) {
                    return  $data->actions != null ? '<p class="text-primary">Have Action Buttons</p>' : '-';
                })
                ->addColumn('html', function ($data) {
                    return  $data->actions != null ? '<p class="text-cyan">Custom HTML code</p>' : '-';
                })
                ->addColumn('action', function($data) use ($request){
                    $route = route("sliders.edit",$data->id);
                    $btn = "<a class='btn btn-primary mr-1' title='Edit Slider' href='$route'><i class='fa fa-edit'></i></a>";
                    $btn .= btn_delete("sliders",$data,"title");
                    return $btn;
                })
                ->rawColumns(['action','image','buttons','html','text','status'])
                ->make(true);
        }//end if cond
        return abort(404);
    }
}
