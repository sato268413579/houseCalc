function infoRegister(){
    if (document.getElementById('infoDetail').value.trim() == '' || document.getElementById('infoDetail').value == null){
        alert('なにも入力されてません');
    }
    else{
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'/infoRegister',
            type:'POST',
            data:JSON.stringify({
                'day':document.getElementById('day').value,
                'func': document.getElementById('func').value,
                'detail': document.getElementById('infoDetail').value,
            }),
            success:function(data){
                alert('送信完了しました。');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) { alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
        });
    }
}