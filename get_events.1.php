<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');  

    function translateMonthName( $month ){
        strtolower($month);
        $nmeng = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
        $nmtur = array('januar', 'februar', 'märz', 'april', 'mai', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'dezember');
        return str_ireplace($nmtur, $nmeng, $month);
    }

    function removeWeekDay( $date ){
        preg_match("/[^,]+.$/", $date, $result);
        return trim( $result[0] );
    }

    function seperateMonth( $string ){
        preg_match("/([a-zA-Z])\w+/", $string, $result);
        return $result[0];
    }

    function addCalendarStart( $organizer ){ // funktioniert nicht weil kein Dateiname vorhanden
        $eol = "\r\n";
        $kb_ics_content = 
        'BEGIN:VCALENDAR'.$eol.
        'VERSION:2.0'.$eol.
        'PRODID:-//mxkraus//mxkraus.de//DE'.$eol.
        'CALSCALE:GREGORIAN'.$eol; 
        file_put_contents('dist/events_'.$organizer.'.ics', $kb_ics_content, FILE_APPEND);
    }
    function addCalendarEvent( $organizer, $start, $end, $current, $title, $location, $description ){
        $kb_start = $start;
        $kb_end = $end;
        $kb_current_time = $current;
        $kb_title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
        $kb_location = preg_replace('/([\,;])/','\\\$1',$location); 
        $kb_description = html_entity_decode($description, ENT_COMPAT, 'UTF-8');
        $kb_url = 'https://mxkraus.de';
        $kb_file_name = $organizer;

        $eol = "\r\n";
        $kb_ics_content =
        'BEGIN:VEVENT'.$eol.
        'DTSTART:'.$kb_start.$eol.
        'DTEND:'.$kb_end.$eol.
        'LOCATION:'.$kb_location.$eol.
        'DTSTAMP:'.$kb_current_time.$eol.
        'SUMMARY:'.$kb_title.$eol.
        'URL;VALUE=URI:'.$kb_url.$eol.
        'DESCRIPTION:'.$kb_description.$eol.
        'UID:'.$kb_current_time.'-'.$kb_start.'-'.$kb_end.$eol.
        'END:VEVENT'.$eol;

        file_put_contents('dist/events_'.$kb_file_name.'.ics', $kb_ics_content, FILE_APPEND);

    }
    function addCalendarEnd( $organizer ){
        $eol = "\r\n";
        $kb_ics_content = 'END:VCALENDAR';
        file_put_contents('dist/events_'.$organizer.'.ics', $kb_ics_content, FILE_APPEND);
    } 

    setlocale(LC_TIME, "de_DE.utf8");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $year_last = date("Y") - 1;
    $year_now = date("Y");
    $year_next = date("Y") + 1;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.vereinskartell-stoernstein.de/index.php/kalenderexport/year.listevents/" . $year_now);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $response = curl_exec( $ch );
    $info = curl_getinfo($ch);
    if( false === $response ){ echo 'Curl-Fehler: ' . curl_error($ch); }
    curl_close( $ch );


    /**
     * HTML Parser
     * 
     */
    include "simple_html_dom.php";    
    $html = new simple_html_dom();
    $html->load( $response );

    $vereine = array();
    $societyColor = array();
    $json = array();
    $current_color = '';
    $old_color = '';

    foreach( $html->find('tr') as $tr ):

        // Monatsnamen
        $monthName = $tr->find('.ev_td_left', 0);

        foreach( $tr->find('.ev_td_li') as $li ):


            /**
             * Termine als Liste ausgeben
             */
            $style = $li->style;
            preg_match( "/#.{6}/", $style, $li_bgcolor );
            if( count($li_bgcolor) == 0 ){ 
                $li_bgcolor[] = '#0000FF'; 
            }


            /**
             * Array nach Farben (Vereine) gruppieren
             * 
             */
            $current_color = $li_bgcolor[0];

            
            /**
             * Zeileninhalt zerlegen
             * Startdatum als Key festlegen
             * 
             */
            $event_paragraph = $li->find('p', 0);


            /**
             * 1. Von-Bis Zeiten extrahieren
             * 2. Zeitspannen / Zeitpunkte festlegen
             */
            preg_match("/(^.*?[a-zA-Z]{1,8} [0-9]{4})( [-] .*[0-9]{4})?/", strip_tags($event_paragraph), $event_output);
            $times = explode( " - ", $event_output[0] );
            switch( count($times) ){
                case 1: 
                    $event_start = removeWeekDay($times[0]); 
                    $event_end = removeWeekDay($times[0]);
                    break;
                case 2: 
                    $event_start = removeWeekDay($times[0]); 
                    $event_end = removeWeekDay($times[1]); 
                    break;
            }


            /**
             * Vonzeiten einfügen
             * 
             */
            $event_start_date = removeWeekDay($event_start);
            $event_start_date = translateMonthName( $event_start_date ); // Deutsche Monate übersetzen
            $event_start_date = strtotime ( $event_start_date ); // Timestamp erzeugen
            $event_start_date = strftime("%d-%m-%Y", $event_start_date); //. "T130000"; // Timestamp formatieren
            $vereine[$current_color][$event_start]['timefrom'] = $event_start_date;


            /**
             * Biszeiten einfüen
             * 
             */
            $event_end_date = removeWeekDay($event_end);
            $event_end_date = translateMonthName( $event_end_date ); // Deutsche Monate übersetzen
            $event_end_date = strtotime ( $event_end_date ); // Timestamp erzeugen
            $event_end_date = strftime("%d-%m-%Y", $event_end_date); //. "T130000"; // Timestamp formatieren
            $vereine[$current_color][$event_start]['timeto'] = $event_end_date;


            /**
             * Termintitel in Array einfügen
             * 
             */ 
            $event_link = $event_paragraph->find('.ev_link_row', 0);
            $vereine[$current_color][$event_start]['title'] = strip_tags( $event_link->title );


            /**
             * Vereinsnamen in Array einfügen
             * 
             */
            preg_match("/([a-zA-Z1-9]+[-]?[^-]+)$/", strip_tags( $event_paragraph ), $society_output);
            $society_name = $society_output[0];
            $vereine[$current_color][$event_start]['organizer'] = $society_name;


            /**
             * Vereinsfarbe in Array einfügen
             * 
             */
            $vereine[$current_color][$event_start]['color'] = $current_color;

            
            /**
             * Monat einfügen
             * 
             */
            $currentMonth = translateMonthName( $monthName->plaintext );
            $vereine[$current_color][$event_start]['month'] = seperateMonth( $currentMonth );


            /**
             * Zuordnungsarray erstellen
             * Farbwert => Vereinsname
             * 
             */
            $translateNameColor = array();
            $society_name = preg_replace( '/\s+|-|\./', '', $society_name ); // Verein bereinigen
            $society_name = str_replace(array('ä','ö','ü','ß'), array('ae','oe','ue','ss'), $society_name ); // Verein bereinigen
            $translateNameColor['name'] = strtolower( $society_name );
            $translateNameColor['color'] = strtolower( $current_color );
            if( ! in_array( $translateNameColor, $societyColor) ){
                array_push( $societyColor, $translateNameColor );
            }


        endforeach;

    endforeach;


    /**
     * @array $vereine enthält alle #FARBWERTE und die gesammelten Events
     * @array societyColor enthält zu jedem #FARBWERT den dazugehörigen Vereinsnamen
     * 
     * Hier werden die Array Keys vom Farbwert in den im Vergleichsarray 
     * festgelegten Vereinsnamen umgewandelt.
     */
    foreach( $vereine as $color => $value) {
        $keyd = array_search( strtolower( $color ), array_column($societyColor, 'color'));
        $name = $societyColor[$keyd]['name'];
        unset($vereine[$color]);
        $vereine[$name] = $value;
    }


    /**
     * Array "umhängen", Infos eine Ebene nach oben transportieren
     * 
     */
    $json = array();
    foreach ($vereine as $verein => $details) {
        $fullname = '';
        foreach($details as $date => $event){
            $fullname = $event['organizer'];
        }
        $json[] = array(
            'verein' => $verein,
            'verein_full' => $fullname,
            'termine' => $details
        );
    }
 
    /**
     * Kalendertermindateien erzeugen
     * 
     */
    // foreach( $vereine as $verein => $details ){
    //     if( ! file_exists('dist/events_'.$verein.'.ics') ){
    //         addCalendarStart( $verein );
    //         foreach( $vereine[$verein] as $date => $details ){
    //             addCalendarEvent( $organizer = $verein, 
    //                             $start = $details["timefrom"], 
    //                             $end = $details["timeto"], 
    //                             $current = date('Ymd'), // . "T130000", 
    //                             $title = $details["title"], 
    //                             $location = "", 
    //                             $description = "" );
    //         }
    //         addCalendarEnd( $verein ); 
    //     }
    // }

 

    echo json_encode( $json );

?>