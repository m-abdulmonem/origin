@extends("dashboard.layouts.app")
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ admin_assets("lib/codemirror.css",'code_miror',true) }}">
        <link rel="stylesheet" href="{{ admin_assets("addon/hint/show-hint.css",'code_miror',true) }}">
        <link rel="stylesheet" href="{{ admin_assets("addon/fold/foldgutter.css",'code_miror',true) }}">
        <script src="{{ admin_assets("lib/codemirror.js",'code_miror',true) }}"></script>
{{--        <script src="{{ admin_assets("line/highlight.js",'code_miror',true) }}"></script>--}}
        <script src="{{ admin_assets("mods/xml/xml.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("mods/javascript/javascript.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("mods/css/css.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("mods/htmlmixed/htmlmixed.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("mods/php/php.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/mode/multiplex.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/hint/anyword-hint.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/hint/css-hint.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/hint/html-hint.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/hint/javascript-hint.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/hint/show-hint.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/hint/xml-hint.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/fold/foldcode.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/fold/comment-fold.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/fold/brace-fold.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/edit/closebrackets.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/edit/closetag.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/edit/continuelist.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/edit/matchbrackets.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/edit/matchtags.js",'code_miror',true) }}"></script>
        <script src="{{ admin_assets("addon/edit/trailingspace.js",'code_miror',true) }}"></script>
    @endpush
    <div class="row">
        <div class="col-8">
            <form action="{{ route("dashboard.appearance.editor.action") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea name="content" id="codeMirror" class="h-100"></textarea>
            </form>
        </div>
        <div class="col-4">
            <style>
                .CodeMirror{
                    height: 1600px;
                }
                .folder.active i.fa-minus,
                .folder:hover i.fa-minus,
                .file:hover i.fa-minus,
                .file.text-primary i.fa-minus{
                    color: #dc3545!important;
                    transition:  0.4s ease-in-out all;
                }
                .folder.active i.fa-plus,
                .folder:hover i.fa-plus,
                .file:hover i.fa-plus,
                .file.text-primary i.fa-plus{
                    color: #17a2b8!important;
                    transition:  0.4s ease-in-out all;
                }
                .active{
                    transition: 0.4s all ease-in-out;
                }
                .file-card span{
                    cursor: pointer;
                }
            </style>

            <button class="btn btn-primary mb-2 w-100" id="saveCode"><i class="fa fa-save"></i> Save code</button>

            @foreach($files as $name => $data)
                <div class="card collapsed-card">
                    <div class="card-header">
                        <div class="card-title">{{ ucfirst($name) }} Files</div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-add-file" data-path="{{ $data[0] }}">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-content">
                        @foreach($data[1] as $folder)
                            {!! file_tree($folder) !!}
                        @endforeach
                    </div>
                    <!-- .card-content -->
                </div>
                <!-- .card -->
            @endforeach
        </div>
        <!-- ./col-4 -->
    </div>
    <!-- ./row -->

    @push("js")
        <script>
            const save = $("#saveCode"), body = $("body");
            if (!Array.prototype.last){
                Array.prototype.last = function(){
                    return this[this.length - 1];
                };
            }

            var editor = CodeMirror.fromTextArea(document.getElementById("codeMirror"), {
                lineNumbers: true,
                value: "function myScript(){return 100;}\n",
                mode: "javascript",
                autofocus: true,
                autocomplete: true,
                autocorrect: true,
                tabMode: "indent",
                matchBrackets: true,
                searchMode: 'inline',
                hint: 'html'
            });

            $(".btn-delete-file").click(function () {
                const el = $(this).parent(),
                    path = el.data("path"),
                    name = path.split("\\").last(),
                    type = name.includes(".") ? "file" : "folder"
                editor.getDoc().setValue(`Deleting ${type} ${name}`)
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:'DELETE',
                            url: "{{ route("dashboard.appearance.editor.delete") }}",
                            contentType: "application/json",
                            processData: false,
                            data: JSON.stringify({
                                path: path,
                                _method:"DELETE"
                            }),
                            headers: {
                                'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                            },
                            success:function(data) {
                                if(data.status === 1){
                                    Swal.fire(
                                        'Deleted!',
                                        `Your ${type} ${name} has been deleted.`,
                                        'success'
                                    )
                                }
                            },
                        });
                    }
                })

            })
            $(".btn-add-file").on("click dblclick",function (){
                $(".name-input").remove();
                inputLocation(this)
            })

            $(".folder").click(function (){
                $(".folder").removeClass("text-primary active")
                $(this).toggleClass("text-primary active")
            })
            $(".file").click(function (){
                $(".file").removeClass("text-primary")
                $(this).toggleClass("text-primary");
                const path = $(this).data("path");
                editor.getDoc().setValue(`loading file ${$(this).text()}`)
                $.ajax({
                    type:'GET',
                    url: "{{ route("dashboard.appearance.editor.open.file") }}?path=" + path,
                    contentType: false,
                    processData: false,
                    success:function(data) {
                        save.attr("data-path",path)
                        editor.getDoc().setValue(data.data)
                    },
                });

                editor.setOption("mode",modes(path.split(".").last()))
            })

            save.click(function (){
                const path = $(this).data("path");
                $.ajax({
                    type:'PUT',
                    url: "{{ route("dashboard.appearance.editor.action") }}",
                    contentType: "application/json",
                    processData: false,
                    data: JSON.stringify({
                        code : editor.getValue(),
                        path: path,
                    }),
                    headers: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    success:function(data) {
                        if(data.status === 1){
                            Swal.fire('Success', data.message, 'success')
                        }
                    },
                });
            })

            function createFile(path,type,name){
                editor.getDoc().setValue(`creating ${type} ${name}`)
                $.ajax({
                    type:'POST',
                    url: "{{ route("dashboard.appearance.editor.create") }}",
                    contentType: "application/json",
                    processData: false,
                    data: JSON.stringify({
                        path: path,
                        type: type,
                        name : name,
                        _token: "{{ csrf_token() }}"
                    }),
                    headers: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    success:function(data) {
                        if(data.status === 1){
                            editor.getDoc().setValue(data.data)
                            Swal.fire('Success', data.message, 'success')
                            $(".name-input").remove();
                        }
                    },
                });
            }

            body.on("click",'.file-type a',function (){
                $(this).parent().parent().parent().find(".btn-create").attr("data-type",$(this).data("type"))
            })
            body.on("keyup",'input[name=name]',function (){
                $(this).parent().find(".btn-create").attr("data-name",$(this).val())
            })
            body.on("click",'.btn-create',function (){
                createFile($(this).data("path"),$(this).data("type"),$(this).data("name"))
            })

            function inputLocation($this){
                const el =  $($this).parent().parent().next(".expandable-body").find("td:first");
                el.prepend(typeInput($($this).parent().data("path")))
            }
            function typeInput(path){
                return `
                     <div class="input-group mb-3 name-input">
                        <div class="input-group-prepend show">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            Type
                            </button>
                            <div class="dropdown-menu show file-type" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" data-type='file'>File</a>
                                <a class="dropdown-item" data-type='folder'>Folder</a>
                            </div>
                        </div>
                        <input name='name' class='form-control p-2 rounded-0' placeholder='File name'/>
                        <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat btn-create" data-path='${path}' data-type='file'>Create</button>
                        </span>
                    </div>
                    `
            }
            function modes($extension){
                if($extension === "js"){
                    CodeMirror.hint.javascript;
                    return "javascript";
                }else if($extension === "php"){
                    CodeMirror.hint.xml;
                    return "htmlmixed";
                }
                CodeMirror.hint.css;
                return  $extension;
            }
        </script>
    @endpush
@endsection
