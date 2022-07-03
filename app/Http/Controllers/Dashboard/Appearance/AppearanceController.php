<?php
//
//namespace App\Http\Controllers\Dashboard\Appearance;
//
//use App\Http\Controllers\Controller;
//use App\Http\Requests\Dashboard\Appearance\EditorRequest;
//use App\Http\Requests\Dashboard\Appearance\PagesRequest;
//use App\Http\Requests\Dashboard\Appearance\WidgetsRequest;
//use Illuminate\Http\Request;
//
//class AppearanceController extends Controller
//{
//
//    public function __construct()
//    {
//        $this->folder =$this->folderPath . ".appearance.";
//    }
//
//
//    public function showPages()
//    {
//        $data = [
//            'title' => 'Page Appearance'
//        ];
//        return view($this->folder . "pages.index",$data);
//    }
//
//    public function pagesAction(PagesRequest $request)
//    {
//
//    }
//
//    public function showWidgets()
//    {
//        $data = [
//            'title' => 'Widgets Appearance'
//        ];
//        return view($this->folder . "widgets.index",$data);
//    }
//
//    public function WidgetsAction(WidgetsRequest $request)
//    {
//
//    }
//
//    public function showEditor()
//    {
//        $data = [
//            'title' => 'Editor Appearance'
//        ];
//        return view($this->folder . "editor.index",$data);
//    }
//
//    public function EditorAction(EditorRequest $request)
//    {
//
//    }
//
//}
