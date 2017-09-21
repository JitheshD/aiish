$(document).ready(function(){
    $('.charOnly').keypress(function (e) {
        var regex = new RegExp("^[a-z-A-Z- -]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });
    $('.abbrChar').keypress(function (e) {
        var regex = new RegExp("^[A-Z-]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });
    
    
    $('.numbOnly').keypress(function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });
    $('.pwdonly').keypress(function (e) {
        var regex = new RegExp("^[0-9a-zA-Z!-$&-*_\-\]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });
});