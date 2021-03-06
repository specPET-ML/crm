<?php
$frazy_ryczalt = false;
$frazy_top_10 = false;
foreach($frazy as $fraza){
if($fraza['typ'] == 1) $frazy_top_10 = true;
if($fraza['typ'] == 2) $frazy_ryczalt = true;
$rok = strtok($klient['umowa_czas_okreslony_od'], '-');
}
?>
<html>
	<body>
		<h3 align="center">Umowa nr 1/P/<?php echo $klient['id_klienta'].'/'.$rok; ?></h3>
		<p align="center">zawarta w dniu <?php echo texts::nice_date($klient['umowa_czas_okreslony_od']);?> roku we Wrocławiu, pomiędzy :</p>
		<?php echo $klient['faktura_nazwa'] ? $klient['faktura_nazwa'] : '.............................................................';?><br />
		<?php echo $klient['faktura_adres'] ? $klient['faktura_adres'] : '.............................................................';?>, <?php echo ($klient['faktura_kod_pocztowy'] && $klient['faktura_miejscowosc']) ? $klient['faktura_kod_pocztowy'].' '.$klient['faktura_miejscowosc'] : '.............................................................';?><br />
		REGON : <?php echo $klient['regon'] ? $klient['regon'] : '.............................................................';?>, numer NIP : <?php echo $klient['nip'] ? $klient['nip'] : '.............................................................';?><br />
		Osoba reprezentująca: <?php echo $klient['reprezentant'] ? $klient['reprezentant'] : '.............................................................';?>, Pesel: <?php echo $klient['pesel'] ? $klient['pesel'] : '...............................';?>,<br />
		zwanym dalej „<strong>Zlecającym</strong>”,<br />
		<br />
		a<br />
		<br />
		ADP POLAND Sp. z o.o.<br />
		ul. Nowogródzka 10, 51-351 Wrocław<br />
		Regon: 932412296, NIP: 895-188-91-12, KRS: 0000258564<br />
		Kapitał zakładowy: 60 000zł, wpłacony w całości.<br />
		Osoba reprezentująca: Artur Stanejko<br />
		zwanym dalej „<strong>Wykonawcą</strong>”.
		
		<h1 align="center">§ 1</h1>
		<h2 align="center">Definicje</h2>
		<ol>
			<li><strong>Umowa</strong> - niniejsza umowa.</li>
			<li><strong>Załącznik</strong> - Załącznik nr 1 do <strong>Umowy</strong></li>
			<li><strong>Domena</strong> - ciąg znaków zakończony sufiksem, tworzący wraz z nim unikalną nazwę.</li>
			<li><strong>Przekierowanie</strong> - zabieg techniczny powodujący zmianę wyświetlanej <strong>Domeny</strong>.</li>
			<li><strong>Domena Docelowa </strong> - <strong>Domena</strong> wskazywana w Internecie przez <strong>Przekierowanie</strong>.</li>
			<li><strong>Serwis WWW</strong> - witryna internetowa, serwis internetowy, umieszczony w <strong>Domenie</strong> lub w <strong>Domenie Docelowej</strong>.</li>
			<li><strong>Pozycja Serwisu WWW</strong> - miejsce na liście wyników wyszukiwarki <u>www.google.pl</u>, na którym widnieje <strong>Serwis WWW</strong> po wpisaniu danej frazy lub słowa kluczowego określonego w <strong>Załączniku</strong>, nie biorąc pod uwagę reklam oraz linków sponsorowanych. Wyszukiwarka powinna mieć ustawione parametry wyszukiwania w języku polskim, bez wskazywania miasta. Użytkownik powinien być wylogowany ze swojego konta w Google i mieć wyczyszczoną zawartość pamięci podręcznej przeglądarki lub okno przeglądarki powinno być otwarte w trybie prywatnym. W wynikach wyszukiwania uwzględniane są pozycje Miejsc Google dla Firm (zwanych również Mapkami Google lub/i Stronami Google+) oraz Zakupów Google.</li>
			<li><strong>Panel Wyników</strong> - narzędzie zarządzane przez <strong>Wykonawcę</strong> i udostępnione <strong>Zlecającemu</strong> przez <strong>Wykonawcę</strong> rejestrujące <strong>Pozycje Serwisu WWW</strong>.</li>
			<li><strong>Optymalizacja Pozycji Serwisu WWW</strong> - działania mające na celu utrzymanie i/lub poprawę <strong>Pozycji Serwisu WWW</strong>.</li>

		</ol>

		<h1 align="center">§ 2</h1>
		<h2 align="center">Przedmiot Umowy</h2>
		<ol>
			<li><strong>Zlecający</strong> oświadcza, że:
				<ol type="a">
					<li>przysługują mu prawa do <strong>Domeny</strong> o nazwie <strong><?php echo $klient['adres_strony'];?></strong>;</li>
					<li>przysługują mu autorskie prawa majątkowe do <strong>Serwisu WWW</strong>, w tym prawo do dokonywania zmian w jego kodzie źródłowym i treści;</li>
					<li>przysługują mu prawa do publikowania materiałów w <strong>Serwisie WWW</strong> oraz ponosi całkowitą odpowiedzialność za ich zawartość i treść;</li>
					<li>nie korzysta z usług innych podmiotów zajmujących się pozycjonowaniem i/lub świadczeniem usług SEO dla <strong>Serwisu WWW</strong>.</li>
				</ol>
			</li>
	<?php if($frazy_ryczalt && $frazy_top_10 == false){ ?>
			<li><strong>Zlecający</strong> zleca <strong>Wykonawcy</strong>, a <strong>Wykonawca</strong> zobowiązuje się za wynagrodzeniem ryczałtowym, o którym mowa w<br />§ 6, do <strong>Optymalizacji Pozycji Serwisu WWW</strong>.</li>
			<?php } ?>
	<?php if($frazy_top_10 && $frazy_ryczalt == false){ ?>
			<li><strong>Zlecający</strong> zleca <strong>Wykonawcy</strong>, a <strong>Wykonawca</strong> zobowiązuje się za wynagrodzeniem w ramach <strong>wariantu PIERWSZA STRONA</strong>, o którym mowa w § 6 do <strong>Optymalizacji Pozycji Serwisu WWW</strong>.</li>
			<?php } ?>
	<?php if($frazy_top_10 && $frazy_ryczalt){ ?>
			<li><strong>Zlecający</strong> zleca <strong>Wykonawcy</strong>, a <strong>Wykonawca</strong> zobowiązuje się za wynagrodzeniem ryczałtowym oraz za wynagrodzeniem w ramach <strong>wariantu PIERWSZA STRONA</strong>, o których mowa w § 6, do <strong>Optymalizacji Pozycji Serwisu WWW</strong>.</li>
			<?php } ?>
			<li>
				<strong>Optymalizacja Pozycji Serwisu WWW</strong>, o której mowa w ust. 2 niniejszego paragrafu może obejmować wybrane działania <strong>Wykonawcy</strong> tj.: 
				<ol type="a">
					<li>przygotowanie niezbędnego środowiska systemowego <strong>Optymalizacji Pozycji Serwisu WWW</strong>;</li>
					<li>włączenie <strong>Serwisu WWW</strong> do własnego, autorskiego systemu <strong>Optymalizacji Pozycji Serwisu WWW</strong>;</li>
					<li>wykonywanie według uznania <strong>Wykonawcy</strong> zmiany kodu źródłowego <strong>Serwisu WWW</strong>;</li>
					<li>modyfikowanie według uznania <strong>Wykonawcy</strong>  tekstów zamieszczonych w <strong>Serwisie WWW</strong>;</li>
					<?php if($klient['nowe_teksty']) {?>
						<li>wprowadzanie według uznania <strong>Wykonawcy</strong> nowych tekstów w <strong>Serwisie WWW</strong> niezbędnych dla potrzeb <strong>Optymalizacji Pozycji Serwisu WWW</strong>;</li>
					<?php } ?>
					<?php if($klient['nowa_strona']) {?>
						<li>wykonanie dla potrzeb <strong>Optymalizacji Pozycji Serwisu WWW</strong> nowej wersji <strong>Serwisu WWW</strong> zgodnie ze specyfikacją określoną w Załączniku nr 2 do Umowy.</li>
					<?php } ?>
				</ol>
			</li>
			
			<li>Usługa <strong>Optymalizacji Pozycji Serwisu WWW</strong> świadczona przez <strong>Wykonawcę</strong> dotyczy wyłącznie <strong>Domeny</strong> określonej w § 2 ust. 1 lit. a). Zmiana <strong>Domeny</strong> nie jest możliwa w trakcie obowiązywania <strong>Umowy</strong>, chyba że <strong>Strony</strong> pisemnie postanowią inaczej. Zmiana <strong>Domeny</strong> stanowi istotną zmianę <strong>Umowy</strong>, dokonywaną zgodnie z § 9 ust. 1.</li>
			<li>W przypadku stwierdzenia, po uzyskaniu dostępu do <i>Narzędzi Dla Webmasterów Google</i> dla <strong>Domeny</strong> określonej w § 2 ust. 1 lit. a), nałożenia ręcznej interwencji Google <strong>Wykonawca</strong>, po powiadomieniu <strong>Zlecającego</strong>, podejmie prace mające na celu usunięcie ręcznej interwencji Google, za odrębnym wynagrodzeniem określonym w § 6.</li>
		</ol>
		
		<h1 align="center">§ 3</h1>
		<h2 align="center">Obowiązki <strong>Wykonawcy</strong></h2>
		<ol>
			<li><strong>Wykonawca</strong> zobowiązany jest świadczyć usługi objęte <strong>Umową</strong>, jednakże nie będzie odpowiedzialny względem <strong>Zlecającego</strong>, za jakiekolwiek działania osób trzecich (nie współpracujących na zlecenie <strong>Wykonawcy</strong> przy realizacji <strong>Umowy</strong>), jak również nie ponosi odpowiedzialności za nieregularność <strong>Pozycji Serwisu WWW</strong> będącą skutkiem zmiany algorytmów wyszukiwania wyszukiwarki Google, czy też błędy w jej algorytmach i kodzie.</li>
			<li><strong>Wykonawca</strong> zapewni <strong>Zlecającemu</strong> dostęp do <strong>Panelu Wyników</strong>.</li>
			<li><strong>Wykonawca</strong> przez cały okres trwania <strong>Umowy</strong> uprawniony jest do umieszczenia w stopce <strong>Serwisu WWW</strong> bannera reklamowego i/lub linka, z atrybutem "nofollow", kierującego do stron <strong>Wykonawcy</strong>.</li>
			<li><strong>Wykonawca</strong> w okresie trwania <strong>Umowy</strong> oraz po jej zakończeniu, uprawniony jest do wykorzystywania informacji zebranych w <strong>Panelu Wyników</strong>, jednakże bez podawania danych <strong>Zlecającego</strong>, we wszystkich materiałach publikowanych za zgodą i wiedzą <strong>Wykonawcy</strong>.</li>
			<li><strong>Wykonawca</strong> zastrzega sobie możliwość wycofania części lub wszystkich zmian w <strong>Serwisie WWW</strong>, o których mowa w § 2 ust. 3 lit. c i d.</li>
		</ol>
		
		<h1 align="center">§ 4</h1>
		<h2 align="center">Obowiązki Zlecającego</h2>
		<ol>
			<li><strong>Zlecający</strong> zobowiązany jest do:
				<ol type="a">
					<li>przekazania <strong>Wykonawcy</strong>, informacji umożliwiających dostęp administracyjny do plików źródłowych <strong>Serwisu WWW</strong> oraz panelu administracyjnego <strong>Serwisu WWW;</strong></li>
					<li>umożliwienia założenia przez <strong>Wykonawcę</strong> konta użytkownika w <strong>Serwisie WWW</strong>;</li>
					<li>niedokonywania zmian w plikach źródłowych <strong>Serwisu WWW</strong> oraz zmian treści <strong>Serwisu WWW</strong> bez uzyskania e-mailem akceptacji <strong>Wykonawcy</strong>;</li>
					<li>zapewnienia ciągłości widoczności <strong>Serwisu WWW</strong> w Internecie i poprawności jego działania;</li>
					<li>stosowania się do zaleceń <strong>Wykonawcy</strong> w zakresie technicznego wykonania i utrzymania <strong>Serwisu WWW</strong>, zarządzania jego treścią, publikowania w Internecie treści powiązanych z tematyką <strong>Serwisu WWW</strong> oraz innych zaleceń niezbędnych dla realizacji <strong>Umowy</strong> zgłaszanych <strong>Zlecającemu</strong> przez <strong>Wykonawcę</strong>;</li>
					<li>uiszczania wynagrodzenia zgodnie z postanowieniami <strong>Umowy</strong>;</li>
					<li>nie korzystania w trakcie obowiązywania <strong>Umowy</strong>, z usług innych podmiotów zajmujących się pozycjonowaniem i/lub świadczeniem usług SEO dla <strong>Serwisu WWW</strong>.</li>
				</ol>
			</li>
			<li><strong>Zlecający</strong> wyraża zgodę na wprowadzanie przez <strong>Wykonawcę</strong> lub wskazanego przez niego administratora <strong>Serwisu WWW</strong> zmian w <strong>Serwisie WWW</strong> dla potrzeb realizacji <strong>Umowy</strong>.</li>
		</ol>
		
		<h1 align="center">§ 5</h1>
		<h2 align="center">Zasady realizacji umowy i skutki niewykonania umowy</h2>
		<ol>
			<li>Przesyłanie wszelkich informacji, materiałów lub propozycji między <strong>Stronami</strong> następować będzie za pośrednictwem poczty e-mail na adresy: dla <strong>Zlecającego</strong> - "<?php echo $klient['mail'];?>". Dla <strong>Wykonawcy</strong> - "pozycjonowanie@adppoland.pl". Zmiana adresu e-mail wymaga pisemnego oświadczenia <strong>Strony</strong>, której adres e-mail uległ zmianie, złożonego drugiej <strong>Stronie</strong> za pośrednictwem poczty e-mail.</li>
			<li>Wszystkie zgłoszenia lub ustalenia przekazywane telefoniczne lub ustnie dotyczące realizacji <strong>Umowy</strong> wymagają dla swej ważności potwierdzenia przez pocztę e-mail.</li>
			<li>Na żądanie każdej ze <strong>Stron</strong> wszystkie zgłoszenia lub ustalenia związane z realizacją <strong>Umowy</strong> zostaną potwierdzone pisemnie.</li>
			<li><strong>Wykonawca</strong> zobowiązuje się realizować <strong>Umowę</strong> z należytą starannością z pełnym wykorzystaniem posiadanej wiedzy i narzędzi związanych z <strong>Optymalizacją Pozycji Serwisu WWW</strong>. <strong>Wykonawca</strong> nie ponosi jednak odpowiedzialności za efekt końcowy realizacji <strong>Umowy</strong>.</li>
			<li><strong>Wykonawca</strong> ma prawo w każdym momencie wstrzymać wykonywanie świadczenie usług i odmówić ich dalszego wykonywania w przypadku umieszczania na <strong>Stronie WWW</strong> treści i/lub materiałów niezgodnych z polskim prawem, dobrymi obyczajami, wywołujących oburzenie, nawołujących do łamania prawa, przemocy, naruszających dobre imię osób trzecich itp.</li>
			<li><strong>Wykonawca</strong> nie ponosi odpowiedzialności za nienależytą realizację <strong>Umowy</strong>, w skutek naruszenia przez <strong>Zlecającego</strong> obowiązku określonych w § 4.</li>
			<li>W przypadku braku zapłaty przez <strong>Zlecającego</strong> pełnej kwoty z tytułu wystawionej przez <strong>Wykonawcę</strong> faktury w terminie określonym w § 6 ust. 2 <strong>Wykonawca</strong> wezwie <strong>Zlecającego</strong> za pośrednictwem poczty e-mail do uregulowania wynagrodzenia w terminie 7 dni od otrzymania wezwania. Po bezskutecznym upływie wyznaczonego terminu może wstrzymać świadczenie usług będących przedmiotem <strong>Umowy</strong>, do momentu całkowitego uregulowania należności.</li>
			<li>W razie sytuacji opisanej w ust. 5 i 7 niniejszego paragrafu <strong>Wykonawca</strong> nie ponosi odpowiedzialności za skutki wstrzymania realizacji <strong>Umowy</strong>.</li>
		</ol>
		
		<h1 align="center">§ 6</h1>
		<h2 align="center">Wynagrodzenie i warunki płatności</h2>
<?php if($frazy_ryczalt && $frazy_top_10 == false){ ?>
				<ol>
					<li>Za wykonanie usługi <strong>Optymalizacji Pozycji Serwisu WWW Wykonawcy</strong> należne jest od <strong>Zlecającego</strong> wynagrodzenie ryczałtowe w kwocie, określonej w <strong>Załączniku</strong>, miesięcznie netto powiększone o należny podatek od towarów i usług w stawce obowiązującej w dniu powstania prawa do wynagrodzenia.</li>
					<li>Wynagrodzenie płatne jest przez <strong>Zlecającego</strong> na podstawie faktury wystawianej przez <strong>Wykonawcę</strong>, w terminie 7 dni od wystawienia faktury.</li>
					<li>Za wykonanie przedmiotu <strong>Umowy</strong> określonego w § 2 ust. 5 <strong>Wykonawcy</strong> należne jest od <strong>Zlecającego</strong> wynagrodzenie w kwocie 300 zł (słownie trzysta złotych) netto powiększone o należny podatek od towarów i usług w stawce obowiązującej w dniu powstania prawa do wynagrodzenia, na podstawie faktury wystawionej przez <strong>Wykonawcę</strong>, po otrzymaniu komunikatu od Google o wycofaniu ręcznej interwencji, płatne w terminie 7 dni od daty wystawienia faktury.</li>
					<li><strong>Zlecający</strong> wyraża zgodę na przesyłanie faktur drogą elektroniczną w formie plików PDF lub równoważnych, gwarantujących integralność zawartych danych. Faktury będą przesyłane na następujący adres e-mail <strong>Zlecającego</strong>: <?php echo $klient['mail'];?></li>
					<li><strong>Zlecający</strong> jest upoważniony do zmiany adresu e-mail, na który przesyłane będą faktury lub cofnięcia zgody na przesyłanie faktur drogą elektroniczną, na zasadach określonych w przepisach prawa podatkowego.</li>
				</ol>
			<?php } ?>
<?php if($frazy_top_10 && $frazy_ryczalt == false){ ?>
				<ol>
					<li>Za wykonanie usługi <strong>Optymalizacji Pozycji Serwisu WWW Wykonawcy</strong> należne jest od <strong>Zlecającego</strong> wynagrodzenie w ramach <strong>wariantu PIERWSZA STRONA</strong>, według stawek określonych przez <strong>Strony</strong> w <strong>Załączniku</strong>, dla każdej frazy i/lub słowa kluczowego. Stawki określone w <strong>Załączniku</strong> dzielone są przez liczbę dni w danym miesiącu kalendarzowym, a następnie, na podstawie danych dostępnych w <strong>Panelu Wyników</strong>, mnożone są przez ilość dni, w których <strong>Pozycja Serwisu WWW</strong> dla danej frazy lub/i słowa kluczowego znajdowała się w określonym, przez <strong>Załącznik</strong> przedziale.</li>
					<li>Łączne miesięczne wynagrodzenie <strong>Wykonawcy</strong> stanowi sumę wynagrodzenia cząstkowego obliczonego zgodnie z ustępem 1 niniejszego paragrafu za wszystkie dni w miesiącu dla każdej frazy i/lub słowa kluczowego określonych w <strong>Załączniku</strong>, powiększone o należny podatek od towarów i usług w stawce obowiązującej w dniu powstania prawa do wynagrodzenia i płatne jest przez <strong>Zlecającego</strong> na podstawie faktury wystawionej przez <strong>Wykonawcę</strong> na koniec każdego miesiąca kalendarzowego, w terminie 7 dni od dnia wystawienia faktury.</li>
					<li>Za wykonanie przedmiotu Umowy określonego w § 2 ust. 5 <strong>Wykonawcy</strong> należne jest od <strong>Zlecającego</strong> wynagrodzenie w kwocie 300 zł (słownie trzysta złotych) netto powiększone o należny podatek od towarów i usług w stawce obowiązującej w dniu powstania prawa do wynagrodzenia, na podstawie faktury  wystawionej przez <strong>Wykonawcę</strong>, po otrzymaniu komunikatu od Google o wycofaniu ręcznej interwencji, płatne w terminie 7 dni od daty wystawienia faktury.</li>
					<li><strong>Zlecający</strong> wyraża zgodę na przesyłanie faktur drogą elektroniczną w formie plików PDF lub równoważnych, gwarantujących integralność zawartych danych. Faktury będą przesyłane na następujący adres e-mail <strong>Zlecającego</strong>: <?php echo $klient['mail'];?>
					</li>
					<li><strong>Zlecający</strong> jest upoważniony do zmiany adresu e-mail, na który przesyłane będą faktury VAT lub cofnięcia zgody na przesyłanie faktur drogą elektroniczną, na zasadach określonych w przepisach prawa podatkowego.</li>
				</ol>
			<?php } ?>
<?php if($frazy_top_10 && $frazy_ryczalt){ ?>
				<ol>
					<li>Za wykonanie usługi <strong>Optymalizacji Pozycji Serwisu WWW Wykonawcy</strong> należne jest od <strong>Zlecającego</strong> wynagrodzenie w ramach wynagrodzenia ryczałtowego oraz <strong>wariantu PIERWSZA STRONA</strong>, według stawek określonych przez <strong>Strony</strong> w <strong>Załączniku</strong>. Dla każdej frazy i/lub słowa kluczowego przypisanych do <strong>wariantu Pierwsza Strona</strong>. stawki określone w <strong>Załączniku</strong> dzielone są przez liczbę dni w danym miesiącu kalendarzowym, a następnie, na podstawie danych dostępnych w <strong>Panelu Wyników</strong>, mnożone są przez ilość dni, w których <strong>Pozycja Serwisu WWW</strong> dla danej frazy lub/i słowa kluczowego znajdowała się w określonym, przez <strong>Załącznik</strong> przedziale.</li>
					<li>Łączne miesięczne wynagrodzenie <strong>Wykonawcy</strong> stanowi sumę wynagrodzenia ryczałtowego i wynagrodzenia wyliczonego w ramach <strong>wariantu Pierwsza Strona</strong> zgodnie z ustępem 1 niniejszego paragrafu dla każdego słowa kluczowego i/lub frazy, określonych w <strong>Załączniku</strong>, powiększona o należny podatek od towarów i usług w stawce obowiązującej w dniu powstania prawa do wynagrodzenia i płatne jest przez <strong>Zlecającego</strong> na podstawie faktury wystawionej przez <strong>Wykonawcę</strong> na koniec każdego miesiąca kalendarzowego w terminie 7 dni od dnia wystawienia faktury.</li>
					<li>Za wykonanie przedmiotu Umowy określonego w § 2 ust. 5 <strong>Wykonawcy</strong> należne jest od <strong>Zlecającego</strong> wynagrodzenie w kwocie 300 zł (słownie trzysta złotych) netto powiększone o należny podatek od towarów i usług w stawce obowiązującej w dniu powstania prawa do wynagrodzenia, na podstawie faktury  wystawionej przez <strong>Wykonawcę</strong>, po otrzymaniu komunikatu od Google o wycofaniu ręcznej interwencji, płatne w terminie 7 dni od daty wystawienia faktury.</li>
					<li><strong>Zlecający</strong> wyraża zgodę na przesyłanie faktur drogą elektroniczną w formie plików PDF lub równoważnych, gwarantujących integralność zawartych danych. Faktury będą przesyłane na następujący adres e-mail <strong>Zlecającego</strong>: <?php echo $klient['mail'];?>
					</li>
					<li><strong>Zlecający</strong> jest upoważniony do zmiany adresu e-mail, na który przesyłane będą faktury VAT lub cofnięcia zgody na przesyłanie faktur drogą elektroniczną, na zasadach określonych w przepisach prawa podatkowego.</li>
				</ol>
			<?php } ?>
		<h1 align="center">§ 7</h1>
		<h2 align="center">Ochrona tajemnicy</h2>
		<ol>
			<li><strong>Strony</strong> zobowiązują się do zachowania w tajemnicy wszystkich informacji o drugiej <strong>Stronie</strong> uzyskanych podczas współpracy w ramach <strong>Umowy</strong>, w szczególności związanych z wykorzystywanym oprogramowaniem, narzędziami informatycznymi oraz przekazaną dokumentacją, zarówno w trakcie wykonywania zobowiązań wynikających z<br /><strong>Umowy</strong>, jak i po jej rozwiązaniu.</li>
			<li>Obowiązek zachowania w poufności informacji dotyczy w szczególności stosowanego przez <strong>Wykonawcę</strong>  sposobu <strong>Optymalizacji Pozycji Serwisu WWW</strong>.</li>
			<li>Klauzula poufności o której mowa w ustępie 1 niniejszego paragrafu dotyczy także treści <strong>Umowy</strong>.</li>
			<li><strong>Strony</strong> mogą ujawniać osobom trzecim informacje poufne, jeżeli uzyskały na to pisemną akceptację drugiej <strong>Strony</strong>.</li>
			<li>Zobowiązania do zachowania przez <strong>Strony</strong>  w tajemnicy informacji poufnych nie narusza ujawnienie:
				<ol type="a">
					<li>informacji ogólnie dostępnych;</li>
					<li>informacji uzyskanych niezależnie od osoby trzeciej, która nie jest zobowiązana do zachowania poufności wobec <strong>Stron</strong> w odniesieniu do tych informacji;</li>
					<li>informacji, których ujawnienie jest obowiązkowe na podstawie przepisów prawa.</li>
				</ol>
			</li>
			<li><strong>Strony</strong> mogą wyjawić informacje objęte tajemnicą tylko tym pracownikom lub podwykonawcom, którzy są bezpośrednio zaangażowani w realizację <strong>Umowy</strong>, pod warunkiem, że będą oni przestrzegać warunków związanych z ochroną tajemnicy.</li>
		</ol>
		<?php if($frazy_ryczalt){ ?>
		<p> </p><p> </p>
		<?php } ?>
		<h1 align="center">§ 8</h1>
		<h2 align="center">Czas trwania</h2>
		<?php if($klient['umowa_czas_okreslony'] && $klient['nowa_strona'] == false && $klient['nowe_teksty'] == false && $klient['okres_umowy'] == 0){ ?>
			<ol>
				<li><strong>Umowa</strong> zostaje zawarta na czas określony od dnia <?php echo texts::nice_date($klient['umowa_czas_okreslony_od']);?> do dnia <?php echo texts::nice_date($klient['umowa_czas_okreslony_do']);?>.</li>
				<li><strong>Wykonawca</strong> jest uprawniony do rozwiązania <strong>Umowy</strong> ze skutkiem natychmiastowym w przypadku naruszenia przez <strong>Zlecającego</strong> postanowień <strong>Umowy</strong>, a w szczególności  w przypadku zaległości <strong>Zlecającego</strong>  w zapłacie należności za dwa okresy płatności.</li>
			</ol>
		<?php } ?>
		<?php if($klient['umowa_czas_okreslony'] == false && $klient['nowa_strona'] == false && $klient['nowe_teksty'] == false && $klient['okres_umowy'] == 0){ ?>
			<ol>
				<li><strong>Umowa</strong> zostaje zawarta na czas nieokreślony i wchodzi w życie z dniem .......................................</li>
				<li>Każda ze <strong>Stron</strong> może rozwiązać <strong>Umowę</strong> za pisemnym wypowiedzeniem przesłanym listem poleconym na adres siedziby drugiej <strong>Strony</strong>. <strong>Strony</strong> wykluczają inną niż pisemna forma wypowiedzenia <strong>Umowy</strong>, pod rygorem jego nieważności.</li>
			<?php if($frazy_ryczalt && $frazy_top_10 == false){ ?>
						<li>Okres wypowiedzenia umowy wynosi 1 (jeden) miesiąc kalendarzowy, liczony od pierwszego dnia miesiąca kalendarzowego, następującego po miesiącu, w którym zostało doręczone wypowiedzenie <strong>Umowy</strong>.</li>
			<?php } if($frazy_top_10) { ?>
						<li>Okres wypowiedzenia umowy wynosi 3 (trzy) miesiące kalendarzowe, liczone od pierwszego dnia miesiąca kalendarzowego, następującego po miesiącu, w którym zostało doręczone wypowiedzenie <strong>Umowy</strong>.</li>
					<?php } ?>
				<li><strong>Wykonawca</strong> jest uprawniony do rozwiązania <strong>Umowy</strong> ze skutkiem natychmiastowym w przypadku naruszenia przez <strong>Zlecającego</strong> postanowień <strong>Umowy</strong>, a w szczególności  w przypadku zaległości <strong>Zlecającego</strong>  w zapłacie należności za dwa okresy płatności.</li>
			</ol>
		<?php } ?> 
		<?php if($klient['nowa_strona'] || $klient['nowe_teksty'] || $klient['okres_umowy'] != 0){ ?>
			<ol>
				<li><strong>Umowa</strong> wchodzi w życie z dniem ....................................... i zostaje zawarta na czas określony <?php echo $klient['okres_umowy']; ?> miesięcy liczonych od pierwszego dnia miesiąca kalendarzowego następującego po miesiącu wejścia <strong>Umowy</strong> w życie.</li>
				<li>W przypadku określonym w § 2 ust. 5 <strong>Umowa</strong> ulega przedłużeniu o cały okres, niezbędny do zidentyfikowania przyczyn i usunięcia ręcznej interwencji Google, przy czym miesiąc zidentyfikowania ręcznej interwencji Google liczony jest jako pierwszy miesiąc, a miesiąc w którym nastąpiło usunięcie ręcznej interwencji Google jako ostatni miesiąc okresu, o który nastąpi przedłużenie umowy. Łączny okres, o który przedłużona zostaje umowa stanowi suma miesięcy liczonych od pierwszego miesiąca do ostatniego miesiąca.</li>
				<li>Gdy w okresie o którym mowa w ustępie 1 i 2 niniejszego paragrafu, <strong>Pozycja Serwisu WWW</strong>w <strong>Panelu Wyników</strong> będzie przez co najmniej 14 dni na co najmniej 10% (dziesięć procent) słów i/lub fraz kluczowych, określonych w <strong>Załączniku</strong>, na pierwszej stronie, w takim wypadku, po upływie terminu określonego w ustępie 1 i 2 niniejszego paragrafu, <strong>Umowa</strong> przechodzi w <strong>Umowę</strong> zawartą na czas nieokreślony, z okresem wypowiedzenia <strong>Umowy</strong> wynoszącym 3 (trzy) miesiące kalendarzowe, liczone od pierwszego dnia miesiąca kalendarzowego, następującego po miesiącu, w którym zostało doręczone wypowiedzenie.</li>
				<li>Wypowiedzenie o którym mowa w ustępie 3 niniejszego paragrafu, w formie pisemnej, winno być przesłane listem poleconym, na adres siedziby  drugiej <strong>Strony</strong>. <strong>Strony</strong> wykluczają inną niż pisemna forma wypowiedzenia <strong>Umowy</strong>, pod rygorem jego nieważności.</li>
				<li><strong>Wykonawca</strong> jest uprawniony do rozwiązania <strong>Umowy</strong> ze skutkiem natychmiastowym w przypadku naruszenia przez <strong>Zlecającego</strong> postanowień <strong>Umowy</strong>, a w szczególności  w przypadku zaległości <strong>Zlecającego</strong> w zapłacie należności za dwa okresy płatności.</li>
			</ol>
		<?php } ?>
		<h1 align="center">§ 9</h1>
		<h2 align="center">Postanowienia końcowe</h2>
		<ol>
			<li>Wszelkie zmiany treści <strong>Umowy</strong> wymagają dla swej ważności zachowania formy pisemnej - aneksu do <strong>Umowy</strong>.</li>
			<li>W sprawach nie uregulowanych <strong>Umową</strong> zastosowanie mają przepisy Kodeksu Cywilnego, ustawy o prawach autorskich i prawach pokrewnych i inne właściwe przepisy prawa.</li>
			<li>Wszelkie spory wynikłe z wykonywania postanowień <strong>Umowy Strony</strong> zobowiązują się rozwiązywać polubownie na drodze negocjacji. W razie braku porozumienia spory rozstrzygał będzie sąd powszechny właściwy dla miejsca siedziby <strong>Wykonawcy</strong>.</li>
			<li>Integralną część <strong>Umowy</strong> stanowią Załączniki.</li>
			<li><strong>Umowę</strong> sporządzono w 2 jednobrzmiących egzemplarzach, po jednym dla każdej ze <strong>Stron</strong>.</li>
		</ol>
		<table>
			<tr>
				<td>
					<p align="center">ZLECAJĄCY:</p>
				</td>
				<td>
					<p align="center">WYKONAWCA:<br />Artur Stanejko</p>
				</td>
			</tr>
		</table>
	</body>
</html>