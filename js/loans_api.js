var LoansAPI = {

    request_id: undefined,
    interval_id: undefined,
    form: undefined,
    $form_el: undefined,
    send_request: function (data) {
        $.post('/api/loans/', data, function (resp) {
            if (resp.hasOwnProperty('request_id')) {
                this.request_id = resp.request_id;
                this.interval_id = setInterval(this.check_status, 1000);
            }
        });
    },

    prepare_request: function (frm) {
        this.$form_el = $(frm);
        this.form = frm.serialize();
        return this.form
    },
    send_order: function() {
        this.$form_el.submit();
    },
    check_status: function() {
        $.get('/api/loans/', {req_id: this.request_id}, function (resp) {
            // console.log('Check status: ');
            console.log(resp);
            if (resp.hasOwnProperty('redirectUrl')) {
                clearInterval(interval_id);
                var $redirectUrl_el = $('hidden'),
                    $transId_el = $('hidden');

                $redirectUrl_el.attr('name', 'redirect_url').val(resp.redirectUrl).appendTo(this.$form_el);
                $transId_el.attr('name', 'transaction_id').val(resp.transactionId).appendTo(this.$form_el);

                this.$form_el.submit();
                // location.href = resp.redirectUrl;
            }
        });
    }
};

function pre_order_send(frm) {
    $('.js_submit').disable();
    LoansAPI.send_request(
        LoansAPI.prepare_request(frm));
}