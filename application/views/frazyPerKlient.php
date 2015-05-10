<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 00:32
 */

$this->load->view('header', array('uzytkownik' => $uzytkownik, 'klientId' => $klientId, 'allPhrasesPerClient' => $allPhrasesPerClient, 'klient' => isset($klient) ? $klient : false));

forms::button(array('value' => '&#171; Powrót',
    'link' => url::page('klienci/profil/' . $klientId)));

forms::title(array('title' => 'Frazy dla klienta '));

?>
    <table border="0" cellpadding="0" cellspacing="0" style="width: 60%;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <h3 style="margin: 0 0 0 5px;">Formularz dodawania fraz dla klienta</h3>
                <?php

                forms::open(array('action' => url::page(CONTROLLER . '/addPhrase/' . PARAM)));

                forms::hidden(array(
                    'name' => 'clientId',
                    'required' => 1,
                    'value' => isset($klientId) ? $klientId : ''
                ));

                forms::textarea(array('label' => 'Fraza/Frazy dla klienta',
                    'name' => 'phrasesForClient',
                    'required' => 1,
                    'subLabel' => 'Oddzielone przecinkami lub każda w nowej linii',
                ));
                ?>
            </td>
            <td style="vertical-align: bottom;">
                <?php forms::submit(array('label' => 'Dodaj frazę')); ?>
            </td>
        </tr>
    </table>
<?php
forms::close(0);

if ($allPhrasesPerClient) {
    forms::itemsOpen(0);

    foreach ($allPhrasesPerClient as $fraza) {
        $actions = array();

        $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/edit.gif'),
            'label' => 'Edytuj',
            'link' => url::page(CONTROLLER . '/editPhrase/' . $fraza['id'] . '/' . $fraza['clientID']));

        $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/delete.gif'),
            'label' => 'Usuń',
            'link' => url::page(CONTROLLER . '/deletePhrase/' . $fraza['id']) . '/' . $fraza['clientID']);

        forms::item(array('actions' => $actions,
            'icon' => 'arrow',
            'id' => $fraza['publicPhrase'],
            'subTitle' => 'ID: ' . $fraza['id'],
            'title' => $fraza['clientPhrase'],
        ));
    }
}
forms::itemsClose(0);
$this->load->view('footer');
?>