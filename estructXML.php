<?php

// inutilizadas

$textoNFCe = '<retInutNFe versao="4.00" 
xmlns="http://www.portalfiscal.inf.br/nfe">
<infInut>
    <tpAmb>1</tpAmb>
    <verAplic>SVRSnfce201905151442</verAplic>
    <cStat>102</cStat>
    <xMotivo>Inutilizacao de numero homologado</xMotivo>
    <cUF>'15'</cUF>
    <ano>'.$area01[$key].'</ano>
    <CNPJ>'.$CNPJ.'</CNPJ>
    <mod>'.$area02[$key].'</mod>
    <serie>'.$area03[$key].'</serie>
    <nNFIni>'.$area04[$key].'</nNFIni>
    <nNFFin>'.$area05[$key].'</nNFFin>
    <dhRecbto>'.$area07[$key].'</dhRecbto>
    <nProt>'.$area06[$key].'</nProt>
</infInut>
</retInutNFe>';

$textoNFe = '<retInutNFe versao="4.00" 
xmlns="http://www.portalfiscal.inf.br/nfe">
<infInut '.Id="ID415190023138834".'>
    <tpAmb>1</tpAmb>
    <verAplic>SVAN.NFeInut4_3.1.2</verAplic>
    <cStat>102</cStat>
    <xMotivo>Inutilizacao de numero homologado</xMotivo>
    <cUF>'15'</cUF>
    <ano>'.$area01[$key].'</ano>
    <CNPJ>'.$CNPJ.'</CNPJ>
    <mod>'.$area02[$key].'</mod>
    <serie>'.$area03[$key].'</serie>
    <nNFIni>'.$area04[$key].'</nNFIni>
    <nNFFin>'.$area05[$key].'</nNFFin>
    <dhRecbto>'.$area07[$key].'</dhRecbto>
    <nProt>'.$area06[$key].'</nProt>
</infInut>
</retInutNFe>';

?>