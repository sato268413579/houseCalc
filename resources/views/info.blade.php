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
            <div class="form-inline">
                <div class="form-group">
                    <label>発生日</label>
                    <select id="day" class="form-control">
                        @for($i=1; $i<13; $i++)
                            @for($j=1; $j<32; $j++)
                                @if(checkdate($i, $j, date('Y')))
                                    <option>{{date('Y/m/d', strtotime(date('Y/').$i.'/'.$j))}}
                                @endif
                            @endfor
                        @endfor
                    </select>
                    <label class="ml-5">画面名</label>
                    <select id="func" class="form-control">
                        <option>当日登録
                        <option>当月登録
                        <option>過去月参照
                        <option>問い合わせ
                    </select>
                </div>
            </div>

            <textarea id="infoDetail" class="form-control input-lg mt-5"></textarea>

            <div class="text-right">
                <button class="btn btn-success light" onclick="infoRegister()">送信</button>
            </div>

        @endsection
    </body>
</html>
