function TinyMceInit(selector, textOnly = false) {
    let lang = window.Laravel.lang,
        // uploadMethod = "/ajax/upload/file",
        uploadMethod = "/ajax/upload/file?_token=" + window.Laravel.csrfToken,
        additionalTools = '', input, progressModal, progressBar, cancelUploadBtn, progressMsgEl,
        vocabulary = {
            en: {
                uploadTitle: 'File upload',
                cancel: 'Cancel',
                fail: 'Failed to load file'
            },
            kk: {
                uploadTitle: 'Файл жүктеу',
                cancel: 'Жою',
                fail: 'Файл жүктелмеді'
            },
            ru: {
                uploadTitle: 'Загрузка файла',
                cancel: 'Отмена',
                fail: 'Не удалось загрузить файл'
            }
        },
        progressModalContent = `<div class="text-center">
                                    <h4 class="title-secondary">${vocabulary[lang].uploadTitle}</h4>
                                    <div class="progress-bar"><span></span></div>
                                    <div class="plain-text gray"></div>
                                    <a href="javascript:;" title="Отмена" class="btn">${vocabulary[lang].cancel}</a>
                                </div>`;

    if (!textOnly) {
        additionalTools = 'image media';
    }

    if (!document.querySelector('#filePicker')) {
        input = document.createElement('input');
        input.type = 'file';
        input.id = 'filePicker';
        input.style.cssText = 'position: fixed; top: -9999px; left: -9999px; z-index: -1';
        document.querySelector('body').append(input);
    } else {
        input = document.querySelector('#filePicker');
    }

    if (!document.querySelector('#progressModal')) {
        progressModal = document.createElement('div');
        progressModal.id = 'progressModal';
        progressModal.innerHTML = progressModalContent;
        progressModal.style.display = 'none';
        document.querySelector('body').append(progressModal);
    } else {
        progressModal = document.querySelector('#progressModal');
    }

    progressBar = progressModal.querySelector('.progress-bar span');
    cancelUploadBtn = progressModal.querySelector('.btn');
    progressMsgEl = progressModal.querySelector('.plain-text');
    progressMsgEl.style.display = 'none';

    tinymce.init({
        selector: selector,
        menubar: false,
        allow_script_urls: true,
        plugins: [
            'lists link ' + additionalTools + ' table paste code wordcount'
        ],
        toolbar: 'undo redo | code | formatselect | ' +
            'bold italic link ' + additionalTools + ' | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist | ' +
            'removeformat | help',
        images_upload_url: uploadMethod,
        files_upload_url: uploadMethod,
        file_picker_types: 'file image media',
        relative_urls: false,
        language: lang,
        file_picker_callback: function (callback, value, meta) {
            if (meta.filetype === 'file') {
                input.accept = '.pdf, .doc, .xls, .ppt, .docx, .xlsx, .pptx, .png, .jpg, .rar, .zip, .7z, .mp3, .mp4, .avi, .mov';
                pickerCallback(callback);
            }

            // Provide image and alt text for the image dialog
            if (meta.filetype === 'image') {
                input.accept = '.png, .jpg, .jpeg, .gif';
                pickerCallback(callback, 'image');
            }

            // Provide alternative source and posted for the media dialog
            if (meta.filetype === 'media') {
                input.accept = '.mp4, .avi, .mov';
                pickerCallback(callback, 'video');
            }
        },
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
            editor.on('Undo', function () {
                editor.save();
            });
            editor.on('Redo', function () {
                editor.save();
            });
        }
    });

    function pickerCallback(callback, fileType = null) {
        input.click();
        input.onchange = function () {
            let fd = new FormData();
            let file = input.files[0];
            fd.append('file', file);
            let ajaxUpload = $.ajax({
                xhr: function () {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            let percentComplete = ((evt.loaded / evt.total) * 100);
                            progressBar.style.width = percentComplete + '%';
                        }
                    }, false);
                    return xhr;
                },
                url: baseUrl + uploadMethod,
                type: 'POST',
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function () {
                    progressMsgEl.style.display = 'none';
                    progressBar.style.width = 0;
                    cancelUploadBtn.addEventListener('click', abortUpload);
                    $.fancybox.open({
                        src: '#' + progressModal.id,
                        touch: false,
                        smallBtn: false,
                        buttons: [],
                        clickSlide: false,
                        clickOutside: false
                    });
                },
                error: function (response) {
                    console.log(response);
                    input.value = '';
                    progressBar.style.width = 0;
                    progressMsgEl.style.display = 'block';
                    progressMsgEl.innerHTML = vocabulary[lang].fail;
                },
                success: function (response) {
                    switch (fileType) {
                        case 'video':
                            callback(baseUrl + response.content.url, {width: '100%', height: 'auto'});
                            break;
                        case 'image':
                            callback(baseUrl + response.content.url, {});
                            break;
                        default:
                            callback(baseUrl + response.location, {});
                            break;
                    }
                    input.value = '';
                    parent.jQuery.fancybox.getInstance().close();
                    cancelUploadBtn.removeEventListener('click', abortUpload);
                }
            });

            function abortUpload() {
                ajaxUpload.abort();
                input.value = '';
                $.fancybox.close();
                progressBar.style.width = 0;
                cancelUploadBtn.removeEventListener('click', abortUpload);
            }
        };
    }
}

(function () {
    /*init Tinymce*/
    if (document.querySelector('.tinymce-here')) {
        TinyMceInit('.tinymce-here');
    }
    if (document.querySelector('.tinymce-text-here')) {
        TinyMceInit('.tinymce-text-here', true);
    }
    /**/
})();
