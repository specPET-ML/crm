<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 00:32
 */



$this->load->view('header', array('uzytkownik' => $uzytkownik, 'publicPhrase' => $publicPhrase,  'klient' => isset($klient) ? $klient : false));

forms::title(array('title' => 'Frazy ogólne '));
?>
<table border="0" cellpadding="0" cellspacing="0" style="width: 60%;">
    <tr>
        <td style="vertical-align: top; width: 50%;">
            <h3 style="margin: 0 0 0 5px;">Formularz edytowania fraz ogólnych</h3>
            <?php
            forms::open(array('action' => url::page(CONTROLLER . '/updatePhrase/' . PARAM)));

            forms::text(array('label' => 'Fraza',
                'name' => 'phrase',
                'required' => 1,
                'value' => isset($publicPhrase["publicPhrase"]) ? $publicPhrase["publicPhrase"] : ''
            ));
            forms::hidden(array(
                'name' => 'id',
                'required' => 1,
                'value' => isset($publicPhrase["id"]) ? $publicPhrase["id"] : ''
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


$this->load->view('footer');
?>