<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('js/app.js')) }}"></script>

<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
{{-- <script
    src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/libs/dropzone/dropzone.js">
</script> --}}

{{-- <script
    src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/js/forms-file-upload.js">
</script> --}}

{{-- <script>
    "use strict";
    ! function() {
        const e =
            '<div class="dz-preview dz-file-preview">\n<div class="dz-details">\n  <div class="dz-thumbnail">\n    <img data-dz-thumbnail>\n    <span class="dz-nopreview">No preview</span>\n    <div class="dz-success-mark"></div>\n    <div class="dz-error-mark"></div>\n    <div class="dz-error-message"><span data-dz-errormessage></span></div>\n    <div class="progress">\n      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>\n    </div>\n  </div>\n  <div class="dz-filename" data-dz-name></div>\n  <div class="dz-size" data-dz-size></div>\n</div>\n</div>',
            a = document.querySelector("#dropzone-basic");
        if (a) {
            new Dropzone(a, {
                previewTemplate: e,
                parallelUploads: 1,
                maxFilesize: 5,
                addRemoveLinks: !0,
                maxFiles: 1
            })
        }
        const s = document.querySelector("#dropzone-multi");
        if (s) {
            new Dropzone(s, {
                
                paramName: function(n) {
                    uuid = "";
                    return "file[" + uuid + "]";
                },
                hiddenInputContainer: "body",
                previewTemplate: e,
                parallelUploads: 1,
                maxFilesize: 10,
                addRemoveLinks: !0,
                acceptedFiles: 'image/jpeg,image/png,image/jpg,image/gif',
                // init: function() {
                //     this.on('error', function(file, message) {
                //         // alert(message);
                //         this.removeFile(file);
                //     });
                // }

                init: function() {
                    var myDropzone = this;

                    // Process files when the form is submitted
                    document.getElementById('dropzone-multi').addEventListener('submit', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue(); // Manually process the queue
                    });

                    // Add hidden input fields with file data
                    myDropzone.on('addedfile', function(file) {
                        // Add hidden input field with the file name
                        var fileNameField = document.createElement('input');
                        fileNameField.setAttribute('type', 'hidden');
                        fileNameField.setAttribute('name', 'images[]');
                        fileNameField.setAttribute('value', file.name);
                        document.getElementById('dropzone-multi').appendChild(fileNameField);
                    });
                }
            })
        }

        $('.dz-hidden-input').attr('name', 'files[]');
    }();
</script> --}}

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>
@yield('pagescript')
<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@include('layouts/flashMessage')

{{-- 
<script>
    console.log(toastr);
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif


    @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif


    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script> --}}
