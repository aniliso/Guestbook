new Vue({
    el: '#guestbook',
    data: {
        formInputs: {},
        formErrors: {},
        loading: false,
        success: false,
        error: false
    },
    methods: {
        onFileChange: function (e) {
            e.preventDefault();
            var files = e.target.files || e.dataTransfer.files;
            this.formInputs.attachment = files[0];
        },
        pnotify: function (message, type) {
            type = type ? type : 'success';
            var html = "<div class=\"notify\">";
                html += message;
            html += "</div>";
            PNotify.prototype.options.styling = "bootstrap3";
            new PNotify({
                text: html,
                type: type
            });
        },
        submitForm: function (e) {
            e.preventDefault();
            this.success = false;
            this.error = false;
            this.ajaxStart(true);
            var form = e.srcElement;
            var action = form.action;
            var csrfToken = form.querySelector('input[name="_token"]').value;
            var formData = new FormData();
            this.formInputs.captcha_guestbook = grecaptcha.getResponse(captcha_guestbook);

            for (var key in this.formInputs) {
                formData.append(key, this.formInputs[key]);
            }

            this.$http.post(action, formData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Cache-Control': 'no-cache'
                }
            }).then(function (response) {
                this.ajaxStart(false);
                this.formInputs = {};
                this.success = true;
                this.pnotify(response.data.data.message);
                $('#guestbook').trigger('reset');
                $('.fileinput').fileinput('reset');
            }).catch(function (data, status, request) {
                this.error = true;
                var errors = data.data;
                this.formErrors = (typeof errors !== 'undefined') ? errors.message : {};
                this.ajaxStart(false);
                grecaptcha.reset(captcha_guestbook);
            });
        },
        ajaxStart: function (loading) {
            if (loading) {
                $('#guestbook').LoadingOverlay("show");
            } else {
                $('#guestbook').LoadingOverlay("hide");
            }
        }
    }
});