<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('head')
    </head>
    
    @section('content')
        <form action="{{ route('today.register') }}" method="POST">
            @csrf
            @if(!is_null(session('message')))
                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
            @endif
            <header>
                @include('header')
            </header>
            <div class="form-group">
                <label for="text1">日付</label>
                <select id="today" name="today" class="form-control w-25">
                    @for($i = 1; $i <= date('t'); $i++)
                        @if(date('d') == $i)
                            <option selected="selected">{{date('Y/').date('m/').$i}}</option>
                        @else
                            <option>{{date('Y/').date('m/').$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <p class="control-label"><b>種別</b></p>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="1" name="gender" id="eat" checked>
                    <label for="eat" class="mb-0">食費</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="2" name="gender" id="other">
                    <label for="other" class="mb-0">その他</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="text1">金額</label>
                <input type="text" id="pay" name="pay" class="form-control" value="0">
                <label id="payError" style="color:red;"></label>
            </div>
            <div id="fileBtn" class="form-gtoup">
                <div class="custom-file">
                    <input type="file" id="image" class="form-control-file" name="image" accept="image/png, image/jpeg">
                </div>
            </div>
            <div id="commentDisp" class="form-gtoup" style="display:none;">
                <label>備考</label>
                <textarea id="otherComment" class="form-control">{{$toMonthData['comment'] ?? ''}}</textarea>
            </div>
            <div class="btn-group ml-auto">
                <button class="btn btn-success text-right">登録</button>
            </div>
        </form>
    @endsection
</html>