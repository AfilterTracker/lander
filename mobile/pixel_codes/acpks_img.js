(function () {
    function serialize(obj) {
        var str = [];
        for (var p in obj)
            if (obj.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + '=' + encodeURIComponent(obj[p]));
            }
        return str.join('&');
    }

    function parseQuery(queryString) {
        if (!queryString) {
            return {}
        }

        var query = {};
        var pairs = (queryString[0] === '?' ? queryString.substr(1) : queryString).split('&');
        for (var i = 0; i < pairs.length; i++) {
            var pair = pairs[i].split('=');
            query[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
        }
        return query;
    }

    function addPixImg() {

        var pxUrl = 'https://user-actrk.com/trk/acp.gif?';
        var params = {};
        var query = document.location.href.split('?')[1];
        if (query) {
            var query_params = query ? parseQuery(query) : {};
                for (var i in query_params) {
                    if (query_params.hasOwnProperty(i)) {
                        params[i] = query_params[i]
                    }
                }
        }
        params['referer'] = document.referrer;
        params['rnd'] = Math.random();

        var img = new Image(1, 1);
        img.src = pxUrl + serialize(params);
    }

    addPixImg();
})();
