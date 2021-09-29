window.register = function () {
    var today = new Date();
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/dataCheck',
        type: 'POST',
        data: JSON.stringify({
            'toMonth': document.getElementById('toMonth').value,
        }),
        success: function (data) {
            if (data['result'] === 0) {
                result = window.confirm('データを登録します。よろしいですか？');
            }
            else {
                result = window.confirm('データが存在します。更新しますか？');
            }

            //登録する場合
            if (result) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: '/register',
                    dataType: 'JSON',
                    type: 'POST',
                    data: JSON.stringify({
                        'month': document.getElementById('toMonth').value,
                        // 'syunyu':document.getElementById('syunyu').value,
                        'yatin': document.getElementById('yatin').value,
                        'syokuhi': document.getElementById('syokuhi').value,
                        'gasudai': document.getElementById('gasudai').value,
                        'denkidai': document.getElementById('denkidai').value,
                        'suidoudai': document.getElementById('suidoudai').value,
                        'tuusinhi': document.getElementById('tuusinhi').value,
                        'loandai': document.getElementById('loan').value,
                        'comment': document.getElementById('comment').value,
                        'otherSum': document.getElementById('otherSum').value,
                    }),
                    success: function (data) {
                        if (data['result']) {
                            alert('データ登録が完了しました！');
                            location.reload();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) { alert('データ登録に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
                })
            }
        },
        error: function (jqXHR, textStatus, errorThrown) { alert('データチェックに失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
    })
}

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