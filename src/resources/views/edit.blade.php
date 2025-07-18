@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/edit.css') }}">
@endsection

@section('content')
<div class="detail-form">
    <div class="detail-form__heading content__heading">
        商品一覧<span class="detail-form__heading_space">&gt;</span>
        <p>{{$product->name}}</p>
    </div>
    <div class="detail-form__inner">
        <form action="/products/{{$product->id}}/update" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="detail-form__main">
                <div class="detail-form__image">
                    <div class="detail-form__group detail-form__image-group">
                        <!-- プレビュー表示用 -->
                        <div class="detail-form__image-preview">
                            <img id="preview" src="{{ asset('storage/' . $product->image) }}" alt="画像プレビュー">
                        </div>
                        <div class="detail-form__image-inputs">
                            <input type="file" accept=".png,.jpeg" name="image" id="image" class="detail-form__input detail-form__image-input" onchange="previewImage(event)" value="{{ old('image', $product->image) }}">
                        </div>
                        @if ($errors->has('image'))
                            @foreach ($errors->get('image') as $message)
                                <div class="detail-form__error-message">{{ $message }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="detail-form__right">
                    <div class="detail-form__group">
                        <label for="name" class="detail-form__label">
                            商品名
                        </label>
                        <div class="detail-form__name-inputs">
                            <input type="text" name="name" id="name" class="detail-form__input detail-form__name-input" placeholder="商品名を入力" value="{{ old('name', $product->name) }}">
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $message)
                                <div class="detail-form__error-message">{{ $message }}</div>
                            @endforeach
                        @endif
                    </div>

                    <div class="detail-form__group">
                        <label for="price" class="detail-form__label">
                            値段
                        </label>
                        <div class="detail-form__price-inputs">
                            <input type="text" name="price" id="price" class="detail-form__input detail-form__price-input" placeholder="値段を入力" value="{{ old('price', $product->price) }}">
                        </div>
                        @if ($errors->has('price'))
                            @foreach ($errors->get('price') as $message)
                                <div class="detail-form__error-message">{{ $message }}</div>
                            @endforeach
                        @endif
                    </div>

                    <div class="detail-form__group detail-form__season-group">
                        <label for="season" class="detail-form__label">季節</label>
                        <div class="detail-form__season-inputs">
                            @foreach($seasons as $season)
                            <label class="detail-form__checkbox-label">
                                <input type="checkbox" name="season_id[]" value="{{ $season->id }}" {{ in_array($season->id, old('season_id', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    {{ $season->name }}
                            </label>
                            @endforeach
                        </div>
                        @if ($errors->has('season->id'))
                            @foreach ($errors->get('season->id') as $message)
                                <div class="detail-form__error-message">{{ $message }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="detail-form__full">
                <div class="detail-form__group">
                    <label for="description" class="detail-form__label">商品説明</label>
                    <div class="detail-form__description-inputs">
                        <textarea name="description" id="description" class="detail-form__textarea" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea> 
                    </div>
                    @if ($errors->has('description'))
                        @foreach ($errors->get('description') as $message)
                            <div class="detail-form__error-message">{{ $message }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="detail-form__btn-inner">
                <input type="submit" class="detail-form__back-btn" value="戻る" name="back">
                <input type="submit" class="detail-form__send-btn btn" value="変更を保存" name="send">
            </div>
        </form>

        <form action="/products/{{ $product->id }}/delete" method="post">
            @csrf
            <button class="delete-button">
                <img src="{{asset('storage/images/Frame 406.png')}}" alt="削除" class="delete-icon">
            </button>
        </form>

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
