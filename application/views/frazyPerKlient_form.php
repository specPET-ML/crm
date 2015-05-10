<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 00:32
 */

$this->load->view('header', array('uzytkownik' => $uzytkownik, 'clientId' => $clientId, 'phrasePerClient' => $phrasePerClient, 'klient' => isset($klient) ? $klient : false));

forms::button(array('value' => '&#171; Powrót',
    'link' => url::page('frazyPerKlient/index/' . $clientId)));

forms::title(array('title' => 'Frazy dla klienta '));

?>
    <table border="0" cellpadding="0" cellspacing="0" style="width: 60%;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <h3 style="margin: 0 0 0 5px;">Formularz dodawania fraz dla klienta</h3>
                <?php
                forms::open(array('action' => url::page(CONTROLLER . '/updatePhrase/' . PARAM)));

                forms::hidden(array(
                    'name' => 'clientId',
                    'required' => 1,
                    'value' => isset($phrasePerClient['clientID']) ? $phrasePerClient['clientID'] : ''
                ));
                forms::hidden(array(
                    'name' => 'id',
                    'required' => 1,
                    'value' => isset($phrasePerClient['id']) ? $phrasePerClient['id'] : ''
                ));

                forms::text(array('label' => 'Fraza dla klienta',
                    'name' => 'phrasesForClient',
                    'required' => 1,
                    'value' => isset($phrasePerClient['clientPhrase']) ? $phrasePerClient['clientPhrase'] : '',
                ));
                ?>
            </td>
            <td style="vertical-align: bottom;">
                <?php forms::submit(array('label' => 'Zapisz zmiany')); ?>
            </td>
        </tr>
    </table>
<?php
forms::close(0);

forms::itemsClose(0);
$this->load->view('footer');
?>