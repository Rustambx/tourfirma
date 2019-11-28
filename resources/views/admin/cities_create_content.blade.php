<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $title }}</strong>
                </div>
                <div class="card-body card-block">

                    @include('includes.result_messages')
                    @if(isset($city))
                        <form action="{{ route('admin.cities.update', $city->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @method('PATCH')
                    @else
                        <form action="{{ route('admin.cities.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate>
                    @endif
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                            @if(isset($city))
                                <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" value="{{ $city->title }}" class="form-control"></div>
                            @else
                                <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text"  class="form-control"></div>
                            @endif
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Анонс</label></div>
                            @if(isset($city))
                                <div class="col-12 col-md-9"><textarea name="preview_text" id="preview_text"  rows="9" placeholder="Текст..." class="form-control">{{ $city->preview_text }}</textarea></div>
                            @else
                                <div class="col-12 col-md-9"><textarea name="preview_text" id="preview_text"  rows="9" placeholder="Текст..." class="form-control"></textarea></div>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Детальный текст</label></div>
                            @if(isset($city))
                                <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..."  class="form-control">{{ $city->detail_text }}</textarea></div>
                            @else
                                <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..."  class="form-control"></textarea></div>
                            @endif
                        </div>

                        @if(isset($city->resized_image))
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                <img src="{{ $city->resized_image }}" alt="{{ $city->title }}">
                            </div>
                        @endif

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Страна</label></div>
                            <div class="col-12 col-md-9">
                                <select name="country_id" id="selectLg" class="form-control-lg form-control">
                                    @if(isset($city))
                                        <option value="0">Выберите страну</option>
                                        @foreach($countries as $categoryOption)
                                            <option value="{{$categoryOption->id}}" @if($categoryOption->id == $city->country_id) selected @endif>
                                                {{$categoryOption->id_title}}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="0">Выберите страну</option>
                                        @foreach($countries as $categoryOption)
                                            <option value="{{$categoryOption->id}}">
                                                {{$categoryOption->id_title}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        @if(isset($city))
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