<?php

namespace App\Repositories;

use App\Models\emrortodonsie;
use App\Models\hospital;
use App\Models\Year;
use App\Repositories\Interfaces\EmrOrtodonsiRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class EmrOrtodonsiRepository implements EmrOrtodonsiRepositoryInterface
{
    public function createwaktuperawatan($request, $uuid)
    {
        return  DB::table("emrortodonsies")->insert($request);
    }
    // public function createbehaviorrating($data)
    // {
    //     return  DB::table("emrpedodontie_behaviorratings")->insert($data);
    // }
    public function findwaktuperawatan($data)
    {
        return emrortodonsie::where('id', $data->id)->get();
    }
    public function viewemrbyRegOperator($data)
    {
        return emrortodonsie::where('nim', $data->nim)->where('noregister', $data->noregister)->get();
    }
    public function updatewaktuperawatan($data)
    {

        $updates = emrortodonsie::where('id', $data->id)->update([
            "noregister" => $data->noregister,
            "noepisode" => $data->noepisode,
            "pendaftaran" => $data->pendaftaran,
            "pencetakan" => $data->pencetakan,
            "pemasanganalat" => $data->pemasanganalat,
            "waktuperawatan_retainer" => $data->waktuperawatan_retainer,
            "keluhanutama" => $data->keluhanutama,
            "kelainanendoktrin" => $data->kelainanendoktrin,
            "penyakitpadamasaanak" => $data->penyakitpadamasaanak,
            "alergi" => $data->alergi,
            "kelainansaluranpernapasan" => $data->kelainansaluranpernapasan,
            "tindakanoperasi" => $data->tindakanoperasi,
            "gigidesidui" => $data->gigidesidui,
            "gigibercampur" => $data->gigibercampur,
            "gigipermanen" => $data->gigipermanen,
            "durasi" => $data->durasi,
            "frekuensi" => $data->frekuensi,
            "intensitas" => $data->intensitas,
            "kebiasaanjelekketerangan" => $data->kebiasaanjelekketerangan,
            "riwayatkeluarga" => $data->riwayatkeluarga,
            "ayah" => $data->ayah,
            "ibu" => $data->ibu,
            "saudara" => $data->saudara,
            "riwayatkeluargaketerangan" => $data->riwayatkeluargaketerangan,
            "jasmani" => $data->jasmani,
            "mental" => $data->mental,
            "tinggibadan" => $data->tinggibadan,
            "beratbadan" => $data->beratbadan,
            "indeksmassatubuh" => $data->indeksmassatubuh,
            "statusgizi" => $data->statusgizi,
            "kategori" => $data->kategori,
            "lebarkepala" => $data->lebarkepala,
            "panjangkepala" => $data->panjangkepala,
            "indekskepala" => $data->indekskepala,
            "bentukkepala" => $data->bentukkepala,
            "panjangmuka" => $data->panjangmuka,
            "lebarmuka" => $data->lebarmuka,
            "indeksmuka" => $data->indeksmuka,
            "bentukmuka" => $data->bentukmuka,
            "bentuk" => $data->bentuk,
            "profilmuka" => $data->profilmuka,
            "senditemporomandibulat_tmj" => $data->senditemporomandibulat_tmj,
            "tmj_keterangan" => $data->tmj_keterangan,
            "bibirposisiistirahat" => $data->bibirposisiistirahat,
            "tunusototmastikasi" => $data->tunusototmastikasi,
            "tunusototmastikasi_keterangan" => $data->tunusototmastikasi_keterangan,
            "tunusototbibir" => $data->tunusototbibir,
            "tunusototbibir_keterangan" => $data->tunusototbibir_keterangan,
            "freewayspace" => $data->freewayspace,
            "pathofclosure" => $data->pathofclosure,
            "higienemulutohi" => $data->higienemulutohi,
            "polaatrisi" => $data->polaatrisi,
            "regio" => $data->regio,
            "lingua" => $data->lingua,
            "intraoral_lainlain" => $data->intraoral_lainlain,
            "palatumvertikal" => $data->palatumvertikal,
            "palatumlateral" => $data->palatumlateral,
            "gingiva" => $data->gingiva,
            "gingiva_keterangan" => $data->gingiva_keterangan,
            "mukosa" => $data->mukosa,
            "mukosa_keterangan" => $data->mukosa_keterangan,
            "frenlabiisuperior" => $data->frenlabiisuperior,
            "frenlabiiinferior" => $data->frenlabiiinferior,
            "frenlingualis" => $data->frenlingualis,
            "ketr" => $data->ketr,
            "tonsila" => $data->tonsila,
            "fonetik" => $data->fonetik,
            "tampakdepantakterlihatgigi" => $data->tampakdepantakterlihatgigi,
            "fotomuka_bentukmuka" => $data->fotomuka_bentukmuka,
            "tampaksamping" => $data->tampaksamping,
            "fotomuka_profilmuka" => $data->fotomuka_profilmuka,
            "tampakdepansenyumterlihatgigi" => $data->tampakdepansenyumterlihatgigi,
            "tampakmiring" => $data->tampakmiring,
            "tampaksampingkanan" => $data->tampaksampingkanan,
            "tampakdepan" => $data->tampakdepan,
            "tampaksampingkiri" => $data->tampaksampingkiri,
            "tampakoklusalatas" => $data->tampakoklusalatas,
            "tampakoklusalbawah" => $data->tampakoklusalbawah,
            "bentuklengkunggigi_ra" => $data->bentuklengkunggigi_ra,
            "bentuklengkunggigi_rb" => $data->bentuklengkunggigi_rb,
            "malposisigigiindividual_rahangatas_kanan1" => $data->malposisigigiindividual_rahangatas_kanan1,
            "malposisigigiindividual_rahangatas_kanan2" => $data->malposisigigiindividual_rahangatas_kanan2,
            "malposisigigiindividual_rahangatas_kanan3" => $data->malposisigigiindividual_rahangatas_kanan3,
            "malposisigigiindividual_rahangatas_kanan4" => $data->malposisigigiindividual_rahangatas_kanan4,
            "malposisigigiindividual_rahangatas_kanan5" => $data->malposisigigiindividual_rahangatas_kanan5,
            "malposisigigiindividual_rahangatas_kanan6" => $data->malposisigigiindividual_rahangatas_kanan6,
            "malposisigigiindividual_rahangatas_kanan7" => $data->malposisigigiindividual_rahangatas_kanan7,
            "malposisigigiindividual_rahangatas_kiri1" => $data->malposisigigiindividual_rahangatas_kiri1,
            "malposisigigiindividual_rahangatas_kiri2" => $data->malposisigigiindividual_rahangatas_kiri2,
            "malposisigigiindividual_rahangatas_kiri3" => $data->malposisigigiindividual_rahangatas_kiri3,
            "malposisigigiindividual_rahangatas_kiri4" => $data->malposisigigiindividual_rahangatas_kiri4,
            "malposisigigiindividual_rahangatas_kiri5" => $data->malposisigigiindividual_rahangatas_kiri5,
            "malposisigigiindividual_rahangatas_kiri6" => $data->malposisigigiindividual_rahangatas_kiri6,
            "malposisigigiindividual_rahangatas_kiri7" => $data->malposisigigiindividual_rahangatas_kiri7,
            "malposisigigiindividual_rahangbawah_kanan1" => $data->malposisigigiindividual_rahangbawah_kanan1,
            "malposisigigiindividual_rahangbawah_kanan2" => $data->malposisigigiindividual_rahangbawah_kanan2,
            "malposisigigiindividual_rahangbawah_kanan3" => $data->malposisigigiindividual_rahangbawah_kanan3,
            "malposisigigiindividual_rahangbawah_kanan4" => $data->malposisigigiindividual_rahangbawah_kanan4,
            "malposisigigiindividual_rahangbawah_kanan5" => $data->malposisigigiindividual_rahangbawah_kanan5,
            "malposisigigiindividual_rahangbawah_kanan6" => $data->malposisigigiindividual_rahangbawah_kanan6,
            "malposisigigiindividual_rahangbawah_kanan7" => $data->malposisigigiindividual_rahangbawah_kanan7,
            "malposisigigiindividual_rahangbawah_kiri1" => $data->malposisigigiindividual_rahangbawah_kiri1,
            "malposisigigiindividual_rahangbawah_kiri2" => $data->malposisigigiindividual_rahangbawah_kiri2,
            "malposisigigiindividual_rahangbawah_kiri3" => $data->malposisigigiindividual_rahangbawah_kiri3,
            "malposisigigiindividual_rahangbawah_kiri4" => $data->malposisigigiindividual_rahangbawah_kiri4,
            "malposisigigiindividual_rahangbawah_kiri5" => $data->malposisigigiindividual_rahangbawah_kiri5,
            "malposisigigiindividual_rahangbawah_kiri6" => $data->malposisigigiindividual_rahangbawah_kiri6,
            "malposisigigiindividual_rahangbawah_kiri7" => $data->malposisigigiindividual_rahangbawah_kiri7,
            "overjet" => $data->overjet,
            "overbite" => $data->overbite,
            "palatalbite" => $data->palatalbite,
            "deepbite" => $data->deepbite,
            "anterior_openbite" => $data->anterior_openbite,
            "edgetobite" => $data->edgetobite,
            "anterior_crossbite" => $data->anterior_crossbite,
            "posterior_openbite" => $data->posterior_openbite,
            "scissorbite" => $data->scissorbite,
            "cusptocuspbite" => $data->cusptocuspbite,
            "relasimolarpertamakanan" => $data->relasimolarpertamakanan,
            "relasimolarpertamakiri" => $data->relasimolarpertamakiri,
            "relasikaninuskanan" => $data->relasikaninuskanan,
            "relasikaninuskiri" => $data->relasikaninuskiri,
            "garistengahrahangbawahterhadaprahangatas" => $data->garistengahrahangbawahterhadaprahangatas,
            "garisinterinsisivisentralterhadapgaristengahrahangra" => $data->garisinterinsisivisentralterhadapgaristengahrahangra,
            "garisinterinsisivisentralterhadapgaristengahrahangra_mm" => $data->garisinterinsisivisentralterhadapgaristengahrahangra_mm,
            "garisinterinsisivisentralterhadapgaristengahrahangrb" => $data->garisinterinsisivisentralterhadapgaristengahrahangrb,
            "garisinterinsisivisentralterhadapgaristengahrahangrb_mm" => $data->garisinterinsisivisentralterhadapgaristengahrahangrb_mm,
            "lebarmesiodistalgigi_rahangatas_kanan1" => $data->lebarmesiodistalgigi_rahangatas_kanan1,
            "lebarmesiodistalgigi_rahangatas_kanan2" => $data->lebarmesiodistalgigi_rahangatas_kanan2,
            "lebarmesiodistalgigi_rahangatas_kanan3" => $data->lebarmesiodistalgigi_rahangatas_kanan3,
            "lebarmesiodistalgigi_rahangatas_kanan4" => $data->lebarmesiodistalgigi_rahangatas_kanan4,
            "lebarmesiodistalgigi_rahangatas_kanan5" => $data->lebarmesiodistalgigi_rahangatas_kanan5,
            "lebarmesiodistalgigi_rahangatas_kanan6" => $data->lebarmesiodistalgigi_rahangatas_kanan6,
            "lebarmesiodistalgigi_rahangatas_kanan7" => $data->lebarmesiodistalgigi_rahangatas_kanan7,
            "lebarmesiodistalgigi_rahangatas_kiri1" => $data->lebarmesiodistalgigi_rahangatas_kiri1,
            "lebarmesiodistalgigi_rahangatas_kiri2" => $data->lebarmesiodistalgigi_rahangatas_kiri2,
            "lebarmesiodistalgigi_rahangatas_kiri3" => $data->lebarmesiodistalgigi_rahangatas_kiri3,
            "lebarmesiodistalgigi_rahangatas_kiri4" => $data->lebarmesiodistalgigi_rahangatas_kiri4,
            "lebarmesiodistalgigi_rahangatas_kiri5" => $data->lebarmesiodistalgigi_rahangatas_kiri5,
            "lebarmesiodistalgigi_rahangatas_kiri6" => $data->lebarmesiodistalgigi_rahangatas_kiri6,
            "lebarmesiodistalgigi_rahangatas_kiri7" => $data->lebarmesiodistalgigi_rahangatas_kiri7,
            "lebarmesiodistalgigi_rahangbawah_kanan1" => $data->lebarmesiodistalgigi_rahangbawah_kanan1,
            "lebarmesiodistalgigi_rahangbawah_kanan2" => $data->lebarmesiodistalgigi_rahangbawah_kanan2,
            "lebarmesiodistalgigi_rahangbawah_kanan3" => $data->lebarmesiodistalgigi_rahangbawah_kanan3,
            "lebarmesiodistalgigi_rahangbawah_kanan4" => $data->lebarmesiodistalgigi_rahangbawah_kanan4,
            "lebarmesiodistalgigi_rahangbawah_kanan5" => $data->lebarmesiodistalgigi_rahangbawah_kanan5,
            "lebarmesiodistalgigi_rahangbawah_kanan6" => $data->lebarmesiodistalgigi_rahangbawah_kanan6,
            "lebarmesiodistalgigi_rahangbawah_kanan7" => $data->lebarmesiodistalgigi_rahangbawah_kanan7,
            "lebarmesiodistalgigi_rahangbawah_kiri1" => $data->lebarmesiodistalgigi_rahangbawah_kiri1,
            "lebarmesiodistalgigi_rahangbawah_kiri2" => $data->lebarmesiodistalgigi_rahangbawah_kiri2,
            "lebarmesiodistalgigi_rahangbawah_kiri3" => $data->lebarmesiodistalgigi_rahangbawah_kiri3,
            "lebarmesiodistalgigi_rahangbawah_kiri4" => $data->lebarmesiodistalgigi_rahangbawah_kiri4,
            "lebarmesiodistalgigi_rahangbawah_kiri5" => $data->lebarmesiodistalgigi_rahangbawah_kiri5,
            "lebarmesiodistalgigi_rahangbawah_kiri6" => $data->lebarmesiodistalgigi_rahangbawah_kiri6,
            "lebarmesiodistalgigi_rahangbawah_kiri7" => $data->lebarmesiodistalgigi_rahangbawah_kiri7,
            "skemafotooklusalgigidarimodelstudi" => $data->skemafotooklusalgigidarimodelstudi,
            "jumlahmesiodistal" => $data->jumlahmesiodistal,
            "jarakp1p2pengukuran" => $data->jarakp1p2pengukuran,
            "jarakp1p2perhitungan" => $data->jarakp1p2perhitungan,
            "diskrepansip1p2_mm" => $data->diskrepansip1p2_mm,
            "diskrepansip1p2" => $data->diskrepansip1p2,
            "jarakm1m1pengukuran" => $data->jarakm1m1pengukuran,
            "jarakm1m1perhitungan" => $data->jarakm1m1perhitungan,
            "diskrepansim1m2_mm" => $data->diskrepansim1m2_mm,
            "diskrepansim1m2" => $data->diskrepansim1m2,
            "diskrepansi_keterangan" => $data->diskrepansi_keterangan,
            "jumlahlebarmesiodistalgigidarim1m1" => $data->jumlahlebarmesiodistalgigidarim1m1,
            "jarakp1p1tonjol" => $data->jarakp1p1tonjol,
            "indeksp" => $data->indeksp,
            "lengkunggigiuntukmenampunggigigigi" => $data->lengkunggigiuntukmenampunggigigigi,
            "jarakinterfossacaninus" => $data->jarakinterfossacaninus,
            "indeksfc" => $data->indeksfc,
            "lengkungbasaluntukmenampunggigigigi" => $data->lengkungbasaluntukmenampunggigigigi,
            "inklinasigigigigiregioposterior" => $data->inklinasigigigigiregioposterior,
            "metodehowes_keterangan" => $data->metodehowes_keterangan,
            "aldmetode" => $data->aldmetode,
            "overjetawal" => $data->overjetawal,
            "overjetakhir" => $data->overjetakhir,
            "rahangatasdiskrepansi" => $data->rahangatasdiskrepansi,
            "rahangbawahdiskrepansi" => $data->rahangbawahdiskrepansi,
            "fotosefalometri" => $data->fotosefalometri,
            "fotopanoramik" => $data->fotopanoramik,
            "maloklusiangleklas" => $data->maloklusiangleklas,
            "hubunganskeletal" => $data->hubunganskeletal,
            "malrelasi" => $data->malrelasi,
            "malposisi" => $data->malposisi,
            "estetik" => $data->estetik,
            "dental" => $data->dental,
            "skeletal" => $data->skeletal,
            "fungsipenguyahanal" => $data->fungsipenguyahanal,
            "crowding" => $data->crowding,
            "spacing" => $data->spacing,
            "protrusif" => $data->protrusif,
            "retrusif" => $data->retrusif,
            "malposisiindividual" => $data->malposisiindividual,
            "maloklusi_crossbite" => $data->maloklusi_crossbite,
            "maloklusi_lainlain" => $data->maloklusi_lainlain,
            "maloklusi_lainlainketerangan" => $data->maloklusi_lainlainketerangan,
            "rapencabutan" => $data->rapencabutan,
            "raekspansi" => $data->raekspansi,
            "ragrinding" => $data->ragrinding,
            "raplataktif" => $data->raplataktif,
            "rbpencabutan" => $data->rbpencabutan,
            "rbekspansi" => $data->rbekspansi,
            "rbgrinding" => $data->rbgrinding,
            "rbplataktif" => $data->rbplataktif,
            "analisisetiologimaloklusi" => $data->analisisetiologimaloklusi,
            "pasiendirujukkebagian" => $data->pasiendirujukkebagian,
            "pencarianruanguntuk" => $data->pencarianruanguntuk,
            "koreksimalposisigigiindividual" => $data->koreksimalposisigigiindividual,
            "retensi" => $data->retensi,
            "pencarianruang" => $data->pencarianruang,
            "koreksimalposisigigiindividual_rahangatas" => $data->koreksimalposisigigiindividual_rahangatas,
            "koreksimalposisigigiindividual_rahangbawah" => $data->koreksimalposisigigiindividual_rahangbawah,
            "intruksipadapasien" => $data->intruksipadapasien,
            "retainer" => $data->retainer,
            "gambarplataktif_rahangatas" => $data->gambarplataktif_rahangatas,
            "gambarplataktif_rahangbawah" => $data->gambarplataktif_rahangbawah,
            "keterangangambar" => $data->keterangangambar,
            "prognosis" => $data->prognosis,
            "prognosis_a" => $data->prognosis_a,
            "prognosis_b" => $data->prognosis_b,
            "prognosis_c" => $data->prognosis_c,
            "indikasiperawatan" => $data->indikasiperawatan

        ]);
        return $updates;;
    }
    public function updateimagesfotopemriksaangigi($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'image_pemeriksaangigi' => $awsurl 
        ]);
        return $updates;
    }
    public function updateuploadtampakdepan($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'image_pemeriksaangigi' => $awsurl,
            'tampakdepantakterlihatgigi' => $awsurl,
            'fotomuka_bentukmuka' => $data->bentukmuka 
        ]);
        return $updates;
    }
    public function updateuploadtampakdepansenyumterlihatgigi($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([  
            'tampakdepansenyumterlihatgigi' => $awsurl 
        ]);
        return $updates;
    }
    public function updateimagesfotosamping($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([  
            'tampaksamping' => $awsurl 
        ]);
        return $updates;
    }
    public function updateimagesfototampakmiring($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'tampakmiring' => $awsurl 
        ]);
        return $updates;
    }

    //geligeli
    public function uploadtampaksampingkanan($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'tampaksampingkanan' => $awsurl 
        ]);
        return $updates;
    }
     
    public function uploadtampakdepangeli($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'tampakdepan' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadtampaksampingkiri($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'tampaksampingkiri' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadtampakoklusalatas($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'tampakoklusalatas' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadtampakoklusalbawah($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'tampakoklusalbawah' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadmodelstudi($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'skemafotooklusalgigidarimodelstudi' => $awsurl 
        ]);
        return $updates;
    }

    public function uploadsefalometri($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'fotosefalometri' => $awsurl 
        ]);
        return $updates;
    }

    public function uploadpanoramik($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'fotopanoramik' => $awsurl 
        ]);
        return $updates;
    }

    public function uploadanalisaetiologi($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'analisisetiologimaloklusi' => $awsurl 
        ]);
        return $updates;
    }

    //jalan perawatan
    public function uploadpencarianruang($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'pencarianruang' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadrahangatas($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'koreksimalposisigigiindividual_rahangatas' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadrahangbawah($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'koreksimalposisigigiindividual_rahangbawah' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadretainer($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'retainer' => $awsurl 
        ]);
        return $updates;
    }

    //plakat
    public function uploadplakatrahangatas($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'gambarplataktif_rahangatas' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadplakatrahangbawah($data,$awsurl)
    { 
        $updates = emrortodonsie::where('id', $data->id)->update([ 
            'gambarplataktif_rahangatas' => $awsurl 
        ]);
        return $updates;
    }
}