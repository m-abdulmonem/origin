<link href="{{ assets("OverlayScrollbars.min.css") }}" rel="stylesheet">
<link href="{{ assets("image-uploader.min.css") }}" rel="stylesheet">
<link href="{{ assets("app.css") }}" rel="stylesheet">


<!-- Modal -->
<div class="modal fade" id="selectMedia" tabindex="-1" role="dialog" aria-labelledby="selectMediaLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectMediaLabel">{{ __("Media") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="mediaUploader" action="#">
                <div class="modal-body">
                    <span class="count-selected"></span>
                    @csrf
                    <input type="hidden" name="model" value="@stack("model")">
                    <div class="input-images"></div>

                    <div class="uploaded-images">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Ok") }}</button>
                    <button type="submit" class="btn btn-primary">{{ __("Upload") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ assets("jquery.min.js") }}"></script>
<script src="{{ assets("jquery.overlayScrollbars.min.js") }}"></script>
<script src="{{ assets("image-uploader.min.js") }}"></script>

<script>
    $(function () {
        $('.input-images').imageUploader({
            imagesInputName: 'media',
        });


        $("#selectMedia").on('shown.bs.modal', function (e) {
            $(".uploaded-images").overlayScrollbars({
                className: "os-theme-dark",
                sizeAutoCapable: true,
                scrollbars: {
                    autoHide: "l",
                    clickScrolling: true
                }
            });
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        getImages();

        $('#mediaUploader').on('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();
            let formData = new FormData(this), form = $("mediaUploader");

            formData.append("_token", "{{ csrf_token() }}")

            $.ajax({
                type: 'POST',
                url: "{{ route("uploader.media.upload")}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    form.trigger("reset");
                    $(".image-uploader").removeClass("has-files")
                    $(".uploaded").empty();
                    Swal.fire("{{ trans("Successfully") }}", "{{ trans("File has been uploaded") }}", "success")
                    getImages();
                    console.log(data)
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });


        $(".btn-select-media").click(function () {
            $("#selectMedia").modal("show")
        })
        let ids = [];

        $(body).on("click", ".uploaded-img img", function () {
            const input = $("input[name=media_ids]"), id = $(this).data("id"), msgNode = $(".count-selected"),
                msg = "Media Selected";

            if (ids.indexOf(id) < 0) {
                $(this).addClass("selected");
                ids.push(id);
            } else {
                $(this).removeClass("selected")
                delete ids[ids.indexOf(id)]
            }
            ids = $.grep(ids, n => n === 0 || n);
            msgNode.text(ids.length > 0 ? `${ids.length} ${msg}` : "")
            input.val(ids.toString())
        })

        $(body).on("click", ".uploaded-img-tools", function () {
            const img = $(this).prev(), id = img.data("id");

            Swal.fire({
                {{--title: "{{ trans('Do you want to remove this media') }}",--}}
                title: "{{ trans("Are you sure?") }}",
                text: "{!!  trans("You won't be able to revert this!") !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: "#d33"
            }).then((result) => {
                if (result.isConfirmed) {

                    img.parent().remove();

                    $.ajax({
                        url: "/uploader/media/" + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            model: $("input[name=model]").val(),
                            id: img.data("id")
                        },
                        success: (data) => {
                            Swal.fire("{{ trans("Successfully") }}", "{{ trans("Media was deleted") }}", "success")
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                } else if (result.isDenied) {

                }
            })

        })

    });


    function getImages() {
        $.ajax({
            type: 'get',
            url: "{{ route("uploader.media.index")}}",
            success: (data) => {
                const container = $(".uploaded-images");
                container.empty()
                for (let i = 0; i < data.data.media.length; i++) {
                    const img = data.data.media[i];
                    container.append(`<div class="uploaded-img"><img src="/${img.path}" data-id="${img.id}" alt="${img.caption}" data-name="${img.name}"><div class="uploaded-img-tools"><i class="fas fa-times"></i></div></div>`)
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

</script>
