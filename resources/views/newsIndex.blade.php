<div class="grid_12">
    <h3 class="head1">Новости</h3>
</div>
@foreach($newsItems as $item)
    <div class="grid_4">
        <div class="block1">
            <time datetime="2014-01-01">{{ $item->created_at->format('j') }}<span>{{ $item->created_at->format('M') }}</span></time>
            <div class="extra_wrapper">
                <div class="text1 col1"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></div>
                {!!   substr($item->preview_text, 0, 100) !!}
            </div>
        </div>
    </div>
@endforeach