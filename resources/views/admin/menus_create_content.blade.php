<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $title }}</strong>
                </div>
                <div class="card-body card-block">
                    @include('includes.result_messages')
                    @if(isset($menu))
                        <form action="{{ route('admin.menus.update', $menu->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @method('PATCH')
                    @else
                        <form action="{{ route('admin.menus.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate>
                    @endif
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                                @if(isset($menu))
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="title" name="title" value="{{ $menu->title }}" placeholder="Text" class="form-control">
                                    </div>
                                @else
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="title" name="title" placeholder="Text" class="form-control">
                                    </div>
                                @endif
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Адресс</label></div>
                                @if(isset($menu))
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="path" name="path" value="{{ $menu->path }}" placeholder="Text" class="form-control">
                                    </div>
                                @else
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="path" name="path" placeholder="Text" class="form-control">
                                    </div>
                                @endif
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Названия маршрута</label></div>
                                @if(isset($menu))
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="routeName" name="routeName" value="{{ $menu->routeName }}" placeholder="Text" class="form-control">
                                    </div>
                                @else
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="routeName" name="routeName" placeholder="Text" class="form-control">
                                    </div>
                                @endif
                            </div>




                            @if(isset($menu))
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