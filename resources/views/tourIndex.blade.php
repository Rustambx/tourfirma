@foreach($tourItems as $item)
    <div class="grid_4">
        <div class="banner">
            <img src="{{ $item->resized_image }}" alt="{{ $item->title }}">
            <div class="label">
                <div class="title"><a href="{{ route('tours.show', $item->id) }}">{{ $item->title }}</a></div>
                <div class="price"><span>$ {{ $item->price }}</span></div>
                <a href="{{ route('tours.show', $item->id) }}">Подробнее</a>
            </div>
        </div>
    </div>
@endforeach
<div class="clear"></div>