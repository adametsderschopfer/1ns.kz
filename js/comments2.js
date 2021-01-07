
function add_smile(text) {
    $('syscontent').innerHTML += "::icon_" + text + "::";
}
function trim(str) {
    str = str.replace(/^\s+/, '');
    for (var i = str.length - 1; i > 0; i--) {
        if (/\S/.test(str.charAt(i))) {
            str = str.substring(0, i + 1);
            break;
        }
    }
    return str;
}

var Base64 = {

    encode: function (input) {
        return btoa(encodeURIComponent(input).replace(/%([0-9A-F]{2})/g, function (match, p1) {
            return String.fromCharCode('0x' + p1);
        }));
    },

    decode: function (input) {
        return decodeURIComponent(atob(input).split('').map(function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    }


}