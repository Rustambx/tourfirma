<div class="grid_12">
    <h3 class="mtop20">{{ $new->title }}</h3>
    <div class="blog">
        <img src="{{ $new->img }}" alt="" class="img_inner fleft mr10">
        <time datetime="2014-10-01">{{ $new->created_at->format('j') }}<span>{{ $new->created_at->format('M') }}</span></time>
        {!! $new->detail_text !!}
    </div>
    <a href="{{ route('news.index') }}" class="link1 mt">К списку</a>
</div>