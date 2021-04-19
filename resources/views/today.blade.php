<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('head')
    </head>
    <body>
        @section('content')
        <header>
            @include('header')
        </header>
        <div class="form-group">
            <label for="text1">日付</label>
            <select id="today" class="form-control w-25">
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
            <label for="text1">金額</label>
            <input type="text" id="pay" name="pay" class="form-control" value="0">
            <label id="payError" style="color:red;"></label>
        </div>
        <div class="btn-group ml-auto">
            <button class="btn btn-success text-right" onclick="todayRegister()">登録</button>
        </div>
    </body>
    @endsection
</html>