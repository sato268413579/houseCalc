function btnCreateShow() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/getBeforeData',
        type: 'POST',
        dataType: 'JSON',
        data: JSON.stringify({ 'toMonth': document.getElementById('toMonth').value }),
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
                row.insertCell().appendChild(document.createTextNode('備考'));
                row.insertCell().appendChild(document.createTextNode(data['data']['comment']));

                document.getElementById('tableShowData').appendChild(table);
            }

        },
        error: function (jqXHR, textStatus, errorThrown) { alert('データチェックに失敗しました'); console.log(jqXHR); console.log(textStatus); console.log(errorThrown); }
    });
}