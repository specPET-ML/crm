<?php
    include('slownie.php');

    function czytelna_data($data){
        $d = explode('-', $data);
        return $d[2].'.'.$d[1].'.'.$d[0];
    }

?>
<table border="1" cellpadding="10" cellspacing="3" class="naglowek">
    <tr>
        <td>

        </td>
        <td>
            <h1 align="center">Faktura<?php if($faktura['proforma']){ echo ' PROFORMA'; } ?></h1>
            <h3 align="center"><?php if($typ == 'oryginal'){ ?>ORYGINAL<?php }else if($typ == 'kopia'){ ?>KOPIA<?php }else if($typ == 'duplikat'){ ?>ORYGINAL - DUPLIKAT<?php }else{ ?>PODGLAD<?php } ?></h2>
            <h4 align="center"><?php echo texts::numer_faktury($faktura);?></h4>
        </td>
        <td>
            Miejscowosc: <?php echo $faktura['miejsce_sprzedazy'];?><br /><?php if($typ != 'duplikat'){ ?><br /><?php } ?>
            Data wystawienia: <?php echo czytelna_data($faktura['data_wystawienia']);?><br /><?php if($typ != 'duplikat'){ ?><br /><?php } ?>
            Data sprzedazy: <?php echo czytelna_data($faktura['data_sprzedazy']);?>
			
            <?php if($typ == 'duplikat'){ ?><br /><br />Duplikat wystawiono: <?php echo date('d.m.Y'); } ?>
        </td>
    </tr>
</table>

<table border="1" cellpadding="10" cellspacing="3" class="strony">
    <tr>
        <td class="glowna">
            <h3>SPRZEDAWCA</h3>
            <table border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td width="25%">
                        Firma:
                    </td>
                    <td width="75%">
                        <?php echo $faktura['sprzedawca_nazwa'];?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        Adres:
                    </td>
                    <td width="75%">
                        <?php echo $faktura['sprzedawca_adres'];?><br />
                        <?php echo $faktura['sprzedawca_kod_pocztowy'];?> <?php echo $faktura['sprzedawca_miejscowosc'];?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        NIP:
                    </td>
                    <td width="75%">
                        <?php echo $faktura['sprzedawca_nip'];?>
                    </td>
                </tr>
            </table>
        </td>
        <td class="glowna">
            <h3>NABYWCA</h3>
            <table border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td width="25%">
                        Firma:
                    </td>
                    <td width="75%">
                        <?php echo $faktura['nabywca_nazwa'];?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        Adres:
                    </td>
                    <td width="75%">
                        <?php echo $faktura['nabywca_adres'];?><br />
                        <?php echo $faktura['nabywca_kod_pocztowy'];?> <?php echo $faktura['nabywca_miejscowosc'];?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        NIP:
                    </td>
                    <td width="75%">
                        <?php echo $faktura['nabywca_nip'];?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br />

<table border="1" cellpadding="5" cellspacing="0" class="wykaz">
    <tr class="naglowki">
        <td align="center" bgcolor="#EDEDED" width="5%">
            <font size="7">L.p</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="27%">
            <font size="7">Nazwa</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="5%">
            <font size="7">J.m.</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="6%">
            <font size="7">Ilosc</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="12%">
            <font size="7">Cena netto</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="12%">
            <font size="7">Kwota netto</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="10%">
            <font size="7">Stawka VAT</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="11%">
            <font size="7">Kwota VAT</font>
        </td>
        <td align="center" bgcolor="#EDEDED" width="12%">
            <font size="7">Wartosc brutto</font>
        </td>
    </tr>
    <?php $uslugi = $this -> load -> model('faktury') -> towary_i_uslugi(0); ?>
    <?php if($faktura['pozycje']){ ?>
    <?php $i = 1; foreach($faktura['pozycje'] as $pozycja){ ?>
    <tr>
        <td align="center" class="center" width="5%">
            <font size="9"><?php echo $i++;?></font>
        </td>
        <td width="27%">
            <font size="9"><?php if($faktura['zaliczka']){ ?>Zaliczka - <?php } ?><?php echo $uslugi[$pozycja['id_towaru_lub_uslugi']];?><?php echo $pozycja['id_towaru_lub_uslugi'] ? ' '.$pozycja['tytul'] : '';?></font>
        </td>
        <td align="right" class="right" width="5%">
            <font size="8"><?php echo $pozycja['jednostka_miary'];?></font>
        </td>
        <td align="center" class="center" width="6%">
            <font size="9"><?php echo str_replace('.00', '', $pozycja['ilosc']);?></font>
        </td>
        <td align="right" class="right" width="12%">
            <font size="9"><?php echo str_replace('.00', '', number_format($pozycja['cena_netto'], 2, '.', ' '));?></font>
        </td>
        <td align="right" class="right" width="12%">
            <font size="9"><?php echo str_replace('.00', '', number_format($pozycja['kwota_netto'], 2, '.', ' '));?></font>
        </td>
        <td align="center" class="center" width="10%">
            <font size="9"><?php echo $pozycja['stawka_vat'];?>%</font>
        </td>
        <td align="right" class="right" width="11%">
            <font size="9"><?php echo str_replace('.00', '', number_format($pozycja['kwota_podatku'], 2, '.', ' '));?></font>
        </td>
        <td align="right" class="right" width="12%">
            <font size="9"><?php echo str_replace('.00', '', number_format($pozycja['kwota_brutto'], 2, '.', ' '));?></font>
        </td>
    </tr>
    <?php } ?>
    <?php if($faktura_zaliczkowa){ ?>
    <tr>
        <td align="center" class="center" width="5%">
            <font size="9"><?php echo $i++;?></font>
        </td>
        <td width="27%">
            <font size="9">Faktura zaliczkowa <?php echo texts::numer_faktury($faktura_zaliczkowa);?></font>
        </td>
        <td align="right" class="right" width="5%">

        </td>
        <td align="center" class="center" width="6%">

        </td>
        <td align="right" class="right" width="12%">

        </td>
        <td align="right" class="right" width="12%">
            <font size="9">-<?php echo str_replace('.00', '', number_format($faktura_zaliczkowa['kwota_netto'], 2, '.', ' '));?></font>
        </td>
        <td align="center" class="center" width="10%">

        </td>
        <td align="right" class="right" width="11%">
            <font size="9">-<?php echo str_replace('.00', '', number_format($faktura_zaliczkowa['kwota_podatku'], 2, '.', ' '));?></font>
        </td>
        <td align="right" class="right" width="12%">
            <font size="9">-<?php echo str_replace('.00', '', number_format($faktura_zaliczkowa['kwota_brutto'], 2, '.', ' '));?></font>
        </td>
    </tr>
    <tr>
        <td align="right" class="right" bgcolor="#EDEDED" colspan="5" width="55%">
            <font size="9">Razem</font>
        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="12%">
            <font size="9"><?php echo str_replace('.00', '', number_format($faktura['kwota_netto'] - $faktura_zaliczkowa['kwota_netto'], 2, '.', ' '));?></font>
        </td>
        <td align="center" class="center" bgcolor="#EDEDED" width="10%">

        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="11%">
            <font size="9"><?php echo str_replace('.00', '', number_format($faktura['kwota_podatku'] - $faktura_zaliczkowa['kwota_podatku'], 2, '.', ' '));?></font>
        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="12%">
            <?php $faktura['kwota_brutto'] = $faktura['kwota_brutto'] - $faktura_zaliczkowa['kwota_brutto']; ?>
            <font size="9"><?php echo str_replace('.00', '', number_format($faktura['kwota_brutto'], 2, '.', ' '));?></font>
        </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td align="right" class="right" bgcolor="#EDEDED" colspan="5" width="55%">
            <font size="9">Razem</font>
        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="12%">
            <font size="9"><?php echo str_replace('.00', '', number_format($faktura['kwota_netto'], 2, '.', ' '));?></font>
        </td>
        <td align="center" class="center" bgcolor="#EDEDED" width="10%">

        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="11%">
            <font size="9"><?php echo str_replace('.00', '', number_format($faktura['kwota_podatku'], 2, '.', ' '));?></font>
        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="12%">
            <font size="9"><?php echo str_replace('.00', '', number_format($faktura['kwota_brutto'], 2, '.', ' '));?></font>
        </td>
    </tr>        
    <?php } ?>
    <?php } ?>
</table>

<br /><br />

<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <td bgcolor="#EDEDED" width="70%">
            <font size="8">Do zaplaty slownie</font>
        </td>
        <td align="right" class="right" bgcolor="#EDEDED" width="30%">
            <font size="8">Do zaplaty</font>
        </td>
    </tr>
    <tr>
        <td width="70%">
            <?php
                $klasa_slownie = new slownie;
                echo ucfirst(trim($klasa_slownie -> pokaz($faktura['kwota_brutto']))); 
            ?>
        </td>
        <td align="right" class="right wartosc" width="30%">
            <font size="13"><b><?php echo str_replace('.00', '', number_format($faktura['kwota_brutto'], 2, '.', ' '));?> PLN</b></font>
        </td>
    </tr>
</table>

<br /><br />
<?php if($faktura['forma_zaplaty'] == 'Przelew'){ ?>
<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <td bgcolor="#EDEDED" width="20%">
            Sposzaplaty
        </td>
        <td width="20%">
            <?php echo ucfirst($faktura['forma_zaplaty']);?>
        </td>
        <td bgcolor="#EDEDED" width="20%">
            W Banku:
        </td>
        <td width="40%">
            <?php echo PAYMENTS_TRANSFER_BANK_NAME;?>
        </td>
    </tr>
    <tr>
        <td bgcolor="#EDEDED" width="20%">
            Termin zaplaty
        </td>
        <td width="20%">
            <?php echo czytelna_data($faktura['termin_zaplaty']);?>
        </td>
        <td bgcolor="#EDEDED" width="20%">
            Nr konta:
        </td>
        <td width="40%">
            <?php echo PAYMENTS_TRANSFER_ACCOUNT_NUMBER;?>
        </td>
    </tr>
</table>
<?php }else{ ?>
<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <td bgcolor="#EDEDED" width="20%">
            Sposzaplaty
        </td>
        <td width="20%">
            <?php echo ucfirst($faktura['forma_zaplaty']);?>
        </td>
    </tr>
</table>
<?php } ?>

<br /><br />

<table border="1" cellpadding="10" cellspacing="3">
    <tr>
        <td>
            Adnotacje<br />
            <?php echo $faktura['adnotacje'] ? nl2br($faktura['adnotacje']) : '<br />';?>
        </td>
    </tr>
</table>

<br /><br />

<table border="1" cellpadding="10" cellspacing="3" class="podpisy">
    <tr>
        <td>
            Podpis odbiorcy:
            <br /><br /><br />
        </td>
        <td>
            Podpis wystawcy:
            <br />Artur Stanejko<br /><br />
        </td>
    </tr>
</table>

<p class="ustawa"><font align="center" color="#777" size="8">Podstawa? do wystawiania faktur VAT bez podpisu osoby uprawnionej do jej wystawienia oraz odbioru, jest Rozporza?dzenia Ministra Finansoz dnia 25 maja 2005 r. Dz. U. Nr 95/2005 poz. 798</font></p>
