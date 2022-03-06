<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('head')
    </head>
    <header>
        @include('header')
    </header>
    @section('content')
        <form action="{{ route('house.register') }}" method="POST">
            @csrf
            @if(!is_null(session('message')))
                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
            @endif
            @if(isset($toMonthData['month']))
                <div>
                    <label>{{date('Y年m月',strtotime($toMonthData['month'].'/01'))}}の出費<h1>{{$toMonthData['yatin'] + $toMonthData['eat'] + $toMonthData['gasu'] + $toMonthData['denki'] + $toMonthData['suidou'] + $toMonthData['tuushin'] + $toMonthData['loan'] + $toMonthData['othersum']}}円</h1></label>
                </div>
            @endif
            
            <select onchange="getMonthData()" name="toMonth" id="toMonth" class="form-control w-25">
                @for($i = 1; $i < 13;$i++)
                    @if(date('m') == $i)
                        <option selected="selected">{{date('Y/m', strtotime(date('Y/').$i.'/1'))}}
                    @else
                        <option>{{date('Y/m', strtotime(date('Y/').$i.'/1'))}}
                    @endif
                @endfor
            </select>
            
            {{-- <div class="form-group">
                <label for="text1">収入</label>
                <input type="text" id="syunyu" class="form-control" value={{$syunyu->syunyu ?: 0}}>
            </div> --}}
            <div class="form-group">
                <label for="yatin">家賃</label>
                <input type="text" id="yatin" name="yatin" class="form-control" value="63000" disabled="disable">
            </div>
            <div class="form-group">
                <label for="syokuhi">食費</label>
                <input type="text" id="syokuhi" name="syokuhi" class="form-control" value={{$sumEat ?? 0}}>
            </div>
            <div class="form-group">
                <label for="gasudai">ガス代</label>
                <input type="text" id="gasudai" name="gasudai" class="form-control" value={{$toMonthData['gasu'] ?? 0}}>
            </div>
            <div class="form-group">
                <label for="denkidai">電気代</label>
                <input type="text" id="denkidai" name="denkidai" class="form-control" value={{$toMonthData['denki'] ?? 0}}>
            </div>
            <div class="form-group">
                <label for="suidoudai">水道代</label>
                <input type="text" id="suidoudai" name="suidoudai" class="form-control" value={{$toMonthData['suidou'] ?? 0}}>
            </div>
            <div class="form-group">
                <label for="tuusinhi">通信費</label>
                <input type="text" id="tuusinhi" name="tuusinhi" class="form-control" value={{$toMonthData['tuushin'] ?? 0}}>
            </div>
            <div class="form-group">
                <label for="loan">ローン</label>
                <input type="text" id="loan" name="loan" class="form-control" value={{$toMonthData['loan'] ?? 0}}>
            </div>
            <div class="form-group">
                <label for="otherSum">個人出費</label>
                <input type="text" id="otherSum" name="otherSum" class="form-control" value={{$sumOther ?? 0}}>
            </div>
            <div class="form-group">
                <label for="comment">備考</label>
                <textarea id="comment" name="comment" class="form-control">{{$toMonthData['comment'] ?? ''}}</textarea>
            </div>
            <div class="form-group">
                <label id="result"></label>
            </div>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <button class="btn btn-light" onclick="calc()">計算</button>
                </div>
                <div class="btn-group ml-auto">
                    <button class="btn btn-success text-right">確定</button>
                </div>
            </div>
        </form>
    @endsection
</html>
