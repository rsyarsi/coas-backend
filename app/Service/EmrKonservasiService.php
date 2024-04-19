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
use App\Repositories\Interfaces\EmrKonservasiRepositoryInterface;

class EmrKonservasiService extends Controller
{
    use AwsTrait;
    private $emrkonservasiRepository;

    public function __construct(EmrKonservasiRepositoryInterface $emrkonservasiRepository)
    {
        $this->emrkonservasiRepository = $emrkonservasiRepository;
    }
    public function createwaktuperawatan(Request $request)
    {
        // validate 
        $request->validate([
            //'noregister' => 'required',
            'noepisode' => 'required',
            'nomorrekammedik' => 'required',
            // 'tanggal' => 'required',
            // 'namapasien' => 'required',
            // 'pekerjaan' => 'required',
            // 'jeniskelamin' => 'required',
            // 'alamatpasien' => 'required',
            // 'nomortelpon' => 'required',
            // 'namaoperator' => 'required',
            // 'nim' => 'required',
            // 'sblmperawatanpemeriksaangigi_18_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_17_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_16_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_15_55_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_14_54_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_13_53_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_12_52_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_11_51_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_21_61_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_22_62_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_23_63_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_24_64_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_25_65_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_26_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_27_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_28_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_18_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_17_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_16_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_15_55_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_14_54_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_13_53_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_12_52_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_11_51_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_21_61_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_22_62_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_23_63_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_24_64_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_25_65_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_26_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_27_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_28_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_18_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_17_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_16_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_15_55_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_14_54_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_13_53_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_12_52_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_11_51_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_21_61_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_22_62_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_23_63_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_24_64_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_25_65_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_26_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_27_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_28_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_41_81_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_42_82_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_43_83_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_44_84_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_45_85_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_46_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_47_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_48_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_38_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_37_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_36_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_35_75_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_34_74_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_33_73_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_32_72_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_31_71_tv' => 'required',
            // 'sblmperawatanpemeriksaangigi_41_81_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_42_82_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_43_83_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_44_84_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_45_85_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_46_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_47_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_48_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_38_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_37_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_36_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_35_75_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_34_74_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_33_73_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_32_72_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_31_71_diagnosis' => 'required',
            // 'sblmperawatanpemeriksaangigi_41_81_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_42_82_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_43_83_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_44_84_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_45_85_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_46_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_47_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_48_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_38_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_37_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_36_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_35_75_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_34_74_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_33_73_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_32_72_rencanaperawatan' => 'required',
            // 'sblmperawatanpemeriksaangigi_31_71_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_18_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_17_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_16_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_15_55_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_14_54_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_13_53_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_12_52_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_11_51_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_21_61_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_22_62_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_23_63_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_24_64_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_25_65_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_26_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_27_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_28_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_18_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_17_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_16_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_15_55_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_14_54_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_13_53_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_12_52_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_11_51_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_21_61_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_22_62_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_23_63_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_24_64_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_25_65_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_26_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_27_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_28_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_18_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_17_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_16_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_15_55_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_14_54_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_13_53_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_12_52_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_11_51_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_21_61_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_22_62_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_23_63_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_24_64_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_25_65_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_26_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_27_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_28_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_41_81_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_42_82_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_43_83_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_44_84_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_45_85_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_46_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_47_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_48_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_38_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_37_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_36_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_35_75_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_34_74_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_33_73_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_32_72_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_31_71_tv' => 'required',
            // 'ssdhperawatanpemeriksaangigi_41_81_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_42_82_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_43_83_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_44_84_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_45_85_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_46_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_47_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_48_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_38_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_37_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_36_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_35_75_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_34_74_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_33_73_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_32_72_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_31_71_diagnosis' => 'required',
            // 'ssdhperawatanpemeriksaangigi_41_81_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_42_82_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_43_83_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_44_84_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_45_85_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_46_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_47_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_48_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_38_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_37_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_36_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_35_75_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_34_74_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_33_73_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_32_72_rencanaperawatan' => 'required',
            // 'ssdhperawatanpemeriksaangigi_31_71_rencanaperawatan' => 'required',
            // 'sblmperawatanfaktorrisikokaries_sikap' => 'required',
            // 'sblmperawatanfaktorrisikokaries_status' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskositas' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepatanaliranper5menit' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasitasbuffer' => 'required',
            // 'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_pH' => 'required',
            // 'sblmperawatanfaktorrisikokaries_plak_pH' => 'required',
            // 'sblmperawatanfaktorrisikokaries_plak_aktivitas' => 'required',
            // 'sblmperawatanfaktorrisikokaries_fluor' => 'required',
            // 'sblmperawatanfaktorrisikokaries_diet' => 'required',
            // 'sblmperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkataliransaliva' => 'required',
            // 'sblmperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyebabmulutkering' => 'required',
            // 'sblmperawatanfaktorrisikokaries_faktormodifikasi_protesa' => 'required',
            // 'sblmperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif' => 'required',
            // 'sblmperawatanfaktorrisikokaries_faktormodifikasi_sikap' => 'required',
            // 'sblmperawatanfaktorrisikokaries_faktormodifikasi_keterangan' => 'required',
            // 'sblmperawatanfaktorrisikokaries_penilaianakhir_saliva' => 'required',
            // 'sblmperawatanfaktorrisikokaries_penilaianakhir_plak' => 'required',
            // 'sblmperawatanfaktorrisikokaries_penilaianakhir_diet' => 'required',
            // 'sblmperawatanfaktorrisikokaries_penilaianakhir_fluor' => 'required',
            // 'sblmperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_sikap' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_status' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskositas' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepatanaliranper5menit' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasitasbuffer' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_pH' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_plak_pH' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_plak_aktivitas' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_fluor' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_diet' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkataliransaliva' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyebabmulutkering' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_faktormodifikasi_protesa' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_faktormodifikasi_sikap' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_faktormodifikasi_keterangan' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_penilaianakhir_saliva' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_penilaianakhir_plak' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_penilaianakhir_diet' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_penilaianakhir_fluor' => 'required',
            // 'ssdhperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi' => 'required',
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                'noregister' => $request->noregister,
                'noepisode' => $request->noepisode,
                'nomorrekammedik' => $request->nomorrekammedik,
                'tanggal' => $request->tanggal,
                'namapasien' => $request->namapasien,
                'pekerjaan' => $request->pekerjaan,
                'jeniskelamin' => $request->jeniskelamin,
                'alamatpasien' => $request->alamatpasien,
                'nomortelpon' => $request->nomortelpon,
                'namaoperator' => $request->namaoperator,
                'nim' => $request->nim,
                'sblmperawatanpemeriksaangigi_18_tv' => $request->sblmperawatanpemeriksaangigi_18_tv,
                'sblmperawatanpemeriksaangigi_17_tv' => $request->sblmperawatanpemeriksaangigi_17_tv,
                'sblmperawatanpemeriksaangigi_16_tv' => $request->sblmperawatanpemeriksaangigi_16_tv,
                'sblmperawatanpemeriksaangigi_15_55_tv' => $request->sblmperawatanpemeriksaangigi_15_55_tv,
                'sblmperawatanpemeriksaangigi_14_54_tv' => $request->sblmperawatanpemeriksaangigi_14_54_tv,
                'sblmperawatanpemeriksaangigi_13_53_tv' => $request->sblmperawatanpemeriksaangigi_13_53_tv,
                'sblmperawatanpemeriksaangigi_12_52_tv' => $request->sblmperawatanpemeriksaangigi_12_52_tv,
                'sblmperawatanpemeriksaangigi_11_51_tv' => $request->sblmperawatanpemeriksaangigi_11_51_tv,
                'sblmperawatanpemeriksaangigi_21_61_tv' => $request->sblmperawatanpemeriksaangigi_21_61_tv,
                'sblmperawatanpemeriksaangigi_22_62_tv' => $request->sblmperawatanpemeriksaangigi_22_62_tv,
                'sblmperawatanpemeriksaangigi_23_63_tv' => $request->sblmperawatanpemeriksaangigi_23_63_tv,
                'sblmperawatanpemeriksaangigi_24_64_tv' => $request->sblmperawatanpemeriksaangigi_24_64_tv,
                'sblmperawatanpemeriksaangigi_25_65_tv' => $request->sblmperawatanpemeriksaangigi_25_65_tv,
                'sblmperawatanpemeriksaangigi_26_tv' => $request->sblmperawatanpemeriksaangigi_26_tv,
                'sblmperawatanpemeriksaangigi_27_tv' => $request->sblmperawatanpemeriksaangigi_27_tv,
                'sblmperawatanpemeriksaangigi_28_tv' => $request->sblmperawatanpemeriksaangigi_28_tv,
                'sblmperawatanpemeriksaangigi_18_diagnosis' => $request->sblmperawatanpemeriksaangigi_18_diagnosis,
                'sblmperawatanpemeriksaangigi_17_diagnosis' => $request->sblmperawatanpemeriksaangigi_17_diagnosis,
                'sblmperawatanpemeriksaangigi_16_diagnosis' => $request->sblmperawatanpemeriksaangigi_16_diagnosis,
                'sblmperawatanpemeriksaangigi_15_55_diagnosis' => $request->sblmperawatanpemeriksaangigi_15_55_diagnosis,
                'sblmperawatanpemeriksaangigi_14_54_diagnosis' => $request->sblmperawatanpemeriksaangigi_14_54_diagnosis,
                'sblmperawatanpemeriksaangigi_13_53_diagnosis' => $request->sblmperawatanpemeriksaangigi_13_53_diagnosis,
                'sblmperawatanpemeriksaangigi_12_52_diagnosis' => $request->sblmperawatanpemeriksaangigi_12_52_diagnosis,
                'sblmperawatanpemeriksaangigi_11_51_diagnosis' => $request->sblmperawatanpemeriksaangigi_11_51_diagnosis,
                'sblmperawatanpemeriksaangigi_21_61_diagnosis' => $request->sblmperawatanpemeriksaangigi_21_61_diagnosis,
                'sblmperawatanpemeriksaangigi_22_62_diagnosis' => $request->sblmperawatanpemeriksaangigi_22_62_diagnosis,
                'sblmperawatanpemeriksaangigi_23_63_diagnosis' => $request->sblmperawatanpemeriksaangigi_23_63_diagnosis,
                'sblmperawatanpemeriksaangigi_24_64_diagnosis' => $request->sblmperawatanpemeriksaangigi_24_64_diagnosis,
                'sblmperawatanpemeriksaangigi_25_65_diagnosis' => $request->sblmperawatanpemeriksaangigi_25_65_diagnosis,
                'sblmperawatanpemeriksaangigi_26_diagnosis' => $request->sblmperawatanpemeriksaangigi_26_diagnosis,
                'sblmperawatanpemeriksaangigi_27_diagnosis' => $request->sblmperawatanpemeriksaangigi_27_diagnosis,
                'sblmperawatanpemeriksaangigi_28_diagnosis' => $request->sblmperawatanpemeriksaangigi_28_diagnosis,
                'sblmperawatanpemeriksaangigi_18_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_18_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_17_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_17_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_16_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_16_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_15_55_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_15_55_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_14_54_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_14_54_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_13_53_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_13_53_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_12_52_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_12_52_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_11_51_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_11_51_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_21_61_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_21_61_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_22_62_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_22_62_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_23_63_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_23_63_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_24_64_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_24_64_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_25_65_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_25_65_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_26_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_26_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_27_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_27_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_28_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_28_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_41_81_tv' => $request->sblmperawatanpemeriksaangigi_41_81_tv,
                'sblmperawatanpemeriksaangigi_42_82_tv' => $request->sblmperawatanpemeriksaangigi_42_82_tv,
                'sblmperawatanpemeriksaangigi_43_83_tv' => $request->sblmperawatanpemeriksaangigi_43_83_tv,
                'sblmperawatanpemeriksaangigi_44_84_tv' => $request->sblmperawatanpemeriksaangigi_44_84_tv,
                'sblmperawatanpemeriksaangigi_45_85_tv' => $request->sblmperawatanpemeriksaangigi_45_85_tv,
                'sblmperawatanpemeriksaangigi_46_tv' => $request->sblmperawatanpemeriksaangigi_46_tv,
                'sblmperawatanpemeriksaangigi_47_tv' => $request->sblmperawatanpemeriksaangigi_47_tv,
                'sblmperawatanpemeriksaangigi_48_tv' => $request->sblmperawatanpemeriksaangigi_48_tv,
                'sblmperawatanpemeriksaangigi_38_tv' => $request->sblmperawatanpemeriksaangigi_38_tv,
                'sblmperawatanpemeriksaangigi_37_tv' => $request->sblmperawatanpemeriksaangigi_37_tv,
                'sblmperawatanpemeriksaangigi_36_tv' => $request->sblmperawatanpemeriksaangigi_36_tv,
                'sblmperawatanpemeriksaangigi_35_75_tv' => $request->sblmperawatanpemeriksaangigi_35_75_tv,
                'sblmperawatanpemeriksaangigi_34_74_tv' => $request->sblmperawatanpemeriksaangigi_34_74_tv,
                'sblmperawatanpemeriksaangigi_33_73_tv' => $request->sblmperawatanpemeriksaangigi_33_73_tv,
                'sblmperawatanpemeriksaangigi_32_72_tv' => $request->sblmperawatanpemeriksaangigi_32_72_tv,
                'sblmperawatanpemeriksaangigi_31_71_tv' => $request->sblmperawatanpemeriksaangigi_31_71_tv,
                'sblmperawatanpemeriksaangigi_41_81_diagnosis' => $request->sblmperawatanpemeriksaangigi_41_81_diagnosis,
                'sblmperawatanpemeriksaangigi_42_82_diagnosis' => $request->sblmperawatanpemeriksaangigi_42_82_diagnosis,
                'sblmperawatanpemeriksaangigi_43_83_diagnosis' => $request->sblmperawatanpemeriksaangigi_43_83_diagnosis,
                'sblmperawatanpemeriksaangigi_44_84_diagnosis' => $request->sblmperawatanpemeriksaangigi_44_84_diagnosis,
                'sblmperawatanpemeriksaangigi_45_85_diagnosis' => $request->sblmperawatanpemeriksaangigi_45_85_diagnosis,
                'sblmperawatanpemeriksaangigi_46_diagnosis' => $request->sblmperawatanpemeriksaangigi_46_diagnosis,
                'sblmperawatanpemeriksaangigi_47_diagnosis' => $request->sblmperawatanpemeriksaangigi_47_diagnosis,
                'sblmperawatanpemeriksaangigi_48_diagnosis' => $request->sblmperawatanpemeriksaangigi_48_diagnosis,
                'sblmperawatanpemeriksaangigi_38_diagnosis' => $request->sblmperawatanpemeriksaangigi_38_diagnosis,
                'sblmperawatanpemeriksaangigi_37_diagnosis' => $request->sblmperawatanpemeriksaangigi_37_diagnosis,
                'sblmperawatanpemeriksaangigi_36_diagnosis' => $request->sblmperawatanpemeriksaangigi_36_diagnosis,
                'sblmperawatanpemeriksaangigi_35_75_diagnosis' => $request->sblmperawatanpemeriksaangigi_35_75_diagnosis,
                'sblmperawatanpemeriksaangigi_34_74_diagnosis' => $request->sblmperawatanpemeriksaangigi_34_74_diagnosis,
                'sblmperawatanpemeriksaangigi_33_73_diagnosis' => $request->sblmperawatanpemeriksaangigi_33_73_diagnosis,
                'sblmperawatanpemeriksaangigi_32_72_diagnosis' => $request->sblmperawatanpemeriksaangigi_32_72_diagnosis,
                'sblmperawatanpemeriksaangigi_31_71_diagnosis' => $request->sblmperawatanpemeriksaangigi_31_71_diagnosis,
                'sblmperawatanpemeriksaangigi_41_81_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_41_81_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_42_82_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_42_82_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_43_83_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_43_83_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_44_84_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_44_84_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_45_85_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_45_85_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_46_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_46_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_47_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_47_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_48_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_48_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_38_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_38_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_37_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_37_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_36_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_36_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_35_75_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_35_75_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_34_74_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_34_74_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_33_73_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_33_73_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_32_72_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_32_72_rencanaperawatan,
                'sblmperawatanpemeriksaangigi_31_71_rencanaperawatan' => $request->sblmperawatanpemeriksaangigi_31_71_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_18_tv' => $request->ssdhperawatanpemeriksaangigi_18_tv,
                'ssdhperawatanpemeriksaangigi_17_tv' => $request->ssdhperawatanpemeriksaangigi_17_tv,
                'ssdhperawatanpemeriksaangigi_16_tv' => $request->ssdhperawatanpemeriksaangigi_16_tv,
                'ssdhperawatanpemeriksaangigi_15_55_tv' => $request->ssdhperawatanpemeriksaangigi_15_55_tv,
                'ssdhperawatanpemeriksaangigi_14_54_tv' => $request->ssdhperawatanpemeriksaangigi_14_54_tv,
                'ssdhperawatanpemeriksaangigi_13_53_tv' => $request->ssdhperawatanpemeriksaangigi_13_53_tv,
                'ssdhperawatanpemeriksaangigi_12_52_tv' => $request->ssdhperawatanpemeriksaangigi_12_52_tv,
                'ssdhperawatanpemeriksaangigi_11_51_tv' => $request->ssdhperawatanpemeriksaangigi_11_51_tv,
                'ssdhperawatanpemeriksaangigi_21_61_tv' => $request->ssdhperawatanpemeriksaangigi_21_61_tv,
                'ssdhperawatanpemeriksaangigi_22_62_tv' => $request->ssdhperawatanpemeriksaangigi_22_62_tv,
                'ssdhperawatanpemeriksaangigi_23_63_tv' => $request->ssdhperawatanpemeriksaangigi_23_63_tv,
                'ssdhperawatanpemeriksaangigi_24_64_tv' => $request->ssdhperawatanpemeriksaangigi_24_64_tv,
                'ssdhperawatanpemeriksaangigi_25_65_tv' => $request->ssdhperawatanpemeriksaangigi_25_65_tv,
                'ssdhperawatanpemeriksaangigi_26_tv' => $request->ssdhperawatanpemeriksaangigi_26_tv,
                'ssdhperawatanpemeriksaangigi_27_tv' => $request->ssdhperawatanpemeriksaangigi_27_tv,
                'ssdhperawatanpemeriksaangigi_28_tv' => $request->ssdhperawatanpemeriksaangigi_28_tv,
                'ssdhperawatanpemeriksaangigi_18_diagnosis' => $request->ssdhperawatanpemeriksaangigi_18_diagnosis,
                'ssdhperawatanpemeriksaangigi_17_diagnosis' => $request->ssdhperawatanpemeriksaangigi_17_diagnosis,
                'ssdhperawatanpemeriksaangigi_16_diagnosis' => $request->ssdhperawatanpemeriksaangigi_16_diagnosis,
                'ssdhperawatanpemeriksaangigi_15_55_diagnosis' => $request->ssdhperawatanpemeriksaangigi_15_55_diagnosis,
                'ssdhperawatanpemeriksaangigi_14_54_diagnosis' => $request->ssdhperawatanpemeriksaangigi_14_54_diagnosis,
                'ssdhperawatanpemeriksaangigi_13_53_diagnosis' => $request->ssdhperawatanpemeriksaangigi_13_53_diagnosis,
                'ssdhperawatanpemeriksaangigi_12_52_diagnosis' => $request->ssdhperawatanpemeriksaangigi_12_52_diagnosis,
                'ssdhperawatanpemeriksaangigi_11_51_diagnosis' => $request->ssdhperawatanpemeriksaangigi_11_51_diagnosis,
                'ssdhperawatanpemeriksaangigi_21_61_diagnosis' => $request->ssdhperawatanpemeriksaangigi_21_61_diagnosis,
                'ssdhperawatanpemeriksaangigi_22_62_diagnosis' => $request->ssdhperawatanpemeriksaangigi_22_62_diagnosis,
                'ssdhperawatanpemeriksaangigi_23_63_diagnosis' => $request->ssdhperawatanpemeriksaangigi_23_63_diagnosis,
                'ssdhperawatanpemeriksaangigi_24_64_diagnosis' => $request->ssdhperawatanpemeriksaangigi_24_64_diagnosis,
                'ssdhperawatanpemeriksaangigi_25_65_diagnosis' => $request->ssdhperawatanpemeriksaangigi_25_65_diagnosis,
                'ssdhperawatanpemeriksaangigi_26_diagnosis' => $request->ssdhperawatanpemeriksaangigi_26_diagnosis,
                'ssdhperawatanpemeriksaangigi_27_diagnosis' => $request->ssdhperawatanpemeriksaangigi_27_diagnosis,
                'ssdhperawatanpemeriksaangigi_28_diagnosis' => $request->ssdhperawatanpemeriksaangigi_28_diagnosis,
                'ssdhperawatanpemeriksaangigi_18_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_18_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_17_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_17_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_16_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_16_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_15_55_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_15_55_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_14_54_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_14_54_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_13_53_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_13_53_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_12_52_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_12_52_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_11_51_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_11_51_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_21_61_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_21_61_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_22_62_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_22_62_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_23_63_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_23_63_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_24_64_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_24_64_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_25_65_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_25_65_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_26_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_26_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_27_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_27_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_28_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_28_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_41_81_tv' => $request->ssdhperawatanpemeriksaangigi_41_81_tv,
                'ssdhperawatanpemeriksaangigi_42_82_tv' => $request->ssdhperawatanpemeriksaangigi_42_82_tv,
                'ssdhperawatanpemeriksaangigi_43_83_tv' => $request->ssdhperawatanpemeriksaangigi_43_83_tv,
                'ssdhperawatanpemeriksaangigi_44_84_tv' => $request->ssdhperawatanpemeriksaangigi_44_84_tv,
                'ssdhperawatanpemeriksaangigi_45_85_tv' => $request->ssdhperawatanpemeriksaangigi_45_85_tv,
                'ssdhperawatanpemeriksaangigi_46_tv' => $request->ssdhperawatanpemeriksaangigi_46_tv,
                'ssdhperawatanpemeriksaangigi_47_tv' => $request->ssdhperawatanpemeriksaangigi_47_tv,
                'ssdhperawatanpemeriksaangigi_48_tv' => $request->ssdhperawatanpemeriksaangigi_48_tv,
                'ssdhperawatanpemeriksaangigi_38_tv' => $request->ssdhperawatanpemeriksaangigi_38_tv,
                'ssdhperawatanpemeriksaangigi_37_tv' => $request->ssdhperawatanpemeriksaangigi_37_tv,
                'ssdhperawatanpemeriksaangigi_36_tv' => $request->ssdhperawatanpemeriksaangigi_36_tv,
                'ssdhperawatanpemeriksaangigi_35_75_tv' => $request->ssdhperawatanpemeriksaangigi_35_75_tv,
                'ssdhperawatanpemeriksaangigi_34_74_tv' => $request->ssdhperawatanpemeriksaangigi_34_74_tv,
                'ssdhperawatanpemeriksaangigi_33_73_tv' => $request->ssdhperawatanpemeriksaangigi_33_73_tv,
                'ssdhperawatanpemeriksaangigi_32_72_tv' => $request->ssdhperawatanpemeriksaangigi_32_72_tv,
                'ssdhperawatanpemeriksaangigi_31_71_tv' => $request->ssdhperawatanpemeriksaangigi_31_71_tv,
                'ssdhperawatanpemeriksaangigi_41_81_diagnosis' => $request->ssdhperawatanpemeriksaangigi_41_81_diagnosis,
                'ssdhperawatanpemeriksaangigi_42_82_diagnosis' => $request->ssdhperawatanpemeriksaangigi_42_82_diagnosis,
                'ssdhperawatanpemeriksaangigi_43_83_diagnosis' => $request->ssdhperawatanpemeriksaangigi_43_83_diagnosis,
                'ssdhperawatanpemeriksaangigi_44_84_diagnosis' => $request->ssdhperawatanpemeriksaangigi_44_84_diagnosis,
                'ssdhperawatanpemeriksaangigi_45_85_diagnosis' => $request->ssdhperawatanpemeriksaangigi_45_85_diagnosis,
                'ssdhperawatanpemeriksaangigi_46_diagnosis' => $request->ssdhperawatanpemeriksaangigi_46_diagnosis,
                'ssdhperawatanpemeriksaangigi_47_diagnosis' => $request->ssdhperawatanpemeriksaangigi_47_diagnosis,
                'ssdhperawatanpemeriksaangigi_48_diagnosis' => $request->ssdhperawatanpemeriksaangigi_48_diagnosis,
                'ssdhperawatanpemeriksaangigi_38_diagnosis' => $request->ssdhperawatanpemeriksaangigi_38_diagnosis,
                'ssdhperawatanpemeriksaangigi_37_diagnosis' => $request->ssdhperawatanpemeriksaangigi_37_diagnosis,
                'ssdhperawatanpemeriksaangigi_36_diagnosis' => $request->ssdhperawatanpemeriksaangigi_36_diagnosis,
                'ssdhperawatanpemeriksaangigi_35_75_diagnosis' => $request->ssdhperawatanpemeriksaangigi_35_75_diagnosis,
                'ssdhperawatanpemeriksaangigi_34_74_diagnosis' => $request->ssdhperawatanpemeriksaangigi_34_74_diagnosis,
                'ssdhperawatanpemeriksaangigi_33_73_diagnosis' => $request->ssdhperawatanpemeriksaangigi_33_73_diagnosis,
                'ssdhperawatanpemeriksaangigi_32_72_diagnosis' => $request->ssdhperawatanpemeriksaangigi_32_72_diagnosis,
                'ssdhperawatanpemeriksaangigi_31_71_diagnosis' => $request->ssdhperawatanpemeriksaangigi_31_71_diagnosis,
                'ssdhperawatanpemeriksaangigi_41_81_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_41_81_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_42_82_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_42_82_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_43_83_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_43_83_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_44_84_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_44_84_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_45_85_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_45_85_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_46_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_46_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_47_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_47_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_48_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_48_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_38_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_38_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_37_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_37_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_36_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_36_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_35_75_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_35_75_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_34_74_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_34_74_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_33_73_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_33_73_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_32_72_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_32_72_rencanaperawatan,
                'ssdhperawatanpemeriksaangigi_31_71_rencanaperawatan' => $request->ssdhperawatanpemeriksaangigi_31_71_rencanaperawatan,
                'sblmperawatanfaktorrisikokaries_sikap' => $request->sblmperawatanfaktorrisikokaries_sikap,
                'sblmperawatanfaktorrisikokaries_status' => $request->sblmperawatanfaktorrisikokaries_status,
                'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi' => $request->sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi,
                'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita' => $request->sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita,
                'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH' => $request->sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH,
                'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi' => $request->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi,
                'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata' => $request->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata,
                'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita' => $request->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita,
                'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_pH' => $request->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_pH,
                'sblmperawatanfaktorrisikokaries_plak_pH' => $request->sblmperawatanfaktorrisikokaries_plak_pH,
                'sblmperawatanfaktorrisikokaries_plak_aktivitas' => $request->sblmperawatanfaktorrisikokaries_plak_aktivitas,
                'sblmperawatanfaktorrisikokaries_fluor_pastagigi' => $request->sblmperawatanfaktorrisikokaries_fluor_pastagigi,
                'sblmperawatanfaktorrisikokaries_diet_gula' => $request->sblmperawatanfaktorrisikokaries_diet_gula,
                'sblmperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata' => $request->sblmperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata,
                'sblmperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb' => $request->sblmperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb,
                'sblmperawatanfaktorrisikokaries_faktormodifikasi_protesa' => $request->sblmperawatanfaktorrisikokaries_faktormodifikasi_protesa,
                'sblmperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif' => $request->sblmperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif,
                'sblmperawatanfaktorrisikokaries_faktormodifikasi_sikap' => $request->sblmperawatanfaktorrisikokaries_faktormodifikasi_sikap,
                'sblmperawatanfaktorrisikokaries_faktormodifikasi_keterangan' => $request->sblmperawatanfaktorrisikokaries_faktormodifikasi_keterangan,
                'sblmperawatanfaktorrisikokaries_penilaianakhir_saliva' => $request->sblmperawatanfaktorrisikokaries_penilaianakhir_saliva,
                'sblmperawatanfaktorrisikokaries_penilaianakhir_plak' => $request->sblmperawatanfaktorrisikokaries_penilaianakhir_plak,
                'sblmperawatanfaktorrisikokaries_penilaianakhir_diet' => $request->sblmperawatanfaktorrisikokaries_penilaianakhir_diet,
                'sblmperawatanfaktorrisikokaries_penilaianakhir_fluor' => $request->sblmperawatanfaktorrisikokaries_penilaianakhir_fluor,
                'sblmperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi' => $request->sblmperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi,
                'ssdhperawatanfaktorrisikokaries_sikap' => $request->ssdhperawatanfaktorrisikokaries_sikap,
                'ssdhperawatanfaktorrisikokaries_status' => $request->ssdhperawatanfaktorrisikokaries_status,
                'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi' => $request->ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi,
                'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita' => $request->ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita,
                'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH' => $request->ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH,
                'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi' => $request->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi,
                'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata' => $request->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata,
                'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita' => $request->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita,
                'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_pH' => $request->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_pH,
                'ssdhperawatanfaktorrisikokaries_plak_pH' => $request->ssdhperawatanfaktorrisikokaries_plak_pH,
                'ssdhperawatanfaktorrisikokaries_plak_aktivitas' => $request->ssdhperawatanfaktorrisikokaries_plak_aktivitas,
                'ssdhperawatanfaktorrisikokaries_fluor_pastagigi' => $request->ssdhperawatanfaktorrisikokaries_fluor_pastagigi,
                'ssdhperawatanfaktorrisikokaries_diet_gula' => $request->ssdhperawatanfaktorrisikokaries_diet_gula,
                'ssdhperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata' => $request->ssdhperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata,
                'ssdhperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb' => $request->ssdhperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb,
                'ssdhperawatanfaktorrisikokaries_faktormodifikasi_protesa' => $request->ssdhperawatanfaktorrisikokaries_faktormodifikasi_protesa,
                'ssdhperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif' => $request->ssdhperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif,
                'ssdhperawatanfaktorrisikokaries_faktormodifikasi_sikap' => $request->ssdhperawatanfaktorrisikokaries_faktormodifikasi_sikap,
                'ssdhperawatanfaktorrisikokaries_faktormodifikasi_keterangan' => $request->ssdhperawatanfaktorrisikokaries_faktormodifikasi_keterangan,
                'ssdhperawatanfaktorrisikokaries_penilaianakhir_saliva' => $request->ssdhperawatanfaktorrisikokaries_penilaianakhir_saliva,
                'ssdhperawatanfaktorrisikokaries_penilaianakhir_plak' => $request->ssdhperawatanfaktorrisikokaries_penilaianakhir_plak,
                'ssdhperawatanfaktorrisikokaries_penilaianakhir_diet' => $request->ssdhperawatanfaktorrisikokaries_penilaianakhir_diet,
                'ssdhperawatanfaktorrisikokaries_penilaianakhir_fluor' => $request->ssdhperawatanfaktorrisikokaries_penilaianakhir_fluor,
                'ssdhperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi' => $request->ssdhperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi,
                'sikatgigi2xsehari' => $request->sikatgigi2xsehari,
                'sikatgigi3xsehari' => $request->sikatgigi3xsehari,
                'flossingsetiaphari' => $request->flossingsetiaphari,
                'sikatinterdental' => $request->sikatinterdental,
                'agenantibakteri_obatkumur' => $request->agenantibakteri_obatkumur,
                'guladancemilandiantarawaktumakanutama' => $request->guladancemilandiantarawaktumakanutama,
                'minumanasamtinggi' => $request->minumanasamtinggi,
                'minumanberkafein' => $request->minumanberkafein,
                'meningkatkanasupanair' => $request->meningkatkanasupanair,
                'obatkumurbakingsoda' => $request->obatkumurbakingsoda,
                'konsumsimakananminumanberbahandasarsusu' => $request->konsumsimakananminumanberbahandasarsusu,
                'permenkaretxylitolccpacp' => $request->permenkaretxylitolccpacp,
                'pastagigi' => $request->pastagigi,
                'kumursetiaphari' => $request->kumursetiaphari,
                'kumursetiapminggu' => $request->kumursetiapminggu,
                'gelsetiaphari' => $request->gelsetiaphari,
                'gelsetiapminggu' => $request->gelsetiapminggu,
                'perlu' => $request->perlu,
                'tidakperlu' => $request->tidakperlu,
                'evaluasi_sikatgigi2xsehari' => $request->evaluasi_sikatgigi2xsehari,
                'evaluasi_sikatgigi3xsehari' => $request->evaluasi_sikatgigi3xsehari,
                'evaluasi_flossingsetiaphari' => $request->evaluasi_flossingsetiaphari,
                'evaluasi_sikatinterdental' => $request->evaluasi_sikatinterdental,
                'evaluasi_agenantibakteri_obatkumur' => $request->evaluasi_agenantibakteri_obatkumur,
                'evaluasi_guladancemilandiantarawaktumakanutama' => $request->evaluasi_guladancemilandiantarawaktumakanutama,
                'evaluasi_minumanasamtinggi' => $request->evaluasi_minumanasamtinggi,
                'evaluasi_minumanberkafein' => $request->evaluasi_minumanberkafein,
                'evaluasi_meningkatkanasupanair' => $request->evaluasi_meningkatkanasupanair,
                'evaluasi_obatkumurbakingsoda' => $request->evaluasi_obatkumurbakingsoda,
                'evaluasi_konsumsimakananminumanberbahandasarsusu' => $request->evaluasi_konsumsimakananminumanberbahandasarsusu,
                'evaluasi_permenkaretxylitolccpacp' => $request->evaluasi_permenkaretxylitolccpacp,
                'evaluasi_pastagigi' => $request->evaluasi_pastagigi,
                'evaluasi_kumursetiaphari' => $request->evaluasi_kumursetiaphari,
                'evaluasi_kumursetiapminggu' => $request->evaluasi_kumursetiapminggu,
                'evaluasi_gelsetiaphari' => $request->evaluasi_gelsetiaphari,
                'evaluasi_gelsetiapminggu' => $request->evaluasi_gelsetiapminggu,
                'evaluasi_perlu' => $request->evaluasi_perlu,
                'evaluasi_tidakperlu' => $request->evaluasi_tidakperlu,
                'sblmperawatanfaktorrisikokaries_fluor_airminum' => $request->sblmperawatanfaktorrisikokaries_fluor_airminum,
                'sblmperawatanfaktorrisikokaries_fluor_topikal' => $request->sblmperawatanfaktorrisikokaries_fluor_topikal,
                'sblmperawatanfaktorrisikokaries_diet_asam' => $request->sblmperawatanfaktorrisikokaries_diet_asam,
                'ssdhperawatanfaktorrisikokaries_fluor_airminum' => $request->ssdhperawatanfaktorrisikokaries_fluor_airminum,
                'ssdhperawatanfaktorrisikokaries_fluor_topikal' => $request->ssdhperawatanfaktorrisikokaries_fluor_topikal,
                'ssdhperawatanfaktorrisikokaries_diet_asam' => $request->ssdhperawatanfaktorrisikokaries_diet_asam

            ];
            $cekdata = $this->emrkonservasiRepository->findwaktuperawatan($request);

            if ($cekdata->count() < 1) {
                $execute = $this->emrkonservasiRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Konservasi Berhasil Dibuat !';
            } else {
                $execute = $this->emrkonservasiRepository->updatewaktuperawatan($request);
                $message = 'Assesment Konservasi Berhasil Diperbarui !';
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
    public function viewemrbyRegOperator(Request $request)
    {
        $request->validate([ 
            "noregister" => "required",            
            "nim" => "required"
   
        ]);
      
        try {    
            DB::beginTransaction();
            $cekdata = $this->emrkonservasiRepository->viewemrbyRegOperator($request);

            if($cekdata->count() < 1){

                $uuid = Uuid::uuid4();
                $data = [
                    'id' => $uuid,
                    'nim' => $request->nim,
                    "noregister" => $request->noregister,
                    "noepisode" => null,
                ];

                $this->emrkonservasiRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Konservasi Berhasil Dibuat !';

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

    //jobs
    public function createjob(Request $request)
    {
        // validate 
        $request->validate([  
            'tindakan' => "required", 
            'keadaangigi' => "required",  
            'keterangan' => "required",      
            'user_entry' => "required", 
            'user_entry_name' => "required",             
            'idemr' => "required",    
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'datejob' => Carbon::now(),
                'tindakan' => $request->tindakan, 
                'keadaangigi' => $request->keadaangigi,  
                'keterangan' => $request->keterangan,   
                'user_entry' => $request->user_entry, 
                'user_entry_name' => $request->user_entry_name, 
                'idemr' => $request->idemr  
            ];
            $execute = $this->emrkonservasiRepository->createjob($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Lembar Pekerjaan Berhasil dibuat !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function updatejob(Request $request)
    {
        // validate 
        $request->validate([  
            'tindakan' => "required", 
            'keadaangigi' => "required",  
            'keterangan' => "required",      
            'user_entry' => "required", 
            'user_entry_name' => "required",             
            'idemr' => "required",  
        ]);

        try {

            // Db Transaction
            DB::beginTransaction(); 
            
            $data = [
                'id' => $request->id,                
                'datejob' => Carbon::now(),
                'tindakan' => $request->tindakan, 
                'keadaangigi' => $request->keadaangigi,  
                'keterangan' => $request->keterangan,   
                'user_entry' => $request->user_entry, 
                'user_entry_name' => $request->user_entry_name, 
                'idemr' => $request->idemr  
            ];

            $cekdata = $this->emrkonservasiRepository->showbyidjob($request)->first();

            if($cekdata->count() < 1 ){
                return $this->sendError('Data job tidak ditemukan !', []);
            }
            $execute = $this->emrkonservasiRepository->updatejob($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'job Berhasil diedit !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function deletejob(Request $request)
    {
         // validate 
        $request->validate([  
            'id' => "required", 
            'active' => "required",    
        ]);

        try {

            // Db Transaction
            DB::beginTransaction(); 
            
            $data = [
                'id' => $request->id,     
                'active' => $request->active
            ];

            $cekdata = $this->emrkonservasiRepository->showbyidjob($request);

            if($cekdata->count() < 1 ){
                return $this->sendError('Data job tidak ditemukan !', []);
            }

            $execute = $this->emrkonservasiRepository->deletejob($data);
            DB::commit();
         
            if($execute){
                return $this->sendResponse($data, 'job Berhasil dihapus !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function showbyidjob(Request $request)
    {

        // validate 
        $request->validate([  
            'id' => "required"    
        ]);

            try {
                
                $cekdata = $this->emrkonservasiRepository->showbyidjob($request)->first();

                if($cekdata->count() < 1 ){
                    return $this->sendError('Data job tidak ditemukan !', []);
                }

                return $this->sendResponse($cekdata, 'job Berhasil ditemukan !');

            } catch (Exception $e) { 
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
                
    }

    public function showalljob(Request $request)
    {
             // validate 
            $request->validate([  
                'idemr' => "required"    
            ]);

            try {
                
                $cekdata = $this->emrkonservasiRepository->showalljob($request);

                if($cekdata->count() < 1 ){
                    return $this->sendError('Data job tidak ditemukan !', []);
                }

                return $this->sendResponse($cekdata, 'job Berhasil ditemukan !');

            } catch (Exception $e) { 
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
    }
    public function verifydpk(Request $request)
    {
        // validate 
        $request->validate([  
            'user_verify' => "required", 
            'user_verify_name' => "required",    
        ]);

        try {

            // Db Transaction
            DB::beginTransaction(); 
  

            $data = [
                'id' => $request->id,                
                'user_verify' => $request->user_verify, 
                'user_verify_name' => $request->user_verify_name,  
                'date_verify' => Carbon::now(),  
            ];

            $cekdata = $this->emrkonservasiRepository->showbyidjob($request)->first();

            if($cekdata->count() < 1 ){
                return $this->sendError('Data job tidak ditemukan !', []);
            }

            $execute = $this->emrkonservasiRepository->verifydpk($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'job Berhasil diverifikasi !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function uploadrestorasibefore(Request $request)
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
                $keyaws = 'emr/konservasi/reparasi/beofre/';
                $upload = $this->UploadtoAWS($new_name,$keyaws);
    
                $data = [
                    'id' => $request->id,
                    'select_file' => $upload
                ];
                $this->emrkonservasiRepository->uploadrestorasibefore($request,$upload);
                DB::commit();
    
                unlink(storage_path() . "/app/". $new_name);
                return $this->sendResponse($data, 'Foto Restorasi sebelum perawatan berhasil di upload !');
    
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
    }
    public function uploadrestorasiafter(Request $request)
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
                $keyaws = 'emr/konservasi/reparasi/beofre/';
                $upload = $this->UploadtoAWS($new_name,$keyaws);
    
                $data = [
                    'id' => $request->id,
                    'select_file' => $upload
                ];
                $this->emrkonservasiRepository->uploadrestorasiafter($request,$upload);
                DB::commit();
    
                unlink(storage_path() . "/app/". $new_name);
                return $this->sendResponse($data, 'Foto Restorasi sebelum perawatan berhasil di upload !');
    
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
    }
}