@extends("dashboard.layouts.app")
@section("content")
        <form action="{{ route("sliders.update",$slider->id) }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8">
                    @csrf
                    @method("PUT")
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title ">Slider content</h3>
                            <button class="btn btn-danger btn-delete float-right" type="button"
                                    data-url="{{ route("sliders.destroy",$slider->id) }}"
                                    data-name="{{  $slider->name }}" data-token="{{ csrf_token() }}"
                                    data-title="Are you sure to delete "
                                    data-text="Delete {{ $slider->title }}"
                                    data-back="{{ route("sliders.index") }}">
                                <a><i class="fa fa-trash"></i> Delete</a>
                            </button>
                            <a href="{{ route("sliders.create") }}" class="btn btn-info float-right ml-1 mr-1"><i class="fa fa-plus"></i> New Slider</a>
                            <button type="submit" class="btn btn-primary float-right "><i class="fa fa-save"></i> Save</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group ">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title" name="title" value="{{ old("title") ? old("title") : $slider->title }}">
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- ./row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="text">Text</label>
                                        <textarea class="form-control @error('text') is-invalid @enderror" id="text" placeholder="Text" name="text" style="min-height: 125px">{{ old("text") ? old("text") : $slider->text }}</textarea>
                                        @error("text")
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ./col-12 -->
                            </div>
                            <!-- ./row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="actions">Actions</label>
                                        <textarea class="form-control @error('actions') is-invalid @enderror" id="actions" placeholder="Actions" name="actions" style="min-height: 125px">{{ old("actions") ? old("actions") : $slider->actions }}</textarea>
                                        @error("actions")
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ./col-12 -->
                            </div>
                            <!-- ./row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="text">html</label>
                                        <textarea class="form-control @error('html') is-invalid @enderror" id="html" placeholder="html" name="html" style="min-height: 125px">{{ old("html") ? old("html") : $slider->html }}</textarea>
                                        @error("html")
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ./col-12 -->
                            </div>
                            <!-- ./row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="title-header">Slider Status</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div>
                                        <input type="radio" id="publish" name="status" value="publish" {{ $slider->status == "publish" ?  "checked" : "" }} >
                                        <label for="publish">Publish</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="draft" name="status" value="draft" {{ $slider->status == "draft" ?  "checked" : "" }}>
                                        <label for="draft">Draft</label>
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
                            <h3 class="title-header">Slider Image</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="w-100">
                                    <img src="{{ asset($slider->image) }}" class="preview-img img " alt="" id="logo" />
                                    <div class="btn btn-default btn-file w-100">Slider Image
                                        <i class="fas fa-paperclip"></i>
                                        <input type="file" value="{{ old('image') }}" class="upload" name="image">
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
            <!-- /.row -->
        </form>
    @push('js')
        <!-- Summernote -->
        <script src="{{ admin_assets("summernote-bs4.min.js") }}"></script>
        <script>
            $("textarea").summernote({
                height: "300px"
            });
        </script>
    @endpush
@endsection
