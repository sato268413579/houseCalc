window.getMonthData = function() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/getAjaxData',
        dataType: 'JSON',
        type: 'POST',
        data: JSON.stringify({
            'toMonth': document.getElementById('toMonth').value,
        }),
        success: function (data) {
            monthData = data['data'];
            if (monthData.length !== 0) {
                document.getElementById('syokuhi').value = data['eat'];
                document.getElementById('gasudai').value = monthData['gasu'];
                document.getElementById('denkidai').value = monthData['denki'];
                document.getElementById('suidoudai').value = monthData['suidou'];
                document.getElementById('tuusinhi').value = monthData['tuushin'];
                document.getElementById('loan').value = monthData['loan'];
                document.getElementById('otherSum').value = data['sumOther'];
                document.getElementById('comment').value = monthData['comment'];
            }
            else{
                document.getElementById('syokuhi').value = 0;
                document.getElementById('gasudai').value = 0;
                document.getElementById('denkidai').value = 0;
                document.getElementById('suidoudai').value = 0;
                document.getElementById('tuusinhi').value = 0;
                document.getElementById('loan').value = 0;
                document.getElementById('otherSum').value = 0;
                document.getElementById('comment').value = '';
                alert('データが存在しません');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) { alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
    })
}