<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Traits\AwsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use App\Repositories\Interfaces\EmrOrtodonsiRepositoryInterface;

class EmrOrtodonsiService extends Controller
{
    use AwsTrait;
    private $emrortodonsiRepository;

    public function __construct(EmrOrtodonsiRepositoryInterface $emrortodonsiRepository)
    {
        $this->emrortodonsiRepository = $emrortodonsiRepository;
    }
    public function createwaktuperawatan(Request $request)
    {
        // validate 
        $request->validate([
            "noregister" => "required",
            "noepisode" => "required",
            // "pendaftaran" => "required",
            // "pencetakan" => "required",
            // "pemasanganalat" => "required",
            // "waktuperawatan_retainer" => "required",
            // "keluhanutama" => "required",
            // "kelainanendoktrin" => "required",
            // "penyakitpadamasaanak" => "required",
            // "alergi" => "required",
            // "kelainansaluranpernapasan" => "required",
            // "tindakanoperasi" => "required",
            // "gigidesidui" => "required",
            // "gigibercampur" => "required",
            // "gigipermanen" => "required",
            // "durasi" => "required",
            // "frekuensi" => "required",
            // "intensitas" => "required",
            // "kebiasaanjelekketerangan" => "required",
            // "riwayatkeluarga" => "required",
            // "ayah" => "required",
            // "ibu" => "required",
            // "saudara" => "required",
            // "riwayatkeluargaketerangan" => "required",
            // "jasmani" => "required",
            // "mental" => "required",
            // "tinggibadan" => "required",
            // "beratbadan" => "required",
            // "indeksmassatubuh" => "required",
            // "statusgizi" => "required",
            // "kategori" => "required",
            // "lebarkepala" => "required",
            // "panjangkepala" => "required",
            // "indekskepala" => "required",
            // "bentukkepala" => "required",
            // "panjangmuka" => "required",
            // "lebarmuka" => "required",
            // "indeksmuka" => "required",
            // "bentukmuka" => "required",
            // "bentuk" => "required",
            // "profilmuka" => "required",
            // "senditemporomandibulat_tmj" => "required",
            // "tmj_keterangan" => "required",
            // "bibirposisiistirahat" => "required",
            // "tunusototmastikasi" => "required",
            // "tunusototmastikasi_keterangan" => "required",
            // "tunusototbibir" => "required",
            // "tunusototbibir_keterangan" => "required",
            // "freewayspace" => "required",
            // "pathofclosure" => "required",
            // "higienemulutohi" => "required",
            // "polaatrisi" => "required",
            // "regio" => "required",
            // "lingua" => "required",
            // "intraoral_lainlain" => "required",
            // "palatumvertikal" => "required",
            // "palatumlateral" => "required",
            // "gingiva" => "required",
            // "gingiva_keterangan" => "required",
            // "mukosa" => "required",
            // "mukosa_keterangan" => "required",
            // "frenlabiisuperior" => "required",
            // "frenlabiiinferior" => "required",
            // "frenlingualis" => "required",
            // "ketr" => "required",
            // "tonsila" => "required",
            // "fonetik" => "required",
            // "tampakdepantakterlihatgigi" => "required",
            // "fotomuka_bentukmuka" => "required",
            // "tampaksamping" => "required",
            // "fotomuka_profilmuka" => "required",
            // "tampakdepansenyumterlihatgigi" => "required",
            // "tampakmiring" => "required",
            // "tampaksampingkanan" => "required",
            // "tampakdepan" => "required",
            // "tampaksampingkiri" => "required",
            // "tampakoklusalatas" => "required",
            // "tampakoklusalbawah" => "required",
            // "bentuklengkunggigi_ra" => "required",
            // "bentuklengkunggigi_rb" => "required",
            // "malposisigigiindividual_rahangatas_kanan1" => "required",
            // "malposisigigiindividual_rahangatas_kanan2" => "required",
            // "malposisigigiindividual_rahangatas_kanan3" => "required",
            // "malposisigigiindividual_rahangatas_kanan4" => "required",
            // "malposisigigiindividual_rahangatas_kanan5" => "required",
            // "malposisigigiindividual_rahangatas_kanan6" => "required",
            // "malposisigigiindividual_rahangatas_kanan7" => "required",
            // "malposisigigiindividual_rahangatas_kiri1" => "required",
            // "malposisigigiindividual_rahangatas_kiri2" => "required",
            // "malposisigigiindividual_rahangatas_kiri3" => "required",
            // "malposisigigiindividual_rahangatas_kiri4" => "required",
            // "malposisigigiindividual_rahangatas_kiri5" => "required",
            // "malposisigigiindividual_rahangatas_kiri6" => "required",
            // "malposisigigiindividual_rahangatas_kiri7" => "required",
            // "malposisigigiindividual_rahangbawah_kanan1" => "required",
            // "malposisigigiindividual_rahangbawah_kanan2" => "required",
            // "malposisigigiindividual_rahangbawah_kanan3" => "required",
            // "malposisigigiindividual_rahangbawah_kanan4" => "required",
            // "malposisigigiindividual_rahangbawah_kanan5" => "required",
            // "malposisigigiindividual_rahangbawah_kanan6" => "required",
            // "malposisigigiindividual_rahangbawah_kanan7" => "required",
            // "malposisigigiindividual_rahangbawah_kiri1" => "required",
            // "malposisigigiindividual_rahangbawah_kiri2" => "required",
            // "malposisigigiindividual_rahangbawah_kiri3" => "required",
            // "malposisigigiindividual_rahangbawah_kiri4" => "required",
            // "malposisigigiindividual_rahangbawah_kiri5" => "required",
            // "malposisigigiindividual_rahangbawah_kiri6" => "required",
            // "malposisigigiindividual_rahangbawah_kiri7" => "required",
            // "overjet" => "required",
            // "overbite" => "required",
            // "palatalbite" => "required",
            // "deepbite" => "required",
            // "anterior_openbite" => "required",
            // "edgetobite" => "required",
            // "anterior_crossbite" => "required",
            // "posterior_openbite" => "required",
            // "scissorbite" => "required",
            // "cusptocuspbite" => "required",
            // "relasimolarpertamakanan" => "required",
            // "relasimolarpertamakiri" => "required",
            // "relasikaninuskanan" => "required",
            // "relasikaninuskiri" => "required",
            // "garistengahrahangbawahterhadaprahangatas" => "required",
            // "garisinterinsisivisentralterhadapgaristengahrahangra" => "required",
            // "garisinterinsisivisentralterhadapgaristengahrahangra_mm" => "required",
            // "garisinterinsisivisentralterhadapgaristengahrahangrb" => "required",
            // "garisinterinsisivisentralterhadapgaristengahrahangrb_mm" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan1" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan2" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan3" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan4" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan5" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan6" => "required",
            // "lebarmesiodistalgigi_rahangatas_kanan7" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri1" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri2" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri3" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri4" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri5" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri6" => "required",
            // "lebarmesiodistalgigi_rahangatas_kiri7" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan1" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan2" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan3" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan4" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan5" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan6" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kanan7" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri1" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri2" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri3" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri4" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri5" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri6" => "required",
            // "lebarmesiodistalgigi_rahangbawah_kiri7" => "required",
            // "skemafotooklusalgigidarimodelstudi" => "required",
            // "jumlahmesiodistal" => "required",
            // "jarakp1p2pengukuran" => "required",
            // "jarakp1p2perhitungan" => "required",
            // "diskrepansip1p2_mm" => "required",
            // "diskrepansip1p2" => "required",
            // "jarakm1m1pengukuran" => "required",
            // "jarakm1m1perhitungan" => "required",
            // "diskrepansim1m2_mm" => "required",
            // "diskrepansim1m2" => "required",
            // "diskrepansi_keterangan" => "required",
            // "jumlahlebarmesiodistalgigidarim1m1" => "required",
            // "jarakp1p1tonjol" => "required",
            // "indeksp" => "required",
            // "lengkunggigiuntukmenampunggigigigi" => "required",
            // "jarakinterfossacaninus" => "required",
            // "indeksfc" => "required",
            // "lengkungbasaluntukmenampunggigigigi" => "required",
            // "inklinasigigigigiregioposterior" => "required",
            // "metodehowes_keterangan" => "required",
            // "aldmetode" => "required",
            // "overjetawal" => "required",
            // "overjetakhir" => "required",
            // "rahangatasdiskrepansi" => "required",
            // "rahangbawahdiskrepansi" => "required",
            // "fotosefalometri" => "required",
            // "fotopanoramik" => "required",
            // "maloklusiangleklas" => "required",
            // "hubunganskeletal" => "required",
            // "malrelasi" => "required",
            // "malposisi" => "required",
            // "estetik" => "required",
            // "dental" => "required",
            // "skeletal" => "required",
            // "fungsipenguyahanal" => "required",
            // "crowding" => "required",
            // "spacing" => "required",
            // "protrusif" => "required",
            // "retrusif" => "required",
            // "malposisiindividual" => "required",
            // "maloklusi_crossbite" => "required",
            // "maloklusi_lainlain" => "required",
            // "maloklusi_lainlainketerangan" => "required",
            // "rapencabutan" => "required",
            // "raekspansi" => "required",
            // "ragrinding" => "required",
            // "raplataktif" => "required",
            // "rbpencabutan" => "required",
            // "rbekspansi" => "required",
            // "rbgrinding" => "required",
            // "rbplataktif" => "required",
            // "analisisetiologimaloklusi" => "required",
            // "pasiendirujukkebagian" => "required",
            // "pencarianruanguntuk" => "required",
            // "koreksimalposisigigiindividual" => "required",
            // "retensi" => "required",
            // "pencarianruang" => "required",
            // "koreksimalposisigigiindividual_rahangatas" => "required",
            // "koreksimalposisigigiindividual_rahangbawah" => "required",
            // "intruksipadapasien" => "required",
            // "retainer" => "required",
            // "gambarplataktif_rahangatas" => "required",
            // "gambarplataktif_rahangbawah" => "required",
            // "keterangangambar" => "required",
            // "prognosis" => "required",
            // "prognosis_a" => "required",
            // "prognosis_b" => "required",
            // "prognosis_c" => "required",
            // "indikasiperawatan" => "required",
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                "noregister" => $request->noregister,
                "noepisode" => $request->noepisode,
                "pendaftaran" => $request->pendaftaran,
                "pencetakan" => $request->pencetakan,
                "pemasanganalat" => $request->pemasanganalat,
                "waktuperawatan_retainer" => $request->waktuperawatan_retainer,
                "keluhanutama" => $request->keluhanutama,
                "kelainanendoktrin" => $request->kelainanendoktrin,
                "penyakitpadamasaanak" => $request->penyakitpadamasaanak,
                "alergi" => $request->alergi,
                "kelainansaluranpernapasan" => $request->kelainansaluranpernapasan,
                "tindakanoperasi" => $request->tindakanoperasi,
                "gigidesidui" => $request->gigidesidui,
                "gigibercampur" => $request->gigibercampur,
                "gigipermanen" => $request->gigipermanen,
                "durasi" => $request->durasi,
                "frekuensi" => $request->frekuensi,
                "intensitas" => $request->intensitas,
                "kebiasaanjelekketerangan" => $request->kebiasaanjelekketerangan,
                "riwayatkeluarga" => $request->riwayatkeluarga,
                "ayah" => $request->ayah,
                "ibu" => $request->ibu,
                "saudara" => $request->saudara,
                "riwayatkeluargaketerangan" => $request->riwayatkeluargaketerangan,
                "jasmani" => $request->jasmani,
                "mental" => $request->mental,
                "tinggibadan" => $request->tinggibadan,
                "beratbadan" => $request->beratbadan,
                "indeksmassatubuh" => $request->indeksmassatubuh,
                "statusgizi" => $request->statusgizi,
                "kategori" => $request->kategori,
                "lebarkepala" => $request->lebarkepala,
                "panjangkepala" => $request->panjangkepala,
                "indekskepala" => $request->indekskepala,
                "bentukkepala" => $request->bentukkepala,
                "panjangmuka" => $request->panjangmuka,
                "lebarmuka" => $request->lebarmuka,
                "indeksmuka" => $request->indeksmuka,
                "bentukmuka" => $request->bentukmuka,
                "bentuk" => $request->bentuk,
                "profilmuka" => $request->profilmuka,
                "senditemporomandibulat_tmj" => $request->senditemporomandibulat_tmj,
                "tmj_keterangan" => $request->tmj_keterangan,
                "bibirposisiistirahat" => $request->bibirposisiistirahat,
                "tunusototmastikasi" => $request->tunusototmastikasi,
                "tunusototmastikasi_keterangan" => $request->tunusototmastikasi_keterangan,
                "tunusototbibir" => $request->tunusototbibir,
                "tunusototbibir_keterangan" => $request->tunusototbibir_keterangan,
                "freewayspace" => $request->freewayspace,
                "pathofclosure" => $request->pathofclosure,
                "higienemulutohi" => $request->higienemulutohi,
                "polaatrisi" => $request->polaatrisi,
                "regio" => $request->regio,
                "lingua" => $request->lingua,
                "intraoral_lainlain" => $request->intraoral_lainlain,
                "palatumvertikal" => $request->palatumvertikal,
                "palatumlateral" => $request->palatumlateral,
                "gingiva" => $request->gingiva,
                "gingiva_keterangan" => $request->gingiva_keterangan,
                "mukosa" => $request->mukosa,
                "mukosa_keterangan" => $request->mukosa_keterangan,
                "frenlabiisuperior" => $request->frenlabiisuperior,
                "frenlabiiinferior" => $request->frenlabiiinferior,
                "frenlingualis" => $request->frenlingualis,
                "ketr" => $request->ketr,
                "tonsila" => $request->tonsila,
                "fonetik" => $request->fonetik,
                "tampakdepantakterlihatgigi" => $request->tampakdepantakterlihatgigi,
                "fotomuka_bentukmuka" => $request->fotomuka_bentukmuka,
                "tampaksamping" => $request->tampaksamping,
                "fotomuka_profilmuka" => $request->fotomuka_profilmuka,
                "tampakdepansenyumterlihatgigi" => $request->tampakdepansenyumterlihatgigi,
                "tampakmiring" => $request->tampakmiring,
                "tampaksampingkanan" => $request->tampaksampingkanan,
                "tampakdepan" => $request->tampakdepan,
                "tampaksampingkiri" => $request->tampaksampingkiri,
                "tampakoklusalatas" => $request->tampakoklusalatas,
                "tampakoklusalbawah" => $request->tampakoklusalbawah,
                "bentuklengkunggigi_ra" => $request->bentuklengkunggigi_ra,
                "bentuklengkunggigi_rb" => $request->bentuklengkunggigi_rb,
                "malposisigigiindividual_rahangatas_kanan1" => $request->malposisigigiindividual_rahangatas_kanan1,
                "malposisigigiindividual_rahangatas_kanan2" => $request->malposisigigiindividual_rahangatas_kanan2,
                "malposisigigiindividual_rahangatas_kanan3" => $request->malposisigigiindividual_rahangatas_kanan3,
                "malposisigigiindividual_rahangatas_kanan4" => $request->malposisigigiindividual_rahangatas_kanan4,
                "malposisigigiindividual_rahangatas_kanan5" => $request->malposisigigiindividual_rahangatas_kanan5,
                "malposisigigiindividual_rahangatas_kanan6" => $request->malposisigigiindividual_rahangatas_kanan6,
                "malposisigigiindividual_rahangatas_kanan7" => $request->malposisigigiindividual_rahangatas_kanan7,
                "malposisigigiindividual_rahangatas_kiri1" => $request->malposisigigiindividual_rahangatas_kiri1,
                "malposisigigiindividual_rahangatas_kiri2" => $request->malposisigigiindividual_rahangatas_kiri2,
                "malposisigigiindividual_rahangatas_kiri3" => $request->malposisigigiindividual_rahangatas_kiri3,
                "malposisigigiindividual_rahangatas_kiri4" => $request->malposisigigiindividual_rahangatas_kiri4,
                "malposisigigiindividual_rahangatas_kiri5" => $request->malposisigigiindividual_rahangatas_kiri5,
                "malposisigigiindividual_rahangatas_kiri6" => $request->malposisigigiindividual_rahangatas_kiri6,
                "malposisigigiindividual_rahangatas_kiri7" => $request->malposisigigiindividual_rahangatas_kiri7,
                "malposisigigiindividual_rahangbawah_kanan1" => $request->malposisigigiindividual_rahangbawah_kanan1,
                "malposisigigiindividual_rahangbawah_kanan2" => $request->malposisigigiindividual_rahangbawah_kanan2,
                "malposisigigiindividual_rahangbawah_kanan3" => $request->malposisigigiindividual_rahangbawah_kanan3,
                "malposisigigiindividual_rahangbawah_kanan4" => $request->malposisigigiindividual_rahangbawah_kanan4,
                "malposisigigiindividual_rahangbawah_kanan5" => $request->malposisigigiindividual_rahangbawah_kanan5,
                "malposisigigiindividual_rahangbawah_kanan6" => $request->malposisigigiindividual_rahangbawah_kanan6,
                "malposisigigiindividual_rahangbawah_kanan7" => $request->malposisigigiindividual_rahangbawah_kanan7,
                "malposisigigiindividual_rahangbawah_kiri1" => $request->malposisigigiindividual_rahangbawah_kiri1,
                "malposisigigiindividual_rahangbawah_kiri2" => $request->malposisigigiindividual_rahangbawah_kiri2,
                "malposisigigiindividual_rahangbawah_kiri3" => $request->malposisigigiindividual_rahangbawah_kiri3,
                "malposisigigiindividual_rahangbawah_kiri4" => $request->malposisigigiindividual_rahangbawah_kiri4,
                "malposisigigiindividual_rahangbawah_kiri5" => $request->malposisigigiindividual_rahangbawah_kiri5,
                "malposisigigiindividual_rahangbawah_kiri6" => $request->malposisigigiindividual_rahangbawah_kiri6,
                "malposisigigiindividual_rahangbawah_kiri7" => $request->malposisigigiindividual_rahangbawah_kiri7,
                "overjet" => $request->overjet,
                "overbite" => $request->overbite,
                "palatalbite" => $request->palatalbite,
                "deepbite" => $request->deepbite,
                "anterior_openbite" => $request->anterior_openbite,
                "edgetobite" => $request->edgetobite,
                "anterior_crossbite" => $request->anterior_crossbite,
                "posterior_openbite" => $request->posterior_openbite,
                "scissorbite" => $request->scissorbite,
                "cusptocuspbite" => $request->cusptocuspbite,
                "relasimolarpertamakanan" => $request->relasimolarpertamakanan,
                "relasimolarpertamakiri" => $request->relasimolarpertamakiri,
                "relasikaninuskanan" => $request->relasikaninuskanan,
                "relasikaninuskiri" => $request->relasikaninuskiri,
                "garistengahrahangbawahterhadaprahangatas" => $request->garistengahrahangbawahterhadaprahangatas,
                "garisinterinsisivisentralterhadapgaristengahrahangra" => $request->garisinterinsisivisentralterhadapgaristengahrahangra,
                "garisinterinsisivisentralterhadapgaristengahrahangra_mm" => $request->garisinterinsisivisentralterhadapgaristengahrahangra_mm,
                "garisinterinsisivisentralterhadapgaristengahrahangrb" => $request->garisinterinsisivisentralterhadapgaristengahrahangrb,
                "garisinterinsisivisentralterhadapgaristengahrahangrb_mm" => $request->garisinterinsisivisentralterhadapgaristengahrahangrb_mm,
                "lebarmesiodistalgigi_rahangatas_kanan1" => $request->lebarmesiodistalgigi_rahangatas_kanan1,
                "lebarmesiodistalgigi_rahangatas_kanan2" => $request->lebarmesiodistalgigi_rahangatas_kanan2,
                "lebarmesiodistalgigi_rahangatas_kanan3" => $request->lebarmesiodistalgigi_rahangatas_kanan3,
                "lebarmesiodistalgigi_rahangatas_kanan4" => $request->lebarmesiodistalgigi_rahangatas_kanan4,
                "lebarmesiodistalgigi_rahangatas_kanan5" => $request->lebarmesiodistalgigi_rahangatas_kanan5,
                "lebarmesiodistalgigi_rahangatas_kanan6" => $request->lebarmesiodistalgigi_rahangatas_kanan6,
                "lebarmesiodistalgigi_rahangatas_kanan7" => $request->lebarmesiodistalgigi_rahangatas_kanan7,
                "lebarmesiodistalgigi_rahangatas_kiri1" => $request->lebarmesiodistalgigi_rahangatas_kiri1,
                "lebarmesiodistalgigi_rahangatas_kiri2" => $request->lebarmesiodistalgigi_rahangatas_kiri2,
                "lebarmesiodistalgigi_rahangatas_kiri3" => $request->lebarmesiodistalgigi_rahangatas_kiri3,
                "lebarmesiodistalgigi_rahangatas_kiri4" => $request->lebarmesiodistalgigi_rahangatas_kiri4,
                "lebarmesiodistalgigi_rahangatas_kiri5" => $request->lebarmesiodistalgigi_rahangatas_kiri5,
                "lebarmesiodistalgigi_rahangatas_kiri6" => $request->lebarmesiodistalgigi_rahangatas_kiri6,
                "lebarmesiodistalgigi_rahangatas_kiri7" => $request->lebarmesiodistalgigi_rahangatas_kiri7,
                "lebarmesiodistalgigi_rahangbawah_kanan1" => $request->lebarmesiodistalgigi_rahangbawah_kanan1,
                "lebarmesiodistalgigi_rahangbawah_kanan2" => $request->lebarmesiodistalgigi_rahangbawah_kanan2,
                "lebarmesiodistalgigi_rahangbawah_kanan3" => $request->lebarmesiodistalgigi_rahangbawah_kanan3,
                "lebarmesiodistalgigi_rahangbawah_kanan4" => $request->lebarmesiodistalgigi_rahangbawah_kanan4,
                "lebarmesiodistalgigi_rahangbawah_kanan5" => $request->lebarmesiodistalgigi_rahangbawah_kanan5,
                "lebarmesiodistalgigi_rahangbawah_kanan6" => $request->lebarmesiodistalgigi_rahangbawah_kanan6,
                "lebarmesiodistalgigi_rahangbawah_kanan7" => $request->lebarmesiodistalgigi_rahangbawah_kanan7,
                "lebarmesiodistalgigi_rahangbawah_kiri1" => $request->lebarmesiodistalgigi_rahangbawah_kiri1,
                "lebarmesiodistalgigi_rahangbawah_kiri2" => $request->lebarmesiodistalgigi_rahangbawah_kiri2,
                "lebarmesiodistalgigi_rahangbawah_kiri3" => $request->lebarmesiodistalgigi_rahangbawah_kiri3,
                "lebarmesiodistalgigi_rahangbawah_kiri4" => $request->lebarmesiodistalgigi_rahangbawah_kiri4,
                "lebarmesiodistalgigi_rahangbawah_kiri5" => $request->lebarmesiodistalgigi_rahangbawah_kiri5,
                "lebarmesiodistalgigi_rahangbawah_kiri6" => $request->lebarmesiodistalgigi_rahangbawah_kiri6,
                "lebarmesiodistalgigi_rahangbawah_kiri7" => $request->lebarmesiodistalgigi_rahangbawah_kiri7,
                "skemafotooklusalgigidarimodelstudi" => $request->skemafotooklusalgigidarimodelstudi,
                "jumlahmesiodistal" => $request->jumlahmesiodistal,
                "jarakp1p2pengukuran" => $request->jarakp1p2pengukuran,
                "jarakp1p2perhitungan" => $request->jarakp1p2perhitungan,
                "diskrepansip1p2_mm" => $request->diskrepansip1p2_mm,
                "diskrepansip1p2" => $request->diskrepansip1p2,
                "jarakm1m1pengukuran" => $request->jarakm1m1pengukuran,
                "jarakm1m1perhitungan" => $request->jarakm1m1perhitungan,
                "diskrepansim1m2_mm" => $request->diskrepansim1m2_mm,
                "diskrepansim1m2" => $request->diskrepansim1m2,
                "diskrepansi_keterangan" => $request->diskrepansi_keterangan,
                "jumlahlebarmesiodistalgigidarim1m1" => $request->jumlahlebarmesiodistalgigidarim1m1,
                "jarakp1p1tonjol" => $request->jarakp1p1tonjol,
                "indeksp" => $request->indeksp,
                "lengkunggigiuntukmenampunggigigigi" => $request->lengkunggigiuntukmenampunggigigigi,
                "jarakinterfossacaninus" => $request->jarakinterfossacaninus,
                "indeksfc" => $request->indeksfc,
                "lengkungbasaluntukmenampunggigigigi" => $request->lengkungbasaluntukmenampunggigigigi,
                "inklinasigigigigiregioposterior" => $request->inklinasigigigigiregioposterior,
                "metodehowes_keterangan" => $request->metodehowes_keterangan,
                "aldmetode" => $request->aldmetode,
                "overjetawal" => $request->overjetawal,
                "overjetakhir" => $request->overjetakhir,
                "rahangatasdiskrepansi" => $request->rahangatasdiskrepansi,
                "rahangbawahdiskrepansi" => $request->rahangbawahdiskrepansi,
                "fotosefalometri" => $request->fotosefalometri,
                "fotopanoramik" => $request->fotopanoramik,
                "maloklusiangleklas" => $request->maloklusiangleklas,
                "hubunganskeletal" => $request->hubunganskeletal,
                "malrelasi" => $request->malrelasi,
                "malposisi" => $request->malposisi,
                "estetik" => $request->estetik,
                "dental" => $request->dental,
                "skeletal" => $request->skeletal,
                "fungsipenguyahanal" => $request->fungsipenguyahanal,
                "crowding" => $request->crowding,
                "spacing" => $request->spacing,
                "protrusif" => $request->protrusif,
                "retrusif" => $request->retrusif,
                "malposisiindividual" => $request->malposisiindividual,
                "maloklusi_crossbite" => $request->maloklusi_crossbite,
                "maloklusi_lainlain" => $request->maloklusi_lainlain,
                "maloklusi_lainlainketerangan" => $request->maloklusi_lainlainketerangan,
                "rapencabutan" => $request->rapencabutan,
                "raekspansi" => $request->raekspansi,
                "ragrinding" => $request->ragrinding,
                "raplataktif" => $request->raplataktif,
                "rbpencabutan" => $request->rbpencabutan,
                "rbekspansi" => $request->rbekspansi,
                "rbgrinding" => $request->rbgrinding,
                "rbplataktif" => $request->rbplataktif,
                "analisisetiologimaloklusi" => $request->analisisetiologimaloklusi,
                "pasiendirujukkebagian" => $request->pasiendirujukkebagian,
                "pencarianruanguntuk" => $request->pencarianruanguntuk,
                "koreksimalposisigigiindividual" => $request->koreksimalposisigigiindividual,
                "retensi" => $request->retensi,
                "pencarianruang" => $request->pencarianruang,
                "koreksimalposisigigiindividual_rahangatas" => $request->koreksimalposisigigiindividual_rahangatas,
                "koreksimalposisigigiindividual_rahangbawah" => $request->koreksimalposisigigiindividual_rahangbawah,
                "intruksipadapasien" => $request->intruksipadapasien,
                "retainer" => $request->retainer,
                "gambarplataktif_rahangatas" => $request->gambarplataktif_rahangatas,
                "gambarplataktif_rahangbawah" => $request->gambarplataktif_rahangbawah,
                "keterangangambar" => $request->keterangangambar,
                "prognosis" => $request->prognosis,
                "prognosis_a" => $request->prognosis_a,
                "prognosis_b" => $request->prognosis_b,
                "prognosis_c" => $request->prognosis_c,
                "indikasiperawatan" => $request->indikasiperawatan
            ];
            $cekdata = $this->emrortodonsiRepository->findwaktuperawatan($request);

            if ($cekdata->count() < 1) {
                $execute = $this->emrortodonsiRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Orthodonsi Berhasil Dibuat !';
            } else {
                $execute = $this->emrortodonsiRepository->updatewaktuperawatan($request);
                $message = 'Assesment Orthodonsi Berhasil Diperbarui !';
            }

            DB::commit();
            if ($execute) {
                return $this->sendResponse($data, $message);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function uploadfoto(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/pemeriksaangigi/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->updateimagesfotopemriksaangigi($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    // analisa foto muka
    public function uploadtampakdepan(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "fotomuka_bentukmuka" => "required",   
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisabentukmuka/tampakdepantakterlihatgigi/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload,
                'bentukmuka' => $request->bentukmuka
            ];
       
           $this->emrortodonsiRepository->updateuploadtampakdepan($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadfotosenyum(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisabentukmuka/tampakdepansenyumterlihatgigi/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->updateuploadtampakdepansenyumterlihatgigi($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadfotosamping(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "fotomuka_profilmuka" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisabentukmuka/tampaksamping/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->updateimagesfotosamping($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadfotomiring(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisabentukmuka/tampakmiring/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->updateimagesfototampakmiring($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    //geligeli
    public function uploadtampaksampingkanan(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/geligeli/tampaksampingkanan/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadtampaksampingkanan($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadtampakdepangeli(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/geligeli/tampakdepan/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadtampakdepangeli($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadtampaksampingkiri(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/geligeli/tampaksampingkiri/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadtampaksampingkiri($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadtampakoklusalatas(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/geligeli/tampakoklusalatas/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadtampakoklusalatas($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadtampakoklusalbawah(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/geligeli/tampakoklusalbawah/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadtampakoklusalbawah($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadmodelstudi(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/okulasigigi/modelstudi/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadmodelstudi($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadsefalometri(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisaradiografi/sefalometri/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadsefalometri($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadpanoramik(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisaradiografi/panoramik/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadpanoramik($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadanalisaetiologi(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/analisaetiologi/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadanalisaetiologi($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    //jalanperawatan
    public function uploadpencarianruang(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/jalanperawatan/uploadpencarianruang/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadpencarianruang($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadrahangatas(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/jalanperawatan/uploadrahangatas/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadrahangatas($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadrahangbawah(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/jalanperawatan/uploadrahangbawah/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadrahangbawah($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadretainer(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/retainer/uploadretainer/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadretainer($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    //plakat
    public function uploadplakatrahangatas(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/plakat/plakatrahangatas/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadplakatrahangatas($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadplakatrahangbawah(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "select_file" => "required|max:10000" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/orthodonti/plakat/plakatrahangbawah/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
       
           $this->emrortodonsiRepository->uploadplakatrahangbawah($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Pedodonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
}
