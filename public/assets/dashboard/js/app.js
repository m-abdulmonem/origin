// const swal = require("sweetalert2");

$(function (){
    'use strict'
    // let spanner = `<p class="spanner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span>إنتظر....</span></p>`;
    const $html = $("html"),
        $image= $(".preview-img-area"),
        $upload = $(".upload"),
        $maxImage = parseInt($image.data("count"));
    /**
     * Set file uploaded in [img-el]
     */
    $upload.change(function(e) {
        previewImg(this, validate(this));
    });

    var files = [],
        isUpload = false;

    $html.bind('dragover drop', function(event) {
        event.preventDefault();
        event.stopPropagation();
    });

    $image.bind('dragover drop', function(event) {
        handleSelectedFile(event)
    });

    $upload.bind('change', function(event) {
        handleSelectedFile(event)
    });

    function handleSelectedFile(event){
        event.stopPropagation();
        event.preventDefault();
        if (event.type === "change" || event.type === "drop") {
            let $_files = event.target.files || event.originalEvent.dataTransfer.files;
            console.log($_files.length)
            files.push($_files);
            isUpload = true;
            if ($_files.length > 1){
                for(let i = 0; i < $_files.length; i++){
                    addThumbnail($_files[i],files)
                }
            }else {
                addThumbnail($_files[0], files);
            }
        }

    }

    function handleFormData(){

        if (files.length === 0) {
            // Handle what you want to happen if no files were in the "queue" on clicking upload
            return;
        }

        var formData = new FormData();
        $.each(files, function(key, value) {
            formData.append(key, value);
        });
        return formData;
    }

    // Added thumbnail
    function addThumbnail(data,formData){
        if ($image.hasClass("d-none")){
            $image.removeClass("d-none");
        }
        $(".preview-img-area h1").remove();
        var len = $(".preview-img-area div.thumbnail").length,
            num = len + 1,
            duplicate = false,
            name = data.name,
            item = "thumbnail_" + num,
            size = convertSize(data.size);


        //check if file is exists
        $(".thumbnail").each(function (k,v) {
            if ($(this).children(".name").text() === name){
                duplicate = true;
                Swal.fire("Warning" ,"File you select to upload is exists","warning")
                return null;
            }else{
                duplicate = false;
            }
        })
        // Creating an thumbnail
        if (! duplicate){
            $image.prepend(`<div id="${item}" class="thumbnail col-4"></div>`);
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#'+item).prepend(`<div class="image-container"><img src="${e.target.result}" class="w-100" title="${name}" alt=""><div class="overlay"></div></div>`);
            };

            reader.readAsDataURL(data);
            var el =  $('#'+item);
            el.append('<span class="size">'+size+'<span>');
            el.append('<span class="name">'+name+'<span>');
            // el.append(`<progress value="${0}" max="100" id="${item}_progress" class="progress-bar-animated w-100">${0}%</progress>`);

            // upload( formData,$(`#thumbnail_${num}_progress`))
        }
    }

    function upload(data,el){
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                     console.log(el,evt.lengthComputable);
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        el.attr("value",percentComplete).text(`${percentComplete}%`);
                        if (percentComplete ==100){
                            el.parent().find(".image-container").find(".overlay").remove()
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: "/dashboard/media/upload",
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files - I actually got this and the next from an SO post but I don't remember where
            contentType: false,
            beforeSend: function(){
                el.attr("value",0).text("0%")
            },
            error:function(){
                el.attr("value",100).text(`upload file error`);
            },
            success: function(data){
                console.log(data);
            }
        })
    }

// Bytes conversion
    function convertSize(size) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (size === 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
        return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }
})






/**
 * Preview img before upload it
 *
 * @param input
 * @param img
 */
function previewImg(input,img) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $(img).attr('src', e.target.result).show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}


/**
 * Validate Preview Image Selector
 *
 * @param selector
 * @returns {null|*|undefined|jQuery}
 */
function validate(selector) {
    return  $(selector).parent().prev().attr('id')
        ? '#' + $(selector).parent().prev().attr('id')
        : $(selector).parent().prev().attr('class')
            ? '.' + $(selector).parent().prev().attr('class')
            : '.preview-img';
}

