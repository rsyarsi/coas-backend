<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Year;
use App\Models\hospital;
use App\Models\emrprostodontie;
use Illuminate\Support\Facades\DB;
use App\Models\emrprostodontie_logbook;
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use App\Repositories\Interfaces\EmrProstodontieRepositoryInterface;

class EmrProstodontieRepository implements EmrProstodontieRepositoryInterface
{
    public function createwaktuperawatan($request, $uuid)
    {
        return  DB::table("emrprostodonties")->insert($request);
    }
    // public function createbehaviorrating($data)
    // {
    //     return  DB::table("emrpedodontie_behaviorratings")->insert($data);
    // }
    public function findwaktuperawatan($data)
    {
        return emrprostodontie::where('id', $data->id)->get();
    }
    public function updatewaktuperawatan($data)
    {

        $updates = emrprostodontie::where('id', $data->id)->update([
            'noregister' => $data->noregister,
            'noepisode' => $data->noepisode,
            'nomorrekammedik' => $data->nomorrekammedik,
            'tanggal' => $data->tanggal,
            'namapasien' => $data->namapasien,
            'pekerjaan' => $data->pekerjaan,
            'jeniskelamin' => $data->jeniskelamin,
            'alamatpasien' => $data->alamatpasien,
            'namaoperator' => $data->namaoperator,
            'nomortelpon' => $data->nomortelpon,
            'npm' => $data->npm,
            'keluhanutama' => $data->keluhanutama,
            'riwayatgeligi' => $data->riwayatgeligi,
            'pengalamandengangigitiruan' => $data->pengalamandengangigitiruan,
            'estetis' => $data->estetis,
            'fungsibicara' => $data->fungsibicara,
            'penguyahan' => $data->penguyahan,
            'pembiayaan' => $data->pembiayaan,
            'lainlain' => $data->lainlain,
            'wajah' => $data->wajah,
            'profilmuka' => $data->profilmuka,
            'pupil' => $data->pupil,
            'tragus' => $data->tragus,
            'hidung' => $data->hidung,
            'pernafasanmelaluihidung' => $data->pernafasanmelaluihidung,
            'bibiratas' => $data->bibiratas,
            'bibiratas_b' => $data->bibiratas_b,
            'bibirbawah' => $data->bibirbawah,
            'bibirbawah_b' => $data->bibirbawah_b,
            'submandibulariskanan' => $data->submandibulariskanan,
            'submandibulariskanan_b' => $data->submandibulariskanan_b,
            'submandibulariskiri' => $data->submandibulariskiri,
            'submandibulariskiri_b' => $data->submandibulariskiri_b,
            'sublingualis' => $data->sublingualis,
            'sublingualis_b' => $data->sublingualis_b,
            'sisikiri' => $data->sisikiri,
            'sisikirisejak' => $data->sisikirisejak,
            'sisikanan' => $data->sisikanan,
            'sisikanansejak' => $data->sisikanansejak,
            'membukamulut' => $data->membukamulut,
            'membukamulut_b' => $data->membukamulut_b,
            'kelainanlain' => $data->kelainanlain,
            'higienemulut' => $data->higienemulut,
            'salivakuantitas' => $data->salivakuantitas,
            'salivakonsisten' => $data->salivakonsisten,
            'lidahukuran' => $data->lidahukuran,
            'lidahposisiwright' => $data->lidahposisiwright,
            'lidahmobilitas' => $data->lidahmobilitas,
            'refleksmuntah' => $data->refleksmuntah,
            'mukosamulut' => $data->mukosamulut,
            'mukosamulutberupa' => $data->mukosamulutberupa,
            'gigitan' => $data->gigitan,
            'gigitanbilaada' => $data->gigitanbilaada,
            'gigitanterbuka' => $data->gigitanterbuka,
            'gigitanterbukaregion' => $data->gigitanterbukaregion,
            'gigitansilang' => $data->gigitansilang,
            'gigitansilangregion' => $data->gigitansilangregion,
            'hubunganrahang' => $data->hubunganrahang,
            'pemeriksaanrontgendental' => $data->pemeriksaanrontgendental,
            'elemengigi' => $data->elemengigi,
            'pemeriksaanrontgenpanoramik' => $data->pemeriksaanrontgenpanoramik,
            'pemeriksaanrontgentmj' => $data->pemeriksaanrontgentmj,
            'frakturgigi' => $data->frakturgigi,
            'frakturarah' => $data->frakturarah,
            'frakturbesar' => $data->frakturbesar,
            'intraorallainlain' => $data->intraorallainlain,
            'perbandinganmahkotadanakargigi' => $data->perbandinganmahkotadanakargigi,
            'interprestasifotorontgen' => $data->interprestasifotorontgen,
            'intraoralkebiasaanburuk' => $data->intraoralkebiasaanburuk,
            'intraoralkebiasaanburukberupa' => $data->intraoralkebiasaanburukberupa,
            'pemeriksaanodontogram_11_51' => $data->pemeriksaanodontogram_11_51,
            'pemeriksaanodontogram_12_52' => $data->pemeriksaanodontogram_12_52,
            'pemeriksaanodontogram_13_53' => $data->pemeriksaanodontogram_13_53,
            'pemeriksaanodontogram_14_54' => $data->pemeriksaanodontogram_14_54,
            'pemeriksaanodontogram_15_55' => $data->pemeriksaanodontogram_15_55,
            'pemeriksaanodontogram_16' => $data->pemeriksaanodontogram_16,
            'pemeriksaanodontogram_17' => $data->pemeriksaanodontogram_17,
            'pemeriksaanodontogram_18' => $data->pemeriksaanodontogram_18,
            'pemeriksaanodontogram_61_21' => $data->pemeriksaanodontogram_61_21,
            'pemeriksaanodontogram_62_22' => $data->pemeriksaanodontogram_62_22,
            'pemeriksaanodontogram_63_23' => $data->pemeriksaanodontogram_63_23,
            'pemeriksaanodontogram_64_24' => $data->pemeriksaanodontogram_64_24,
            'pemeriksaanodontogram_65_25' => $data->pemeriksaanodontogram_65_25,
            'pemeriksaanodontogram_26' => $data->pemeriksaanodontogram_26,
            'pemeriksaanodontogram_27' => $data->pemeriksaanodontogram_27,
            'pemeriksaanodontogram_28' => $data->pemeriksaanodontogram_28,
            'pemeriksaanodontogram_48' => $data->pemeriksaanodontogram_48,
            'pemeriksaanodontogram_47' => $data->pemeriksaanodontogram_47,
            'pemeriksaanodontogram_46' => $data->pemeriksaanodontogram_46,
            'pemeriksaanodontogram_45_85' => $data->pemeriksaanodontogram_45_85,
            'pemeriksaanodontogram_44_84' => $data->pemeriksaanodontogram_44_84,
            'pemeriksaanodontogram_43_83' => $data->pemeriksaanodontogram_43_83,
            'pemeriksaanodontogram_42_82' => $data->pemeriksaanodontogram_42_82,
            'pemeriksaanodontogram_41_81' => $data->pemeriksaanodontogram_41_81,
            'pemeriksaanodontogram_38' => $data->pemeriksaanodontogram_38,
            'pemeriksaanodontogram_37' => $data->pemeriksaanodontogram_37,
            'pemeriksaanodontogram_36' => $data->pemeriksaanodontogram_36,
            'pemeriksaanodontogram_75_35' => $data->pemeriksaanodontogram_75_35,
            'pemeriksaanodontogram_74_34' => $data->pemeriksaanodontogram_74_34,
            'pemeriksaanodontogram_73_33' => $data->pemeriksaanodontogram_73_33,
            'pemeriksaanodontogram_72_32' => $data->pemeriksaanodontogram_72_32,
            'pemeriksaanodontogram_71_31' => $data->pemeriksaanodontogram_71_31,
            'rahangataspostkiri' => $data->rahangataspostkiri,
            'rahangataspostkanan' => $data->rahangataspostkanan,
            'rahangatasanterior' => $data->rahangatasanterior,
            'rahangbawahpostkiri' => $data->rahangbawahpostkiri,
            'rahangbawahpostkanan' => $data->rahangbawahpostkanan,
            'rahangbawahanterior' => $data->rahangbawahanterior,
            'rahangatasbentukpostkiri' => $data->rahangatasbentukpostkiri,
            'rahangatasbentukpostkanan' => $data->rahangatasbentukpostkanan,
            'rahangatasbentukanterior' => $data->rahangatasbentukanterior,
            'rahangatasketinggianpostkiri' => $data->rahangatasketinggianpostkiri,
            'rahangatasketinggianpostkanan' => $data->rahangatasketinggianpostkanan,
            'rahangatasketinggiananterior' => $data->rahangatasketinggiananterior,
            'rahangatastahananjaringanpostkiri' => $data->rahangatastahananjaringanpostkiri,
            'rahangatastahananjaringanpostkanan' => $data->rahangatastahananjaringanpostkanan,
            'rahangatastahananjaringananterior' => $data->rahangatastahananjaringananterior,
            'rahangatasbentukpermukaanpostkiri' => $data->rahangatasbentukpermukaanpostkiri,
            'rahangatasbentukpermukaanpostkanan' => $data->rahangatasbentukpermukaanpostkanan,
            'rahangatasbentukpermukaananterior' => $data->rahangatasbentukpermukaananterior,
            'rahangbawahbentukpostkiri' => $data->rahangbawahbentukpostkiri,
            'rahangbawahbentukpostkanan' => $data->rahangbawahbentukpostkanan,
            'rahangbawahbentukanterior' => $data->rahangbawahbentukanterior,
            'rahangbawahketinggianpostkiri' => $data->rahangbawahketinggianpostkiri,
            'rahangbawahketinggianpostkanan' => $data->rahangbawahketinggianpostkanan,
            'rahangbawahketinggiananterior' => $data->rahangbawahketinggiananterior,
            'rahangbawahtahananjaringanpostkiri' => $data->rahangbawahtahananjaringanpostkiri,
            'rahangbawahtahananjaringanpostkanan' => $data->rahangbawahtahananjaringanpostkanan,
            'rahangbawahtahananjaringananterior' => $data->rahangbawahtahananjaringananterior,
            'rahangbawahbentukpermukaanpostkiri' => $data->rahangbawahbentukpermukaanpostkiri,
            'rahangbawahbentukpermukaanpostkanan' => $data->rahangbawahbentukpermukaanpostkanan,
            'rahangbawahbentukpermukaananterior' => $data->rahangbawahbentukpermukaananterior,
            'anterior' => $data->anterior,
            'prosteriorkiri' => $data->prosteriorkiri,
            'prosteriorkanan' => $data->prosteriorkanan,
            'labialissuperior' => $data->labialissuperior,
            'labialisinferior' => $data->labialisinferior,
            'bukalisrahangataskiri' => $data->bukalisrahangataskiri,
            'bukalisrahangataskanan' => $data->bukalisrahangataskanan,
            'bukalisrahangbawahkiri' => $data->bukalisrahangbawahkiri,
            'bukalisrahangbawahkanan' => $data->bukalisrahangbawahkanan,
            'lingualis' => $data->lingualis,
            'palatum' => $data->palatum,
            'kedalaman' => $data->kedalaman,
            'toruspalatinus' => $data->toruspalatinus,
            'palatummolle' => $data->palatummolle,
            'tuberorositasalveolariskiri' => $data->tuberorositasalveolariskiri,
            'tuberorositasalveolariskanan' => $data->tuberorositasalveolariskanan,
            'ruangretromilahioidkiri' => $data->ruangretromilahioidkiri,
            'ruangretromilahioidkanan' => $data->ruangretromilahioidkanan,
            'bentuklengkungrahangatas' => $data->bentuklengkungrahangatas,
            'bentuklengkungrahangbawah' => $data->bentuklengkungrahangbawah,
            'perlekatandasarmulut' => $data->perlekatandasarmulut,
            'pemeriksaanlain_lainlain' => $data->pemeriksaanlain_lainlain,
            'sikapmental' => $data->sikapmental,
            'diagnosa' => $data->diagnosa,
            'rahangatas' => $data->rahangatas,
            'rahangataselemen' => $data->rahangataselemen,
            'rahangbawah' => $data->rahangbawah,
            'rahangbawahelemen' => $data->rahangbawahelemen,
            'gigitiruancekat' => $data->gigitiruancekat,
            'gigitiruancekatelemen' => $data->gigitiruancekatelemen,
            'perawatanperiodontal' => $data->perawatanperiodontal,
            'perawatanbedah' => $data->perawatanbedah,
            'perawatanbedah_ada' => $data->perawatanbedah_ada,
            'perawatanbedahelemen' => $data->perawatanbedahelemen,
            'perawatanbedahlainlain' => $data->perawatanbedahlainlain,
            'konservasigigi' => $data->konservasigigi,
            'konservasigigielemen' => $data->konservasigigielemen,
            'rekonturing' => $data->rekonturing,
            'adapembuatanmahkota' => $data->adapembuatanmahkota,
            'pengasahangigimiring' => $data->pengasahangigimiring,
            'pengasahangigiextruded' => $data->pengasahangigiextruded,
            'rekonturinglainlain' => $data->rekonturinglainlain,
            'macamcetakan_ra' => $data->macamcetakan_ra,
            'acamcetakan_rb' => $data->acamcetakan_rb,
            'warnagigi' => $data->warnagigi,
            'klasifikasidaerahtidakbergigirahangatas' => $data->klasifikasidaerahtidakbergigirahangatas,
            'klasifikasidaerahtidakbergigirahangbawah' => $data->klasifikasidaerahtidakbergigirahangbawah,
            'gigipenyangga' => $data->gigipenyangga,
            'direk' => $data->direk,
            'indirek' => $data->indirek,
            'platdasar' => $data->platdasar,
            'anasirgigi' => $data->anasirgigi,
            'prognosis' => $data->prognosis,
            'prognosisalasan' => $data->prognosisalasan,
            'reliningregio' => $data->reliningregio,
            'reliningregiotanggal' => $data->reliningregiotanggal,
            'reparasiregio' => $data->reparasiregio,
            'reparasiregiotanggal' => $data->reparasiregiotanggal,
            'perawatanulangsebab' => $data->perawatanulangsebab,
            'perawatanulanglainlain' => $data->perawatanulanglainlain,
            'perawatanulanglainlaintanggal' => $data->perawatanulanglainlaintanggal,
            'perawatanulangketerangan' => $data->perawatanulangketerangan

        ]);
        return $updates;;
    }

    //logbook 
    public function logbookcreate($data)
    {
        return emrprostodontie_logbook::create($data);
    }
    public function logbookupdate($data)
    {

        $updates = emrprostodontie_logbook::where('id', $data->id)->update([
            'emrid' => $data->emrid,
            'dateentri' => $data->dateentri,
            'work' => $data->work,
            'usernameentry' => $data->usernameentry,
            'usernameentryname' => $data->usernameentryname,            
            'lectureid' => $data->lectureid,
            'lecturename' => $data->lecturename,       

        ]);
        return $updates;
    }
    public function logbookdelete($data)
    {
        return  emrprostodontie_logbook::where('id',$data->id)->delete();
    }
    public function findlogbookbyId($data)
    {
        return emrprostodontie_logbook::where('id', $data->id)->get();
    }
    public function findlogbookAll($data)
    {
        return emrprostodontie_logbook::where('emrid', $data->emrid)->get();
    }
    public function validatelecture($data)
    { 
        $updates = emrprostodontie_logbook::where('id', $data->id)->update([
            'dateverifylecture' => Carbon::now(),
            'lectureid' => $data->lectureid, 
            'lecturename' => $data->lecturename
        ]);
        return $updates;
    }
}
