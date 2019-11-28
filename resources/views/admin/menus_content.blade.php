<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                @if(session('status'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        {{ session()->get('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <a href="{{route('admin.menus.create')}}" class="btn btn-primary">Создать меню</a>
                </div>
                <div class="card-header">
                    <strong class="card-title">Список меню</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Адресс</th>
                            <th>Названия маршрута</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.menus.edit', $item->id) }}">{{ $item->title }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.menus.edit', $item->id) }}">{{ $item->path }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.menus.edit', $item->id) }}">{{ $item->routeName }}</a>
                                </td>

                                <td>
                                    <form method="post" action="{{ route('admin.menus.destroy', $item->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div><!-- .animated -->