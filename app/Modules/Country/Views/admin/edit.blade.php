@extends('layouts.site')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $country->title }}</strong>
                    </div>
                    <div class="card-body card-block">
                        @include('includes.result_messages')
                        <form action="{{ route('admin.countries.update', $country->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="title" name="title" value="{{ $country->title }}" placeholder="Text" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Анонс</label></div>
                                <div class="col-12 col-md-9">
                                    <textarea name="preview_text" id="preview_text" rows="9" placeholder="Текст..." class="form-control html-editor">{{ $country->preview_text }}</textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Детальный текст</label></div>
                                <div class="col-12 col-md-9">
                                    <textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control html-editor">{{ $country->detail_text }}</textarea>
                                </div>
                            </div>

                            @if(isset($country->resized_image))
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                    <img src="{{ $country->resized_image }}" alt="{{ $country->title }}">
                                </div>
                            @endif


                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                            </div>

                            @if(isset($country))
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <div class="card-footer">
                                <input type="submit" value="Сохранить" class="btn btn-primary btn-sm">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
