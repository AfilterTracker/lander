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
<html>
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
  <meta charset="utf-8"/>
  <title>
   Varikosette
  </title>
  <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <link href="images/header_logo.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="css/normalize.css" rel="stylesheet">
   <link href="css/styles.css" rel="stylesheet"/>
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic&subset=latin-ext" rel="stylesheet" type="text/css"/>
   <link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet" type="text/css"/>
   <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css"/>
  </link>
 </head>
 <body data-lang="IT">
  <!--retarget-->
  <!--retarget-->
  <div class="wrapper cf body s__main">
   <div id="popWindow">
   </div>
   <header>
    <div class="center_wrapper">
     <span class="logo">
     </span>
    </div>
   </header>
   <!-- end of #header -->
   <div class="block_1">
    <div class="center_wrapper">
     <img alt="" class="for_header_product" src="images/product.png" width="180"/>
     <p class="bubble arrow_box">
      senza chirurgia né
      <br/>
      procedure mediche
     </p>
     <h1 class="slogon">
      Sbarazzati delle vene varicose
     </h1>
     <div class="stmp stmp1">
      <p>
       Per tutte
       <br/>
       le età
      </p>
     </div>
     <div class="stmp stmp2">
      <p>
       Prodotto 100% naturale
      </p>
     </div>
     <div class="list">
      <p>
       L'uso continuativo della crema:
      </p>
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
     <p>
      <b>
       Smetti di vergognarti
      </b>
      <br/>
      (non avere paura di mostrare il tuo corpo, pelle senza segni)
     </p>
     <div class="form">
      <div class="discount">
       <p>
        <b>
         50%
        </b>
        <br/>
        di sconto
       </p>
      </div>
      <p>
       EFFETTUA IL TUO ORDINE A UN PREZZO INCREDIBILE:
      </p>
      <p>
       <span>
        <strong>
         39
        </strong>
        <strong>
         €
        </strong>
       </span>
      </p>
      <p>
       Prezzo normale:
       <span>
        <strong>
         78
        </strong>
        <strong>
         €
        </strong>
       </span>
      </p>
      <a class="lv-order-button rushOrder pre_toform" href="#order_form">
       ORDINA
      </a>
     </div>
    </div>
   </div>
   <div class="block_2">
    <div class="center_wrapper">
     <p class="headline">
      Crema anti-vene varicose
      <br/>
      <span>
       Varikosette
      </span>
     </p>
     <p>
      Trattamento completo che previene la comparsa delle vene varicose. Basta solo usarla! Elimina la
                comparsa delle vene varicose, tonifica la pelle e rinforza le pareti venose in modo delicato ed
                efficace.
     </p>
     <p>
      Un metodo eccellente per prevenire e curare quelle già visibili. È l'ancora di salvezza che avresti
                dovuto trovare prima!
     </p>
    </div>
   </div>
   <div class="block_3">
    <div class="center_wrapper">
     <i class="bg">
     </i>
     <div class="lable">
      <p>
       Primi
       <br/>
       sintomi
      </p>
     </div>
     <div class="description">
      <p>
       Dolore
      </p>
      <p>
       Sensazione di bruciore, botte
      </p>
      <p>
       Malattia
      </p>
      <p>
       Ipostasi
      </p>
      <p>
       Spasmi notturni
      </p>
     </div>
     <p class="headline">
      Cause della comparsa delle vene varicose:
     </p>
     <ul>
      <li>
       Genetica, ereditate dai genitori o dalla famiglia
      </li>
      <li>
       Vita sedentaria e mancanza di movimento e di attività fisica
      </li>
      <li>
       Diete moderne prive di cellulosa
      </li>
      <li>
       Vestiti stretti e tacchi alti che impediscono una corretta circolazione del sangue
      </li>
      <li>
       Cattive abitudini quando si è seduti
      </li>
      <li>
       Eccesso di sport
      </li>
      <li>
       Trattamenti ormonali come gli anticoncezionali, farmaci per il raffreddore, ecc.
      </li>
     </ul>
    </div>
   </div>
   <div class="block_4">
    <div class="center_wrapper cf">
     <div class="block_4_bg">
     </div>
     <div class="ss">
      <p>
       Vena varicosa
      </p>
      <p>
       Vena sana
      </p>
     </div>
     <p class="headline">
      <span>
       COME FUNZIONA
       <span>
        LA CREMA:
       </span>
      </span>
      <br/>
     </p>
     <p class="headlinep">
      Grazie alla sua formula unica, Varikosette funziona in modo sicuro ed efficace eliminando i sintomi
                generali dei processi infiammatori e alleviando il dolore. L'uso regolare della crema migliora la
                circolazione sanguigna, oltre a rinforzare e a tonificare le pareti venose.
     </p>
     <p class="headlinep">
      Varikosette elimina anche altri sintomi come la pelle d'oca, le mani e i piedi freddi e la stanchezza;
                il peso è molto importante anche in questi casi.
     </p>
    </div>
   </div>
   <div class="block_5">
    <div class="center_wrapper">
     <p class="headline">
      Il parere degli esperti:
     </p>
     <div>
      <img alt="block_5_foto1" src="images/block_5_foto1.jpg"/>
      <p>
       Non mi stancherò mai di ripetere quanto sia importante usare una crema anti-varici per curare questa
                    malattia! È difficile sopravvalutare la sua efficacia, soprattutto se si tratta della formula
                    esclusiva di Varikosette. Questa crema è stata clinicamente testata e ha portato risultati
                    inaspettati nei pazienti.
      </p>
      <p>
       Si può adoperare in casa, meglio se quotidianamente, ed è facile da usare: basta solo applicarla
                    massaggiando delicatamente i punti interessati. Il suo effetto è visibile molto rapidamente. I
                    pazienti affermano che il dolore, la stanchezza di mani e pieci, ecc. diminuiscono. Consiglio
                    Varikosette a tutti!
      </p>
      <p class="">
       <span>
        <b>
         Renato Semenzato
        </b>
        <br/>
        Chirurgo, 15 anni di esperienza in campo circolatorio
       </span>
      </p>
     </div>
     <div>
      <img alt="block_5_foto2" src="images/block_5_foto2.jpg"/>
      <p>
       MSpesso mi chiedo quale sia la crema anti-varici più efficace, delicata e sicura per me, che
                    consiglio anche alle mamme giovani e alle signore anziane. Quindi vi dico di provare la crema
                    Varikosette!
      </p>
      <p>
       In pratica, solo questa crema dà miglioramenti reali, eliminando i sintomi dolorosi e migliorando
                    l'aspetto delle vene giorno dopo giorno. Molte pomate chimiche possono causare allergie, ma
                    Varikosette contiene solo ingredienti naturali. Dovreste provarla!
      </p>
      <p class="">
       <span>
        <b>
         Elena Trifirò
        </b>
        <br/>
        Flebologa
       </span>
      </p>
     </div>
    </div>
   </div>
   <div class="block_6">
    <div class="center_wrapper">
     <p class="headline">
      Formula 100% naturale
      <br/>
      <span>
       <span>
        Varikosette
       </span>
      </span>
     </p>
     <p>
      <b>
       Presta attenzione ai suoi componenti attivi!
      </b>
      <br/>
      Per trovare una crema che funzioni, è necessario sapere quali sono i suoi ingredienti: sapere che
                effetto hanno ti può aiutare.
     </p>
     <div class="cf">
      <div class="clearup">
       <div class="clear for_consist">
        <div class="list_box box4">
         <h4 class="headline">
          <span class="lt33">
           Assenzio, mentolo,
           <br/>
           camomilla e ortica
          </span>
         </h4>
         <ul>
          <li>
           <span class="lt34">
            donano leggerezza e forza
            <br/>
            alle gambe
           </span>
          </li>
          <li>
           <span class="lt35">
            rinfrescano
            <br/>
            e disinfettano la pelle delle gambe
           </span>
          </li>
          <li>
           <span class="lt36">
            accelerano la guarigione delle
            <br/>
            microfratture
           </span>
          </li>
         </ul>
        </div>
        <div class="list_box box1">
         <h4 class="headline lt21">
          <span>
           Troxerutina
          </span>
         </h4>
         <ul>
          <li>
           <span class="lt22">
            allevia la sensazione di
            <br/>
            pesantezza e stanchezza alle gambe
           </span>
          </li>
          <li>
           <span class="lt23">
            diminuisce la permeabilità e la fragilità
            <br/>
            capillare
           </span>
          </li>
          <li>
           <span class="lt24">
            allevia il gonfiore e
            <br/>
            l'infiammazione
           </span>
          </li>
         </ul>
        </div>
       </div>
      </div>
      <div class="left">
       <div>
        <img alt="block_6_pic1" src="images/img2.png" width="110"/>
        <p>
         <b>
          Olio d'oliva
         </b>
         <br/>
         Aumentare la circolazione è essenziale per curare le vene varicose
                            e massaggiare l'area interessata con olio d'oliva può aiutare a migliorarla, nonché a
                            ridurre il dolore e l'infiammazione.
        </p>
       </div>
      </div>
      <div class="right">
       <div>
        <img alt="block_6_pic5" src="images/img1.png" width="110"/>
        <p>
         <b>
          Propoli
         </b>
         <br/>
         Il propoli è un ingrediente efficace per rinforzare i vasi sanguigni e,
                            quindi, può ridurre i sintomi delle vene varicose. Oltre ad essere astringente, contiene
                            anche sostanze naturali che possono aiutare a ridurre l'infiammazione e il dolore.
        </p>
       </div>
       <!-- <div>
                                        <img alt="block_6_pic3" src="images/block_6_pic3.png"/>
                                        <p>
                                        <b>Veneno de abeja </b><br/> Mejora la circulación de la sangre y quita los espasmos musculares.
                                                            </p>
                                                        </div> -->
      </div>
      <div class="cf">
      </div>
     </div>
     <p>
      Questo prodotto contiene le vitamine B1, B5 e C, che rinforzano le pareti delle vene e le rigenerano.
     </p>
     <p>
      Varikosette allarga i capillari affinché il sangue circoli meglio e rimuove il dolore che provoca la
                cattiva circolazione delle vene varicose. Inoltre, penetra le vene più efficacemente dei farmaci, perché
                agisce direttamente sul problema.
     </p>
    </div>
   </div>
   <div class="block_7">
    <div class="center_wrapper">
     <p class="headline">
      Principali benefici contro le varici:
     </p>
     <p>
      Rinforza l'organismo, elimina i sintomi della stanchezza, elimina la sensazione di bruciore e dà
                sollievo alle gambe pesanti.
     </p>
     <div>
      <div>
       <p>
        Migliora la circolazione
       </p>
       <p>
        Riduce la tensione delle vene
       </p>
       <p>
        Rapido recupero dei capillari
       </p>
      </div>
      <div>
       <p>
        Riduce il gonfiore
       </p>
       <p>
        Migliora l'elasticità delle vene
       </p>
       <p>
        Pulisce e risana le vene
       </p>
      </div>
     </div>
    </div>
   </div>
   <div class="block_8">
    <div class="center_wrapper">
     <div>
      <img alt="block_8_ico1" src="images/block_8_ico1.png"/>
      <p>
       SENZA INTERVENTI CHIRURGICI
      </p>
     </div>
     <div>
      <img alt="block_8_ico2" src="images/block_8_ico2.png"/>
      <p>
       SENZA FARMACI COSTOSI
      </p>
     </div>
     <div>
      <img alt="block_8_ico3" src="images/block_8_ico3.png"/>
      <p>
       SENZA DOLORI NÉ EFFETTI COLLATERALI PER LA SALUTE
      </p>
     </div>
    </div>
   </div>
   <div class="block_9">
    <div class="center_wrapper">
     <p class="headline">
      Le varici sono una malattia seria che va curata il prima possibile
     </p>
     <div>
      <img alt="block_9_foto1" src="images/block_9_foto1.jpg"/>
      <p>
       Ragni vascolari
      </p>
     </div>
     <div>
      <img alt="block_9_foto2" src="images/block_9_foto2.jpg"/>
      <p>
       Varici reticolari
      </p>
     </div>
     <div>
      <img alt="block_9_foto3" src="images/block_9_foto3.jpg"/>
      <p>
       Varici tronculari e collaterali
      </p>
     </div>
     <div>
      <img alt="block_9_foto4" src="images/block_9_foto4.jpg"/>
      <p>
       Problemi venosi cronici
      </p>
     </div>
     <div>
      <img alt="block_9_foto5" src="images/block_9_foto5.jpg"/>
      <p>
       Ulcere trofiche
      </p>
     </div>
    </div>
   </div>
   <div class="block_10">
    <div class="center_wrapper">
     <p class="headline">
      Il parere degli utenti:
     </p>
     <div>
      <div>
       <i>
        APrima Dopo
       </i>
       <img alt="block_10_foto1" src="images/block_10_foto1.jpg"/>
       <p>
        Lucia Collasanti
        <br/>
        28 anni
       </p>
      </div>
      <p>
       Dopo la gravidanza e il parto ho iniziato ad avere problemi di circolazione alle gambe: mi facevano
                    molto male e sono comparse le varici. Sono andata dal flebologo, che mi ha consigliato una crema
                    anti-varici da applicare due volte al giorno.
      </p>
      <p>
       Dopo cinque giorni le mie vene erano migliorate, la pelle era tornata alla normalità e le varici
                    erano scomparse. Non mi facevano più male e il gonfiore era andato giù. Continuo con il trattamento
                    e va molto bene, ora sto meglio.
      </p>
     </div>
     <div>
      <div>
       <i>
        Prima Dopo
       </i>
       <img alt="block_10_foto2" src="images/block_10_foto2.jpg"/>
       <p>
        Benedetta Savalli
        <br/>
        47 anni
       </p>
      </div>
      <p>
       Nel mio caso le vene varicose sono un problema cronico. Ho provato pillole, creme e gel per dieci
                    anni, ma l'unica cosa che ha funzionato su di me è stata Varikosette. Si tratta di una crema molto
                    buona che si assorbe rapidamente e agisce velocemente. Ora non ho più nessuna sensazione di
                    bruciore. Inoltre, non causa reazioni allergiche, e io sono incline alle allergie!
      </p>
      <p>
       Il gonfiore e l'infiammazione sono scomparsi a poco a poco, non tanto velocemente quanto avrei
                    voluto, ma posso dimenticarli per sempre! Senza contare che adesso le mie gambe sono più leggere.
                    Anche se viene usata molto, gli effetti sono sempre visibili, il corpo non si assuefa.
      </p>
     </div>
     <div>
      <div>
       <i>
        Prima Dopo
       </i>
       <img alt="block_10_foto3" src="images/block_10_foto3.jpg"/>
       <p>
        Gabriella Natoli
        <br/>
        58 anni
       </p>
      </div>
      <p>
       Io ero al secondo stadio di varici, le vene erano molto visibili, le gambe mi si gonfiavano e la
                    pelle era molto secca. Mia figlia mi ha comprato questa crema, ma non credevo che sarebbe stata così
                    efficace, visto che gli altri metodi non mi avevano aiutata.
      </p>
      <p>
       Uso continuamente la crema da quasi un anno e i risultati sono impressionanti! La mia pelle sta
                    molto meglio, è più viva e ben idratata. A poco a poco il dolore e il gonfiore sono scomparsi e dopo
                    un mese le vene visibili sono sparite, mentre quelle in rilievo sono diventate lisce. Sono molto
                    soddisfatta dei risultati!
      </p>
     </div>
     <div>
      <div>
       <i>
        Prima Dopo
       </i>
       <img alt="block_10_foto4" src="images/block_10_foto4.jpg"/>
       <p>
        Ettore Modigliano
        <br/>
        65 anni
       </p>
      </div>
      <p>
       Mia moglie mi dava un sacco di strigliate perché ho le vene visibili e le ignoro. Ce le ho sulle
                    braccia, molto stanche e con una sensazione di freddo continua. Così mi ha comprato questa crema ed
                    è sempre lei a spalmarmela.
      </p>
      <p>
       Mi piace quando me la mette, perché mi fa un massaggio e la crema ha un effetto caldo, il che mi dà
                    sollevo, visto che le mie braccia sono sempre fredde. Dopo 10 giorni il tono della mia pelle è
                    cambiato e le vene si notano meno. Sono molto felice perché sto molto meglio, il dolore è scomparso!
      </p>
     </div>
    </div>
   </div>
   <div class="block_11">
    <div class="center_wrapper">
     <i class="bg">
     </i>
     <img alt="" class="for_footer_product" src="images/product.png" width="266"/>
     <div class="dsc_box">
      <div class="discount">
       <p>
        <b>
         50%
        </b>
        <br/>
        di sconto
       </p>
      </div>
      <p>
       Ordina subito
      </p>
      <p>
       UN PREZZO INCREDIBILE:
       <span>
        <strong>
         39
        </strong>
        <strong>
         €
        </strong>
       </span>
      </p>
      <p>
       Prezzo normale:
       <span>
        <strong>
         78
        </strong>
        <strong>
         €
        </strong>
       </span>
      </p>
      <form action="" class="orderForm" id="order_form" method="post">
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
        <p style="text-align:left;font-size: 12px;">
         Ad esempio: Carla Verdi
        </p>
        <input class="inp" name="name" placeholder="Ad esempio" type="text"/>
        <p style="text-align:left;font-size: 12px;">
         Ad esempio: (+39) 041 6354982
        </p>
        <input class="inp only_number" name="phone" placeholder="Ad esempio" type="text"/>
        <!-- -->
        <button class="lv-order-button rushOrder button__text js_pre_toform">
         Ordina subito
        </button>
        <div class="toform">
        </div>
        <!-- -->
       </div>
      </form>
     </div>
    </div>
   </div>
  </div>
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
  <script type="text/javascript">
      button = document.getElementById("afilter_tracker_event_1");
      button.onclick = function() {
          $.ajax({
              type: "POST",
              url: "https://afilter.xyz/p/events",
              data: {"et":1},
              xhrFields: {withCredentials: true},
              crossDomain: true,
          });
      }
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