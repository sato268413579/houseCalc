function register() {
    var today = new Date();
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/dataCheck',
        type: 'GET',
        data: [],
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
                        'month': today.getFullYear() + '/' + month,
                        // 'syunyu':document.getElementById('syunyu').value,
                        'yatin': document.getElementById('yatin').value,
                        'syokuhi': document.getElementById('syokuhi').value,
                        'gasudai': document.getElementById('gasudai').value,
                        'denkidai': document.getElementById('denkidai').value,
                        'suidoudai': document.getElementById('suidoudai').value,
                        'tuusinhi': document.getElementById('tuusinhi').value,
                        'loandai': document.getElementById('loan').value,
                        'comment': document.getElementById('comment').value,
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