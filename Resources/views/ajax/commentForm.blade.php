<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Sizde Yazın
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hasta Yorumu</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['@submit.prevent'=>'submitForm', 'route' => 'api.guestbook.comment.add', 'files'=>true, 'method'=>'post', 'id'=>'guestbook']) !!}
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" v-bind:class="[formErrors['first_name'] ? 'has-error' : '']">
                            {!! Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder' => trans('guestbook::comments.form.first_name'), 'v-model'=>'formInputs.first_name', 'v-if'=>'!formInputs.first_nmae']) !!}
                            <span v-if="formErrors['first_name']" class="help-block validMessage">@{{ formErrors['first_name'] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" v-bind:class="[formErrors['last_name'] ? 'has-error' : '']">
                            {!! Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder' => trans('guestbook::comments.form.last_name'), 'v-model'=>'formInputs.last_name']) !!}
                            <span v-if="formErrors['last_name']" class="help-block validMessage">@{{ formErrors['last_name'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" v-bind:class="[formErrors['phone'] ? 'has-error' : '']">
                            {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'placeholder' => trans('guestbook::comments.form.phone'), 'v-model'=>'formInputs.phone']) !!}
                            <span v-if="formErrors['phone']" class="help-block validMessage">@{{ formErrors['phone'] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group" v-bind:class="[formErrors['email'] ? 'has-error' : '']">
                            {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder' => trans('guestbook::comments.form.email'),'v-model'=>'formInputs.email']) !!}
                            <span v-if="formErrors['email']" class="help-block validMessage">@{{ formErrors['email'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" v-bind:class="[formErrors['subject'] ? 'has-error' : '']">
                            {!! Form::text('subject', old('subject'), ['class'=>'form-control', 'placeholder' => trans('guestbook::comments.form.subject'),'v-model'=>'formInputs.subject']) !!}
                            <span v-if="formErrors['subject']" class="help-block validMessage">@{{ formErrors['subject'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" v-bind:class="[formErrors['message'] ? 'has-error' : '']">
                            {!! BSForm::textarea('message',old('message'),['placeholder' => trans('guestbook::comments.form.message'), 'v-model'=>'formInputs.message']) !!}
                            <span v-if="formErrors['message']" class="help-block validMessage">@{{ formErrors['message'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="form-group" v-bind:class="[formErrors['g-recaptcha-response'] ? 'has-error' : '']">
                            {!! Captcha::display('captcha_guestbook') !!}
                            <span v-if="formErrors['g-recaptcha-response']" class="help-block validMessage">@{{ formErrors['g-recaptcha-response'] }}</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="fileinput fileinput-new pull-right" data-provides="fileinput" v-bind:class="[formErrors['attachment'] ? 'has-error' : '']">
                            <span class="btn btn-default btn-file"><span>Dosya Ekle</span>
                                <input type="file" name="attachment" v-on:change="onFileChange"/>
                            </span>
                            <span class="fileinput-filename"></span><span class="fileinput-new">Dosya Seçilmedi</span>
                            <span v-if="formErrors['attachment']" class="help-block validMessage">@{{ formErrors['attachment'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        {!! BSForm::submit('Gönder', ['class'=>'theme_button color1 btn-lg']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.css"/>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.14/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay_progress.min.js"></script>
@endpush

@push('js_inline')
<script>
    new Vue({
        el: '#guestbook',
        data: {
            formInputs: {},
            formErrors: {},
            loading: false
        },
        methods: {
            onFileChange: function (e) {
                e.preventDefault();
                var files = e.target.files || e.dataTransfer.files;
                this.formInputs.attachment = files[0];
            },
            submitForm: function (e) {
                e.preventDefault();
                this.ajaxStart(true);
                var form = e.srcElement;
                var action = form.action;
                var csrfToken = form.querySelector('input[name="_token"]').value;
                var formData = new FormData();
                for (var key in this.formInputs) {
                    formData.append(key, this.formInputs[key]);
                }
                this.$http.post(action, formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }).then(function (response) {
                    this.ajaxStart(false);
                    this.formInputs = {};
                    $('#guestbook').trigger('reset');
                    $('.fileinput').fileinput('reset');
                }).catch(function (data, status, request) {
                    var errors = data.data;
                    this.formErrors = (typeof errors !== 'undefined') ? errors.message : {};
                    this.ajaxStart(false);
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
</script>
{!! Captcha::scriptWithCallback(['captcha_guestbook','captcha_contact']) !!}
@endpush