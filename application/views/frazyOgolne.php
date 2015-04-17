<?php

/**
 * Created by PhpStorm.
 * User: mm
 * Date: 09.04.15
 * Time: 00:32
 */



$this->load->view('header', array('uzytkownik' => $uzytkownik, 'allPublicPhrases' => $allPublicPhrases,  'klient' => isset($klient) ? $klient : false));

forms::title(array('title' => 'Frazy ogólne '));

?>
    <table border="0" cellpadding="0" cellspacing="0" style="width: 60%;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <h3 style="margin: 0 0 0 5px;">Formularz dodawania fraz ogólnych</h3>
                <?php
                    forms::open(array('action' => url::page(CONTROLLER . '/addPhrase/' . PARAM)));

                    forms::textarea(array('label' => 'Fraza/Frazy',
                        'name' => 'phrase',
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

                if ($allPublicPhrases) {
                    forms::itemsOpen(0);

                    foreach ($allPublicPhrases as $fraza) {
                        $actions = array();

                        $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/edit.gif'),
                            'label' => 'Edytuj',
                            'link' => url::page(CONTROLLER . '/editPhrase/' . $fraza['id']));

                        $actions[] = array('icon' => url::page('inc/cms/img/crystalClear/35/delete.gif'),
                            'label' => 'Usuń',
                            'link' => url::page(CONTROLLER.'/deletePhrase/'.$fraza['id']));

                        forms::item(array('actions' => $actions,
                            'icon' => 'arrow',
                            'id' => $fraza['publicPhrase'],
                            'subTitle' => 'ID: ' . $fraza['id'],
                            'title' => $fraza['publicPhrase'],
                        ));

                    }
                }
                forms::itemsClose(0);
                    $this->load->view('footer');
                ?>