<?php

    $CNPJ = preg_replace("/[^0-9]/", "", $_POST["CNPJ"]);

    // Recebendo valores do formulário e transformando em vetores, representando as linhas de cada campo
    $area01 = explode("\r\n", $_POST["area01"]);
    $area02 = explode("\r\n", $_POST["area02"]);
    $area03 = explode("\r\n", $_POST["area03"]);
    $area04 = explode("\r\n", $_POST["area04"]);
    $area05 = explode("\r\n", $_POST["area05"]);
    $area06 = explode("\r\n", $_POST["area06"]);
    $area07 = explode("\r\n", $_POST["area07"]);
    //----------------------------------------------------------------------------------------------------

    //Limpando espaços em brancos no inicio e fim de cada valor do vetor, eliminando vetores vazios e reordenando os vetores resultantes.
    if (count($area01) == count($area02) && count($area01) == count($area03) && count($area01) == count($area04) && count($area01) == count($area05) && count($area01) == count($area06) && count($area01) == count($area07)) {
        foreach ($area01 as $key => $conteudo) {
            $area01[$key] = trim($conteudo);
            $area02[$key] = trim($area02[$key]);
            $area03[$key] = trim($area03[$key]);
            $area04[$key] = trim($area04[$key]);
            $area05[$key] = trim($area05[$key]);
            $area06[$key] = trim($area06[$key]);
            $area07[$key] = trim($area07[$key]);
        };

        $area01 = array_filter($area01);
        $area02 = array_filter($area02);
        $area03 = array_filter($area03);
        $area04 = array_filter($area04);
        $area05 = array_filter($area05);
        $area06 = array_filter($area06);
        $area07 = array_filter($area07);

        $area01 = array_values($area01);
        $area02 = array_values($area02);
        $area03 = array_values($area03);
        $area04 = array_values($area04);
        $area05 = array_values($area05);
        $area06 = array_values($area06);
        $area07 = array_values($area07);
    };
    //----------------------------------------------------------------------------------------------------------------------------------------

    //Validando se atende os requisitos. Requsitos: Formulario com todos os campos devidamente preenchidos e número igual de linhas devidamente preenchidas. 
    if ($area01[0] != "" && $area02[0] != "" && $area03[0] != "" && $area04[0] != "" && $area05[0] != "" && $area06[0] != "" && $area07[0] != "" && count($area01) == count($area02) && count($area01) == count($area03) && count($area01) == count($area04) && count($area01) == count($area05) && count($area01) == count($area06) && count($area01) == count($area07)) {
        
        date_default_timezone_set('America/Cuiaba');
        
        //verificando se o número inicial é igual ao número final (campos nº 04 e 05) e criando arquivos somente nas linhas que atendem a condição.
        foreach ($area04 as $key => $nomeArquivo) {
            if ($area04[$key] == $area05[$key]) {
                $vt07 = explode(" ", $area07[$key]);
                $area07[$key] = implode("-",array_reverse(explode("/", $vt07[0])))."T".$vt07[1];
                $area07[$key] = $area07[$key]."-03:00";
                $area01[$key] = substr($area01[$key], -2);
                $fp = fopen("XMLs/".$nomeArquivo.".xml", "w");
                    if($area02[$key] == 65) {
                        fwrite($fp, "<retInutNFe versao=".'"4.00"'." xmlns=".'"http://www.portalfiscal.inf.br/nfe"'."><infInut><tpAmb>1</tpAmb><verAplic>SVRSnfce201905151442</verAplic><cStat>102</cStat><xMotivo>Inutilizacao de numero homologado</xMotivo><cUF>15</cUF><ano>$area01[$key]</ano><CNPJ>$CNPJ</CNPJ><mod>$area02[$key]</mod><serie>$area03[$key]</serie><nNFIni>$area04[$key]</nNFIni><nNFFin>$area05[$key]</nNFFin><dhRecbto>$area07[$key]</dhRecbto><nProt>$area06[$key]</nProt></infInut></retInutNFe>");
                    } elseif ($area02[$key] == 55) {
                        fwrite($fp, "<retInutNFe versao=".'"4.00"'." xmlns=".'"http://www.portalfiscal.inf.br/nfe"'."><infInut Id=".'"ID'.date('YmdHis').'"'."><tpAmb>1</tpAmb><verAplic>SVRSnfce201905151442</verAplic><cStat>102</cStat><xMotivo>Inutilizacao de numero homologado</xMotivo><cUF>15</cUF><ano>$area01[$key]</ano><CNPJ>$CNPJ</CNPJ><mod>$area02[$key]</mod><serie>$area03[$key]</serie><nNFIni>$area04[$key]</nNFIni><nNFFin>$area05[$key]</nNFFin><dhRecbto>$area07[$key]</dhRecbto><nProt>$area06[$key]</nProt></infInut></retInutNFe>");
                    } else {
                        fclose($fp);
                        unlink("XMLs/$nomeArquivo.xml");
                        $msgNotSupport = "Modelo ".'"'.$area02[$key].'"'." não suportado!";
                        $fp = fopen("XMLs/$nomeArquivo - $msgNotSupport.txt", "w");
                        fwrite($fp, $msgNotSupport);
                    };
                fclose($fp);
            };
        };
        //---------------------------------------------------------------------------------------------------------------------------------------------

        //Zipando arquivos e mandando para download.
        $fileName  = date('YmdHis').".zip";
        $path      = __DIR__.'/XMLs';
        $fullPath  = $path.'/'.$fileName;
        $scanDir = scandir($path);
        array_shift($scanDir);
        array_shift($scanDir);
        $zip = new \ZipArchive();

        if( $zip->open($fullPath, \ZipArchive::CREATE) ){
            foreach($scanDir as $file){
                $zip->addFile($path.'/'.$file, $file);
            }
            $zip->close();
        };

        setcookie("CookieTeste", 'teste', time()+7); //Cookie para dar refresh na página pelo javascript após o download.

        if(file_exists($fullPath)){
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="'.$fileName.'"');
            readfile($fullPath);
            array_map('unlink', glob($path."/*.xml"));
            array_map('unlink', glob($path."/*.txt"));
            unlink($fullPath);
        };
        //------------------------------------------------------------------------------------------------------

        //É um caso onde o usuário preenche apenas uma linha no formulário e o número inicial é diferente do número final, o que acaba não criando nenhum arquivo a ser baixado e devido a isso abre essa página php, o que por sua vez torna impossível dar o refresh ref. ao cookie no client-side, tendo que ser feito por aqui.
        if((count($area04) == 1 && count($area05) == 1 && $area04[0] != $area05[0]) || isset($_COOKIE['CookieTeste'])){
            echo "<script> window.location=".'"index.html"'." </script>";
        };
        //-----------------------------------------------------------------------------------------------------

    //Mensagem de erro caso não seja atendido os requisitos da linha 43.    
    } else {
            echo "<script> alert(".'"ERRO: Por favor, verificar se todos os campos foram preenchidos corretamente!\n\nVerifique a contagem de itens se é igual em todos os campos."'.") </script>";
            echo "<script> window.location=".'"index.html"'." </script>";
    };//---------------------------------------------------------------------------------------------------------------

?>