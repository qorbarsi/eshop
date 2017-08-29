<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

use dvizh\cart\widgets\ElementsList;
use dvizh\promocode\widgets\Enter;

use frontend\assets\CartAsset;

/* @var $this yii\web\View */
$this->title = Yii::t('app/frontend','Krepšelis');

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url' => '',
];

$this->params['withSignup']   = 0;
$this->params['withBenefits'] = 0;
//$this->registerJsFile('/js/cart.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
CartAsset::register($this);
?>
    <div class="shopping-cart_container">
      <div class="breadcrumbs">
          <?= Breadcrumbs::widget([
              'links' => $this->params['breadcrumbs'],
              'itemTemplate' => "<li>{link}</li>\n",
              'activeItemTemplate' => "{link}\n",
              'tag' => 'div',
              'options' => [
                  'class' => 'breadcrumbs'
              ]
          ]) ?>
      </div>
      <h1>Krepšelis</h1>
      <div class="ss_cart">
          <div class="shopping_cart_steps" id="step0">
              <?= ElementsList::widget(['type' => ElementsList::TYPE_FULL, 'elementView' => '//widgets/tomedaCardListView', 'showTotal' => true, /*'cartCssClass' => 'simpleCart_items'*/ ]); ?>
              <div class="ssc_total">
                  <?= Enter::widget(['view'=>'//widgets/tomedaPromocodeWidget', 'ok_button' => 'Pritaikyti', 'del_button' => 'Panaikinti', 'cssClass' => (yii::$app->cart->getCount() > 0) ? '' : ' hidden']); ?>
                  <a class="button <?php echo (yii::$app->cart->getCount() > 0) ? '' : 'hidden';  ?>" href="javascript:;" id="step0-button" >Užsakyti</a>
              </div>
              <div class="clear"></div>
          </div>
          <div class="desktop_steps">
              <div class="top_steps">
                  <div class="top_step selected">
                      <div class="top_step_number">1</div>
                      <div class="top_step_text">Asmeninė informacija</div>
                  </div>
                  <div class="top_step_arrow"></div>
                  <div class="top_step">
                      <div class="top_step_number">2</div>
                      <div class="top_step_text">Pristatymo adresas</div>
                  </div>
                  <div class="top_step_arrow"></div>
                  <div class="top_step">
                      <div class="top_step_number">3</div>
                      <div class="top_step_text">Apmokėjimo būdas</div>
                  </div>
                  <div class="top_step_arrow"></div>
                  <div class="top_step last">
                      <div class="top_step_number">4</div>
                      <div class="top_step_text">Užsakymo patvirtinimas</div>
                  </div>
                  <div class="clear"></div>
              </div>
          </div>
          <div class="shopping_cart_steps" id="step1" style="display:none;">
              <!-- START OF STEP1 -->
              <p class="head_instruct">Įveskite savo kontaktinę informaciją</p>

              <div class="cart_contact_details">
                  <div>
                      <label for="order_name">Vardas ir pavardė:</label><br />
                      <input class="ssc_input sc_name" id="order_name" name="name" type="text" value="" />
                      <div class="ssc_input_error">Įveskite savo vardą</div>
                  </div>
                  <div>
                      <label for="order_email">El. paštas:</label><br />
                      <input class="ssc_input sc_email" id="order_email" name="email" type="email" value="" />
                      <div class="ssc_input_error">Įveskite savo el. paštą</div>
                  </div>
                  <div>
                      <label for="order_phone">Telefonas:</label><br />
                      <input class="ssc_input sc_phone registerphone" id="order_phone" name="phone" type="tel" value="+370" />
                      <div class="ssc_input_error">Įveskite savo telefono numerį</div>
                  </div>
              </div>

              <div>
                  <a class="button" href="javascript:;">Toliau</a>
                  <a class="cart_back" href="javascript:;"><span>«</span> Atgal</a>
              </div>
              <!-- END OF STEP1 -->
          </div>

          <div class="shopping_cart_steps" id="step2" style="display:none;">
              <!-- START OF STEP2 -->
              <p class="head_instruct">Pasirinkite pristatymo būdą</p>

              <div class="cs_shipping_option not_selected" data-hiddenpayment="[2]" data-shipping="Kurjeris („LP EXPRESS“)" data-shippingtype="LP_KURJERIS">
                  <div class="bullet"><div></div></div>
                  <div class="shipping_header">
                      <p>Pristatymas kurjeriu iki Jūsų namų (arba darbo) durų</p>
                  </div>
                  <div class="shipping_info">
                      <div class="shipping_img"></div>
                      <div class="shipping_info_text">
                          Užsakymus, atliktus iki 16:00 val., „LP Express” kurjeris pristatys jau kitą darbo dieną visoje Lietuvoje.
                          <div class="desktop">Atsiskaityti galima per <span>el. bankininkystę</span> arba <span>grynais pristatymo metu</span>.</div>
                          <p class="shipping_price">Kaina: 0.00€</p>
                      </div>
                      <div class="clear"></div>
                      <div class="shipping_addition_info" data-addresstype="1">
                          <div>
                              <p>Įveskite pristatymo adresą:</p><span></span>
                          </div>
                          <div class="adress_inputs">
                              <div>
                                  <label for="lpexpress_address">Adresas:</label><br />
                                  <input id="lpexpress_address" name="shipping_address" type="text" />
                              </div>
                              <div>
                                  <label for="lpexpress_city">Miestas:</label><br />
                                  <input id="lpexpress_city" name="shipping_city" type="text" />
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="cs_shipping_option not_selected" data-hiddenpayment="[1]" data-shipping="„LP EXPRESS“ terminalas" data-shippingtype="LP_EXPRESS_TERMINALAS">
                  <div class="bullet"><div></div></div>
                  <div class="shipping_header">
                      <p>LP Express terminalas</p>
                  </div>
                  <div class="shipping_info">
                      <div class="shipping_img">&nbsp;</div>
                      <div class="shipping_info_text">
                          Galite pasirinkti terminalą šalia Jūsų ir atsiimti prekes patogiu laiku. Užsakymus, atliktus iki 16:00 val., pristatysime kitą darbo dieną.
                          <div class="desktop">Atsiskaityti galima per <span>el. bankininkystę</span> arba <span>banko kortele prie terminalo</span>.</div>
                          <p class="shipping_price">Kaina: 0.00€</p>
                      </div>
                      <div class="clear"></div>
                      <div class="shipping_addition_info" data-addresstype="2">
                          <div>
                              <p>Pasirinkite terminalą:</p> <span></span>
                          </div>
                          <select id="terminal_city">
                              <option value="Vilnius">Vilnius</option><option value="Kaunas">Kaunas</option><option value="Klaipėda">Klaipėda</option><option value="Šiauliai">Šiauliai</option><option value="Panevėžys">Panevėžys</option><option value="Alytus">Alytus</option><option value="Anykščiai">Anykščiai</option><option value="Biržai">Biržai</option><option value="Didžioji Riešė">Didžioji Riešė</option><option value="Druskininkai">Druskininkai</option><option value="Elektrėnai">Elektrėnai</option><option value="Gargždai">Gargždai</option><option value="Garliava">Garliava</option><option value="Ignalina">Ignalina</option><option value="Jonava">Jonava</option><option value="Joniškis">Joniškis</option><option value="Jurbarkas">Jurbarkas</option><option value="Kaišiadorys">Kaišiadorys</option><option value="Kėdainiai">Kėdainiai</option><option value="Kelmė">Kelmė</option><option value="Kretinga">Kretinga</option><option value="Kupiškis">Kupiškis</option><option value="Kuršėnai">Kuršėnai</option><option value="Lazdijai">Lazdijai</option><option value="Marijampolė">Marijampolė</option><option value="Mažeikiai">Mažeikiai</option><option value="Naujoji Akmenė">Naujoji Akmenė</option><option value="Palanga">Palanga</option><option value="Pasvalys">Pasvalys</option><option value="Plungė">Plungė</option><option value="Prienai">Prienai</option><option value="Radviliškis">Radviliškis</option><option value="Raseiniai">Raseiniai</option><option value="Rokiškis">Rokiškis</option><option value="Šakiai">Šakiai</option><option value="Šilalė">Šilalė</option><option value="Šilutė">Šilutė</option><option value="Tauragė">Tauragė</option><option value="Telšiai">Telšiai</option><option value="Ukmergė">Ukmergė</option><option value="Utena">Utena</option><option value="Varėna">Varėna</option><option value="Vilkaviškis">Vilkaviškis</option><option value="Visaginas">Visaginas</option><option value="Zarasai">Zarasai</option> </select> <select data-mode="reloadpacks" data-target="pack-size" id="terminal_id" name="terminal_id"><option value="">-- Pasirinkite --</option><option value="Gedimino pr. 7 (Centrinis paštas)">Gedimino pr. 7 (Centrinis paštas)</option><option value="Liepkalnio g. 112 (Maxima XX)">Liepkalnio g. 112 (Maxima XX)</option><option value="Ozo g. 25 (Akropolis)">Ozo g. 25 (Akropolis)</option><option value="P. Lukšio g. 34 (Banginis)">P. Lukšio g. 34 (Banginis)</option><option value="Ukmergės g. 282 (Maxima XXX)">Ukmergės g. 282 (Maxima XXX)</option><option value="Architektų g. 43 (IKI Papartis)">Architektų g. 43 (IKI Papartis)</option><option value="Bajorų kelias 4 (IKI Visoriai)">Bajorų kelias 4 (IKI Visoriai)</option><option value="Baltupio g. 10 (Statoil)">Baltupio g. 10 (Statoil)</option><option value="Fabijoniškių g. 2A (IKI Fabijoniškės)">Fabijoniškių g. 2A (IKI Fabijoniškės)</option><option value="Geležinkelio g. 16 (Geležinkelio stotis)">Geležinkelio g. 16 (Geležinkelio stotis)</option><option value="J. Jasinskio g. 16 (Verslo trikampis)">J. Jasinskio g. 16 (Verslo trikampis)</option><option value="J. Tiškevičiaus g. 22 (Maxima XX)">J. Tiškevičiaus g. 22 (Maxima XX)</option><option value="Laisvės pr. 43C (Statoil)">Laisvės pr. 43C (Statoil)</option><option value="Mindaugo g. 25 (IKI Mindaugo)">Mindaugo g. 25 (IKI Mindaugo)</option><option value="Naugarduko g. 84 (Maxima XX)">Naugarduko g. 84 (Maxima XX)</option><option value="Nemenčinės pl. 2 (IKI Antakalnis)">Nemenčinės pl. 2 (IKI Antakalnis)</option><option value="Ozo g. 18 (Ozas)">Ozo g. 18 (Ozas)</option><option value="Pilaitės pr. 31 (Maxima XX)">Pilaitės pr. 31 (Maxima XX)</option><option value="Saltoniškių g. 9 (Panorama)">Saltoniškių g. 9 (Panorama)</option><option value="Taikos g. 162A (Maxima XX)">Taikos g. 162A (Maxima XX)</option><option value="Tuskulėnų g. 66 (Maxima XX)">Tuskulėnų g. 66 (Maxima XX)</option><option value="Ukmergės g. 369 (BIG)">Ukmergės g. 369 (BIG)</option><option value="Žalgirio g. 105 (Maxima XX)">Žalgirio g. 105 (Maxima XX)</option><option value="Žirmūnų g. 2 (IKI Minskas)">Žirmūnų g. 2 (IKI Minskas)</option>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="cs_shipping_option not_selected" data-hiddenpayment="[1,2]" data-shipping="Paštas" data-shippingtype="LP_PASTAS">
                  <div class="bullet"><div></div></div>
                  <div class="shipping_header">
                      <p>Pristatymas paštu</p>
                  </div>
                  <div class="shipping_info">
                      <div class="shipping_img"></div>
                      <div class="shipping_info_text">
                          Pristatymas registruotu paštu visoje Lietuvoje nurodytu adresu.<br />
                          Pristatymo laikas: 2-3 darbo dienos.
                          <div class="desktop">Atsiskaityti galima per <span>el. bankininkystę</span>.</div>
                          <p class="shipping_price">Kaina: 0.00€</p>
                      </div>
                      <div class="clear"></div>
                      <div class="shipping_addition_info" data-addresstype="1">
                          <div>
                              <p>Įveskite pristatymo adresą:</p> <span></span>
                          </div>
                          <div class="adress_inputs">
                              <div>
                                  <label for="post_address">Adresas:</label><br />
                                  <input id="post_address" name="shipping_address" type="text" />
                              </div>
                              <div>
                                  <label for="post_city">Miestas:</label><br />
                                  <input id="post_city" name="shipping_city" type="text" />
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div>
                  <a class="button" href="javascript:;">Toliau</a><span class="no_shipping_selected"></span>
                  <a class="cart_back" href="javascript:;"><span>«</span> Atgal</a>
              </div>
              <!-- END OF STEP2 -->
          </div>

          <div class="shopping_cart_steps" id="step3" style="display:none;">
              <!-- START OF STEP3 -->
              <p class="head_instruct">Pasirinkite apmokėjimo būdą</p>
              <div class="cs_payment_option" data-payment="El. bankininkystė (Paysera)" data-paymenttype="paysera" data-paysera="1" data-paymentcode="paysera">
                  <div class="bullet"><div></div></div>
                  <div class="payment_header">
                      <p>El. bankininkystė (Paysera)</p>
                  </div>
                  <div class="payment_info">
                      <div class="payment_img"></div>
                      <div class="payment_info_text">Užsakymą galite apmokėti prisijungiant prie internetinės bankininkystės.</div>
                      <div class="clear"></div>
                  </div>
              </div>

              <div class="cs_payment_option" data-payment="Grynais pristatymo metu" data-paymenttype="cod" data-paymentcode="GRYNAIS">
                  <div class="bullet"><div></div></div>
                  <div class="payment_header">
                      <p>Grynais pristatymo metu</p>
                  </div>
                  <div class="payment_info">
                      <div class="payment_img"></div>
                      <div class="payment_info_text">Galite atsiskaityti grynais pinigais, kai kurjeris pristatys prekes.</div>
                      <div class="clear"></div>
                  </div>
              </div>

              <div class="cs_payment_option" data-payment="Atsiskaitymas kortele prie terminalo" data-paymenttype="lp-terminal-card" data-paymentcode="KORTELE">
                  <div class="bullet"><div></div></div>
                  <div class="payment_header">
                      <p>Atsiskaitymas kortele prie terminalo</p>
                  </div>
                  <div class="payment_info">
                      <div class="payment_img"></div>
                      <div class="payment_info_text">Galite apmokėti užsakymą banko kortele atsiimant prekes iš terminalo.</div>
                      <div class="clear"></div>
                  </div>
              </div>

              <p class="head_instruct comment_head">Galite palikti komentarą prie savo užsakymo</p>
              <textarea id="order_comment"></textarea>

              <div>
                  <a class="button" href="javascript:;">Toliau</a><span class="no_payment_selected"></span>
                  <a class="cart_back" href="javascript:;"><span>«</span> Atgal</a>
              </div>
              <!-- END OF STEP3 -->
          </div>

          <div class="shopping_cart_steps" id="step4" style="display:none;">
              <!-- START OF STEP4 -->
              <div class="mobile_padding">
                  <p class="head_instruct">Užsakymo suvestinė</p>
                  <div class="product_summary">
                      <div class="product_sum_row">
                          <div class="product_sum_name head"></div>
                          <div class="product_sum_qnty head">Kiekis</div>
                          <div class="product_sum_price head">Kaina</div>
                          <div class="product_sum_sum head">Suma</div>
                      </div>
                  </div>
              </div>

              <div class="ssc_total">
                  <div class="ssc_total_row ssc_cart_total">
                      <div class="ssc_total_desc">Suma:</div>
                      <div class="ssc_total_sum">0.00€</div>
                  </div>

                  <div class="ssc_total_row ssc_cart_shipping">
                      <div class="ssc_total_desc">Pristatymas:</div>
                      <div class="ssc_total_sum">0.00€</div>
                  </div>

                  <div class="ssc_total_row ssc_cart_discount">
                      <div class="ssc_total_desc">Nuolaida:</div>
                      <div class="ssc_total_sum">0.00€</div>
                  </div>

                  <div class="ssc_total_row ssc_cart_grand_total">
                      <div class="ssc_total_desc">Viso mokėti:</div>
                      <div class="ssc_total_sum">0.00€</div>
                  </div>

                  <div class="paysera-payment-block">
                      <div>
                          <p class="head_instruct">Pasirinkite banką apmokėjimui <span class="no_bank_selected">Pasirinkite savo banką</span></p>
                          <select id="mobile_bank_selcet">
                              <option value="">--- Pasirinkite banką ---</option>
                              <option value="hanza">Swedbank</option>
                              <option value="vb2">SEB</option>
                              <option value="nord">DNB</option>
                              <option value="sb">Šiaulių bankas</option>
                              <option value="mb">Medicinos Bankas</option>
                              <option value="lku">Lietuvos kredito unija</option>
                              <option value="sampo">Danske</option>
                              <option value="parex">Citadele</option>
                              <option value="nordealt">Nordea</option>
                              <option value="wallet">Paysera</option>
                          </select>

                          <ul class="paysera-payment">
                              <li class="paysera-banks" id="hanza">Swedbank</li>
                              <li class="paysera-banks" id="vb2">SEB</li>
                              <li class="paysera-banks" id="nord">DNB</li>
                              <li class="paysera-banks" id="sb">Šiaulių bankas</li>
                              <li class="paysera-banks" id="mb">Medicinos Bankas</li>
                              <li class="paysera-banks" id="lku">Lietuvos kredito unija</li>
                              <li class="paysera-banks" id="sampo">Danske</li>
                              <li class="paysera-banks" id="parex">Citadele</li>
                              <li class="paysera-banks" id="nordealt">Nordea</li>
                              <li class="paysera-banks" id="wallet">Paysera</li>
                          </ul>
                      </div>
                      <div class="clear"></div>
                  </div>
                  <a class="button" href="javascript:;" id="confirm_order">Patvirtinti užsakymą</a>
                  <a class="cart_back" href="javascript:;"><span>«</span> Atgal</a>
              </div>

              <form action="<?= Url::to(['paysera/paysera/redirect']) ?>" id="paysera-form" method="POST">
                  <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                  <input name="order_id" type="hidden" value="" /><input name="payment_bank" type="hidden" value="" />
              </form>
              <!-- END OF STEP4 -->
          </div>

          <div id="success_block" style="display:none;">
              <!-- START OF SUCCESS -->
              <div class="s-anim">
                  <div class="s-bags"></div>
                  <div class="s-check"></div>
                  <div class="s-text">Puiku!</div>
              </div>
              <div class="s-points">
                  <div class="s-point">
                      <span>1</span>
                      <p class="s-head">Jūsų užsakymas sėkmingai pateiktas.</p>
                      <p>Visą užsakymo patvirtinimo informaciją išsiuntėme Jūsų nurodytu el. pašto adresu.</p>
                  </div>
                  <div class="s-point">
                      <span>2</span>
                      <p class="s-head">Dėkojame, kad pasirinkote apsipirkimui mūsų e-parduotuvę „<?= Yii::$app->params['storeName'] ?>“.</p>
                      <p>Jaučiame didelę atsakomybę, todėl iš visų jėgų stengsimės, kad mūsų produktų kokybė ir aptarnavimas Jūsų nenuviltų!</p>
                  </div>
              </div>
              <!-- END OF SUCCESS -->
          </div>

          <div id="cancel_block" style="display:none;">
              <!-- START OF CANCEL -->
              <p>Dėl tam tikrų techninių priežaščių Jums nepavyko apmokėti savo užsakymo.</p>
              <p>Ką daryti tokiu atveju:</p>
              <ol>
                  <li>Visa užsakymo informacija buvo išsaugota mūsų sistemoje, bet nebuvo nepateikta apdorojimui. Jūs galite paskambinti mums arba parašyti SMS ir pranešti, kad norite apmokėti užsakymą grynais.</li>
                  <li>Jeigu norite mokėti per el. bankininkystę, Jums reikės pakartoti užsakymą.</li>
                  <li>Jeigu neveikia banko puslapis arba trūksta pinigų sąskaitoje, Jūs visada galite pasirinkti kitą mokėjimo būdą užsakymo metu.</li>
                  <li>Jeigu turite kitų klausimų, parašykite mums el. paštu arba skambinkite telefonu</li>
              </ol>
              <!-- END OF CANCEL -->
          </div>

          <div class="cart_black_bg"></div>

          <script>
              shippingTypeList = [];
              paymentTypeList = [];
              <?php foreach($shippingTypesList as $sht) { ?>
                  shippingTypeList["<?=strtoupper($sht->description);?>"] = <?=$sht->id;?>;
              <?php } ?>
              <?php foreach($paymentTypesList as $pmt) { ?>
                  paymentTypeList["<?=strtoupper($pmt->name);?>"] = <?=$pmt->id;?>;
              <?php } ?>
          </script>
      </div>
    </div>
    <?php
        $elements =  yii::$app->cart->elements;
        $js = '';
        if (!empty($elements)) {
            foreach ($elements as $element) {
                $img = $element->getModel()->getImage()->getUrl('88x88');
                $js .= 'item = simpleCart.add({id:'.$element->id.' ,name: "'.Html::encode($element->name).'" ,price: '.$element->price.' , quantity: '.$element->count.', thumb: "'.$img.'", productimg: "'.$img.'" }); '."\n";
            }
        }
        $code = yii::$app->promocode->get();
        $code = isset($code->promocode) ? $code->promocode : null ;
        $js .= 'discount = 0; '."\n";
        $js .= 'discount_type = 0;'."\n";
        if ( !empty($code) ) {
            $js .= 'promocode = "'.$code->code.'";'."\n";
            if ($code->type == 'quantum') {
                $js .= 'discount_type = 2;'."\n";
            } else {
                $js .= 'discount_type = 1;'."\n";
            }
            $js .= 'discount = '.$code->discount.'; '."\n";
        }

        $js .= 'orderUrl = "'.Url::toRoute(['/order/order/create']).'";'."\n";

        $this->registerJs($js);
    ?>
