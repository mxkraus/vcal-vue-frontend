<?php

    /**
     * Header setzen
     */
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');  

    /**
     * Includes
     */
    include "simple_html_dom.php";   

    /**
     * Debugging aktiv setzen
     */
    setlocale(LC_TIME, "de_DE.utf8");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    /**
     * Seitenquelltext holen
     */
    function getUrlContent($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    $pageSourceCode = getUrlContent("https://www.vereinskartell-stoernstein.de/index.php/kalenderexport/year.listevents/2019");

    /**
     * Quelltext verarbeiten
     */
    $html = new simple_html_dom();
    $html->load( $pageSourceCode );

    $array = array();

    foreach( $html->find('tr') as $tr ):

        $monthName = strip_tags( $tr->find('.ev_td_left', 0) );

        foreach( $tr->find('.ev_td_li') as $li ):
            $array[$monthName][] = $event = strip_tags( $li->plaintext );
        endforeach;
    
    endforeach;



    echo '<pre>';
    print_r( $array );
    echo '</pre>';

?>