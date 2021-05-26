function todayRegister() {
    
    if (document.getElementById('pay').value == '' || document.getElementById('pay').value == '0' || isNaN(document.getElementById('pay').value) || (!document.getElementById('eat').checked && !document.getElementById('other').checked)) {
        document.getElementById('payError').innerText = '金額が未入力、0または種別を選択しておりません。再度入力をお願いします。';
        return;
    }

    var type = document.getElementById('eat').checked ? '1' : '2';
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/todayRegister',
        dataType: 'JSON',
        type: 'POST',
        data: JSON.stringify({
            'today': document.getElementById('today').value,
            'pay': document.getElementById('pay').value,
            'type': type,
        }),
        success: function () {
            alert('データ登録に成功しました！');
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) { alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
    });
}