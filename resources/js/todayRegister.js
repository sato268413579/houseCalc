window.todayRegister = function() {
    if (document.getElementById('pay').value == '' || document.getElementById('pay').value == '0' || isNaN(document.getElementById('pay').value) || (!document.getElementById('eat').checked && !document.getElementById('other').checked)) {
        document.getElementById('payError').innerText = '金額が未入力、0または種別を選択しておりません。再度入力をお願いします。';
        return;
    }

    var type = document.getElementById('eat').checked ? '1' : '2';
    var reader = new FileReader();

    reader.onloadend = function func(event){
        var formData = new FormData();
        formData.append('today', document.getElementById('today').value);
        formData.append('pay', document.getElementById('pay').value);
        formData.append('type', type);
        formData.append('image', document.getElementById('image').files[0]);
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/todayRegister',
            // dataType: 'JSON',
            type: 'POST',
            processData: false, // jQueryがデータを処理しないよう指定
            contentType: false,  // jQueryがcontentTypeを設定しないよう指定
            // data: JSON.stringify({
            //     'today': document.getElementById('today').value,
            //     'pay': document.getElementById('pay').value,
            //     'type': type,
            //     'image': uaJoin,
            // }),
            data: formData,
            success: function (data) {
                alert('データ登録に成功しました！');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) { alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
        });
    }

    reader.readAsArrayBuffer(document.getElementById('image').files[0]);
}