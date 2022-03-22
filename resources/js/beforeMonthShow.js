window.btnCreateShow = function () {

    var type = document.getElementsByName('gender');
    for (i = 0; i < type.length; i++){
        if (type[i].checked){
            type = type[i].id;
        }
    }

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/getBeforeData',
        type: 'POST',
        dataType: 'JSON',
        data: JSON.stringify({ 'toMonth': document.getElementById('toMonth').value,
                               'type': type,}),
        success: function (data) {
            var elementCheck = document.getElementById('msg');
            if (elementCheck != null) {
                elementCheck.remove();
            }
            var elementCheck = document.getElementById('tblMonth');
            if (elementCheck != null) {
                elementCheck.remove();
            }
            if (data['data'] == null) {
                const label = document.createElement('label');
                label.id = 'msg';
                label.innerHTML = 'データがありません';
                label.style = 'color:red;';

                var parent = document.getElementById('errMsg');
                parent.appendChild(label);
            }
            else {
                
                const table = document.createElement('table');
                switch (type){
                    case 'registerDay':
                        
                        table.id = 'tblMonth';
                        table.className = 'table';

                        oldDay = '';

                        for(i = 0; i < data['data'].length; i++){
                            row = table.insertRow();
                            row.id = 'registerdRowId' + i;
                            if (oldDay == data['data'][i]['day']){
                                row.insertCell().appendChild(document.createTextNode('')).id = 'aaaaaaa' + i;
                                row.insertCell().appendChild(document.createTextNode('金額'));
                                row.insertCell().appendChild(document.createTextNode(data['data'][i]['pay']));
                            }
                            else{
                                row.insertCell().appendChild(document.createTextNode(data['data'][i]['day']));
                                row.insertCell().appendChild(document.createTextNode('金額'));
                                row.insertCell().appendChild(document.createTextNode(data['data'][i]['pay']));
                            }
                            if (data['data'][i]['type'] === 1) {
                                row.insertCell().appendChild(document.createTextNode('食費'));
                            } else {
                                row.insertCell().appendChild(document.createTextNode('個人出費'));
                            }
                            row.insertCell().appendChild(document.createTextNode(data['data'][i]['othercomment']));

                            var img = document.createElement('img');
                            if (data['data'][i]['image']) {
                                img.src = '/img/public/' + data['data'][i]['image'];
                                img.width = 150;
                            }
                            row.insertCell().appendChild(img);

                            var fileCrear = document.createElement('i');
                            fileCrear.onclick = new Function("dayDelete('" + data['data'][i]['day'] + '|' + data['data'][i]['oiban'] + "', 'registerdRowId"+i+"')");
                            fileCrear.className = 'fas fa-times-circle text-danger';
                            row.insertCell().appendChild(fileCrear);
                            
                            oldDay = data['data'][i]['day'];
                        }

                        
                        document.getElementById('tableShowData').appendChild(table);
                        break;
                    case 'sum':
                        createSumData(data);
                        break;
                }
                
            }

        },
        error: function (jqXHR, textStatus, errorThrown) { 
            alert('データチェックに失敗');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown); 
        }
    });
}

//指定月の合計金額を作成
function createSumData(data){
    const table = document.createElement('table');
    
    table.id = 'tblMonth';
    table.className = 'table';

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('家賃'));
    row.insertCell().appendChild(document.createTextNode(data['data']['yatin']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('食費'));
    row.insertCell().appendChild(document.createTextNode(data['data']['eat']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('ガス代'));
    row.insertCell().appendChild(document.createTextNode(data['data']['gasu']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('電気代'));
    row.insertCell().appendChild(document.createTextNode(data['data']['denki']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('水道代'));
    row.insertCell().appendChild(document.createTextNode(data['data']['suidou']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('通信費'));
    row.insertCell().appendChild(document.createTextNode(data['data']['tuushin']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('ローン'));
    row.insertCell().appendChild(document.createTextNode(data['data']['loan']));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('個人出費'));
    row.insertCell().appendChild(document.createTextNode(data['data']['othersum'] ?? 0));

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('備考'));
    row.insertCell().appendChild(document.createTextNode(data['data']['comment']));

    sum = data['data']['yatin'] + data['data']['eat'] + data['data']['gasu'] + data['data']['denki'] + data['data']['suidou'] + data['data']['tuushin'] + data['data']['loan'] + data['data']['othersum'];

    row = table.insertRow();
    row.insertCell().appendChild(document.createTextNode('合計'));
    row.insertCell().appendChild(document.createTextNode(sum));

    document.getElementById('tableShowData').appendChild(table);
}

window.dayDelete = function (dayPipeOiban, rowId) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/dayDelete',
        dataType: 'JSON',
        type: 'POST',
        data: JSON.stringify({
            'dayPipeOiban': dayPipeOiban,
        }),
        success: function (data) {
            $('#' + rowId).remove();
        },
        error: function (jqXHR, textStatus, errorThrown) { alert('削除に失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
    });
}