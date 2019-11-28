<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $title }}</strong>
                </div>
                <div class="card-body card-block">
                    @include('includes.result_messages')
                    @if(isset($new))
                        <form action="{{ route('admin.news.update', $new->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @else
                                <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate>
                                    @endif
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                        @if(isset($new))
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="title" name="title" value="{{ $new->title }}" placeholder="Text" class="form-control">
                                            </div>
                                        @else
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="title" name="title" placeholder="Text" class="form-control">
                                            </div>
                                        @endif
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Анонс</label></div>
                                        @if(isset($new))
                                            <div class="col-12 col-md-9">
                                                <textarea name="preview_text" id="preview_text" rows="9" placeholder="Текст..." class="form-control">{{ $new->preview_text }}</textarea>
                                            </div>
                                        @else
                                            <div class="col-12 col-md-9">
                                                <textarea name="preview_text" id="preview_text" rows="9" placeholder="Текст..." class="form-control"></textarea>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Детальный текст</label></div>
                                        @if(isset($new))
                                            <div class="col-12 col-md-9">
                                                <textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control">{{ $new->detail_text }}</textarea>
                                            </div>
                                        @else
                                            <div class="col-12 col-md-9">
                                                <textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control"></textarea>
                                            </div>
                                        @endif
                                    </div>

                                    @if(isset($new->resized_image))
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                            <img src="{{ $new->resized_image }}" alt="{{ $new->title }}">
                                        </div>
                                    @endif


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                                    </div>

                                    @if(isset($new))
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