@push("css")
<link href="{{ admin_assets("image-uploader.min.css") }}" rel="stylesheet">

@endpush
<!-- Modal -->
<div class="modal fade" id="selectMedia" tabindex="-1" role="dialog" aria-labelledby="selectMediaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectMediaLabel">{{ __("Upload Media") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" id="mediaUploader" action="#">
      <div class="modal-body">

                @csrf
                <div class="input-images"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
        <button type="submit" class="btn btn-primary">{{ __("Upload") }}</button>
      </div>
           </form>
    </div>
  </div>
</div>


@push("js")
    <script src="{{ admin_assets("image-uploader.min.js") }}"></script>

    <script>
        $(function(){
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                        type:'get',
                        url: "{{ route("dashboard.media.index")}}",
                        // data: formData,
                        // cache: false,
                        // contentType: false,
                        // processData: false,
                        success: (data) => {
                            var preloaded = [];
                            for (var i = 0; i < data.data.media.length; i++) {
                                preloaded.push({
                                    id: data.data.media[i].id,
                                    src: `/${data.data.media[i].path}`
                                })
                            }

     $('.input-images').imageUploader({
            imagesInputName:'media',
preloaded:preloaded
          });
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
          $('.input-images').imageUploader({
            imagesInputName:'media',

          });


            $('#mediaUploader').on('submit', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var formData = new FormData(this);

                    $.ajax({
                        type:'POST',
                        url: "{{ route("dashboard.media.upload")}}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            alert('File has been uploaded successfully');
                            console.log(data);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                });


        $(".btn-select-media").click(function () {
            $("#selectMedia").modal("show")
        })

        $("body").on("click",".image-uploader .uploaded-image img",function () {
            console.log($(this))
        })

        });



    </script>
@endpush
