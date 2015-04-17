<?php header('Content-Type: text/html; charset=UTF-8'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">    <head>        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />        <meta name="robots" content="noindex, nofollow" />        <meta name="googlebot" content="noindex, noarchive, nosnippets" />        <link href="<?php echo url::base();?>inc/cms/css/smoothness/style.css?v=<?php echo VERSION;?>" rel="stylesheet" type="text/css" />        <link href="<?php echo url::base();?>inc/cms/css/style.css?v=<?php echo VERSION;?>" rel="stylesheet" type="text/css" />        <script type="text/javascript" src="<?php echo url::base();?>inc/cms/js/jquery-1.4.2.min.js?v=<?php echo VERSION;?>"></script>        <script type="text/javascript" src="<?php echo url::base();?>inc/cms/js/cms/general.js?v=<?php echo VERSION;?>"></script>        <script type="text/javascript" src="<?php echo url::base();?>inc/cms/js/cms/requests.js?v=<?php echo VERSION;?>"></script>        <script type="text/javascript" src="<?php echo url::base();?>inc/cms/js/jquery.color.js?v=<?php echo VERSION;?>"></script>        <script type="text/javascript" src="<?php echo url::base();?>inc/cms/js/jquery-ui-1.8.2.custom.min.js?v=<?php echo VERSION;?>"></script>        <?php /*<script type="text/javascript" src="<?=url::base();?>inc/cms/js/ui.core.js?v=<?=VERSION;?>"></script>        <script type="text/javascript" src="<?=url::base();?>inc/cms/js/ui.datepicker.js?v=<?=VERSION;?>"></script>        <script type="text/javascript" src="<?=url::base();?>inc/cms/js/ui.sortable.js?v=<?=VERSION;?>"></script>*/?>        <script type="text/javascript" src="<?php echo url::base();?>inc/cms/js/jquery.blockui.js?v=<?php echo VERSION;?>"></script>        <?php if($uzytkownik){ ?>        <script type="text/javascript">            var tfn = '<?php echo url::page(CONTROLLER);?>';            var messages_active_error = 'Błąd zapisu. Nie zapisano zmian.';            var messages_delete_error = 'Błąd usuwania. Nie usunięto elementu.';            var messages_move_error = 'Błąd zapisu. Nie zmieniono kolejności.';            var messages_delete_confirmation = 'Ta operacja jest nieodwracalna. Czy na pewno chcesz usunąć?';            $(document).ready(function(){                init();            	$("#wyszukiwarka_klientow").autocomplete({            		source: "<?php echo url::page('klienci/szukaj');?>",            		minLength: 2,            		select: function(event, ui) {            		    self.location.href = '<?php echo url::page('klienci/profil');?>/' + ui.item.id;            		}            	});            });        </script>        <?php } ?>        <title><?php echo APP_NAME;?></title>    </head>    <body>        <?php if($uzytkownik){ ?>            <?php if($uzytkownik['typ'] != 'pozycjoner'){ $statusbar_wiadomosci = $this -> load -> model('wiadomosci') -> pobierz_statystyke_wiadomosci($uzytkownik); if($statusbar_wiadomosci['odebrane']['nieprzeczytane'] || $statusbar_wiadomosci['odebrane']['niewykonane']){ ?>            <div id="statusbar_wiadomosci">                <?php if($statusbar_wiadomosci['odebrane']['nieprzeczytane']){ ?>                    <p>                        <a href="<?php echo url::page('wiadomosci/index/odebrane/nieprzeczytane');?>">                            Nowe wiadomości: <b><?php echo $statusbar_wiadomosci['odebrane']['nieprzeczytane'];?></b>                        </a>                    </p>                <?php } ?>                <?php if($statusbar_wiadomosci['odebrane']['niewykonane']){ ?>                    <p>                        <a href="<?php echo url::page('wiadomosci/index/odebrane/niewykonane');?>">                            Niewykonane zadania: <b><?php echo $statusbar_wiadomosci['odebrane']['niewykonane'];?></b>                        </a>                    </p>                <?php } ?>            </div>            <?php } } ?>        <div id="header">            <a href="<?php echo url::page('witaj');?>">                <img alt="" class="logo" src="<?php echo url::base();?>inc/logo.png	" />            </a>			<?php if(($uzytkownik['typ'] == 'admin' && $uzytkownik['id'] == '1' || $uzytkownik['id'] == '4' || $uzytkownik['id'] == '5' || $uzytkownik['id'] == '6' || $uzytkownik['id'] == '9' || $uzytkownik['id'] == '124' || $uzytkownik['id'] == '126') || ($uzytkownik['typ'] == 'pozycjoner' && $uzytkownik['id'] == '3' || $uzytkownik['id'] == '2')){			forms::button(array('value' => 'Pobierz nfo o linkach', 'link' => '/gl/gotlink_API_pobierz'));			forms::button(array('value' => 'Pobierz nfo o grupach', 'link' => '/gl/update_gl'));						}?>			            Znajdź klienta            <input name="wyszukiwarka_klientow" id="wyszukiwarka_klientow" type="text" />            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            Konto typu <b><?php echo $uzytkownik['typ'];?></b>            &nbsp; &nbsp;            Witaj <b><?php echo $uzytkownik['login'];?></b>!            &nbsp; &nbsp;            <!--<a href="<?php echo url::page('ustawienia');?>">                <img alt="" src="<?php echo url::base();?>inc/cms/img/crystalClear/20/settings.gif" style="vertical-align: middle; position: relative; top: -2px;" />                ustawienia            </a>-->            &nbsp; &nbsp;            <a href="<?php echo url::page('autoryzacja/wyloguj');?>">                <img alt="" src="<?php echo url::base();?>inc/cms/img/crystalClear/20/lock.gif" style="vertical-align: middle; position: relative; top: -2px;" />                wyloguj            </a>		    <div class="clear"></div>        </div>	    <div id="navigation_line">            <?php $this -> load -> view('menu', array('uzytkownik' => $uzytkownik)); ?>		    <div class="clear"></div>	    </div>        <?php } ?>        <?php            if(isset($klient) && $klient && isset($klient['id_klienta'])){				// prawa dostępu                $acl_dokumenty = $this -> acl -> get('acl_dokumenty');                $acl_frazy = $this -> acl -> get('acl_frazy');                $etapy = $this -> load -> model('klienci') -> etapy();                $actions = array();                $actions[] = array('icon' => url::page('inc/cms/img/private_spice.jpg'),                                   'label' => 'Privkat',                                   'link' => url::page('privcat/index/index/'.$klient['id_klienta']));				$actions[] = array('icon' => url::page('inc/cms/img/seo.gif'),                                   'label' => 'SEO',                                   'link' => url::page('seo/seo_view/'.$klient['id_klienta']));				$actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/id.gif'),                                   'label' => 'Profil',                                   'link' => url::page('klienci/profil/'.$klient['id_klienta']));                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/plus.gif'),                                   'label' => 'Notatka',                                   'link' => url::page('notatki-klienta/form/'.$klient['id_klienta']));                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/browse.gif'),                                   'label' => 'Historia',                                   'link' => url::page('notatki-klienta/wszystkie/'.$klient['id_klienta']),                                   'rel' => 'modal');                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/list.gif'),                                   'label' => 'Frazy',                                   'link' => url::page('frazy/wszystkie/'.$klient['id_klienta']));                if($acl_frazy -> is_allowed($uzytkownik['typ'], 'pozycje_etap_'.$klient['etap'])){                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/status1.gif'),                                   'label' => 'Pozycje',                                   'link' => url::page('frazy/pozycje/'.$klient['id_klienta']));                }                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/stats.gif'),                               'label' => 'Statystyki',                               'link' => url::page('klient/wyniki/'.$klient['hash']),                               'rel' => 'external');                if($acl_dokumenty -> is_allowed($uzytkownik['typ'], 'lista_etap_'.$klient['etap'])){                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/documents.gif'),                                   'label' => 'Dokumenty',                                   'link' => url::page('dokumenty/wszystkie/'.$klient['id_klienta']));                }                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/edit.gif'),                                   'label' => 'Edytuj',                                   'link' => url::page('klienci/form/'.$klient['id_klienta']));                /*				if($uzytkownik['typ'] == 'admin'){                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/people.gif'),                                   'label' => 'Powiązania',                                   'link' => url::page('klienci/powiazania/'.$klient['id_klienta']));                }*/				$actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/spreadsheet.gif'),                                   'label' => 'Faktury',                                   'link' => url::page('faktury/klienta/'.$klient['id_klienta']));				$actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/attachment.gif'),                                   'label' => 'Załączniki',                                   'link' => url::page('klienci/zalaczniki/'.$klient['id_klienta']));										 if(($uzytkownik['typ'] == 'admin') || ($uzytkownik['typ'] == 'pozycjoner'))										 $actions[] = array('icon' => url::page('inc/cms/img/budzet.gif'),                                   'label' => 'Budżet',                                   'link' => url::page('budzet/view/'.$klient['id_klienta']));                $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/agreement.gif'),                                   'label' => 'Umowy',                                   'link' => url::page('umowy/wszystkie/'.$klient['id_klienta']));				if(($uzytkownik['typ'] == 'admin' && $uzytkownik['id'] == '1' || $uzytkownik['id'] == '4' || $uzytkownik['id'] == '5' || $uzytkownik['id'] == '6' || $uzytkownik['id'] == '9' || $uzytkownik['id'] == '10' || $uzytkownik['id'] == '124' || $uzytkownik['id'] == '126') || ($uzytkownik['typ'] == 'pozycjoner' && $uzytkownik['id'] == '3' || $uzytkownik['id'] == '2')){				$actions[] = array('icon' => url::page('inc/cms/img/gotlink.jpg'),                                   'label' => 'Gotlink',                                   'link' => url::page('gl/gotlink_status/'.$klient['id_klienta']),								    'rel' => 'modal');				}				if($uzytkownik['typ'] == 'admin') {				    $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/upload.png'),				        'label' => 'Import statystyk',				        'link' => url::page('phraseStatsImport/index/' . $klient['id_klienta']));				}				forms::item(array('actions' => $actions,                                  'icon' => 'id',                                  'id' => 'klient_'.$klient['id_klienta'],                                  'image' => url::base().('inc/cms/img/crystalClear/64/flag.gif'),                                  'title' => $klient['nazwa'].'<br /><span class="small"><a class="noCover" href="http://'.$klient['adres_strony'].'" rel="external">'.$klient['adres_strony'].'</a><br />Etap: '.$etapy[$klient['etap']].'</span>'));            }        ?>        <table id="page">            <tr>                <td id="content">                    <div class="text">                        <?php                            $infos = Array();                            $infos[1] = 'Dane zostały zapisane.';                            $info_by_get = $this -> input -> get('info');                            $info_by_session = $this -> session -> get('info');                        ?>                        <?php if($info_by_get || $info_by_session){ ?>                            <div class="block text info">                                <?php echo is_numeric($info_by_get) ? $infos[$info_by_get] : $info_by_get; ?>                                <?php echo is_numeric($info_by_session) ? $infos[$info_by_session] : $info_by_session; ?>                            </div>                            <script type="text/javascript">                                $(document).ready(function(){                                    $('.info')                                    <?php for($x = 1; $x <= 15; $x++){ ?>                                    .animate({backgroundColor: "#628F1A"}, 150)                                    .animate({backgroundColor: "#76BF00"}, 150)                                    <?php } ?>                                    .slideUp('slow');                                });                            </script>                        <?php $this -> session -> delete('info'); } ?>                        <?php                            $errors = Array();                            $errors[1] = 'Wypełnij pola oznaczone czerwoną gwiazdką.';                            $errors[2] = 'E-mail jest w niepoprawnym formacie.';                            $errors[3] = 'Wpisany login jest w niepoprawnym formacie (a-z 0-9 - _)';                            $errors[4] = 'Wpisany login jest już zajęty.';                            $error_by_get = $this -> input -> get('error');                            $error_by_session = $this -> session -> get('error');                        ?>                        <?php if($error_by_get || $error_by_session){ ?>                            <div class="block text error">                                <?php echo is_numeric($error_by_get) ? $errors[$error_by_get] : $error_by_get; ?>                                <?php echo is_numeric($error_by_session) ? $errors[$error_by_session] : $error_by_session; ?>                            </div>                        <?php $this -> session -> delete('error'); } ?>