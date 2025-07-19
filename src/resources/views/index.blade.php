@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css') }}">
@endsection

@section('content')
    <div class="index__content">
        <div class="index-heading">
            <h2 class="content__heading">
                @if(!empty(request('keyword')))
                "{{ request('keyword') }}"の一覧
                @else
                商品一覧
                @endif
            </h2>
            <a href="/products/register" class="header__link">+商品を追加</a>
        </div>
        <div class="search-main">
            <div class="sidebar">
                <div class="search-form">
                    <form class="search-form__input" action="/products/search" method="get">
                        <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{request('keyword')}}">
                        <div class="search-form__actions">
                            <button class="search-form__actions-btn" type="submit">検索</button>
                        </div>
                        <h3>価格順で表示</h3>
                        <select name="sort" class="search-form__price-sort">
                            <option disabled {{ empty(request('sort')) ? 'selected' : '' }}>価格で並び替え</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>高い順に表示</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>安い順に表示</option>
                        </select>
                        <div class="search-tag">
                            @if(request('sort')==='price_desc')
                            <span class="search-tag__text">高い順に表示
                                <a href="{{ url('/products/search') . '?' . http_build_query(request()->except('sort')) }}" class="search-tag__icon">×</a>
                            </span>
                            @elseif(request('sort')=== 'price_asc')
                            <span class="search-tag__text">安い順に表示</span>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
            <div class="index-cards">
                @foreach ($products as $product)
                <a href="{{ url('/products/'. $product->id) }}" class="index-card-link">
                    <div class="index-card">
                        <div class="index-card__img-wrapper">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="画像プレビュー">
                        </div>
                        <div class="index-card__body">
                            <p class="index-card__name">{{$product->name}}</p>
                            <p class="index-card__price">¥{{$product->price}}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="index-paginate">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>

@endsection

@section('js')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

