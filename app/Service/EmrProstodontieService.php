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
use App\Repositories\Interfaces\EmrProstodontieRepositoryInterface;

class EmrProstodontieService extends Controller
{
    use AwsTrait;
    private $emrprostodontieRepository;

    public function __construct(EmrProstodontieRepositoryInterface $emrprostodontieRepository)
    {
        $this->emrprostodontieRepository = $emrprostodontieRepository;
    }
    public function createwaktuperawatan(Request $request)
    {
        // validate 
        $request->validate([
            "noregister" => 'required',
            "noepisode" => 'required',
            // "nomorrekammedik" => 'required',
            // "tanggal" => 'required',
            // "namapasien" => 'required',
            // "pekerjaan" => 'required',
            // "jeniskelamin" => 'required',
            // "alamatpasien" => 'required',
            // "namaoperator" => 'required',
            // "nomortelpon" => 'required',
            // "npm" => 'required',
            // "keluhanutama" => 'required',
            // "riwayatgeligi" => 'required',
            // "pengalamandengangigitiruan" => 'required',
            // "estetis" => 'required',
            // "fungsibicara" => 'required',
            // "penguyahan" => 'required',
            // "pembiayaan" => 'required',
            // "lainlain" => 'required',
            // "wajah" => 'required',
            // "profilmuka" => 'required',
            // "pupil" => 'required',
            // "tragus" => 'required',
            // "hidung" => 'required',
            // "pernafasanmelaluihidung" => 'required',
            // "bibiratas" => 'required',
            // "bibiratas_b" => 'required',
            // "bibirbawah" => 'required',
            // "bibirbawah_b" => 'required',
            // "submandibulariskanan" => 'required',
            // "submandibulariskanan_b" => 'required',
            // "submandibulariskiri" => 'required',
            // "submandibulariskiri_b" => 'required',
            // "sublingualis" => 'required',
            // "sublingualis_b" => 'required',
            // "sisikiri" => 'required',
            // "sisikirisejak" => 'required',
            // "sisikanan" => 'required',
            // "sisikanansejak" => 'required',
            // "membukamulut" => 'required',
            // "membukamulut_b" => 'required',
            // "kelainanlain" => 'required',
            // "higienemulut" => 'required',
            // "salivakuantitas" => 'required',
            // "salivakonsisten" => 'required',
            // "lidahukuran" => 'required',
            // "lidahposisiwright" => 'required',
            // "lidahmobilitas" => 'required',
            // "refleksmuntah" => 'required',
            // "mukosamulut" => 'required',
            // "mukosamulutberupa" => 'required',
            // "gigitan" => 'required',
            // "gigitanbilaada" => 'required',
            // "gigitanterbuka" => 'required',
            // "gigitanterbukaregion" => 'required',
            // "gigitansilang" => 'required',
            // "gigitansilangregion" => 'required',
            // "hubunganrahang" => 'required',
            // "pemeriksaanrontgendental" => 'required',
            // "elemengigi" => 'required',
            // "pemeriksaanrontgenpanoramik" => 'required',
            // "pemeriksaanrontgentmj" => 'required',
            // "frakturgigi" => 'required',
            // "frakturarah" => 'required',
            // "frakturbesar" => 'required',
            // "intraorallainlain" => 'required',
            // "perbandinganmahkotadanakargigi" => 'required',
            // "interprestasifotorontgen" => 'required',
            // "intraoralkebiasaanburuk" => 'required',
            // "intraoralkebiasaanburukberupa" => 'required',
            // "pemeriksaanodontogram_11_51" => 'required',
            // "pemeriksaanodontogram_12_52" => 'required',
            // "pemeriksaanodontogram_13_53" => 'required',
            // "pemeriksaanodontogram_14_54" => 'required',
            // "pemeriksaanodontogram_15_55" => 'required',
            // "pemeriksaanodontogram_16" => 'required',
            // "pemeriksaanodontogram_17" => 'required',
            // "pemeriksaanodontogram_18" => 'required',
            // "pemeriksaanodontogram_61_21" => 'required',
            // "pemeriksaanodontogram_62_22" => 'required',
            // "pemeriksaanodontogram_63_23" => 'required',
            // "pemeriksaanodontogram_64_24" => 'required',
            // "pemeriksaanodontogram_65_25" => 'required',
            // "pemeriksaanodontogram_26" => 'required',
            // "pemeriksaanodontogram_27" => 'required',
            // "pemeriksaanodontogram_28" => 'required',
            // "pemeriksaanodontogram_48" => 'required',
            // "pemeriksaanodontogram_47" => 'required',
            // "pemeriksaanodontogram_46" => 'required',
            // "pemeriksaanodontogram_45_85" => 'required',
            // "pemeriksaanodontogram_44_84" => 'required',
            // "pemeriksaanodontogram_43_83" => 'required',
            // "pemeriksaanodontogram_42_82" => 'required',
            // "pemeriksaanodontogram_41_81" => 'required',
            // "pemeriksaanodontogram_38" => 'required',
            // "pemeriksaanodontogram_37" => 'required',
            // "pemeriksaanodontogram_36" => 'required',
            // "pemeriksaanodontogram_75_35" => 'required',
            // "pemeriksaanodontogram_74_34" => 'required',
            // "pemeriksaanodontogram_73_33" => 'required',
            // "pemeriksaanodontogram_72_32" => 'required',
            // "pemeriksaanodontogram_71_31" => 'required',
            // "rahangataspostkiri" => 'required',
            // "rahangataspostkanan" => 'required',
            // "rahangatasanterior" => 'required',
            // "rahangbawahpostkiri" => 'required',
            // "rahangbawahpostkanan" => 'required',
            // "rahangbawahanterior" => 'required',
            // "rahangatasbentukpostkiri" => 'required',
            // "rahangatasbentukpostkanan" => 'required',
            // "rahangatasbentukanterior" => 'required',
            // "rahangatasketinggianpostkiri" => 'required',
            // "rahangatasketinggianpostkanan" => 'required',
            // "rahangatasketinggiananterior" => 'required',
            // "rahangatastahananjaringanpostkiri" => 'required',
            // "rahangatastahananjaringanpostkanan" => 'required',
            // "rahangatastahananjaringananterior" => 'required',
            // "rahangatasbentukpermukaanpostkiri" => 'required',
            // "rahangatasbentukpermukaanpostkanan" => 'required',
            // "rahangatasbentukpermukaananterior" => 'required',
            // "rahangbawahbentukpostkiri" => 'required',
            // "rahangbawahbentukpostkanan" => 'required',
            // "rahangbawahbentukanterior" => 'required',
            // "rahangbawahketinggianpostkiri" => 'required',
            // "rahangbawahketinggianpostkanan" => 'required',
            // "rahangbawahketinggiananterior" => 'required',
            // "rahangbawahtahananjaringanpostkiri" => 'required',
            // "rahangbawahtahananjaringanpostkanan" => 'required',
            // "rahangbawahtahananjaringananterior" => 'required',
            // "rahangbawahbentukpermukaanpostkiri" => 'required',
            // "rahangbawahbentukpermukaanpostkanan" => 'required',
            // "rahangbawahbentukpermukaananterior" => 'required',
            // "anterior" => 'required',
            // "prosteriorkiri" => 'required',
            // "prosteriorkanan" => 'required',
            // "labialissuperior" => 'required',
            // "labialisinferior" => 'required',
            // "bukalisrahangataskiri" => 'required',
            // "bukalisrahangataskanan" => 'required',
            // "bukalisrahangbawahkiri" => 'required',
            // "bukalisrahangbawahkanan" => 'required',
            // "lingualis" => 'required',
            // "palatum" => 'required',
            // "kedalaman" => 'required',
            // "toruspalatinus" => 'required',
            // "palatummolle" => 'required',
            // "tuberorositasalveolariskiri" => 'required',
            // "tuberorositasalveolariskanan" => 'required',
            // "ruangretromilahioidkiri" => 'required',
            // "ruangretromilahioidkanan" => 'required',
            // "bentuklengkungrahangatas" => 'required',
            // "bentuklengkungrahangbawah" => 'required',
            // "perlekatandasarmulut" => 'required',
            // "pemeriksaanlain_lainlain" => 'required',
            // "sikapmental" => 'required',
            // "diagnosa" => 'required',
            // "rahangatas" => 'required',
            // "rahangataselemen" => 'required',
            // "rahangbawah" => 'required',
            // "rahangbawahelemen" => 'required',
            // "gigitiruancekat" => 'required',
            // "gigitiruancekatelemen" => 'required',
            // "perawatanperiodontal" => 'required',
            // "perawatanbedah" => 'required',
            // "perawatanbedah_ada" => 'required',
            // "perawatanbedahelemen" => 'required',
            // "perawatanbedahlainlain" => 'required',
            // "konservasigigi" => 'required',
            // "konservasigigielemen" => 'required',
            // "rekonturing" => 'required',
            // "adapembuatanmahkota" => 'required',
            // "pengasahangigimiring" => 'required',
            // "pengasahangigiextruded" => 'required',
            // "rekonturinglainlain" => 'required',
            // "macamcetakan_ra" => 'required',
            // "acamcetakan_rb" => 'required',
            // "warnagigi" => 'required',
            // "klasifikasidaerahtidakbergigirahangatas" => 'required',
            // "klasifikasidaerahtidakbergigirahangbawah" => 'required',
            // "gigipenyangga" => 'required',
            // "direk" => 'required',
            // "indirek" => 'required',
            // "platdasar" => 'required',
            // "anasirgigi" => 'required',
            // "prognosis" => 'required',
            // "prognosisalasan" => 'required',
            // "reliningregio" => 'required',
            // "reliningregiotanggal" => 'required',
            // "reparasiregio" => 'required',
            // "reparasiregiotanggal" => 'required',
            // "perawatanulangsebab" => 'required',
            // "perawatanulanglainlain" => 'required',
            // "perawatanulanglainlaintanggal" => 'required',
            // "perawatanulangketerangan" => 'required',
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                "operator" => $request->operator,
                "nim" => $request->nim,
                "pembimbing" => $request->pembimbing,
                "tanggal" => $request->tanggal,
                "namapasien" => $request->namapasien,
                "suku" => $request->suku,
                "umur" => $request->umur,
                "jeniskelamin" => $request->jeniskelamin,
                "alamat" => $request->alamat,
                "telepon" => $request->telepon,
                "pekerjaan" => $request->pekerjaan,
                "rujukandari" => $request->rujukandari,
                "namaayah" => $request->namaayah,
                "sukuayah" => $request->sukuayah,
                "umurayah" => $request->umurayah,
                "namaibu" => $request->namaibu,
                "sukuibu" => $request->sukuibu,
                "umuribu" => $request->umuribu,
                "pekerjaanorangtua" => $request->pekerjaanorangtua,
                "alamatorangtua" => $request->alamatorangtua,
                'noregister' => $request->noregister,
                'noepisode' => $request->noepisode,
                'nomorrekammedik' => $request->nomorrekammedik,
                'tanggal' => $request->tanggal,
                'namapasien' => $request->namapasien,
                'pekerjaan' => $request->pekerjaan,
                'jeniskelamin' => $request->jeniskelamin,
                'alamatpasien' => $request->alamatpasien,
                'namaoperator' => $request->namaoperator,
                'nomortelpon' => $request->nomortelpon,
                'npm' => $request->npm,
                'keluhanutama' => $request->keluhanutama,
                'riwayatgeligi' => $request->riwayatgeligi,
                'pengalamandengangigitiruan' => $request->pengalamandengangigitiruan,
                'estetis' => $request->estetis,
                'fungsibicara' => $request->fungsibicara,
                'penguyahan' => $request->penguyahan,
                'pembiayaan' => $request->pembiayaan,
                'lainlain' => $request->lainlain,
                'wajah' => $request->wajah,
                'profilmuka' => $request->profilmuka,
                'pupil' => $request->pupil,
                'tragus' => $request->tragus,
                'hidung' => $request->hidung,
                'pernafasanmelaluihidung' => $request->pernafasanmelaluihidung,
                'bibiratas' => $request->bibiratas,
                'bibiratas_b' => $request->bibiratas_b,
                'bibirbawah' => $request->bibirbawah,
                'bibirbawah_b' => $request->bibirbawah_b,
                'submandibulariskanan' => $request->submandibulariskanan,
                'submandibulariskanan_b' => $request->submandibulariskanan_b,
                'submandibulariskiri' => $request->submandibulariskiri,
                'submandibulariskiri_b' => $request->submandibulariskiri_b,
                'sublingualis' => $request->sublingualis,
                'sublingualis_b' => $request->sublingualis_b,
                'sisikiri' => $request->sisikiri,
                'sisikirisejak' => $request->sisikirisejak,
                'sisikanan' => $request->sisikanan,
                'sisikanansejak' => $request->sisikanansejak,
                'membukamulut' => $request->membukamulut,
                'membukamulut_b' => $request->membukamulut_b,
                'kelainanlain' => $request->kelainanlain,
                'higienemulut' => $request->higienemulut,
                'salivakuantitas' => $request->salivakuantitas,
                'salivakonsisten' => $request->salivakonsisten,
                'lidahukuran' => $request->lidahukuran,
                'lidahposisiwright' => $request->lidahposisiwright,
                'lidahmobilitas' => $request->lidahmobilitas,
                'refleksmuntah' => $request->refleksmuntah,
                'mukosamulut' => $request->mukosamulut,
                'mukosamulutberupa' => $request->mukosamulutberupa,
                'gigitan' => $request->gigitan,
                'gigitanbilaada' => $request->gigitanbilaada,
                'gigitanterbuka' => $request->gigitanterbuka,
                'gigitanterbukaregion' => $request->gigitanterbukaregion,
                'gigitansilang' => $request->gigitansilang,
                'gigitansilangregion' => $request->gigitansilangregion,
                'hubunganrahang' => $request->hubunganrahang,
                'pemeriksaanrontgendental' => $request->pemeriksaanrontgendental,
                'elemengigi' => $request->elemengigi,
                'pemeriksaanrontgenpanoramik' => $request->pemeriksaanrontgenpanoramik,
                'pemeriksaanrontgentmj' => $request->pemeriksaanrontgentmj,
                'frakturgigi' => $request->frakturgigi,
                'frakturarah' => $request->frakturarah,
                'frakturbesar' => $request->frakturbesar,
                'intraorallainlain' => $request->intraorallainlain,
                'perbandinganmahkotadanakargigi' => $request->perbandinganmahkotadanakargigi,
                'interprestasifotorontgen' => $request->interprestasifotorontgen,
                'intraoralkebiasaanburuk' => $request->intraoralkebiasaanburuk,
                'intraoralkebiasaanburukberupa' => $request->intraoralkebiasaanburukberupa,
                'pemeriksaanodontogram_11_51' => $request->pemeriksaanodontogram_11_51,
                'pemeriksaanodontogram_12_52' => $request->pemeriksaanodontogram_12_52,
                'pemeriksaanodontogram_13_53' => $request->pemeriksaanodontogram_13_53,
                'pemeriksaanodontogram_14_54' => $request->pemeriksaanodontogram_14_54,
                'pemeriksaanodontogram_15_55' => $request->pemeriksaanodontogram_15_55,
                'pemeriksaanodontogram_16' => $request->pemeriksaanodontogram_16,
                'pemeriksaanodontogram_17' => $request->pemeriksaanodontogram_17,
                'pemeriksaanodontogram_18' => $request->pemeriksaanodontogram_18,
                'pemeriksaanodontogram_61_21' => $request->pemeriksaanodontogram_61_21,
                'pemeriksaanodontogram_62_22' => $request->pemeriksaanodontogram_62_22,
                'pemeriksaanodontogram_63_23' => $request->pemeriksaanodontogram_63_23,
                'pemeriksaanodontogram_64_24' => $request->pemeriksaanodontogram_64_24,
                'pemeriksaanodontogram_65_25' => $request->pemeriksaanodontogram_65_25,
                'pemeriksaanodontogram_26' => $request->pemeriksaanodontogram_26,
                'pemeriksaanodontogram_27' => $request->pemeriksaanodontogram_27,
                'pemeriksaanodontogram_28' => $request->pemeriksaanodontogram_28,
                'pemeriksaanodontogram_48' => $request->pemeriksaanodontogram_48,
                'pemeriksaanodontogram_47' => $request->pemeriksaanodontogram_47,
                'pemeriksaanodontogram_46' => $request->pemeriksaanodontogram_46,
                'pemeriksaanodontogram_45_85' => $request->pemeriksaanodontogram_45_85,
                'pemeriksaanodontogram_44_84' => $request->pemeriksaanodontogram_44_84,
                'pemeriksaanodontogram_43_83' => $request->pemeriksaanodontogram_43_83,
                'pemeriksaanodontogram_42_82' => $request->pemeriksaanodontogram_42_82,
                'pemeriksaanodontogram_41_81' => $request->pemeriksaanodontogram_41_81,
                'pemeriksaanodontogram_38' => $request->pemeriksaanodontogram_38,
                'pemeriksaanodontogram_37' => $request->pemeriksaanodontogram_37,
                'pemeriksaanodontogram_36' => $request->pemeriksaanodontogram_36,
                'pemeriksaanodontogram_75_35' => $request->pemeriksaanodontogram_75_35,
                'pemeriksaanodontogram_74_34' => $request->pemeriksaanodontogram_74_34,
                'pemeriksaanodontogram_73_33' => $request->pemeriksaanodontogram_73_33,
                'pemeriksaanodontogram_72_32' => $request->pemeriksaanodontogram_72_32,
                'pemeriksaanodontogram_71_31' => $request->pemeriksaanodontogram_71_31,
                'rahangataspostkiri' => $request->rahangataspostkiri,
                'rahangataspostkanan' => $request->rahangataspostkanan,
                'rahangatasanterior' => $request->rahangatasanterior,
                'rahangbawahpostkiri' => $request->rahangbawahpostkiri,
                'rahangbawahpostkanan' => $request->rahangbawahpostkanan,
                'rahangbawahanterior' => $request->rahangbawahanterior,
                'rahangatasbentukpostkiri' => $request->rahangatasbentukpostkiri,
                'rahangatasbentukpostkanan' => $request->rahangatasbentukpostkanan,
                'rahangatasbentukanterior' => $request->rahangatasbentukanterior,
                'rahangatasketinggianpostkiri' => $request->rahangatasketinggianpostkiri,
                'rahangatasketinggianpostkanan' => $request->rahangatasketinggianpostkanan,
                'rahangatasketinggiananterior' => $request->rahangatasketinggiananterior,
                'rahangatastahananjaringanpostkiri' => $request->rahangatastahananjaringanpostkiri,
                'rahangatastahananjaringanpostkanan' => $request->rahangatastahananjaringanpostkanan,
                'rahangatastahananjaringananterior' => $request->rahangatastahananjaringananterior,
                'rahangatasbentukpermukaanpostkiri' => $request->rahangatasbentukpermukaanpostkiri,
                'rahangatasbentukpermukaanpostkanan' => $request->rahangatasbentukpermukaanpostkanan,
                'rahangatasbentukpermukaananterior' => $request->rahangatasbentukpermukaananterior,
                'rahangbawahbentukpostkiri' => $request->rahangbawahbentukpostkiri,
                'rahangbawahbentukpostkanan' => $request->rahangbawahbentukpostkanan,
                'rahangbawahbentukanterior' => $request->rahangbawahbentukanterior,
                'rahangbawahketinggianpostkiri' => $request->rahangbawahketinggianpostkiri,
                'rahangbawahketinggianpostkanan' => $request->rahangbawahketinggianpostkanan,
                'rahangbawahketinggiananterior' => $request->rahangbawahketinggiananterior,
                'rahangbawahtahananjaringanpostkiri' => $request->rahangbawahtahananjaringanpostkiri,
                'rahangbawahtahananjaringanpostkanan' => $request->rahangbawahtahananjaringanpostkanan,
                'rahangbawahtahananjaringananterior' => $request->rahangbawahtahananjaringananterior,
                'rahangbawahbentukpermukaanpostkiri' => $request->rahangbawahbentukpermukaanpostkiri,
                'rahangbawahbentukpermukaanpostkanan' => $request->rahangbawahbentukpermukaanpostkanan,
                'rahangbawahbentukpermukaananterior' => $request->rahangbawahbentukpermukaananterior,
                'anterior' => $request->anterior,
                'prosteriorkiri' => $request->prosteriorkiri,
                'prosteriorkanan' => $request->prosteriorkanan,
                'labialissuperior' => $request->labialissuperior,
                'labialisinferior' => $request->labialisinferior,
                'bukalisrahangataskiri' => $request->bukalisrahangataskiri,
                'bukalisrahangataskanan' => $request->bukalisrahangataskanan,
                'bukalisrahangbawahkiri' => $request->bukalisrahangbawahkiri,
                'bukalisrahangbawahkanan' => $request->bukalisrahangbawahkanan,
                'lingualis' => $request->lingualis,
                'palatum' => $request->palatum,
                'kedalaman' => $request->kedalaman,
                'toruspalatinus' => $request->toruspalatinus,
                'palatummolle' => $request->palatummolle,
                'tuberorositasalveolariskiri' => $request->tuberorositasalveolariskiri,
                'tuberorositasalveolariskanan' => $request->tuberorositasalveolariskanan,
                'ruangretromilahioidkiri' => $request->ruangretromilahioidkiri,
                'ruangretromilahioidkanan' => $request->ruangretromilahioidkanan,
                'bentuklengkungrahangatas' => $request->bentuklengkungrahangatas,
                'bentuklengkungrahangbawah' => $request->bentuklengkungrahangbawah,
                'perlekatandasarmulut' => $request->perlekatandasarmulut,
                'pemeriksaanlain_lainlain' => $request->pemeriksaanlain_lainlain,
                'sikapmental' => $request->sikapmental,
                'diagnosa' => $request->diagnosa,
                'rahangatas' => $request->rahangatas,
                'rahangataselemen' => $request->rahangataselemen,
                'rahangbawah' => $request->rahangbawah,
                'rahangbawahelemen' => $request->rahangbawahelemen,
                'gigitiruancekat' => $request->gigitiruancekat,
                'gigitiruancekatelemen' => $request->gigitiruancekatelemen,
                'perawatanperiodontal' => $request->perawatanperiodontal,
                'perawatanbedah' => $request->perawatanbedah,
                'perawatanbedah_ada' => $request->perawatanbedah_ada,
                'perawatanbedahelemen' => $request->perawatanbedahelemen,
                'perawatanbedahlainlain' => $request->perawatanbedahlainlain,
                'konservasigigi' => $request->konservasigigi,
                'konservasigigielemen' => $request->konservasigigielemen,
                'rekonturing' => $request->rekonturing,
                'adapembuatanmahkota' => $request->adapembuatanmahkota,
                'pengasahangigimiring' => $request->pengasahangigimiring,
                'pengasahangigiextruded' => $request->pengasahangigiextruded,
                'rekonturinglainlain' => $request->rekonturinglainlain,
                'macamcetakan_ra' => $request->macamcetakan_ra,
                'acamcetakan_rb' => $request->acamcetakan_rb,
                'warnagigi' => $request->warnagigi,
                'klasifikasidaerahtidakbergigirahangatas' => $request->klasifikasidaerahtidakbergigirahangatas,
                'klasifikasidaerahtidakbergigirahangbawah' => $request->klasifikasidaerahtidakbergigirahangbawah,
                'gigipenyangga' => $request->gigipenyangga,
                'direk' => $request->direk,
                'indirek' => $request->indirek,
                'platdasar' => $request->platdasar,
                'anasirgigi' => $request->anasirgigi,
                'prognosis' => $request->prognosis,
                'prognosisalasan' => $request->prognosisalasan,
                'reliningregio' => $request->reliningregio,
                'reliningregiotanggal' => $request->reliningregiotanggal,
                'reparasiregio' => $request->reparasiregio,
                'reparasiregiotanggal' => $request->reparasiregiotanggal,
                'perawatanulangsebab' => $request->perawatanulangsebab,
                'perawatanulanglainlain' => $request->perawatanulanglainlain,
                'perawatanulanglainlaintanggal' => $request->perawatanulanglainlaintanggal,
                'perawatanulangketerangan' => $request->perawatanulangketerangan,
                'designngigitext' => $request->designngigitext,


            ];
            $cekdata = $this->emrprostodontieRepository->findwaktuperawatan($request);

            if ($cekdata->count() < 1) {
                $execute = $this->emrprostodontieRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Prostodonti Berhasil Dibuat !';
            } else {
                $execute = $this->emrprostodontieRepository->updatewaktuperawatan($request);
                $message = 'Assesment Prostodonti Berhasil Diperbarui !';
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
            "select_file" => "required|max:10000",
            "notes" => "required" 
        ]);
      
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
             
            $image = $request->file('select_file');
            $uuid = Uuid::uuid4();
            $new_name = $uuid. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $keyaws = 'emr/prostodonti/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
 
           $this->emrprostodontieRepository->uploadfoto($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Prostonti berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadodontogram(Request $request)
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
            $keyaws = 'emr/prostodonti/odontogram/';
            $upload = $this->UploadtoAWS($new_name,$keyaws);

            $data = [
                'id' => $request->id,
                'select_file' => $upload
            ];
 
           $this->emrprostodontieRepository->uploadodontogram($request,$upload);
            DB::commit();

            unlink(storage_path() . "/app/". $new_name);
            return $this->sendResponse($data, 'Foto Odontogram berhasil di upload !');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    //logbook 
    public function logbookcreate(Request $request)
    {
      
            // validate 
        $request->validate([ 
            "emrid" => "required", 
            "dateentri" => "required",  
            "work" => "required",    
            "usernameentry" => "required",    
            "usernameentryname" => "required",    
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
  
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'emrid' => $request->emrid,
                'dateentri' => $request->dateentri, 
                'work' => $request->work,  
                'usernameentry' => $request->usernameentry,
                'usernameentryname' => $request->usernameentryname, 
            ];
       
            $execute = $this->emrprostodontieRepository->logbookcreate($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment Plan berhasil ditambahkan !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function logbookupdate(Request $request)
    {
        $request->validate([ 
            "emrid" => "required", 
            "dateentri" => "required",  
            "work" => "required",    
            "usernameentry" => "required",    
            "usernameentryname" => "required",    
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            // $findmedicalhistory = $this->emrpedodontiRepository->findmedicaldentalhistory($request->emrid);
            // dd($findmedicalhistory);
            // if($findmedicalhistory->count() < 1){
            //     return $this->sendError('Medical History tidak ditemukan !', []);
            // } 
            $data = [
                'id' => $request->id,                
                'emrid' => $request->emrid,
                'dateentri' => $request->dateentri, 
                'work' => $request->work,  
                'usernameentry' => $request->usernameentry,
                'usernameentryname' => $request->usernameentryname, 
            ];
       
            $execute = $this->emrprostodontieRepository->logbookupdate($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment Plan berhasil dirubah !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function logbookdelete(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 

            $findmedicalhistory = $this->emrprostodontieRepository->findlogbookbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment tidak ditemukan !', []);
            } 

            $data = [
                'id' => $request->id,                 
            ];
       
            $execute = $this->emrprostodontieRepository->logbookdelete($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment berhasil dihapus !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function logbookviewbyid(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrprostodontieRepository->findlogbookbyId($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment Plan tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory->first(), 'Treatment berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function logbookviewall(Request $request)
    {
        $request->validate([ 
            "emrid" => "required",  
        ]);
        
        try { 
            $findmedicalhistory = $this->emrprostodontieRepository->findlogbookAll($request);
        
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Treatment Plan tidak ditemukan !', []);
            } else{
                return $this->sendResponse($findmedicalhistory, 'Treatment Plan berhasil ditemukan !');
            }
 
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function validatelecture(Request $request)
    {
        $request->validate([ 
            "id" => "required",  
            "lectureid" => "required",
            "lecturename" => "required" 
        ]);
        
        try {
           
            // Db Transaction
            DB::beginTransaction(); 
            $findmedicalhistory = $this->emrprostodontieRepository->findlogbookbyId($request);
          
            if($findmedicalhistory->count() < 1){
                return $this->sendError('Log Book tidak ditemukan !', []);
            } 
           
            $data = [
                'id' => $request->id,                 
                'lectureid' => $request->lectureid,
                'lecturename' => $request->lecturename 
            ];
       
            $execute = $this->emrprostodontieRepository->validatelecture($request);
          
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Treatment Plan berhasil dirubah !');
            } 

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function viewemrbyRegOperator(Request $request)
    {
        $request->validate([ 
            "noregister" => "required",            
            "nim" => "required"
   
        ]);
      
        try {   
            DB::beginTransaction();

           
            $cekdata = $this->emrprostodontieRepository->viewemrbyRegOperator($request);

            if($cekdata->count() < 1){
                $uuid = Uuid::uuid4();
                $data = [
                    'id' => $uuid,
                    'nim' => $request->nim,
                    "noregister" => $request->noregister,
                                        "noepisode" => null,

                ];

                $this->emrprostodontieRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Prostodonti Berhasil Dibuat !';

                 DB::commit();
 
                return $this->sendResponse($data, $message);
            }else{
                $uuiddata = $cekdata->first(); 
                return $this->sendResponse($uuiddata, 'Data EMR ditemukan !');
            }
           
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
}