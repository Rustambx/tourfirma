<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $title }}</strong>
                </div>
                <div class="card-body card-block">

                    @include('includes.result_messages')
                    @if(isset($slider))
                        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @method('PATCH')
                            @else
                                <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate>
                                    @endif
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                        @if(isset($slider))
                                            <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" value="{{ $slider->title }}" class="form-control"></div>
                                        @else
                                            <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text"  class="form-control"></div>
                                        @endif
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Цена</label></div>
                                        @if(isset($slider))
                                            <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Text" value="{{ $slider->price }}" class="form-control"></div>
                                        @else
                                            <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Text"  class="form-control"></div>
                                        @endif
                                    </div>



                                    @if(isset($slider->resized_image))
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                            <img src="{{ $slider->resized_image}}" alt="{{ $slider->title }}">
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
                                                @if(isset($slider))
                                                    <option value="0">Выберите Страну</option>
                                                    @foreach($countries as $categoryOption)
                                                        <option value="{{$categoryOption->id}}" @if($categoryOption->id == $slider->country_id) selected @endif>
                                                            {{$categoryOption->id_title}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="0">Выберите Страну</option>
                                                    @foreach($countries as $categoryOption)
                                                        <option value="{{$categoryOption->id}}">
                                                            {{$categoryOption->id_title}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    @if(isset($slider))
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