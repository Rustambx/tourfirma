<div class="grid_4 prefix_1">
    <h5>Выберите страну</h5>
    <ul class="list">
        @foreach($countries as $item)
            <li><a href="{{ route('countries.show', $item->id) }}">{{ $item->title }}</a></li>
        @endforeach

    </ul>

    <h3 class="mtop20">Найти Тур</h3>
    <form id="bookingForm" method="get" action="{{ route('tours.index') }}">
        @csrf
        <div class="fl1 fl2">
            <em>Страна</em>
            <select id="country" name="country">
                <option value="">Выберите страну</option>
                @foreach($countries as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
            <div class="clear"></div>
            <em>Город</em>
            <select id="city" name="city">
                <option>Выберите город</option>
            </select>
            <div class="clear"></div>
            <em>Тип тура</em>
            <select name="type">
                <option>Выберите тур</option>
                @foreach($typeTours as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <label class="price">Цена до ($)</label>
            <input type="number" name="price" min="100">
        </div>

        <div class="clear"></div>
        <div class="tmRadio hot_tour">
            <label>
                <input name="hot" value="Y" type="checkbox" id="tmRadio0" data-constraints='	@RadioGroupChecked(name="Comfort", groups=[RadioGroup])' />
                Горячий тур
            </label>
        </div>
        <div class="clear"></div>
        <button class="btn" type="submit">Найти</button>

    </form>
</div>
<script src="{{ asset('js/script.js') }}"></script>