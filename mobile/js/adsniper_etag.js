var syncScript = document.createElement("script");
syncScript.type = 'text/javascript';
syncScript.src = "https://sync.users-api.com/e.js";
syncScript.onerror = function () {
    window['__sc_int_uid'] = 'ssp-etg-error';
};
document.getElementsByTagName("head")[0].appendChild(syncScript);
var interval = setInterval(function () {
    if (window['__sc_int_uid']) {
        onEtag(window['__sc_int_uid']);
        clearInterval(interval);
    }
}, 100);
