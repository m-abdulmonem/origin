<?php

namespace App\Http\Controllers\Dashboard\Appearance;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditorController extends Controller
{


    public function __construct()
    {
        $this->folder =  $this->dPath . ".appearance.editor.";
    }

    public function showEditor()
    {
        $data = [
            'title' => 'Template Editor',
            'extensions' => ['.','blade','php','css' ,'js','min','png','gif','jpg','svg','jpeg'],
            'files' => $this->templateFiles(),
        ];

        return view($this->folder. "index",$data);
    }

    public function editorAction(Request $request)
    {
        if (is_file($request->path) && file_exists($request->path)) {
            $file = fopen($request->path, "w+");
            fwrite($file,$request->code);
            fclose($file);
            return response()->json(['message' => 'code was saved successfully','status' => 1]);
        }else {
            return response()->json(['data' => 'open file error', 'status' => 0]);
        }
    }

    public function openFile(Request $request): JsonResponse
    {
        if (is_file($request->path) && file_exists($request->path)) {
            $file = fopen($request->path, "r+");
            $open = fread($file,filesize($request->path));
            fclose($file);
            return response()->json(['data' => $open,'status' => 1]);
        }else {
            return response()->json(['data' => 'open file error', 'status' => 0]);
        }
    }


    public function create(Request $request)
    {
        $name = $request->path . "/" . $request->name;
        switch ($request->type){
            case "folder":
                $dir = mkdir($name,0777,true);
                return $this->file_created_message("folder",null,$name,+$dir);
            case "file" :
                if (!str_contains($request->name,".")) {
                    if (str_contains($request->path, 'views') ) {
                        $file= $this->read_file($name,"blade.php",$request);
                        return $this->file_created_message("template file",$file,$name);
                    }else if (str_contains($request->path, 'css') ) {
                        $file= $this->read_file($name,"css",$request);
                        return $this->file_created_message("style file",$file,$name);
                    }else if (str_contains($request->path, 'js') ) {
                        $file= $this->read_file($name,"js",$request);
                        return $this->file_created_message("script file",$file,$name);
                    }
                }else {
                    $file= $this->read_file($name,"",$request);
                    return $this->file_created_message("file",$file,$name);
                }
        }
    }

    public function delete(Request $request): JsonResponse
    {
        $this->validate($request,[
            'path' => 'required'
        ]);
        if (is_dir($request->path)) {
            $type = "folder";
            delete_dir($request->path);
        }else {
            $type = 'file';
            unlink($request->path);
        }
        return response()->json(['status' => 1, 'message' => ucfirst($type) . ' Was deleted successfully']);
    }

    private function file_created_message($name,$data,$path,$status = 1): JsonResponse
    {
        return response()->json(['status' => $status, 'message' => ucfirst($name) . " was created successfully",'data' => $data,'path' => $path]);
    }


    private function read_file($name,$extension,$request,$isHtml = false)
    {
        $file = fopen("$name.$extension", "w+");
        $file_content = "/** file name : ".$request->name.".$extension  */";
        $file_content .= "/**  Write some ".strtoupper($extension)." code here.... */";
        $file_content .= "/** file path : " .$request->path. "  */";
        if ($isHtml) {
            fwrite($file, "<h1>file name: <b>$name.blade.php</b></h1><h4> Write some HTML code here.... </h4> <p>" . $request->path . "</p>");
        }else {
            fwrite($file,$file_content);

        }
        $open = fread($file,filesize("$name.$extension"));
        fclose($file);
        return $open;
    }

    private function templateFiles() : array
    {
        $public_path = "assets/frontend/";

        return  [
            'folders' => [
                resource_path() . "/views/frontend",
                expandDirectoriesMatrix(resource_path() . "/views/frontend"),
            ],
            'styles' =>  [
                "$public_path/css",
                expandDirectoriesMatrix(realpath("$public_path/css/"),0,true)
            ],
            'scripts' =>  [
                "$public_path/js",
                expandDirectoriesMatrix(realpath("$public_path/js/"),0,true)
            ],
        ];
    }

}
