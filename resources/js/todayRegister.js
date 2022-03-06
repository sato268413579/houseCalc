document.addEventListener('DOMContentLoaded', function () {
    if (location.pathname == '/') {
        $('#eat').on('change', function () {
            console.log(this.checked);
            if (this.checked) {
                $('#fileBtn').show();
                $('#commentDisp').hide();
            }
        });
        $('#other').on('change', function () {
            console.log(this.checked);
            if (this.checked) {
                $('#fileBtn').hide();
                $('#commentDisp').show();
            }
        });
    }
}, false);