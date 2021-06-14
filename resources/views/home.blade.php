@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>Images</div>
                            <div>
                                <form class="form-inline">
                                    <select class="form-control">
                                        <option>Oldest</option>
                                        <option>Latest</option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        {{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">Personal</a>
                                    <a href="#" class="list-group-item list-group-item-action">Friends</a>
                                    <a href="#" class="list-group-item list-group-item-action">Family</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($errors->any())
                                            @foreach($errors->all() as $error)
                                                <div class="alert alert-danger">
                                                    <strong>Error!</strong>{{$error}}
                                                </div>
                                            @endforeach
                                        @endif
                                        <button class="btn btn-success" data-toggle="collapse"
                                                data-target="#demo">Add
                                            Image
                                        </button>

                                        <div id="demo" class="collapse">
                                            <form action="{{route('image-store')}}" method="post"
                                                  id="image_upload_form"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="caption">Image Caption</label>
                                                    <input type="text" name="caption" class="form-control"
                                                           placeholder="Enter Caption"
                                                           id="caption">
                                                </div>
                                                <div class="form-group">
                                                    <label for="category">Select Category:</label>
                                                    <select name="category" class="form-control" id="category">
                                                        <option value="">Select a category</option>
                                                        <option value="personal">Personal</option>
                                                        <option value="friends">Friends</option>
                                                        <option value="family">Family</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Upload Image</label>
                                                    <div class="preview-zone hidden">
                                                        <div class="box box-solid">
                                                            <div class="box-header with-border">
                                                                <div><b>Preview</b></div>
                                                                <div class="box-tools pull-right">
                                                                    <button type="button"
                                                                            class="btn btn-danger btn-xs remove-preview">
                                                                        <i class="fa fa-times"></i> Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body"></div>
                                                        </div>
                                                    </div>
                                                    <div class="dropzone-wrapper">
                                                        <div class="dropzone-desc">
                                                            <i class="glyphicon glyphicon-download-alt"></i>
                                                            <p>Choose an image file or drag it here.</p>
                                                        </div>
                                                        <input type="file" name="image" class="dropzone">
                                                    </div>
                                                    <div id="image_error"></div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="row">
                                            <div class="col-md-3 mb-4">
                                                <a href="#">
                                                    <img src="https://via.placeholder.com/150/0000FF/808080 ?Text=Digital.com
C/O https://placeholder.com/" height="100%" width="100%">
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <a href="#">
                                                    <img src="https://via.placeholder.com/150/0000FF/808080 ?Text=Digital.com
C/O https://placeholder.com/" height="100%" width="100%">
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <a href="#">
                                                    <img src="https://via.placeholder.com/150/0000FF/808080 ?Text=Digital.com
C/O https://placeholder.com/" height="100%" width="100%">
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <a href="#">
                                                    <img src="https://via.placeholder.com/150/0000FF/808080 ?Text=Digital.com

C/O https://placeholder.com/" height="100%" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $("#image_upload_form").validate({
            rules: {
                caption: {
                    required: true,
                    maxlength: 255
                },
                category: {
                    required: true,
                },
                image: {
                    required: true,
                    extension: "png|jpeg|jpg|bmp"
                }
            },
            messages: {
                caption: {
                    required: "Please enter an image caption",
                    maxlength: "Max. 255 characters allowed."
                },
                category: {
                    required: "Please select a category.",
                },
                image: {
                    required: "Please upload an image.",
                    extension: "Only jpeg, jpg, png, bmp allowed"
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr('name') == "image") {
                    error.insertAfter("#image_error");
                } else {
                    error.insertAfter(element);
                }
            }
        });


        function readFile(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {

                    let validateImageType = ['image/png', 'image/bmp', 'image/jpeg', 'image/jpg'];

                    if (!validateImageType.includes(input.files[0]['type'])) {
                        var htmlPreview =
                            '<p>Image preview not available</p>' +
                            '<p>' + input.files[0].name + '</p>';
                    } else {
                        var htmlPreview =
                            '<img width="70%" height="300" src="' + e.target.result + '" />' +
                            '<p>' + input.files[0].name + '</p>';
                    }

                    let wrapperZone = $(input).parent();
                    let previewZone = $(input).parent().parent().find('.preview-zone');
                    let boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                    wrapperZone.removeClass('dragover');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(htmlPreview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function reset(e) {
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $(".dropzone").change(function () {
            readFile(this);
        });

        $('.dropzone-wrapper').on('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        $('.dropzone-wrapper').on('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        $('.remove-preview').on('click', function () {
            let boxZone = $(this).parents('.preview-zone').find('.box-body');
            let previewZone = $(this).parents('.preview-zone');
            let dropzone = $(this).parents('.form-group').find('.dropzone');
            boxZone.empty();
            previewZone.addClass('hidden');
            reset(dropzone);
        });

    </script>
@endsection
