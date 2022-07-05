@extends("dashboard.layouts.app")
@section("content")
    @push('css')
        <link rel="stylesheet" href="{{ admin_assets("grapes.min.css",true) }}">
        <script src="{{ admin_assets("grapes.min.js",true) }}"></script>
        <script src="{{ admin_assets("grapesjs-blocks-basic.min.js",'grapes') }}"></script>
        <script src="{{ admin_assets("grapesjs-blocks-bootstrap4.min.js",'grapes') }}"></script>
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ admin_assets("icheck-bootstrap.min.css") }}">

        <link rel="stylesheet" href="{{ admin_assets("daterangepicker.css") }}">
    @endpush
    <form action="{{ route("pages.update",$page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-10">
                <div id="gjs" style="height:1000px !important; overflow:hidden;">
                    {!! $page->content !!}
                </div>
            </div>
            <!-- /.col -->
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block mb-4">Save Page</button>
                <a href="{{ route("pages.create") }}" class="btn btn-info w-100 mb-4"><i class="fa fa-plus"></i> New Page</a>
                <button class="btn btn-danger btn-delete w-100 mb-4" type="button"
                        data-url="{{ route("pages.destroy",$page->id) }}"
                        data-name="{{  $page->name }}" data-token="{{ csrf_token() }}"
                        data-title="Are you sure to delete "
                        data-text="Delete {{ $page->title }}"
                        data-back="{{ route("pages.index") }}">
                    <a><i class="fa fa-trash"></i> Delete</a>
                </button>

                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">Page Title</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="title">Page Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Page Title" name="title" value="{{ old("title") ?? $page->title }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">Status & visibility</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="radio" id="publish" name="status" value="public" class="form-check-input" {{ old("status") == "public" || $page->status == 'public' ? 'checked': '' }} >
                                    <label for="publish" class="form-check-label">Publish</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="private" name="status" value="private" class="form-check-input" {{ old("status") == "private" || $page->status == 'private' ? 'checked': '' }}>
                                    <label for="private" class="form-check-label">Private</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="protected" name="status" value="protected" class="form-check-input" {{ old("status") == "protected" || $page->status == 'protected' ? 'checked': '' }}>
                                    <label for="protected" class="form-check-label">Protected Password</label>
                                </div>

                                <input type="text" name="password" placeholder="Protected Password" style="display: none" value="{{ old("password") ?? $page->password }}">
                                <hr>
                                <div class="form-group">
                                    <label>Publish at</label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="published_at" value="{{ old("published_at") ?? $page->published_at }}">
                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./form-group -->
                                <hr>
                                <div class="icheck-primary">
                                    <input type="checkbox" name="is_reviewed" id="is_reviewed" {{ old("is_reviewed")|| $page->is_reviewed ? 'checked' : '' }}>
                                    <label for="is_reviewed">
                                        Pending Review
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- ./col-md-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">Discussion</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="icheck-primary">
                                <input type="checkbox" name="has_comments" id="has_comments" {{ old("has_comments")|| $page->has_comments ? 'checked' : '' }}>
                                <label for="has_comments">
                                    Allow Comments
                                </label>
                            </div>
                        </div>
                        <!-- ./col-md-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">Permalink</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="permalink">URL Slug</label>
                                <input type="text" class="form-control @error('permalink') is-invalid @enderror" id="permalink" placeholder="URL Slug" name="permalink" value="{{ old("permalink") ?? $page->permalink }}">
                                @error('permalink')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <a href="{{ request()->getScheme() }}://{{ request()->getHost() }}/{{ $page->permalink }}" id="pageUrl" target="_blank">{{ request()->getScheme() }}://{{ request()->getHost() }}/{{ $page->permalink }}</a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{__("Related Service")}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group ">
                                @php $services = \App\Models\Service\Service::all()->pluck("title","id") @endphp
                                <label for="service_id">{{ __('Select Related Service') }}</label>
                                <select name="service_id" id="service_id"
                                        class="form-control @error('services') is-invalid @enderror">
                                    <option value="">{{ __('Select Related Service') }}</option>
                                    {!! select_options($services,"services",$page->service_id) !!}
                                </select>
                                @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">Featured Image</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="w-100">
                                <img src="{{ $page->featured_image? asset($page->featured_image) : admin_assets("AdminLTELogo.png") }}" class="preview-img img " alt="" id="logo" />
                                <div class="btn btn-default btn-file w-100">Slider Image
                                    <i class="fas fa-paperclip"></i>
                                    <input type="file" class="upload" name="featured_image">
                                </div>
                            </div>
                        </div>
                        <!-- ./col-md-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col-4 -->
        </div>
        <!-- ./row -->

    </form>
    <!-- /.row -->


    @push('js')
        <script src="{{ admin_assets("moment.min.js") }}"></script>
        <script src="{{ admin_assets("tempusdominus-bootstrap-4.min.js") }}"></script>
        <script type="text/javascript">
            var editor = grapesjs.init({
                showOffsets: 1,
                noticeOnUnload: 0,
                container: '#gjs',
                height: '1200px',
                fromElement: 1,
                plugins: ["gjs-blocks-basic",'grapesjs-blocks-bootstrap4'],
                pluginsOpts: {
                    // "gjs-blocks-basic": {
                    //     /* ...options */
                    // },
                    // 'grapesjs-blocks-bootstrap4': {
                    //     blocks: {
                    //         // ...
                    //     },
                    //     blockCategories: {
                    //         // ...
                    //     },
                    //     labels: {
                    //         // ...
                    //     },
                    //     // ...
                    // },
                },
                canvas: {
                    styles: [
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
                    ],
                    scripts: [
                        'https://code.jquery.com/jquery-3.3.1.slim.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
                    ],
                },
                storageManager: {
                    id: 'gjs-',             // Prefix identifier that will be used inside storing and loading
                    type: 'local',          // Type of the storage
                    autosave: true,         // Store data automatically
                    autoload: false,         // Autoload stored data on init
                    stepsBeforeSave: 0,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
                    storeComponents: true,  // Enable/Disable storing of components in JSON format
                    storeStyles: true,      // Enable/Disable storing of rules in JSON format
                    storeHtml: true,        // Enable/Disable storing of components as HTML string
                    storeCss: true,
                },
                styleManager : {
                    sectors: [{
                        name: 'General',
                        open: false,
                        buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
                    },{
                        name: 'Flex',
                        open: false,
                        buildProps: ['flex-direction', 'flex-wrap', 'justify-content', 'align-items', 'align-content', 'order', 'flex-basis', 'flex-grow', 'flex-shrink', 'align-self']
                    },{
                        name: 'Dimension',
                        open: false,
                        buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
                    },{
                        name: 'Typography',
                        open: false,
                        buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
                    },{
                        name: 'Decorations',
                        open: false,
                        buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
                    },{
                        name: 'Extra',
                        open: false,
                        buildProps: ['transition', 'perspective', 'transform'],
                    }
                    ],
                },
            });

            $("form").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                // const js= (editor.getJs() != null) ? `\<script>${editor.getJs()}<script>` : '',
                //     content = `<style>${editor.getCss()}</style> ${editor.getHtml()}`;

                formData.append("content",editor.getHtml());
                formData.append("js",editor.getJs());
                formData.append("css",editor.getCss());

                $.ajax({
                    type:'POST',
                    url: "{{ route("pages.update",$page->id) }}",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success:function(data) {
                        Swal.fire(
                            'Congratulation',
                            'Page was updated successfully',
                            'success'
                        )
                        const form =  $("form");
                        form[0].reset();
                        form.trigger("reset");

                    },
                    error: function(data, textStatus, jqXHR) {
                        const  response = data.responseJSON;
                        Swal.fire(
                            response.message,
                            response.errors['title'][0],
                            'error'
                        )
                    },
                });
            })

            $("input[name=status]").change(function () {
                const pass = $("input[name=password]");
                if($(this).val() === "protected"){
                    pass.css("display",'block')
                }else{
                    pass.css("display",'none');
                    pass.val("")
                }
            })

            //Date and time picker
            $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

            $("input[name=title]").keyup(function () {
                const scheme = "{{ request()->getScheme() }}://",
                    host = "{{ request()->getHost() }}/",
                    permalink = $(this).val().replaceAll(" ","-"), //strReplace([" ","-","/","_","@",".","#","$","!","%","^","&","*","(",")","+","="],"-", $(this).val()),
                    url = scheme + host + permalink;
                $("#permalink").val(permalink)
                $("#pageUrl").text(url).attr("href",url)
            })
        </script>
    @endpush
@endsection
