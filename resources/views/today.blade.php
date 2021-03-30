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
                    @endif
                    <option>{{date('Y/').date('m/').$i}}</option>
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
        <script>
            function todayRegister(){
                if(document.getElementById('pay').value == '' || document.getElementById('pay').value == '0' || isNaN(document.getElementById('pay').value)){
                    document.getElementById('payError').innerText = '失敗';
                    return;
                }

                $.ajax({
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'/todayRegister',
                    dataType:'JSON',
                    type:'POST',
                    data:JSON.stringify({
                        'today':document.getElementById('today').value,
                        'pay':document.getElementById('pay').value,
                    }),
                    success:function(){
                        alert('データ登録に成功しました！');
                        location.reload();
                    },
                    error:function(jqXHR, textStatus, errorThrown){alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown);}
                });
            }
        </script>
    </body>
    @endsection
</html>