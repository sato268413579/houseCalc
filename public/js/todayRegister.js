function todayRegister() {
    if (document.getElementById('pay').value == '' || document.getElementById('pay').value == '0' || isNaN(document.getElementById('pay').value)) {
        document.getElementById('payError').innerText = '失敗';
        return;
    }

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/todayRegister',
        dataType: 'JSON',
        type: 'POST',
        data: JSON.stringify({
            'today': document.getElementById('today').value,
            'pay': document.getElementById('pay').value,
        }),
        success: function () {
            alert('データ登録に成功しました！');
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) { alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
    });
}