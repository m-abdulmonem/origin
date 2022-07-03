@extends("dashboard.layouts.app")
@section("content")
    <form action="{{ route("sliders.store") }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-8">
                @csrf
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title float-left">Slider Content</h3>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Create</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="col-12">
                            <div class="form-group ">
                                <label for="title">Slider Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Slider Title" name="title" value="{{ old("title") }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                            <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="text">Slider Text</label>
                                <textarea class="form-control @error('text') is-invalid @enderror" id="text" placeholder="Slider Text" name="text" style="min-height: 125px">{{ old("text") }}</textarea>
                                @error("text")
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="actions">Slider Actions</label>
                                    <textarea class="form-control @error('actions') is-invalid @enderror" id="actions" placeholder="Slider Text" name="actions" style="min-height: 125px">{{ old("actions") }}</textarea>
                                    @error("actions")
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="html">Slider Html</label>
                                <textarea class="form-control @error('html') is-invalid @enderror" id="html" placeholder="Slider Html" name="html" style="min-height: 125px">{{ old("html") }}</textarea>
                                @error("html")
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
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
                                    <input type="radio" id="publish" name="status" value="publish" checked>
                                    <label for="publish">Publish</label>
                                </div>
                                <div>
                                    <input type="radio" id="draft" name="status" value="draft">
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
                                <img src="{{ admin_assets("AdminLTELogo.png") }}" class="preview-img img " alt="" id="logo" />
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
        <!-- ./row -->

    </form>
    <!-- /.row -->

    @push('js')
        <!-- Summernote -->
        <script src="{{ admin_assets("summernote-bs4.min.js") }}"></script>
        <script>
            $("textarea").summernote({
                height: 300
            });
        </script>
    @endpush
@endsection
