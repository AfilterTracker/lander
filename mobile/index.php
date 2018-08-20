<?php
ini_set('error_reporting', 0);

const API_URL = 'https://api.adcombo.com/api/v2/order/create/';
const API_KEY = 'bd50ecc788397512eb571cf1ac79d127';
const COUNTRIES = array('IT');

function log_order($request_url, $response)
{
    $ip = $_REQUEST['REMOTE_ADDR'];
    $date_now = date('Y-m-d H:i:s');
    $fp = fopen('orders.txt', 'a+');
    fwrite($fp, "Offer id: 2999\nIP: {$ip}\nDate: {$date_now}\nRequest url: {$request_url}\nResponse: {$response}\n\n\n=====================\n\n\n");
    fclose($fp);
}

function is_mobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function redirect($path) {
    header('Location: ' . $path);
    echo '<meta http-equiv="refresh" content="0;url=' . $path . '">';
    exit();
}

if (file_exists('mobile') && is_mobile()) {
    redirect('mobile');
}

if (isset($_REQUEST['price']))
{
    $params = $_REQUEST;

    if (!isset($params['country_code'])) {
        $params['country_code'] = COUNTRIES[array_rand(COUNTRIES)];
    }

    $params['api_key'] = API_KEY;
    $params['offer_id'] = '2999';
    $params['base_url'] = $_SERVER['REQUEST_URI'];
    $params['referrer'] = $_SERVER['HTTP_REFERER'];
    $params['ip'] = $_SERVER['REMOTE_ADDR'];
    $parsed_referer = parse_url($_SERVER['HTTP_REFERER']);
    parse_str($parsed_referer['query'], $land_params);

    $request_url = API_URL . '?' . http_build_query($params + $land_params);

    $resp = file_get_contents($request_url);
    log_order($request_url, $resp);
    $data = json_decode($resp, true);

    if ($data['code'] == 'ok') {
        $order_data = base64_encode($params['name'] . '|' . $params['phone']);
        redirect('success.php?order_data=' . $order_data);
    }
}
?>
<!DOCTYPE html>
<html class="">
 <head>
  <!-- [pre]land_id =  -->
  <script>
   var acrum_extra = {"esub":"-7EBRQCgQAAANmiwO3CwAAA0glAAMPZWB6WxERChEJChENQhENWgABf2FkY29tYm__NjAzOGEzNmQAAzhm","ip_city":"","offer_id":2999,"location":null,"type":"landing","id":9544,"ccodes":[]};
  </script>
  <!--suppress ES6ConvertVarToLetConst -->
  <script>
   var lang_locale = "en";
  </script>
  <!-- browser locale -->
  <script type="text/javascript">
   var ccode = "EN"; var ip_ccode = "EN"; var package_prices = {"1":{"price":39,"old_price":78,"price_w_vat":48,"shipment_price":0},"3":{"price":78,"old_price":156,"price_w_vat":95,"shipment_price":0},"5":{"price":117,"old_price":234,"price_w_vat":143,"shipment_price":0},"7":{"price":156,"old_price":312,"price_w_vat":190,"shipment_price":0}}; var shipment_price = 0; var name_hint = "Adriana Bellini"; var phone_hint = "+39 XX XXX XXXX"; var iew = false; var offer_countries = {};
  </script>
  <script src="js/jquery-1.12.4.min.js" type="text/javascript">
  </script>
  <script src="js/placeholders-3.0.2.min.js" type="text/javascript">
  </script>
  <script src="js/moment-with-locales-2.18.1.min.js" type="text/javascript">
  </script>
  <script src="js/dr-dtime.js" type="text/javascript">
  </script>
  <script src="js/order_me.js" type="text/javascript">
  </script>
  <link href="css/order_me.css" media="all" rel="stylesheet" type="text/css"/>
  <script src="js/validation.js" type="text/javascript">
  </script>
  <script src="js/video_avid.js" type="text/javascript">
  </script>
  <script>
   function move_next(a, obj) {
        {
            if (!Object.keys) {
                Object.keys = function (obj) {
                    var keys = [];
                    for (var i in obj) {
                        if (obj.hasOwnProperty(i)) {
                            keys.push(i);
                        }
                    }
                    return keys;
                };
            }
            var redirect_url = "";
            if (obj !== undefined) {
                redirect_url += '&' + Object.keys(obj).map(k => k + '=' + encodeURIComponent(obj[k])).join('&');
            }
            var background_url = "";
            if (background_url === "" &&
                location.protocol === "http:" &&
                window.domain_has_valid_cert === true &&
                window.sawpp !== true) {
                // xxx: push notifications
                background_url = location.href.replace('http', 'https').replace('#init', '');
                var sep = '&';
                if (background_url.indexOf('?') === -1) {
                    sep = '?';
                }
                background_url += sep + 'showing_push_=1';
            }
            if (background_url !== '') {
                location.replace(background_url);
            }
            $(window).off("beforeunload");
            a.preventDefault();
            a.stopPropagation();
            setTimeout(function () {
                window.show_pushwru_show && window.show_pushwru_show();
            }, 250);
            var open_target = getParameterByName('open_target');
            open_target === 'self' ?
              window.open(redirect_url, "_self") :
              window.open(redirect_url);
        }
    }
    function onEtag (etag) {
        console.log(etag);
        var img = new Image(1, 1);
        img.src = 'https://xl-trk.com/track.gif?' +
            'a=pat' +
            '&b=' + etag +
            '&c=' + acrum_extra.type +
            '&d=' + acrum_extra.offer_id +
            '&e=' + acrum_extra.id +
            '&f=' + acrum_extra.esub;
    }
    $(document).ready(function () {

        window.domain_has_valid_cert = true;
        window.show_gdpr_warning = false;

        // if we are on https and have sppp_ in location then showing push immediately
        // xxx: push notifications
        if (location.protocol === 'https:' &&
            window.sawpp !== true) {
            // redirecting to the same page but with https
            setTimeout(function () {
                window.show_pushwru_show && window.show_pushwru_show();
            }, 250);
        }
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

        
        
    });

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    function hide_warn() {
        $('.ac_gdpr_fix').hide();
    }
  </script>
  <style>
   .ac_footer {
        position: relative;
        top: 10px;
        height: 0;
        text-align: center;
        margin-bottom: 70px;
        color: #A12000;
    }

    .ac_footer a {
        color: #A12000;
    }

    .ac_footer p {
        text-align: center;
    }

    img[height="1"], img[width="1"] {
        display: none !important;
    }
  </style>
  <!--retarget-->
  <!--retarget-->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
  <meta charset="utf-8"/>
  <meta content="width=device-width" name="viewport"/>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,greek-ext,latin-ext,cyrillic" rel="stylesheet" type="text/css"/>
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic&subset=latin,greek-ext,latin-ext,cyrillic" rel="stylesheet" type="text/css">
   <link href="http://fonts.googleapis.com/css?family=Lobster&subset=latin,greek-ext,latin-ext,cyrillic" rel="stylesheet" type="text/css"/>
   <title>
    Varikosette
   </title>
   <link href="css/style.css" rel="stylesheet"/>
   <link href="css/owl.carousel.css" rel="stylesheet"/>
   <link href="css/owl.theme.css" rel="stylesheet"/>
  </link>
 </head>
 <body data-lang="IT">
  <!--retarget-->
  <!--retarget-->
  <div class="wrapper hidejs s__main">
   <header>
    <div class="page-wrapper__inner transitionall">
     <a class="show" href="#">
      <img alt="gsdgsd" class="center-block" src="images/header_logo_new.png"/>
     </a>
     <img alt="" class="product_img" src="images/product.png" width="150"/>
     <h1>
      Sbarazzati delle vene varicose
     </h1>
     <div class="c-blue text-center">
      senza chirurgia né procedure mediche
     </div>
     <div class="mt20">
     </div>
     <div class="text-center">
      Prezzo normale:
      <span class="tdlh ">
       78
      </span>
      €
     </div>
     <div class="newprice text-center">
      EFFETTUA IL TUO ORDINE A UN PREZZO INCREDIBILE:
      <span>
       39
      </span>
      €
     </div>
     <div class="for-event button pre_toform">
      ORDINA
     </div>
    </div>
   </header>
   <div class="slide2">
    <div class="page-wrapper__inner">
     <ul>
      <li>
       Aiuta contro le ulcere
      </li>
      <li>
       Favorisce una corretta circolazione del sangue
      </li>
      <li>
       Rinforza le pareti venose
      </li>
      <li>
       Elimina la pesantezza ai piedi
      </li>
      <li>
       Riduce la formazione di coaguli di sangue
      </li>
      <li>
       Migliora il funzionamento delle valvole venose
      </li>
      <li>
       Migliora il drenaggio dei tessuti
      </li>
     </ul>
    </div>
   </div>
   <div class="slide3">
    <div class="page-wrapper__inner">
     <h2 class="c-blue">
      <b>
       Crema anti-vene varicose
       <br/>
       Varikosette
      </b>
     </h2>
     <!--<img alt="gg" class="imgs3" src="img/imgs3.png">-->
     <p>
      Trattamento completo che previene la comparsa delle vene varicose. Basta solo usarla! Elimina la comparsa
                delle vene varicose, tonifica la pelle e rinforza le pareti venose in modo delicato ed efficace. Un
                metodo eccellente per prevenire e curare quelle già visibili. È l'ancora di salvezza che avresti dovuto
                trovare prima!
     </p>
    </div>
   </div>
   <div class="slide4">
    <div class="page-wrapper__inner">
     <h2 class="text-center">
      <b>
       COME FUNZIONA
      </b>
     </h2>
     <div class="text-center s4">
      <img alt="s4" src="images/s4i.jpg"/>
     </div>
     <p>
      <span class="s4arrow">
      </span>
      Grazie alla sua formula unica, Varikosette funziona in modo sicuro ed
                efficace eliminando i sintomi generali dei processi infiammatori e alleviando il dolore. L'uso regolare
                della crema migliora la circolazione sanguigna, oltre a rinforzare e a tonificare le pareti venose.
      <br/>
      Varikosette
                elimina anche altri sintomi come la pelle d'oca, le mani e i piedi freddi e la stanchezza; il peso è
                molto importante anche in questi casi.
     </p>
    </div>
   </div>
   <div class="slide5">
    <div class="page-wrapper__inner">
     <h2 class="c-blue text-center">
      <b>
       Il parere degli esperti:
      </b>
     </h2>
     <div class="mt20">
     </div>
     <ul class="bxslider">
      <li>
       <div class="dtable">
        <!--<div class="dtc">
                                                                                <img src="img/client3.jpg" alt="gdsg">
                                                                            </div>-->
        <div class="dtc revname">
         Lucia Collasanti
         <br/>
         28 anni
        </div>
       </div>
       <p>
        Dopo la gravidanza e il parto ho iniziato ad avere problemi di circolazione alle gambe: mi
                        facevano molto male e sono comparse le varici. Sono andata dal flebologo, che mi ha consigliato
                        una crema anti-varici da applicare due volte al giorno.

                        Dopo cinque giorni le mie vene erano migliorate, la pelle era tornata alla normalità e le varici
                        erano scomparse. Non mi facevano più male e il gonfiore era andato giù. Continuo con il
                        trattamento e va molto bene, ora sto meglio.
       </p>
       <div class="text-center">
        <img alt="ggg" src="images/block_10_foto1.jpg"/>
       </div>
       <div class="mt20">
       </div>
      </li>
      <li>
       <div class="dtable">
        <!--<div class="dtc">
                                                                                <img src="img/client2.jpg" alt="gdsg">
                                                                            </div>-->
        <div class="dtc revname">
         Benedetta Savalli
         <br/>
         47 anni
        </div>
       </div>
       <p>
        Nel mio caso le vene varicose sono un problema cronico. Ho provato pillole, creme e gel per
                        dieci anni, ma l'unica cosa che ha funzionato su di me è stata Varikosette. Si tratta di una
                        crema molto buona che si assorbe rapidamente e agisce velocemente. Ora non ho più nessuna
                        sensazione di bruciore. Inoltre, non causa reazioni allergiche, e io sono incline alle allergie!
                        Il gonfiore e l'infiammazione sono scomparsi a poco a poco, non tanto velocemente quanto avrei
                        voluto, ma posso dimenticarli per sempre! Senza contare che adesso le mie gambe sono più
                        leggere. Anche se viene usata molto, gli effetti sono sempre visibili, il corpo non si assuefa.
       </p>
       <div class="text-center">
        <img alt="ggg" src="images/block_10_foto2.jpg"/>
       </div>
       <div class="mt20">
       </div>
      </li>
      <li>
       <div class="dtable">
        <!--<div class="dtc">
                                                                                <img src="img/client1.png" alt="gdsg">
                                                                            </div>-->
        <div class="dtc revname">
         Gabriella Natoli
         <br/>
         58 anni
        </div>
       </div>
       <p>
        Io ero al secondo stadio di varici, le vene erano molto visibili, le gambe mi si gonfiavano e la
                        pelle era molto secca. Mia figlia mi ha comprato questa crema, ma non credevo che sarebbe stata
                        così efficace, visto che gli altri metodi non mi avevano aiutata.

                        Uso continuamente la crema da quasi un anno e i risultati sono impressionanti! La mia pelle sta
                        molto meglio, è più viva e ben idratata. A poco a poco il dolore e il gonfiore sono scomparsi e
                        dopo un mese le vene visibili sono sparite, mentre quelle in rilievo sono diventate lisce. Sono
                        molto soddisfatta dei risultati!
       </p>
       <div class="text-center">
        <img alt="ggg" src="images/block_10_foto3.jpg"/>
       </div>
       <div class="mt20">
       </div>
      </li>
      <li>
       <div class="dtable">
        <!--<div class="dtc">
                                                                                <img src="img/client1.png" alt="gdsg">
                                                                            </div>-->
        <div class="dtc revname">
         Ettore Modigliano
         <br/>
         65 anni
        </div>
       </div>
       <p>
        Mia moglie mi dava un sacco di strigliate perché ho le vene visibili e le ignoro. Ce le ho sulle
                        braccia, molto stanche e con una sensazione di freddo continua. Così mi ha comprato questa crema
                        ed è sempre lei a spalmarmela.

                        Mi piace quando me la mette, perché mi fa un massaggio e la crema ha un effetto caldo, il che mi
                        dà sollevo, visto che le mie braccia sono sempre fredde. Dopo 10 giorni il tono della mia pelle
                        è cambiato e le vene si notano meno. Sono molto felice perché sto molto meglio, il dolore è
                        scomparso!
       </p>
       <div class="text-center">
        <img alt="ggg" src="images/block_10_foto4.jpg"/>
       </div>
       <div class="mt20">
       </div>
      </li>
     </ul>
    </div>
   </div>
   <footer>
    <div class="page-wrapper__inner transitionall">
     <h2>
      <br/>
      <b>
       Ordina subito
      </b>
     </h2>
     <form action="" id="order_form" method="post">
      <input name="total_price" type="hidden" value="39.0"/>
      <input name="shipment_price" type="hidden" value="0"/>
      <input name="template_name" type="hidden" value="tE_Varikosette_IT_blueN"/>
      <input name="price" type="hidden" value="39"/>
      <input name="total_price_wo_shipping" type="hidden" value="39.0"/>
      <input name="package_prices" type="hidden" value="{u'1': {'price': 39, 'old_price': 78, 'price_w_vat': 48, 'shipment_price': 0}, u'3': {'price': 78, 'old_price': 156, 'price_w_vat': 95, 'shipment_price': 0}, u'5': {'price': 117, 'old_price': 234, 'price_w_vat': 143, 'shipment_price': 0}, u'7': {'price': 156, 'old_price': 312, 'price_w_vat': 190, 'shipment_price': 0}}"/>
      <input name="currency" type="hidden" value="€"/>
      <input name="package_id" type="hidden" value="1"/>
      <input name="country_code" type="hidden" value="IT"/>
      <input name="shipment_vat" type="hidden" value="0.22"/>
      <input name="old_price" type="hidden" value="78"/>
      <input name="price_vat" type="hidden" value="0.22"/>
      <div class="s__on">
       <select class="inp" id="country_code_selector">
        <option value="IT">
         Italy
        </option>
       </select>
       <p style="text-align:left;font-size: 12px;padding-bottom: 15px;">
        Ad esempio: Carla Verdi
       </p>
       <input class="inp" name="name" placeholder="Ad esempio" type="text"/>
       <p style="text-align:left;font-size: 12px;padding-bottom: 15px;">
        Ad esempio: (+39) 041 6354982
       </p>
       <input class="inp only_number" name="phone" placeholder="Ad esempio" type="text"/>
       <div class="dtable">
        <div class="w50 dtc">
         Prezzo normale:
         <br/>
         <span class="tdlh">
          78
         </span>
         €
        </div>
        <div class="dtc text-right fs24f">
         PREZZO INCREDIBILE:
         <span>
          39
         </span>
         €
        </div>
       </div>
       <!-- -->
       <div class="button button__text js_pre_toform">
        Ordina subito
       </div>
       <div class="toform">
       </div>
       <!-- -->
      </div>
     </form>
    </div>
   </footer>
  </div>
  <script src="js/owl.carousel.min.js">
  </script>
  <script src="js/common.js" type="text/javascript">
  </script>
  <link href="//dadbab.info/content/second/js_for_sp2_v2/jquery.modal.min.css" rel="stylesheet" type="text/css"/>
  <script src="//dadbab.info/content/second/js_for_sp2_v2/jquery.modal.min.js">
  </script>
  <script src="//dadbab.info/content/second/js_for_sp2_v2/jquery.countdown.js">
  </script>
  <script>
   var sp_form_fields = {
        IN: {
          hint: "यह फील्ड भरी नहीं ह",
          input: {
        	street:{
				desc:'गली',
				req:true,
				add:'गली '
			},
			house:{
				desc:'घर संख्या',
				req:true,
				add:', '
			},
			entrance:{
				desc:'प्रवेश',
				req:true,
				add:', '
			},
			floor:{
				desc:'मंज़िल',
				req:true,
				add:', मंज़िल-'
			},
			apartment:{
				desc:'अपार्टमेंट',
				req:true,
				add:', अपार्टमेंट-'
			},
          	city:{
				desc:'शहर',
				req:true,
				add:', '
			},
			postal_code:{
				desc:'पोस्टकोड',
				req:true,
				add:', '
			},
          	comment:{
				desc:'कोरियर के लिए संदेश',
				req:false
            }
      }
    },
	ES:{
		hint:'El campo está vacío',
		input:{
			street:{
				desc:'Calle',
				req:true,
				add:'Calle '
			},
			house:{
				desc:'Numero de casa',
				req:true,
				add:', '
			},
			entrance:{
				desc:'Portal / Escalera',
				req:true,
				add:', '
			},
			floor:{
				desc:'Planta',
				req:true,
				add:', planta-'
			},
			apartment:{
				desc:'Puerta',
				req:true,
				add:', puerta-'
			},
          	city:{
				desc:'Ciudad',
				req:true,
				add:', '
			},
			postal_code:{
				desc:'Codigo postal',
				req:true,
				add:', '
			},
          	comment:{
				desc:'Comentario para la mensajeria',
				req:false
            }
		}
	},
	PL:{
		hint:'Pole nie wypełnione',
		input:{
			street:{
				desc:'Ulica',
				req:true,
				add:'ul. '
			},
			house:{
				desc:'Nr domu',
				req:true,
				add:' '
			},
			apartment:{
				desc:'Nr mieszkania',
				req:true,
				add:'/'
			},
			floor:{
				desc:'Piętro',
				req:false,
				add:' '
			},
			postal_code:{
				desc:'Kod pocztowy',
				req:true,
				add:' '
			},
			city:{
				desc:'Miejscowość',
				req:true,
				add:' '
			},
          	comment:{
				desc:'Uwagi dla kuriera',
				req:false
            }
		}
	},
	IT:{
		hint:'Campo non compilato',
		input:{
			postal_code:{
				desc:'CAP',
				req:true
			},
          	city:{
				desc:'Citta`',
				req:true,
				add:' '
			},
          	street:{
				desc:'Via',
				req:true,
				add:', '
			},
			house:{
				desc:'Numero civico',
				req:true,
				add:' '
			},
			entrance:{
				desc:'Scala',
				req:false,
				add:' scala '
			},
			floor:{
				desc:'Piano',
				req:false,
				add:', '
			},
			apartment:{
				desc:'Numero interno',
				req:true,
				add:', int.'
			},
          	comment:{
				desc:'Commenti per il corriere',
				req:false
            }
		}
	},
	ZA:{
		hint:'Die veld is leeg',
		input:{
			postal_code:{
				desc:'POSKODE',
				req:true
			},
          	city:{
				desc:'Stad',
				req:true,
				add:' '
			},
          	street:{
				desc:'Straat',
				req:true,
				add:', '
			},
			house:{
				desc:'Nommer',
				req:true,
				add:', '
			},
			entrance:{
				desc:'Gebou',
				req:false,
				add:', '
			},
			floor:{
				desc:'Vloer',
				req:false,
				add:', '
			},
			apartment:{
				desc:'Interne nommer',
				req:true,
				add:', '
			},
          	comment:{
				desc:'Kommentaar vir die diensverskaffer',
				req:false
            }
		}
	},
	PT:{
		hint:'Campo não preenchido',
		input:{
			street:{
				desc:'Rua',
				req:true
			},
			house:{
				desc:'Casa',
				req:true,
				add:', '
			},
			entrance:{
				desc:'Portão',
				req:false,
				add:', portão '
			},
			floor:{
				desc:'Andar',
				req:false,
				add:', ',
              	ade:' andar'
			},
			apartment:{
				desc:'Apartamento',
				req:true,
				add:', ap.'
			},
          	city:{
				desc:'Cidade',
				req:true,
				add:', '
			},
          	postal_code:{
				desc:'Código postal',
				req:true,
				add:' '
			},
          	comment:{
				desc:'Comentário para a transportadora',
				req:false
            }
		}
	},
	RO:{
		hint:'Câmpul nu a fost completat',
		input:{
			postal_code:{
				desc:'Cod postal',
				req:true
			},
          	district:{
				desc:'Judet',
				req:true,
				add:', judetul '
            },
          	city:{
				desc:'Localitatea',
				req:true,
				add:', localitatea '
			},
          	street:{
				desc:'Strada',
				req:true,
				add:', strada '
			},
			house:{
				desc:'Nr',
				req:true,
				add:', nr. '
			},
          	housing:{
				desc:'Bloc',
				req:true,
				add:', bl. '
			},
			entrance:{
				desc:'Scara',
				req:true,
				add:', sc. '
			},
			floor:{
				desc:'Etaj',
				req:true,
				add:', et. '
			},
			apartment:{
				desc:'Apartament',
				req:true,
				add:', ap. '
			},
          	comment:{
				desc:'Comentarii serviciu curierat',
				req:false
            }
		}
	},
	FR:{
		hint:'Le champs n\'a pas été renseigné',
		input:{
			house:{
				desc:'numéro du bâtiment',
				req:true
			},
          	street:{
				desc:'nom de la rue',
				req:true,
				add:' '
			},
            postal_code:{
				desc:'code postal',
				req:true,
				add:' '
			},
          	city:{
				desc:'nom de la ville',
				req:true,
				add:' '
			},
			entrance:{
				desc:'entrée',
				req:false,
				add:' '
			},
			floor:{
				desc:'étagé',
				req:false,
				add:' '
			},
			apartment:{
				desc:'numéro de l\'appartement',
				req:false,
				add:' '
			},
          	comment:{
				desc:'Commentaire pour le facteur',
				req:false
            }
		}
	},
	GR:{
		hint:'Το πεδίο δεν έχει συμπληρωθεί',
		input:{
			street:{
				desc:'Οδός',
				req:true
			},
            house:{
				desc:'Αρ.Κτιρίου',
				req:true,
				add:' '
			},
          	district:{
				desc:'Περιοχή',
				req:true,
				add:', '
            },
          	city:{
				desc:'Πόλη',
				req:true,
				add:', '
			},
          	postal_code:{
				desc:'Ταχ.Κώδικας',
				req:true,
				add:', '
			},
			entrance:{
				desc:'Είσοδος',
				req:false,
				add:', '
			},
            locality:{
				desc:'Συνοικισμός',
				req:{
                  GR:true,
                  CY:false
                },
				add:', '
			},
			floor:{
				desc:'Όροφος',
				req:{
                  GR:false,
                  CY:true
                },
				add:', '
			},
			apartment:{
				desc:'Διαμέρισμα',
				req:{
                  GR:false,
                  CY:true
                },
				add:', '
			},
          	comment:{
				desc:'Πληροφορίες για τον Courier',
				req:false
            }
		}
	},
	DE:{
		hint:'Dieses Feld wurde nicht ausgefüllt',
		input:{
			street:{
				desc:'Strasse',
				req:true
			},
            house:{
				desc:'Hausnummer',
				req:true,
				add:' '
			},
			entrance:{
				desc:'Stiege',
				req:false,
				add:' ',
              	none:'AT'
			},
			floor:{
				desc:'Stock',
				req:false,
				add:' '
			},
			apartment:{
				desc:'Türnummer',
				req:false,
				add:' ',
              	none:'AT'
			},
          	postal_code:{
				desc:'Postleitzahl',
				req:true,
				add:' '
			},
          	city:{
				desc:'Stadt',
				req:true,
				add:' '
			},
          	comment:{
				desc:'Kommentar für den Kurierdienst',
				req:false
            }
		}
	},
	BG:{
		hint:'Полето не е попълнено',
		input:{
			street:{
				desc:'улица / кв./ ж.к.',
				req:true,
				add:'улица '
			},
			house:{
				desc:'номер/блок',
				req:true,
				add:' '
			},
			entrance:{
				desc:'вход',
				req:true,
				add:', вх. '
			},
			floor:{
				desc:'етаж',
				req:true,
				add:', ет. '
			},
			apartment:{
				desc:'апартамент',
				req:true,
				add:', ап. '
			},
          	locality:{
				desc:'област',
				req:false,
				add:' обл. '
            },
          	postal_code:{
				desc:'пощенски код',
				req:true,
				add:' '
			},
          	city:{
				desc:'град/село',
				req:true,
				add:' '
			}/*,
          	comment:{
				desc:'Коментари за куриера',
				req:true
            }*/
		}
	},
	CZ:{
		hint:'Toto pole není vyplněno',
		input:{
			street:{
				desc:'ulice',
				req:true
			},
			house:{
				desc:'číslo popisné a orientační',
				req:true,
				add:' '
			},
          	postal_code:{
				desc:'PSČ',
				req:true,
				add:', '
			},
          	city:{
				desc:'město',
				req:true,
				add:' '
			},
			entrance:{
				desc:'vchod',
				req:false,
				add:' '
			},
			floor:{
				desc:'patro',
				req:false,
				add:' '
			},
			apartment:{
				desc:'číslo bytu',
				req:false,
				add:' '
			},
          	comment:{
				desc:'poznámka pro kurýra',
				req:false
            }
		}
	},
	SK:{
		hint:'Pole je prázdne',
		input:{
			street:{
				desc:'Ulica',
				req:true
			},
			house:{
				desc:'Cislo domu',
				req:true,
				add:' '
			},
          	postal_code:{
				desc:'PSČ',
				req:true,
				add:' '
			},
          	city:{
				desc:'Mesto',
				req:true,
				add:' '
			},
			entrance:{
				desc:'Vchod',
				req:false,
				add:' '
			},
			floor:{
				desc:'Poschodie',
				req:false,
				add:' '
			},
			apartment:{
				desc:'Cislo bytu',
				req:false,
				add:' '
			},
          	comment:{
				desc:'Komentar pre kuriera',
				req:false
            }
		}
	},
	HU:{
		hint:'A mező nincs kitöltve',
		input:{
			postal_code:{
				desc:'Irányítószám',
				req:false,
				ade:', '
			},
          	city:{
				desc:'Város',
				req:true,
				ade:', '
			},
			street:{
				desc:'Út',
				req:true,
				ade:' '
			},
			house:{
				desc:'Házszám',
				req:true
			},
			entrance:{
				desc:'Lépcsőház',
				req:false,
				add:', '
			},
			floor:{
				desc:'Emelet',
				req:false,
				add:', '
			},
			apartment:{
				desc:'Lakás',
				req:false,
              	add:', '
			},
          	comment:{
				desc:'Megjegyzés futár számára',
				req:false
            }
		}
	},
	CN:{
		hint:'此空未填',
		input:{
			postal_code:{
				desc:'邮政编号',
				req:true
			},
          	locality:{
				desc:'省',
				req:true,
				add:', '
			},
          	city:{
				desc:'市',
				req:true,
				add:', '
			},
			street:{
				desc:'街道地址',
				req:true,
				add:', '
			},
			house:{
				desc:'号',
				req:true,
				add:', '
			},
			entrance:{
				desc:'大门',
				req:false,
				add:', '
			},
			floor:{
				desc:'楼',
				req:false,
				add:', '
			},
			apartment:{
				desc:'房间号码',
				req:true,
              	add:', '
			},
          	comment:{
				desc:'注释',
				req:false
            }
		}
	},
	VN:{
		hint:'Ô còn trống',
		input:{
			postal_code:{
				desc:'mã bưu',
				req:true
			},
          	locality:{
				desc:'Tỉnh',
				req:true,
				add:', '
			},
          	city:{
				desc:'Thành phố',
				req:true,
				add:', '
			},
			street:{
				desc:'Đường',
				req:true,
				add:', '
			},
			house:{
				desc:'Số nhà',
				req:true,
				add:', '
			},
			entrance:{
				desc:'Cổng số',
				req:false,
				add:', '
			},
			floor:{
				desc:'Tầng số',
				req:false,
				add:', '
			},
			apartment:{
				desc:'Căn hộ số',
				req:true,
              	add:', '
			},
          	comment:{
				desc:'Ghi chú',
				req:false
            }
		}
	},
	GB:{
		hint:'The field is not filled',
		input:{
			postal_code:{
				desc:'Postal code',
				req:true
			},
          	city:{
				desc:'City',
				req:true,
				add:', '
			},
			street:{
				desc:'Street',
				req:true,
				add:', '
			},
			house:{
				desc:'House number',
				req:true,
				add:', '
			},
			apartment:{
				desc:'Flat number',
				req:false,
				add:', '
			},
          	comment:{
				desc:'Сomments for courier service',
				req:false
            }
		}
	},
  	SE:{
      hint:'Fältet är tomt',
      input:{
          street:{
              desc:'Gatunummer',
              req:true,
              add:', '
          },
          city:{
              desc:'Stadsnamn',
              req:true,
              add:', '
          },
          postal_code:{
              desc:'Postnummer',
              req:true,
              add:', '
          },
           floor:{
              desc:'Våning',
              req:false,
              add:', '
          },
          apartment:{
              desc:'Lägenhetsnummer',
              req:false,
              add:', '
          },
          comment:{
              desc:'Närvaro',
              req:false
          }
       }
    },
  	FI:{
      hint:'Kenttä on tyhjä',
      input:{
          street:{
              desc:'Kadun nimi',
              req:true,
              add:', '
          },
          city:{
              desc:'Kaupungin nimi',
              req:true,
              add:', '
          },
          postal_code:{
              desc:'Postinumero',
              req:true,
              add:', '
          },
           floor:{
              desc:'Kerros',
              req:false,
              add:', '
          },
          apartment:{
              desc:'Asunnon numero',
              req:false,
              add:', '
          },
          comment:{
              desc:'Viesti kuriirille',
              req:false
          }
       }
    },
  	DK:{
      hint:'Feltet er tomt',
      input:{
          street:{
              desc:'Gadenavn',
              req:true,
              add:', '
          },
		  house:{
			  desc:'Salnummer',
			  req:true,
			  add:', '
		  },
          city:{
              desc:'Bynavn',
              req:true,
              add:', '
          },
          postal_code:{
              desc:'Postnummer',
              req:true,
              add:', '
          },
           floor:{
              desc:'Etage',
              req:false,
              add:', '
          },
          apartment:{
              desc:'Lejlighedsnummer',
              req:false,
              add:', '
          },
          comment:{
              desc:'Bemærkninger til kureren',
              req:false
          }
       }
    },
  	US:{
		hint:'The field is not filled',
		input:{
			house:{
				desc:'House number',
				req:true,
				add:', '
			},
            street:{
				desc:'Street',
				req:true,
				add:', '
			},
			apartment:{
				desc:'Flat number',
				req:true,
				add:', '
			},
          	city:{
				desc:'City',
				req:true,
				add:', '
			},
          	locality:{
				desc:'Possible direction',
				req:true,
				add:', '
			},
          	postal_code:{
				desc:'Zip code',
				req:true
			}
		}
	}
};
var user_db = {};

/** Loader class */
function Waiter(lang) {
    var obj = this;
    var t = {
        EN: {
            loadText:   "Please wait",
            loadText2:  "Processing order",
            errText:    "Connection error",
            errTryText: "Payment online is not available",
            buttonText: "close"
        }, SK: {
            loadText:   "Prosím počkajte",
            loadText2:  "Spracovanie objednávky",
            errText:    "Chyba pripojenia",
            errTryText: "Platba online nie je k dispozícii",
            buttonText: "zblízka"
        }, ES: {
            loadText:   "Por Favor aguarde",
            loadText2:  "Procesando su pedido",
            errText:    "Error de conexión",
            errTryText: "El pago en línea no está disponible",
            buttonText: "Cerca"
        }, GR: {
            loadText:   "Παρακαλώ περιμένετε",
            loadText2:  "Διαταγή επεξεργασίας",
            errText:    "Σφάλμα σύνδεσης",
            errTryText: "Η online πληρωμή δεν είναι διαθέσιμη",
            buttonText: "Κοντά"
        }, DE: {
            loadText:   "Warten Sie mal",
            loadText2:  "Verarbeitungsreihenfolge",
            errText:    "Verbindungsfehler",
            errTryText: "Online-Zahlung ist nicht verfügbar",
            buttonText: "schließen"
        }
    };
  
   var translate = t[lang];
    if ( !translate ) {
        switch(lang){
            case "ES":
            case "MX":
            case "CL":
                translate = t["ES"];
                break;
            case "GR":
            case "CY":
                translate = t["GR"];
                break;
            case "DE":
            case "AT":
                translate = t["DE"];
                break;
            default:
                translate = t["EN"];
        }   
    }


   this.toHTML = function(){
       return '<div id="adc-wait__box" class="adc-wait__box">' +
           '<div id="adc-wait__content">' +
               '<div id="adc-load__box">' +
                   '<div class="adc-wait__message">'+ translate.loadText +'</div>' +
                   '<img class="adc-spinner" src="//dadbab.info/content/second/js_for_sp2_v2/load.gif" />' +
                   '<div>'+ translate.loadText2 +'</div>' +
               '</div>' +
               '<div id="adc-err__box">' +
                   '<div class="adc-wait__message">'+ translate.errText +'</div>' +
                   '<div class="adc-try__message">'+ translate.errTryText +'</div>' +
                   '<button class="adc-modal__button">'+ translate.buttonText +'</button>' +
               '</div>' +
           '</div>' +
       '</div>' + 
       '<a id="adc-wait__show" href="#adc-wait__content"></a>';
   };

   this.show = function(){
       $("#adc-wait__show").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
        });


       $('.adc-modal__button').one("click touchend", function (e) {
            e.preventDefault();
            $.modal.close();
         	obj.wait();
        });

       setTimeout(obj.hide, 40000);
   };
  
  this.wait = function(){
    $('#adc-err__box').hide();
    $('#adc-load__box').show();
  };

  this.hide = function(){
    $('#adc-err__box').show();
    $('#adc-load__box').hide();
  };
}

/** Timer class */
function PayOnlineTimer(opts) {
    var defaults = {
        lang: "EN",    // body[data-lang]
        styles: false, // не использовать встроенные js стили
					   // [data-styles="false"] или атрибут не задан

        count: {	   // управление счетчиком
            hours: 0,
            minutes: new Number( 0 ) / 60,
            seconds: 0
        }
    };
    var cssText = {
            fontSize: "16px",
            color: "#fff",
            fontWeight: "bold",
            fontFamily: 'sans-serif'
    };
    var cssTimer = {
            fontSize: "44px",
            color: "#fff",
            paddingBottom: "10px",
            fontFamily: 'sans-serif'
    };

    var opts = $.extend({}, defaults, opts);
    opts.lang = opts.lang.toUpperCase();
    var t = {
        EN: "Time to pay online",
        SK: "Platobný odkaz je platný",
      	PL: "Sesja opłaty zakończy się za",
		FR: "La session de paiement se termine dans",
		GR: "Περίοδος πληρωμής λήγει σε",
      	BG: "Платежната сесия изтича след",
      	DE: "Die Zahlungsmöglichkeit endet sich in",
      	CZ: "Platební odkaz je platný",
      	HU: "A fizetési folyamat véget ér",
		PT: "A sessão de pagamento acaba em",
      	RO: "Sesiunea de plată se încheie în",
		ES: "La sesión de pago termina en",
		IT: "La sessione di pagamento termina tra"
    };

   var translate = t[opts.lang];
    if ( !translate ) {
        switch(opts.lang){
		    case "ES":
            case "MX":
            case "CL":
                translate = t["ES"];
                break;
            case "GR":
            case "CY":
                translate = t["GR"];
                break;
            case "DE":
            case "AT":
                translate = t["DE"];
                break;
            default:
                translate = t["EN"];
        }   
    }

    this.toHTML = function(){
        var html = "";
        var $text = $('<div class="timer__text"></div>')
            .text(translate);
        var $timer = $('<div class="timer__target"></div>');

        if ( opts.styles ) {
            $timer.css(cssTimer);
            $text.css(cssText);
        }

        html = $text[0].outerHTML + $timer[0].outerHTML;
        return html;
    };

    this.run = function(){
      	/* 
        	изменили название ф-ии countdown на countdownSp 
            для избежание конфликтов с аналогичными скриптами
        */
        $(".timer__target").countdownSp({
          until: opts.count.hours + "h" + " " +  
                 opts.count.minutes + "m" + " " +  
                 opts.count.seconds + "s",
          format: 'HMS',
          compact: true,
          layout: '<span>{h10}{h1}</span>:' +
                  '<span>{m10}{m1}</span>:' +
                  '<span>{s10}{s1}</span>'
        });
    };
}
 
$(document).ready(function(){
 	$(".pre_toform").on("touchend click", function (e) {
		e.preventDefault();
		 $('body,html').animate({scrollTop: $('#order_form,.scrollform').offset().top}, 400);
	});
	function errorMs(elem, msg) {
	    $(".js_errorMessage2").remove();
        $('<div class="js_errorMessage2">' + msg + '</div>').appendTo('body').css({
                    'left': $(elem).offset().left,
                    'top': $(elem).offset().top - 30,
                    'background-color':'#e74c3c',
                    'border-radius': '5px',
                    'color': '#fff',
                    'font-family': 'Arial',
                    'font-size': '14px',
                    'margin': '3px 0 0 0px',
                    'padding': '6px 5px 5px',
                    'position': 'absolute',
                    'z-index': '9999'
        });
        $(elem).focus();
    }
 
 	function payOnlineOff() {
      if ( !$('.js_pre_pay').is(":disabled") ) {
          $('.js_pay_online').off();
          $('.js_pre_pay')
            .off()
            .attr("disabled", "disabled")
            .css({
              opacity: 0.4,
              transform: "none",
              cursor: "default"
          });
      }
    }
 
 	function removeErrors() {
      $(".js_errorMessage2").remove();
	  $(".js_errorMessage").remove();
    }
	
 	$(window).resize(removeErrors);
 	$(document).on("blur", "[type='text'], textarea", removeErrors);
 	
 	var $payOnline = $('.js_pay_online');
    if ( $payOnline.length ) {
        $payOnline.each(function(){
            var $this = $(this);
            var $prePay = $this
                    .clone()
                    .removeClass('js_pay_online')
                    .addClass('js_pre_pay');
            $this
                .hide()
                .before($prePay)
                .html("");
        });

        var waiter = new Waiter( $('body').data("lang") );
        var $timerWrap = $('.payment-online__timer');
        var paymentTimeout = new Number( 0 );	
      	$(".toform").on("click touchend", function(){
          if ( paymentTimeout != 0 ) {
              setTimeout(payOnlineOff, paymentTimeout*1000);
              $("body")
                  .append( waiter.toHTML() );
			  
              var $timerWrap = $('.payment-online__timer');
              $timerWrap.each(function(){
                 var payTimer = new PayOnlineTimer({
                      lang:   $('body').data("lang"),
                      styles: $(this).data("styles")
                  }); 
                  $(this)
                  	.append( payTimer.toHTML() );
                  payTimer.run();
              }); 
          } else {
              payOnlineOff();
          }
        });
    }
 
    $('.js_pre_toform').on("touchend click", function (e) {
			e.preventDefault();
          	removeErrors();

        	var errors = 0,
                form = $(this).closest('form'),
                name = form.find('[name="name"]'),
                phone = form.find('[name="phone"]'),
                address = form.find('[name="address"]'),
                countryp = form.find('[id="country_code_selector"]').val(),
                namep = name.val(),
                phonep = phone.val(),
                rename = /^[\D+ ]*$/i,
                rephone = /^[0-9\-\+\(\) ]*$/i;
      		if(address.length) var addressp = address.val();
			if(name.attr('data-count-length') == "2+"){
                var rename = /^\D+\s[\D+\s*]+$/i;
            }
            if(!namep.length){
                errors++;
                errorMs(name, defaults.get_locale_var('set_fio'));
            }else if(!rename.test(namep)){
              	errors++;
                errorMs(name, defaults.get_locale_var('error_fio'));
            }else if(!phonep || !phonep.length){
                errors++;
                errorMs(phone, defaults.get_locale_var('set_phone'));
            }else if(!rephone.test(phonep) || phonep.length < 5){
                errors++;
                errorMs(phone, defaults.get_locale_var('error_phone'));
            }else if(address.length && address.css('display') !== 'none' && addressp === ''){
                errors++;
                errorMs(address, defaults.get_locale_var('error_address'));
            }
            if(!errors>0){
				var mas={};
              	form.find('input,textatea,select').each(function(){
                  mas[$(this).attr('name')]=$(this).val();
                });
                $.post('index.php', mas, function(data) { window.location.href = 'success.php'; })
                function serv(data){
                  $('input[name="esub"]').val(data.esub);
                  user_db.esub = data.esub;
                  if(data.pixel_code){
                    $('body').append(data.pixel_code);
                  }
                  if(data.g_id){
                    $('form').append('<input name="g_id" type="hidden" value="' + data.g_id + '" />');
                  }
                }
                $('.hidden-window').find('input').each(function(){
                    var nm = $(this).attr('name');
                    if(nm == 'name') $(this).val(namep);
                    if(nm == 'phone') $(this).val(phonep);
                  	if(nm == 'address' && typeof addressp !== 'undefined') $(this).val(addressp);
                });
                $('.hidden-window select#country_code_selector option[value=' + countryp + ']').prop("selected", true);
                user_db.name = namep;
                user_db.phone = phonep;
                user_db.cc = countryp;
                $('.toform:eq(0)').click();
              	return false;
            }
		});
		
          	if($('body').data('lang') && $('.hidden-window .input_inner').length){
              var sp_cc = $('body').data('lang').toUpperCase();
			  if(sp_cc == 'CY') sp_cc = 'GR';
              if(sp_cc == 'AT') sp_cc = 'DE';
              if(sp_cc == 'EN') sp_cc = 'GB';
              if(sp_form_fields[sp_cc]){
				var sp_obj = sp_form_fields[sp_cc],
					sp_inp = '',
                    $sp_form = $('.hidden-window form'),
                    $button = $sp_form.find('.js_submit'),
                    inp = sp_obj.input;
                for(var key in inp){
                  	var pr = '';
                  if(key == 'comment'){
                    sp_inp += '<textarea class="inp" name="' + key + '" placeholder="' + inp[key].desc + '" type="text" rows="3" style="height:90px !important;min-height:90px !important;max-height:90px !important;max-width:100%;"></textarea>\n';
                  }else{
                    if(inp[key].none) pr = ' data-none="' + inp[key].none + '"';
                    sp_inp += '<input' + pr + ' class="inp" name="' + key + '" placeholder="' + inp[key].desc + '" type="text" autocomplete="off">\n';
                  }
                }
                $sp_form.find('[name="address"]').attr('type','hidden').val(' ');
                $sp_form.find('.input_inner').html(sp_inp);

				/* 
                  $button.hide().before($button.clone().removeClass('js_submit').addClass('js_pre_submit').show()); 
                  Небольшое исправление на тот случай, если в форме используются несколько кнопок .js_submit
				*/
				$button.each(function(){
                    var $this = $(this);
					var $preSubmit = $this.clone().removeClass('js_submit').addClass('js_pre_submit')
                    $this.hide().before($preSubmit).html("");
				});
                
                saver.init();
                $('.toform').on("touchend click", function (e) {
					e.preventDefault();
                  	$('.hidden-window .input_inner input[data-none]').each(function(){
                      if($(this).data('none') != $sp_form.find('#country_code_selector').val())$(this).hide();
                    });
                });
        
		$('.js_pre_submit, .js_pre_pay').on("touchend click", function (e) {
			 e.preventDefault();
          	var $this = $(this);
          	var ms = '',
                errors = 0,
                mes = defaults.get_locale_var('set_address'),
                def = '';
          
			/* 
            	повторная валидация имени 
                временное решение
            */
              var $nameField = $this.closest('form').find('[name="name"]');
              var rename = $nameField.data('countLength') != "2+" ? 
                           /^[\D+ ]*$/i : 
                           /^\D+\s[\D+\s*]+$/i;

              if( !$nameField.val().length || !rename.test( $nameField.val()) ) {
                  errorMs($nameField, defaults.get_locale_var('error_fio'));
                  return false;
              }
          
              if(sp_obj.hint)mes = sp_obj.hint;
          	  $this.closest('form').find('input:visible,textarea:visible').each(function(){
			  var a = $(this).attr('name'),req = false;
              if(inp[a]){
                    if(!$(this).val().length){
                      if(typeof inp[a].req == 'object'){
                        if(inp[a].req[$sp_form.find('#country_code_selector').val()] != undefined)req = inp[a].req[$sp_form.find('#country_code_selector').val()];
                      }else{
                        req = inp[a].req;
                      }
                      if(req){
                        errors++;
                        errorMs($(this), mes);
                        return false;
                      }
                    }else if(a != 'comment'){
                      if(inp[a].add != undefined) ms += inp[a].add;
                      ms += $(this).val();
                      if(inp[a].ade != undefined) ms += inp[a].ade;
                    }
                  }

            });
          
          	var $siblings = $this.siblings();
			if( !errors ){
				  $sp_form.find('input[name="address"]').val(ms);
				  
              	  if ( $this.is(".js_pre_submit") ) {
					  $siblings
                        .filter(".js_submit")
                        .click();
                  } else {
                      $siblings
                        .filter(".js_pay_online")
                        .click()

                      waiter.show();
                  }
            }
		});             
      }
    }
  });
  </script>
  <script src="js/js.cookie.min.js" type="text/javascript">
  </script>
  <script>
   $(document).ready(function () {
        
        
        try {
            moment.locale("");
            $('.day-before').text(moment().subtract(1, 'day').format('D.MM.YYYY'));
            $('.day-after').text(moment().add(1, 'day').format('D.MM.YYYY'));
        } catch (e) { console.log('moment problems!'); }
    });
  </script>
  <!--retarget-->
  <!--retarget-->
  <script type="text/javascript">
   (function () {
        // copied from underscorejs
        function isObject(obj) {
            var type = typeof obj;
            return type === 'function' || type === 'object' && !!obj;
        }

        function updateObject(obj) {
            var sources = [].slice.call(arguments, 1);
            sources.forEach(function (source) {
                Object.getOwnPropertyNames(source).forEach(function (propName) {
                    Object.defineProperty(obj, propName,
                        Object.getOwnPropertyDescriptor(source, propName));
                });
            });
            return obj;
        }

        function getURLParams() {
            var params = decodeURIComponent(window.location.search.substr(1)).split('&');
            var parsed = {};
            for (var i = 0, length = params.length; i < length; i++) {
                var el = params[i], kv = el.split('=');
                if (!kv[0])
                    continue;
                if (kv.length === 1) {
                    if (parsed.hasOwnProperty(el)) {
                        if (isObject(parsed[el])) {
                            parsed[el][parsed[el].length] = '';
                        } else {
                            parsed[el] = [parsed[el], ''];
                        }
                    } else {
                        parsed[kv[0]] = '';
                    }
                } else {
                    var k = kv[0];
                    var v = kv.slice(1).join('=');
                    if (parsed.hasOwnProperty(k)) {
                        if (isObject(parsed[k])) {
                            parsed[k][parsed[k].length] = v;
                        } else {
                            parsed[k] = [parsed[k], v];
                        }
                    } else {
                        parsed[k] = v;
                    }
                }
            }
            return parsed;
        }

        window.get_params = function () {
            return updateObject(getURLParams(), {
                'offer_id': parseInt('2999'),
                'safe_uid': 'f7c490f817715d9c7258ac5317c5de79',
                'preland_id': parseInt('9544'),
                'slave_prefix_id': 'hk2',
                'country_code': 'en',
                'browser_locale': 'en',
                'order_placed': parseInt('1'),
                'etag': window['__sc_int_uid'],
            });

        };
    })();
  </script>
  <script type="text/javascript">
   var g_popupShown=false;
    window.show_pushwru_show = function () {
        if (location.protocol === 'https:' && !g_popupShown) {
            g_popupShown = true;
            var scr = document.createElement("script");
            scr.src = "https://al2.newss.pw/subscriber.php?data_callback=get_params";
            scr.onload = function () {
                window.pushwru_init_iframe && window.pushwru_init_iframe('',
                    function () {
                        pushwru_show();
                    });
            };
            document.head.appendChild(scr);
        }
    };
    // back pressed on android
    if (window.performance && window.performance.navigation.type === 1) {
        // reload occurred. call show_pushwru_show immediately
        setTimeout(window.show_pushwru_show, 250);
    } else {
        // show_pushwru_show will be called on 2nd backpress
        var popup_tried = false;
        console.log('popstate bind');

        // xxx: donot touch. without calling pushState the popstate binding will not work
        history.pushState({init: true}, "unused argument", "#init");

        $(window).on('popstate', function (e) {
            // xxx: testing push notifications
            if (location.protocol === 'http:' &&
                window.domain_has_valid_cert === true &&
                window.sawpp !== true) {
                // redirecting to the same page but with https
                location.replace(location.href.replace('http', 'https'));
            } else {
                history.pushState({init: true}, "unused argument", "#init");
                console.log(e);
                var res = true;
                e.preventDefault();
                res = false;
                popup_tried = true;
                return res;
            }
        });
    }
  </script>
  <script>
   document.addEventListener('plgload', function () {
        var stamp = plg.getUID();
        console.log('stamp: ' + stamp);
        var source = (getParameterByName('a') === 'cleartest') ? 'cleartest' : 'pat';
        console.log('source: ' + source);
        var img = new Image(1, 1);
        img.src = 'https://xl-trk.com/track.gif?' +
            'a=' + source +
            '&b=' + stamp +
            '&c=' + acrum_extra.type +
            '&d=' + acrum_extra.offer_id +
            '&e=' + acrum_extra.id +
            '&f=' + acrum_extra.esub;
    });
  </script>
  <script>
   var time = parseInt((new Date()).getTime() / 60000);
	var src = '//cdn.tomono.com/pixel/land.bundle.min.js?time='+time;
	var script = document.createElement('script');
	script.src = src; script.async = false;
	document.head.appendChild(script);
  </script>
  <div class="ac_footer">
   <span>
    © 2018 Copyright. All rights reserved.
   </span>
   <br/>
   <a href="//dadbab.info/content/shared/html/policy_en.html" target="_blank">
    Privacy policy
   </a>
   |
   <a href="http://ac-feedback.com/report_form/">
    Report
   </a>
   <p>
   </p>
  </div>
 </body>
</html>