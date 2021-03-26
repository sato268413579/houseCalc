<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        @include('head')
    </head>
    <body>
        <header>
            @include('header')
        </header>
        @section('content')
        <div>
            
            {{-- <label>{{$toMonthData->month}}</label><br> --}}
        </div>
        
        <div class="form-group">
            <label for="text1">収入</label>
            <input type="text" id="syunyu" class="form-control" value="200000">
        </div>
        <div class="form-group">
            <label for="text1">家賃</label>
            <input type="text" id="yatin" class="form-control" value="63000">
        </div>
        <div class="form-group">
            <label for="text1">食費</label>
            <input type="text" id="syokuhi" class="form-control" value="40000">
        </div>
        <div class="form-group">
            <label for="text1">ガス代</label>
            <input type="text" id="gasudai" class="form-control" value="4000">
        </div>
        <div class="form-group">
            <label for="text1">電気代</label>
            <input type="text" id="denkidai" class="form-control" value="3400">
        </div>
        <div class="form-group">
            <label for="text1">水道代</label>
            <input type="text" id="suidoudai" class="form-control" value="4300">
        </div>
        <div class="form-group">
            <label for="text1">通信費</label>
            <input type="text" id="tuusinhi" class="form-control" value="16000">
        </div>
        <div class="form-group">
            <label id="result"></label>
        </div>
        <button class="btn btn-light" onclick="calc()">計算</button>
        <button class="btn btn-success">登録</button>
        
        @endsection
    </body>
</html>
