$(function () {
    var Unloader = {
        redirectUrl: '',

        init: function () {
            var oThis = this;

            history.pushState({init: true}, "unused argument", "#init");
            var foo = {foo: true}; // state object
            history.pushState(foo, "unused argument", "#now");

            $(window).on('popstate', function (e) {
                var op = '&';
                if (e.originalEvent.state && e.originalEvent.state.init) {
                    if (oThis.redirectUrl.indexOf('?') === -1) {
                        op = '?';
                    }
                    location.href = oThis.redirectUrl + op + 'bb_=1' + op + 'cb_click=1';
                    e.preventDefault();
                }
            });
        }
    };

    Unloader.redirectUrl = "%(redirect_url)s";
    Unloader.init();
});