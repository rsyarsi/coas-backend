<?php

namespace App\Repositories\Interfaces;

interface EmrOrtodonsiRepositoryInterface
{
    public function createwaktuperawatan($data, $uuid);
    // public function createbehaviorrating($data);
    public function findwaktuperawatan($data);    
    public function viewemrbyRegOperator($data);
    
    public function updatewaktuperawatan($data);
    public function updateimagesfotopemriksaangigi($data,$awsurl);
    public function updateuploadtampakdepan($data,$awsurl);
    public function updateuploadtampakdepansenyumterlihatgigi($data,$awsurl);
    public function updateimagesfotosamping($data,$awsurl);
    public function updateimagesfototampakmiring($data,$awsurl);


    public function uploadtampaksampingkanan($data,$awsurl);
    public function uploadtampakdepangeli($data,$awsurl);
    public function uploadtampaksampingkiri($data,$awsurl);
    public function uploadtampakoklusalatas($data,$awsurl);
    public function uploadtampakoklusalbawah($data,$awsurl);
    public function uploadmodelstudi($data,$awsurl);

    public function uploadsefalometri($data,$awsurl);
    public function uploadpanoramik($data,$awsurl);

    public function uploadanalisaetiologi($data,$awsurl);

    public function uploadpencarianruang($data,$awsurl);
    public function uploadrahangatas($data,$awsurl);
    public function uploadrahangbawah($data,$awsurl);

    public function uploadretainer($data,$awsurl);

    public function uploadplakatrahangatas($data,$awsurl);
    public function uploadplakatrahangbawah($data,$awsurl);


}
