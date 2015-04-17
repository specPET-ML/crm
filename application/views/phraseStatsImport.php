<!DOCTYPE html>
<html>

<head>
    <style>
        h1 {
            text-align: center;
        }

        #leftBox {
            float: left;
            width: 39%;
            background-color: lightgreen;
        }

        #rightBox {
            float: right;
            width: 60%;
            background-color: lightcoral;
        }

        table {
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #eee;
        }

        table tr:nth-child(odd) {
            background-color: #fff;
        }

        table th {
            background-color: black;
            color: white;
        }
    </style>
</head>

<?php

/**
 * Created by Marcin Ławniczak
 * specPET Marcin Ławniczak
 * Date: 14.04.15
 */

$this->load->view('header', array('uzytkownik' => $uzytkownik, 'id_klienta' => $id_klienta, 'afterUpload' => $afterUpload, 'succesUpload' => $succesUpload, 'errorUpload' => $errorUpload, 'statsDateForm' => $statsDateForm, 'fileForm' => $fileForm, 'klient' => isset($klient) ? $klient : false));


forms::open(array('action' => url::page(CONTROLLER . '/upload/' . PARAM)));

forms::button(array('value' => '&#171; Powrót',
    'link' => url::page('klienci/profil/' . $id_klienta)));
?>
<h3 style="margin: 0 0 0 5px;">Formularz importu statystyk</h3>
<?php
forms::open(array('action' => url::page(CONTROLLER . '/upload/' . PARAM)));

forms::hidden(array(
    'name' => 'id_klienta',
    'required' => 1,
    'value' => isset($id_klienta) ? $id_klienta : ''
));

forms::text(array('label' => 'Plik csv z statystykami',
    'required' => 1,
    'inputType' => 'file',
    'name' => 'file',
    'title' => 'file',
    'fieldClass' => 'widthQuarter',
    'subLabel' => 'Plik musi być typu CSV z separatorem TAB',
));

forms::text(array(
    'fieldClass' => 'widthQuarter',
    'label' => 'Statystyki z dnia',
    'required' => 1,
    'name' => 'statsDate',
    'value' => isset($statsDateForm) ? $statsDateForm : ''));

forms::submit(array('label' => 'Wgraj statystyki'));

forms::close(0);

if ($afterUpload) {
    ?>
    <div id="container">
        <div id="leftBox">
            <h1><?php echo "Prawidłowo zaimportowane " . count($succesUpload) ?></h1>
            <table border="0" cellpadding="0" cellspacing="0" style="float: left">
                <tr>
                    <th>
                        Lp
                    </th>
                    <th>
                        Data
                    </th>
                    <th>
                        Fraza
                    </th>
                    <th>
                        Ranking Google.PL
                    </th>
                    <th>
                        Akcja
                    </th>
                </tr>
                <?php
                $i = 1;
                foreach ($succesUpload as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                            <?php $i++ ?>
                        </td>
                        <td>
                            <?php echo $row['data'] ?>
                        </td>
                        <td>
                            <?php echo $row['fraza'] ?>
                        </td>
                        <td>
                            <?php echo $row['wynik'] ?>
                        </td>
                        <td>
                            <?php echo $row['action'] ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div id="rightBox">
            <h1><?php echo "Błędne wpisy " . count($errorUpload) ?></h1>
            <table border="0" cellpadding="0" cellspacing="0" style="float: right">
                <tr>
                    <th>
                        Lp
                    </th>
                    <th>
                        Fraza
                    </th>
                    <th>Edy
                        Ranking Google.PL
                    </th>
                    <th>
                        Powód nie zaimportowania
                    </th>
                </tr>
                <?php
                $i = 1;
                foreach ($errorUpload as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                            <?php $i++ ?>
                        </td>
                        <td>
                            <?php echo $row['phrase'] ?>
                        </td>
                        <td>
                            <?php echo $row['rank'] ?>
                        </td>
                        <td>
                            <?php echo $row['reason'] ?>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </table>
        </div>
    </div>
<?php
}
?>


