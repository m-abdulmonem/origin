@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("select2.min.css") }}">
    @endpush
    <form action="{{ route("dashboard.appearance.menus.store") }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-8 ">
                @csrf
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title float-left">Menu Content</h3>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Create</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="col-12">
                                <div class="form-group ">
                                    <label for="title">Menu Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Menu Title" name="title" value="{{ old("title") }}">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="link">Menu Link</label>
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Menu Link" name="link" value="{{ old("link") }}">
                                @error('link')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                @php $menus = \App\Models\Appearance\Menus::all()->pluck("title","id") @endphp
                                <label for="parent">Select Parent Menu</label>
                                <select name="parent" id="parent" class="form-control @error('parent') is-invalid @enderror">
                                    <option value="">Select Parent Menu</option>
                                    {{ select_options($menus,"parent") }}
                                </select>
                                @error('parent')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-4-->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Menu Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Menu Description" name="description" style="min-height: 125px">{{ old("description") }}</textarea>
                                    @error("description")
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
        </div>
        <!-- ./row -->

    </form>
    <!-- /.row -->

    @push('js')
        <!-- Summernote -->
        <script src="{{ admin_assets("summernote-bs4.min.js") }}"></script>
        <script src="{{ admin_assets("select2.full.min.js") }}"></script>
        <!-- Select2 -->
        <script>
            $("textarea").summernote({
                height: 300
            });

        </script>
    @endpush
@endsection
