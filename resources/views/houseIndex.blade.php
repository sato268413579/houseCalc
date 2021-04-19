<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('head')
    </head>
    <body>
        <header>
            @include('header')
        </header>
        @section('content')
        
        @if(isset($toMonthData['month']))
            <div>
                <label>{{date('Y年m月',strtotime($toMonthData['month'].'/01'))}}の出費<h1>{{$toMonthData['yatin'] + $toMonthData['eat'] + $toMonthData['gasu'] + $toMonthData['denki'] + $toMonthData['suidou'] + $toMonthData['tuushin'] + $toMonthData['loan']}}円</h1></label>
            </div>
        @endif
        
        
        {{-- <div class="form-group">
            <label for="text1">収入</label>
            <input type="text" id="syunyu" class="form-control" value={{$syunyu->syunyu ?: 0}}>
        </div> --}}
        <div class="form-group">
            <label for="text1">家賃</label>
            <input type="text" id="yatin" class="form-control" value="63000" disabled="disable">
        </div>
        <div class="form-group">
            <label for="text1">食費</label>
            <input type="text" id="syokuhi" class="form-control" value={{$sumEat ?? 0}}>
        </div>
        <div class="form-group">
            <label for="text1">ガス代</label>
            <input type="text" id="gasudai" class="form-control" value={{$toMonthData['gasu'] ?? 0}}>
        </div>
        <div class="form-group">
            <label for="text1">電気代</label>
            <input type="text" id="denkidai" class="form-control" value={{$toMonthData['denki'] ?? 0}}>
        </div>
        <div class="form-group">
            <label for="text1">水道代</label>
            <input type="text" id="suidoudai" class="form-control" value={{$toMonthData['suidou'] ?? 0}}>
        </div>
        <div class="form-group">
            <label for="text1">通信費</label>
            <input type="text" id="tuusinhi" class="form-control" value={{$toMonthData['tuushin'] ?? 0}}>
        </div>
        <div class="form-group">
            <label for="text1">ローン</label>
            <input type="text" id="loan" class="form-control" value={{$toMonthData['loan'] ?? 0}}>
        </div>
        <div class="form-group">
            <label for="text1">備考</label>
            <textarea id="comment" class="form-control">{{$toMonthData['comment'] ?? ''}}</textarea>
        </div>
        <div class="form-group">
            <label id="result"></label>
        </div>
        <div class="btn-toolbar">
            <div class="btn-group">
                <button class="btn btn-light" onclick="calc()">計算</button>
            </div>
            <div class="btn-group ml-auto">
                <button class="btn btn-success text-right" onclick="register()">確定</button>
            </div>
        </div>
        @endsection
    </body>
</html>
