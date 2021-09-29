window.calc = function (){
    // var syunyu = document.getElementById('syunyu').value;
    var syunyu = 294088;
    var yatin = document.getElementById('yatin').value;
    var syokuhi = document.getElementById('syokuhi').value;
    var gasudai = document.getElementById('gasudai').value;
    var denkidai = document.getElementById('denkidai').value;
    var suidoudai = document.getElementById('suidoudai').value;
    var tuusinhi = document.getElementById('tuusinhi').value;
    var loan = document.getElementById('loan').value;
    var otherSum = document.getElementById('otherSum').value;

    var result = Number(syunyu) - (Number(yatin) + Number(syokuhi) + Number(gasudai) + Number(denkidai) + Number(suidoudai) + Number(tuusinhi) + Number(loan) + Number(otherSum));

    document.getElementById('result').innerHTML = '計算結果：' + result.toString();
}