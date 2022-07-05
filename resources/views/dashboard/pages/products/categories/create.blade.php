@extends("dashboard.layouts.app")
@section("content")
    @push("css")
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("select2.min.css") }}">
    @endpush
    <form action="{{ route("categories.store") }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-8 ">
                @csrf
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title float-left">@lang("Category Details")</h3>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> @lang("Create")</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="col-12">
                                <div class="form-group ">
                                    <label for="title">@lang("Title")</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="@lang("Title")" name="title" value="{{ old("title") }}">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                <label for="link">@lang("Permalink")</label>
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="@lang("Permalink")" name="link" value="{{ old("link") }}">
                                @error('link')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-12 -->
                        <div class="col-12">
                            <div class="form-group ">
                                @php $categories = \App\Models\Product\Category\Category::all()->pluck("title","id") @endphp
                                <label for="category_id">@lang("Select Parent Category")</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">@lang("Select Parent Category")</option>
                                    {!! select_options($categories,"category_id") !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- ./col-4-->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">@lang("Description")</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="@lang("Description")" name="description" style="min-height: 125px">{{ old("description") }}</textarea>
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
            $('#category_id').select2()
            $("textarea").summernote({
                height: 300
            });

        </script>
    @endpush
@endsection
