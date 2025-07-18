@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">商品登録</h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/products/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="register-form__group">
                <label for="name" class="register-form__label">
                    商品名<span class="register-form__required">必須</span>
                </label>
                <div class="register-form__name-inputs">
                    <input type="text" name="name" id="name" class="register-form__input register-form__name-input" value="{{ old('name') }}" placeholder="商品名を入力">
                </div>
                @if ($errors->has('name'))
                    @foreach ($errors->get('name') as $message)
                        <div class="register-form__error-message">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div class="register-form__group">
                <label for="price" class="register-form__label">
                    値段<span class="register-form__required">必須</span>
                </label>
                <div class="register-form__price-inputs">
                    <input type="text" name="price" id="price" class="register-form__input register-form__price-input" value="{{ old('price') }}" placeholder="値段を入力">
                </div>
                @if ($errors->has('price'))
                    @foreach ($errors->get('price') as $message)
                        <div class="register-form__error-message">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div class="register-form__group register-form__image-group">
                <label for="image" class="register-form__label">
                    商品画像<span class="register-form__required">必須</span>
                </label>
                <div class="register-form__image-inputs">
                    <input type="file" accept=".png,.jpeg" name="image" id="image" class="register-form__input register-form__image-input" onchange="previewImage(event)">
                </div>
                <!-- プレビュー表示用 -->
                <div class="register-form__image-preview">
                    <img id="preview" src="" alt="画像プレビュー" style="max-width: 200px; display: none;">
                </div>
                @if ($errors->has('image'))
                    @foreach ($errors->get('image') as $message)
                        <div class="register-form__error-message">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div class="register-form__group register-form__season-group">
                <label for="season" class="register-form__label">
                    季節<span class="register-form__required">必須</span>
                    <span class="register-form__note">複数選択可</span>
                </label>
                <div class="register-form__season-inputs">
                    @foreach($seasons as $season)
                    <label for="" class="register-form__checkbox-label">
                        <input type="checkbox" name="season_id[]" value="{{ $season->id }}" >
                        {{ $season->name }}
                    </label>
                    @endforeach
                </div>
                @error('season_id')
                    <div class="register-form__error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="register-form__group">
                <label for="description" class="register-form__label">
                    商品説明<span class="register-form__required">必須</span>
                </label>
                <div class="register-form__name-inputs">
                    <textarea name="description" id="description" class="register-form__textarea" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description') }}</textarea> 
                </div>
                @if ($errors->has('description'))
                    @foreach ($errors->get('description') as $message)
                        <div class="register-form__error-message">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div class="register-form__btn-inner">
                <input type="submit" class="register-form__back-btn" value="戻る" name="back">
                <input type="submit" class="register-form__send-btn btn" value="登録" name="send">  
            </div>
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
