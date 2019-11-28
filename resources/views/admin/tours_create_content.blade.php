<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $title }}</strong>
                </div>
                <div class="card-body card-block">
                    @include('includes.result_messages')
                    @if(isset($tour))
                        <form action="{{ route('admin.tours.update', $tour->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @else
                        <form action="{{ route('admin.tours.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate>
                    @endif
                            @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                            @if(isset($tour))
                                <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" value="{{ $tour->title }}" class="form-control"></div>
                            @else
                                <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Text" class="form-control"></div>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Цена</label></div>
                            @if(isset($tour))
                                <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Text" value="{{ $tour->price }}" class="form-control"></div>
                            @else
                                <div class="col-12 col-md-9"><input type="text" id="price" name="price" placeholder="Text" class="form-control"></div>
                            @endif
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текст</label></div>
                            @if(isset($tour))
                                <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control"> {{ $tour->detail_text }}</textarea></div>
                            @else
                                <div class="col-12 col-md-9"><textarea name="detail_text" id="detail_text" rows="9" placeholder="Текст..." class="form-control"></textarea></div>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Тип тура</label></div>
                            <div class="col-12 col-md-9">
                                @if(isset($tour))
                                    <select name="type_tour_id" id="type_tour_id"  class="form-control-lg form-control">
                                        <option value="0">Выберите тип тура</option>
                                        @foreach($typeTours as $typeTour)
                                            <option value="{{$typeTour->id}}" @if($typeTour->id == $tour->type_tour_id) selected @endif>
                                                {{$typeTour->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="type_tour_id" id="type_tour_id"  class="form-control-lg form-control">
                                        <option value="0">Выберите тип тура</option>
                                        @foreach($typeTours as $typeTour)
                                            <option value="{{$typeTour->id}}">
                                                {{$typeTour->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Отель</label></div>
                            <div class="col-12 col-md-9">
                                <select name="hotel_id[]" id="hotel_id" multiple class="form-control-lg form-control">

                                    @if(isset($tour))
                                        @foreach($hotels as $hotel)
                                            <option value="{{$hotel->id}}" @if($hotel->id == $tour->hotel_id) selected @endif>
                                                {{$hotel->title}}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach($hotels as $hotel)
                                            <option value="{{$hotel->id}}">
                                                <b>Отель:</b> {{$hotel->title}} - <b>Город:</b> {{ $hotel->city->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        @if(isset($tour->img))
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Текущее изображение</label></div>
                                <img src="{{ $tour->img }}" alt="{{ $tour->title }}">
                            </div>
                        @endif

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Изображение</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="img" name="img" class="form-control-file"></div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2"><label for="file-input" class=" form-control-label">Горячий тур</label></div>
                            @if(isset($tour->hot))
                                <div class="col-12 col-md-3"><input type="checkbox" checked value="Y" id="hot" name="hot" class="form-control-file"></div>
                            @else
                                <div class="col-12 col-md-3"><input type="checkbox" value="Y" id="hot" name="hot" class="form-control-file"></div>
                            @endif
                        </div>


                        @if(isset($tour))
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