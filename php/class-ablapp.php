<?php
class AblApp{

    public $baseurl;
    public $idbase;
    
    function __construct(){
        /*$this->baseurl = "https://app.apibuilderlab.com";
        $this->idbase = "REPLACE_WITH_ID_FORM";
        $this->token = "REPLACE_WITH_API_KEY";*/

        $this->baseurl = "https://app.apibuilderlab.com";
        $this->idbase = "14";
        $this->token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Imd1c2VrYS5kZXZAZ21haWwuY29tIiwiaWF0IjoxNjk0MDczNjc2fQ.vCRp2X_MmtxOlidpf-SxvCvq39_PQZEM3eTYVsdzLMg";
    }

    function curlPost($urlpaging){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlpaging);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-access-token: '.$this->token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close ($ch);
        return $result;
    }

    function curlPostWithBody($urlpaging, $postbody){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlpaging);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-access-token: '.$this->token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postbody);
        $result = curl_exec($ch);
        curl_close ($ch);
        return $result;
    }
}
?>