<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?=Html::csrfMetaTags() ?>

<div class="product-email-sign-up pad-top pad-bot">
    <div class="content">
        <p class="h2">Kodėl verta gauti „Tomeda.lt“ naujienlaiškį?</p>
        <div class="points">
            <div class="point text">
                <p>Tomeda.lt naujienlaiškis – tai:</p>
                <ul>
                    <li><span>1</span> Slaptos akcijos ir specialūs pasiūlymai</li>
                    <li><span>2</span> Elektronikos ir technikos naujovių apžvalgos</li>
                    <li><span>3</span> Objektyvios ir išsamios produktų apžvalgos</li>
                    <li><span>4</span> Naudingi patarimai ir rekomendacijos</li>
                </ul>
            </div>
            <div class="point form" id="emailSubsription_form">
                <div class="form-head-bg"></div>
                <div class="form-content">
                    <p>Įveskite savo el. pašto adresą</p>
                    <p>
                        <input type="email" name="email" id="emailSubsription-email" placeholder="El. paštas" style="border-color:#ccc;"/>
                        <div class="emailSubsription_error" style="display: none;"></div>
                    </p>
                    <a href="javascript:;" class="button emailSubsription" data-link="<?= Url::to(['/site/subscribe']);?>">Prenumeruoti</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="content product-join-facebook">
    <p class="h2">Prisijunkite prie mūsų draugų Facebooke</p>
    <div class="pr-fb-like-box">
        <div class="fb-page" data-href="https://www.facebook.com/inovexas/" data-tabs="none" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/inovexas/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/inovexas/">InOvex</a></blockquote></div>
    </div>
</div>

<?php
    $js = "
        function _validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function clearError() {
            $('#emailSubsription-email').css('border-color','#ccc');
            $('.emailSubsription_error').css('display','none');
        }

        function pushError(message) {
            if (message) {
                $('.emailSubsription_error').html(message);
                if ( $('.emailSubsription_error').css('display') == 'none' ) {
                    $('.emailSubsription_error').toggle('fast');
                }
                $('#emailSubsription-email').css('border-color','#f99');
            }
        }

        $('#emailSubsription-email').keypress(function(){
            clearError();
        });

        $('#emailSubsription-email').click(function(){
            clearError();
        });

        $('.emailSubsription').on('click', function(){
            clearError();
            var csrf = $('meta[name=csrf-token]').attr('content');
            var csrf_param = $('meta[name=csrf-param]').attr('content');
            var link = $(this);
            var data = {};

            data['email'] = $('#emailSubsription-email').val();

            if (!_validateEmail(data['email'])) {
                pushError('Įveskite savo el. paštą');
                return false;
            }

            data[csrf_param] = csrf;
            $.post($(this).data('link'), data,
                function(json) {
                    if(json.result == 'success') {
                        $('#emailSubsription_form .form-content').html('Prenumerata sėkmingai užsakyta');
                    }
                    else {
                        pushError(json.error);
                    }
                }, 'json'
            );

            return false;
        });
    ";
    $this->registerJs($js);
?>
