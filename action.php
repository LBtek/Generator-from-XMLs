<?php
    $area01 = explode("\r\n", $_POST["area01"]);
    $area02 = explode("\r\n", $_POST["area02"]);
    $area03 = explode("\r\n", $_POST["area03"]);
    $area04 = explode("\r\n", $_POST["area04"]);
    $area05 = explode("\r\n", $_POST["area05"]);
    $area06 = explode("\r\n", $_POST["area06"]);
    $area07 = explode("\r\n", $_POST["area07"]);

    if (count($area01) == count($area02) && count($area01) == count($area03) && count($area01) == count($area04) && count($area01) == count($area05) && count($area01) == count($area06) && count($area01) == count($area07)) {
        foreach ($area01 as $key => $conteudo) {
            $area01[$key] = trim($conteudo);
            $area02[$key] = trim($area02[$key]);
            $area03[$key] = trim($area03[$key]);
            $area04[$key] = trim($area04[$key]);
            $area05[$key] = trim($area05[$key]);
            $area06[$key] = trim($area06[$key]);
            $area07[$key] = trim($area07[$key]);
        }
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
    }

    if ($_POST["area01"] != "" && $_POST["area02"] != "" && $_POST["area03"] != "" && $_POST["area04"] != "" && $_POST["area05"] != "" && $_POST["area06"] != "" && $_POST["area07"] != "" && count($area01) == count($area02) && count($area01) == count($area03) && count($area01) == count($area04) && count($area01) == count($area05) && count($area01) == count($area06) && count($area01) == count($area07)) {
        
        $msgErro = "Número Final diferente do Número Inicial!".'\n\n'."Não foram gerados os XML's das Notas:".'\n\n'."Número Inicial - Número Final";
        foreach ($area04 as $key => $nomeArquivo) {
            if ($area04[$key] == $area05[$key]) {
                $fp = fopen("XMLs/".$nomeArquivo.".txt", "w");
                    fwrite($fp, "Ano: ".$area01[$key]."\nModelo: ".$area02[$key]."\nSérie: ".$area03[$key]."\nNúmero Inicial: ".$area04[$key]."\nNúmero Final: ".$area05[$key]."\nProtocolo: ".$area06[$key]."\nData/Hora: ".$area07[$key]);
                fclose($fp);
            } else {
                $msgErro = $msgErro.'\n'.$area04[$key]." - ".$area05[$key];
            }   
        }
        if ($msgErro != "Número Final diferente do Número Inicial!".'\n\n'."Não foram gerados os XML's das Notas:".'\n\n'."Número Inicial - Número Final") {
            $msg = "<script> alert(".'"'.$msgErro.'"'.") </script>";
            echo $msg;   
            echo "<script> window.location=".'"index.html"'." </script>";
        } else {
            echo "<script> alert(".'"Arquivos XMLs gerados com SUCESSO!"'.") </script>";
            echo "<script> window.location=".'"index.html"'." </script>";
        }
    } else {
        echo "<script> alert(".'"ERRO: Por favor, verificar se todos os campos foram preenchidos corretamente!"'.") </script>";
        echo "<script> window.location=".'"index.html"'." </script>";
    }
?>