<?php

namespace App\Repositories;

use App\Models\emrkonservasi;
use App\Models\emrkonservasi_job;
use App\Models\hospital;
use App\Models\Year;
use App\Repositories\Interfaces\EmrKonservasiRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class EmrKonservasiRepository implements EmrKonservasiRepositoryInterface
{
    public function createwaktuperawatan($request, $uuid)
    {
        return  DB::table("emrkonservasis")->insert($request);
    }
    // public function createbehaviorrating($data)
    // {
    //     return  DB::table("emrpedodontie_behaviorratings")->insert($data);
    // }
    public function findwaktuperawatan($data)
    {
        return emrkonservasi::where('id', $data->id)->get();
    }
    public function viewemrbyRegOperator($data)
    {
        return emrkonservasi::where('nim', $data->nim)->where('noregister', $data->noregister)->get(); 
    }
    public function updatewaktuperawatan($data)
    {

        $updates = emrkonservasi::where('id', $data->id)->update([
            'noregister' => $data->noregister,
            'noepisode' => $data->noepisode,
            'nomorrekammedik' => $data->nomorrekammedik,
            'tanggal' => $data->tanggal,
            'namapasien' => $data->namapasien,
            'pekerjaan' => $data->pekerjaan,
            'jeniskelamin' => $data->jeniskelamin,
            'alamatpasien' => $data->alamatpasien,
            'nomortelpon' => $data->nomortelpon,
            'namaoperator' => $data->namaoperator,
            'nim' => $data->nim,
            'sblmperawatanpemeriksaangigi_18_tv' => $data->sblmperawatanpemeriksaangigi_18_tv,
            'sblmperawatanpemeriksaangigi_17_tv' => $data->sblmperawatanpemeriksaangigi_17_tv,
            'sblmperawatanpemeriksaangigi_16_tv' => $data->sblmperawatanpemeriksaangigi_16_tv,
            'sblmperawatanpemeriksaangigi_15_55_tv' => $data->sblmperawatanpemeriksaangigi_15_55_tv,
            'sblmperawatanpemeriksaangigi_14_54_tv' => $data->sblmperawatanpemeriksaangigi_14_54_tv,
            'sblmperawatanpemeriksaangigi_13_53_tv' => $data->sblmperawatanpemeriksaangigi_13_53_tv,
            'sblmperawatanpemeriksaangigi_12_52_tv' => $data->sblmperawatanpemeriksaangigi_12_52_tv,
            'sblmperawatanpemeriksaangigi_11_51_tv' => $data->sblmperawatanpemeriksaangigi_11_51_tv,
            'sblmperawatanpemeriksaangigi_21_61_tv' => $data->sblmperawatanpemeriksaangigi_21_61_tv,
            'sblmperawatanpemeriksaangigi_22_62_tv' => $data->sblmperawatanpemeriksaangigi_22_62_tv,
            'sblmperawatanpemeriksaangigi_23_63_tv' => $data->sblmperawatanpemeriksaangigi_23_63_tv,
            'sblmperawatanpemeriksaangigi_24_64_tv' => $data->sblmperawatanpemeriksaangigi_24_64_tv,
            'sblmperawatanpemeriksaangigi_25_65_tv' => $data->sblmperawatanpemeriksaangigi_25_65_tv,
            'sblmperawatanpemeriksaangigi_26_tv' => $data->sblmperawatanpemeriksaangigi_26_tv,
            'sblmperawatanpemeriksaangigi_27_tv' => $data->sblmperawatanpemeriksaangigi_27_tv,
            'sblmperawatanpemeriksaangigi_28_tv' => $data->sblmperawatanpemeriksaangigi_28_tv,
            'sblmperawatanpemeriksaangigi_18_diagnosis' => $data->sblmperawatanpemeriksaangigi_18_diagnosis,
            'sblmperawatanpemeriksaangigi_17_diagnosis' => $data->sblmperawatanpemeriksaangigi_17_diagnosis,
            'sblmperawatanpemeriksaangigi_16_diagnosis' => $data->sblmperawatanpemeriksaangigi_16_diagnosis,
            'sblmperawatanpemeriksaangigi_15_55_diagnosis' => $data->sblmperawatanpemeriksaangigi_15_55_diagnosis,
            'sblmperawatanpemeriksaangigi_14_54_diagnosis' => $data->sblmperawatanpemeriksaangigi_14_54_diagnosis,
            'sblmperawatanpemeriksaangigi_13_53_diagnosis' => $data->sblmperawatanpemeriksaangigi_13_53_diagnosis,
            'sblmperawatanpemeriksaangigi_12_52_diagnosis' => $data->sblmperawatanpemeriksaangigi_12_52_diagnosis,
            'sblmperawatanpemeriksaangigi_11_51_diagnosis' => $data->sblmperawatanpemeriksaangigi_11_51_diagnosis,
            'sblmperawatanpemeriksaangigi_21_61_diagnosis' => $data->sblmperawatanpemeriksaangigi_21_61_diagnosis,
            'sblmperawatanpemeriksaangigi_22_62_diagnosis' => $data->sblmperawatanpemeriksaangigi_22_62_diagnosis,
            'sblmperawatanpemeriksaangigi_23_63_diagnosis' => $data->sblmperawatanpemeriksaangigi_23_63_diagnosis,
            'sblmperawatanpemeriksaangigi_24_64_diagnosis' => $data->sblmperawatanpemeriksaangigi_24_64_diagnosis,
            'sblmperawatanpemeriksaangigi_25_65_diagnosis' => $data->sblmperawatanpemeriksaangigi_25_65_diagnosis,
            'sblmperawatanpemeriksaangigi_26_diagnosis' => $data->sblmperawatanpemeriksaangigi_26_diagnosis,
            'sblmperawatanpemeriksaangigi_27_diagnosis' => $data->sblmperawatanpemeriksaangigi_27_diagnosis,
            'sblmperawatanpemeriksaangigi_28_diagnosis' => $data->sblmperawatanpemeriksaangigi_28_diagnosis,
            'sblmperawatanpemeriksaangigi_18_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_18_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_17_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_17_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_16_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_16_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_15_55_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_15_55_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_14_54_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_14_54_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_13_53_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_13_53_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_12_52_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_12_52_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_11_51_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_11_51_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_21_61_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_21_61_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_22_62_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_22_62_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_23_63_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_23_63_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_24_64_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_24_64_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_25_65_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_25_65_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_26_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_26_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_27_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_27_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_28_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_28_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_41_81_tv' => $data->sblmperawatanpemeriksaangigi_41_81_tv,
            'sblmperawatanpemeriksaangigi_42_82_tv' => $data->sblmperawatanpemeriksaangigi_42_82_tv,
            'sblmperawatanpemeriksaangigi_43_83_tv' => $data->sblmperawatanpemeriksaangigi_43_83_tv,
            'sblmperawatanpemeriksaangigi_44_84_tv' => $data->sblmperawatanpemeriksaangigi_44_84_tv,
            'sblmperawatanpemeriksaangigi_45_85_tv' => $data->sblmperawatanpemeriksaangigi_45_85_tv,
            'sblmperawatanpemeriksaangigi_46_tv' => $data->sblmperawatanpemeriksaangigi_46_tv,
            'sblmperawatanpemeriksaangigi_47_tv' => $data->sblmperawatanpemeriksaangigi_47_tv,
            'sblmperawatanpemeriksaangigi_48_tv' => $data->sblmperawatanpemeriksaangigi_48_tv,
            'sblmperawatanpemeriksaangigi_38_tv' => $data->sblmperawatanpemeriksaangigi_38_tv,
            'sblmperawatanpemeriksaangigi_37_tv' => $data->sblmperawatanpemeriksaangigi_37_tv,
            'sblmperawatanpemeriksaangigi_36_tv' => $data->sblmperawatanpemeriksaangigi_36_tv,
            'sblmperawatanpemeriksaangigi_35_75_tv' => $data->sblmperawatanpemeriksaangigi_35_75_tv,
            'sblmperawatanpemeriksaangigi_34_74_tv' => $data->sblmperawatanpemeriksaangigi_34_74_tv,
            'sblmperawatanpemeriksaangigi_33_73_tv' => $data->sblmperawatanpemeriksaangigi_33_73_tv,
            'sblmperawatanpemeriksaangigi_32_72_tv' => $data->sblmperawatanpemeriksaangigi_32_72_tv,
            'sblmperawatanpemeriksaangigi_31_71_tv' => $data->sblmperawatanpemeriksaangigi_31_71_tv,
            'sblmperawatanpemeriksaangigi_41_81_diagnosis' => $data->sblmperawatanpemeriksaangigi_41_81_diagnosis,
            'sblmperawatanpemeriksaangigi_42_82_diagnosis' => $data->sblmperawatanpemeriksaangigi_42_82_diagnosis,
            'sblmperawatanpemeriksaangigi_43_83_diagnosis' => $data->sblmperawatanpemeriksaangigi_43_83_diagnosis,
            'sblmperawatanpemeriksaangigi_44_84_diagnosis' => $data->sblmperawatanpemeriksaangigi_44_84_diagnosis,
            'sblmperawatanpemeriksaangigi_45_85_diagnosis' => $data->sblmperawatanpemeriksaangigi_45_85_diagnosis,
            'sblmperawatanpemeriksaangigi_46_diagnosis' => $data->sblmperawatanpemeriksaangigi_46_diagnosis,
            'sblmperawatanpemeriksaangigi_47_diagnosis' => $data->sblmperawatanpemeriksaangigi_47_diagnosis,
            'sblmperawatanpemeriksaangigi_48_diagnosis' => $data->sblmperawatanpemeriksaangigi_48_diagnosis,
            'sblmperawatanpemeriksaangigi_38_diagnosis' => $data->sblmperawatanpemeriksaangigi_38_diagnosis,
            'sblmperawatanpemeriksaangigi_37_diagnosis' => $data->sblmperawatanpemeriksaangigi_37_diagnosis,
            'sblmperawatanpemeriksaangigi_36_diagnosis' => $data->sblmperawatanpemeriksaangigi_36_diagnosis,
            'sblmperawatanpemeriksaangigi_35_75_diagnosis' => $data->sblmperawatanpemeriksaangigi_35_75_diagnosis,
            'sblmperawatanpemeriksaangigi_34_74_diagnosis' => $data->sblmperawatanpemeriksaangigi_34_74_diagnosis,
            'sblmperawatanpemeriksaangigi_33_73_diagnosis' => $data->sblmperawatanpemeriksaangigi_33_73_diagnosis,
            'sblmperawatanpemeriksaangigi_32_72_diagnosis' => $data->sblmperawatanpemeriksaangigi_32_72_diagnosis,
            'sblmperawatanpemeriksaangigi_31_71_diagnosis' => $data->sblmperawatanpemeriksaangigi_31_71_diagnosis,
            'sblmperawatanpemeriksaangigi_41_81_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_41_81_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_42_82_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_42_82_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_43_83_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_43_83_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_44_84_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_44_84_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_45_85_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_45_85_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_46_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_46_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_47_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_47_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_48_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_48_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_38_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_38_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_37_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_37_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_36_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_36_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_35_75_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_35_75_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_34_74_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_34_74_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_33_73_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_33_73_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_32_72_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_32_72_rencanaperawatan,
            'sblmperawatanpemeriksaangigi_31_71_rencanaperawatan' => $data->sblmperawatanpemeriksaangigi_31_71_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_18_tv' => $data->ssdhperawatanpemeriksaangigi_18_tv,
            'ssdhperawatanpemeriksaangigi_17_tv' => $data->ssdhperawatanpemeriksaangigi_17_tv,
            'ssdhperawatanpemeriksaangigi_16_tv' => $data->ssdhperawatanpemeriksaangigi_16_tv,
            'ssdhperawatanpemeriksaangigi_15_55_tv' => $data->ssdhperawatanpemeriksaangigi_15_55_tv,
            'ssdhperawatanpemeriksaangigi_14_54_tv' => $data->ssdhperawatanpemeriksaangigi_14_54_tv,
            'ssdhperawatanpemeriksaangigi_13_53_tv' => $data->ssdhperawatanpemeriksaangigi_13_53_tv,
            'ssdhperawatanpemeriksaangigi_12_52_tv' => $data->ssdhperawatanpemeriksaangigi_12_52_tv,
            'ssdhperawatanpemeriksaangigi_11_51_tv' => $data->ssdhperawatanpemeriksaangigi_11_51_tv,
            'ssdhperawatanpemeriksaangigi_21_61_tv' => $data->ssdhperawatanpemeriksaangigi_21_61_tv,
            'ssdhperawatanpemeriksaangigi_22_62_tv' => $data->ssdhperawatanpemeriksaangigi_22_62_tv,
            'ssdhperawatanpemeriksaangigi_23_63_tv' => $data->ssdhperawatanpemeriksaangigi_23_63_tv,
            'ssdhperawatanpemeriksaangigi_24_64_tv' => $data->ssdhperawatanpemeriksaangigi_24_64_tv,
            'ssdhperawatanpemeriksaangigi_25_65_tv' => $data->ssdhperawatanpemeriksaangigi_25_65_tv,
            'ssdhperawatanpemeriksaangigi_26_tv' => $data->ssdhperawatanpemeriksaangigi_26_tv,
            'ssdhperawatanpemeriksaangigi_27_tv' => $data->ssdhperawatanpemeriksaangigi_27_tv,
            'ssdhperawatanpemeriksaangigi_28_tv' => $data->ssdhperawatanpemeriksaangigi_28_tv,
            'ssdhperawatanpemeriksaangigi_18_diagnosis' => $data->ssdhperawatanpemeriksaangigi_18_diagnosis,
            'ssdhperawatanpemeriksaangigi_17_diagnosis' => $data->ssdhperawatanpemeriksaangigi_17_diagnosis,
            'ssdhperawatanpemeriksaangigi_16_diagnosis' => $data->ssdhperawatanpemeriksaangigi_16_diagnosis,
            'ssdhperawatanpemeriksaangigi_15_55_diagnosis' => $data->ssdhperawatanpemeriksaangigi_15_55_diagnosis,
            'ssdhperawatanpemeriksaangigi_14_54_diagnosis' => $data->ssdhperawatanpemeriksaangigi_14_54_diagnosis,
            'ssdhperawatanpemeriksaangigi_13_53_diagnosis' => $data->ssdhperawatanpemeriksaangigi_13_53_diagnosis,
            'ssdhperawatanpemeriksaangigi_12_52_diagnosis' => $data->ssdhperawatanpemeriksaangigi_12_52_diagnosis,
            'ssdhperawatanpemeriksaangigi_11_51_diagnosis' => $data->ssdhperawatanpemeriksaangigi_11_51_diagnosis,
            'ssdhperawatanpemeriksaangigi_21_61_diagnosis' => $data->ssdhperawatanpemeriksaangigi_21_61_diagnosis,
            'ssdhperawatanpemeriksaangigi_22_62_diagnosis' => $data->ssdhperawatanpemeriksaangigi_22_62_diagnosis,
            'ssdhperawatanpemeriksaangigi_23_63_diagnosis' => $data->ssdhperawatanpemeriksaangigi_23_63_diagnosis,
            'ssdhperawatanpemeriksaangigi_24_64_diagnosis' => $data->ssdhperawatanpemeriksaangigi_24_64_diagnosis,
            'ssdhperawatanpemeriksaangigi_25_65_diagnosis' => $data->ssdhperawatanpemeriksaangigi_25_65_diagnosis,
            'ssdhperawatanpemeriksaangigi_26_diagnosis' => $data->ssdhperawatanpemeriksaangigi_26_diagnosis,
            'ssdhperawatanpemeriksaangigi_27_diagnosis' => $data->ssdhperawatanpemeriksaangigi_27_diagnosis,
            'ssdhperawatanpemeriksaangigi_28_diagnosis' => $data->ssdhperawatanpemeriksaangigi_28_diagnosis,
            'ssdhperawatanpemeriksaangigi_18_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_18_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_17_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_17_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_16_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_16_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_15_55_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_15_55_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_14_54_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_14_54_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_13_53_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_13_53_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_12_52_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_12_52_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_11_51_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_11_51_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_21_61_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_21_61_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_22_62_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_22_62_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_23_63_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_23_63_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_24_64_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_24_64_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_25_65_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_25_65_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_26_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_26_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_27_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_27_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_28_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_28_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_41_81_tv' => $data->ssdhperawatanpemeriksaangigi_41_81_tv,
            'ssdhperawatanpemeriksaangigi_42_82_tv' => $data->ssdhperawatanpemeriksaangigi_42_82_tv,
            'ssdhperawatanpemeriksaangigi_43_83_tv' => $data->ssdhperawatanpemeriksaangigi_43_83_tv,
            'ssdhperawatanpemeriksaangigi_44_84_tv' => $data->ssdhperawatanpemeriksaangigi_44_84_tv,
            'ssdhperawatanpemeriksaangigi_45_85_tv' => $data->ssdhperawatanpemeriksaangigi_45_85_tv,
            'ssdhperawatanpemeriksaangigi_46_tv' => $data->ssdhperawatanpemeriksaangigi_46_tv,
            'ssdhperawatanpemeriksaangigi_47_tv' => $data->ssdhperawatanpemeriksaangigi_47_tv,
            'ssdhperawatanpemeriksaangigi_48_tv' => $data->ssdhperawatanpemeriksaangigi_48_tv,
            'ssdhperawatanpemeriksaangigi_38_tv' => $data->ssdhperawatanpemeriksaangigi_38_tv,
            'ssdhperawatanpemeriksaangigi_37_tv' => $data->ssdhperawatanpemeriksaangigi_37_tv,
            'ssdhperawatanpemeriksaangigi_36_tv' => $data->ssdhperawatanpemeriksaangigi_36_tv,
            'ssdhperawatanpemeriksaangigi_35_75_tv' => $data->ssdhperawatanpemeriksaangigi_35_75_tv,
            'ssdhperawatanpemeriksaangigi_34_74_tv' => $data->ssdhperawatanpemeriksaangigi_34_74_tv,
            'ssdhperawatanpemeriksaangigi_33_73_tv' => $data->ssdhperawatanpemeriksaangigi_33_73_tv,
            'ssdhperawatanpemeriksaangigi_32_72_tv' => $data->ssdhperawatanpemeriksaangigi_32_72_tv,
            'ssdhperawatanpemeriksaangigi_31_71_tv' => $data->ssdhperawatanpemeriksaangigi_31_71_tv,
            'ssdhperawatanpemeriksaangigi_41_81_diagnosis' => $data->ssdhperawatanpemeriksaangigi_41_81_diagnosis,
            'ssdhperawatanpemeriksaangigi_42_82_diagnosis' => $data->ssdhperawatanpemeriksaangigi_42_82_diagnosis,
            'ssdhperawatanpemeriksaangigi_43_83_diagnosis' => $data->ssdhperawatanpemeriksaangigi_43_83_diagnosis,
            'ssdhperawatanpemeriksaangigi_44_84_diagnosis' => $data->ssdhperawatanpemeriksaangigi_44_84_diagnosis,
            'ssdhperawatanpemeriksaangigi_45_85_diagnosis' => $data->ssdhperawatanpemeriksaangigi_45_85_diagnosis,
            'ssdhperawatanpemeriksaangigi_46_diagnosis' => $data->ssdhperawatanpemeriksaangigi_46_diagnosis,
            'ssdhperawatanpemeriksaangigi_47_diagnosis' => $data->ssdhperawatanpemeriksaangigi_47_diagnosis,
            'ssdhperawatanpemeriksaangigi_48_diagnosis' => $data->ssdhperawatanpemeriksaangigi_48_diagnosis,
            'ssdhperawatanpemeriksaangigi_38_diagnosis' => $data->ssdhperawatanpemeriksaangigi_38_diagnosis,
            'ssdhperawatanpemeriksaangigi_37_diagnosis' => $data->ssdhperawatanpemeriksaangigi_37_diagnosis,
            'ssdhperawatanpemeriksaangigi_36_diagnosis' => $data->ssdhperawatanpemeriksaangigi_36_diagnosis,
            'ssdhperawatanpemeriksaangigi_35_75_diagnosis' => $data->ssdhperawatanpemeriksaangigi_35_75_diagnosis,
            'ssdhperawatanpemeriksaangigi_34_74_diagnosis' => $data->ssdhperawatanpemeriksaangigi_34_74_diagnosis,
            'ssdhperawatanpemeriksaangigi_33_73_diagnosis' => $data->ssdhperawatanpemeriksaangigi_33_73_diagnosis,
            'ssdhperawatanpemeriksaangigi_32_72_diagnosis' => $data->ssdhperawatanpemeriksaangigi_32_72_diagnosis,
            'ssdhperawatanpemeriksaangigi_31_71_diagnosis' => $data->ssdhperawatanpemeriksaangigi_31_71_diagnosis,
            'ssdhperawatanpemeriksaangigi_41_81_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_41_81_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_42_82_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_42_82_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_43_83_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_43_83_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_44_84_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_44_84_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_45_85_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_45_85_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_46_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_46_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_47_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_47_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_48_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_48_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_38_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_38_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_37_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_37_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_36_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_36_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_35_75_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_35_75_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_34_74_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_34_74_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_33_73_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_33_73_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_32_72_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_32_72_rencanaperawatan,
            'ssdhperawatanpemeriksaangigi_31_71_rencanaperawatan' => $data->ssdhperawatanpemeriksaangigi_31_71_rencanaperawatan,
            'sblmperawatanfaktorrisikokaries_sikap' => $data->sblmperawatanfaktorrisikokaries_sikap,
            'sblmperawatanfaktorrisikokaries_status' => $data->sblmperawatanfaktorrisikokaries_status,
            'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi' => $data->sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi,
            'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita' => $data->sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita,
            'sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH' => $data->sblmperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH,
            'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi' => $data->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi,
            'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata' => $data->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata,
            'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita' => $data->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita,
            'sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_pH' => $data->sblmperawatanfaktorrisikokaries_saliva_denganstimulasi_pH,
            'sblmperawatanfaktorrisikokaries_plak_pH' => $data->sblmperawatanfaktorrisikokaries_plak_pH,
            'sblmperawatanfaktorrisikokaries_plak_aktivitas' => $data->sblmperawatanfaktorrisikokaries_plak_aktivitas,
            'sblmperawatanfaktorrisikokaries_fluor' => $data->sblmperawatanfaktorrisikokaries_fluor,
            'sblmperawatanfaktorrisikokaries_diet' => $data->sblmperawatanfaktorrisikokaries_diet,
            'sblmperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata' => $data->sblmperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata,
            'sblmperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb' => $data->sblmperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb,
            'sblmperawatanfaktorrisikokaries_faktormodifikasi_protesa' => $data->sblmperawatanfaktorrisikokaries_faktormodifikasi_protesa,
            'sblmperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif' => $data->sblmperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif,
            'sblmperawatanfaktorrisikokaries_faktormodifikasi_sikap' => $data->sblmperawatanfaktorrisikokaries_faktormodifikasi_sikap,
            'sblmperawatanfaktorrisikokaries_faktormodifikasi_keterangan' => $data->sblmperawatanfaktorrisikokaries_faktormodifikasi_keterangan,
            'sblmperawatanfaktorrisikokaries_penilaianakhir_saliva' => $data->sblmperawatanfaktorrisikokaries_penilaianakhir_saliva,
            'sblmperawatanfaktorrisikokaries_penilaianakhir_plak' => $data->sblmperawatanfaktorrisikokaries_penilaianakhir_plak,
            'sblmperawatanfaktorrisikokaries_penilaianakhir_diet' => $data->sblmperawatanfaktorrisikokaries_penilaianakhir_diet,
            'sblmperawatanfaktorrisikokaries_penilaianakhir_fluor' => $data->sblmperawatanfaktorrisikokaries_penilaianakhir_fluor,
            'sblmperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi' => $data->sblmperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi,
            'ssdhperawatanfaktorrisikokaries_sikap' => $data->ssdhperawatanfaktorrisikokaries_sikap,
            'ssdhperawatanfaktorrisikokaries_status' => $data->ssdhperawatanfaktorrisikokaries_status,
            'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi' => $data->ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_hidrasi,
            'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita' => $data->ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_viskosita,
            'ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH' => $data->ssdhperawatanfaktorrisikokaries_saliva_tanpastimulasi_pH,
            'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi' => $data->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_hidrasi,
            'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata' => $data->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kecepata,
            'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita' => $data->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_kapasita,
            'ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_pH' => $data->ssdhperawatanfaktorrisikokaries_saliva_denganstimulasi_pH,
            'ssdhperawatanfaktorrisikokaries_plak_pH' => $data->ssdhperawatanfaktorrisikokaries_plak_pH,
            'ssdhperawatanfaktorrisikokaries_plak_aktivitas' => $data->ssdhperawatanfaktorrisikokaries_plak_aktivitas,
            'ssdhperawatanfaktorrisikokaries_fluor' => $data->ssdhperawatanfaktorrisikokaries_fluor,
            'ssdhperawatanfaktorrisikokaries_diet' => $data->ssdhperawatanfaktorrisikokaries_diet,
            'ssdhperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata' => $data->ssdhperawatanfaktorrisikokaries_faktormodifikasi_obatpeningkata,
            'ssdhperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb' => $data->ssdhperawatanfaktorrisikokaries_faktormodifikasi_penyakitpenyeb,
            'ssdhperawatanfaktorrisikokaries_faktormodifikasi_protesa' => $data->ssdhperawatanfaktorrisikokaries_faktormodifikasi_protesa,
            'ssdhperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif' => $data->ssdhperawatanfaktorrisikokaries_faktormodifikasi_kariesaktif,
            'ssdhperawatanfaktorrisikokaries_faktormodifikasi_sikap' => $data->ssdhperawatanfaktorrisikokaries_faktormodifikasi_sikap,
            'ssdhperawatanfaktorrisikokaries_faktormodifikasi_keterangan' => $data->ssdhperawatanfaktorrisikokaries_faktormodifikasi_keterangan,
            'ssdhperawatanfaktorrisikokaries_penilaianakhir_saliva' => $data->ssdhperawatanfaktorrisikokaries_penilaianakhir_saliva,
            'ssdhperawatanfaktorrisikokaries_penilaianakhir_plak' => $data->ssdhperawatanfaktorrisikokaries_penilaianakhir_plak,
            'ssdhperawatanfaktorrisikokaries_penilaianakhir_diet' => $data->ssdhperawatanfaktorrisikokaries_penilaianakhir_diet,
            'ssdhperawatanfaktorrisikokaries_penilaianakhir_fluor' => $data->ssdhperawatanfaktorrisikokaries_penilaianakhir_fluor,
            'ssdhperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi' => $data->ssdhperawatanfaktorrisikokaries_penilaianakhir_faktormodifikasi,
            'sikatgigi2xsehari' => $data->sikatgigi2xsehari,
            'sikatgigi3xsehari' => $data->sikatgigi3xsehari,
            'flossingsetiaphari' => $data->flossingsetiaphari,
            'sikatinterdental' => $data->sikatinterdental,
            'agenantibakteri_obatkumur' => $data->agenantibakteri_obatkumur,
            'guladancemilandiantarawaktumakanutama' => $data->guladancemilandiantarawaktumakanutama,
            'minumanasamtinggi' => $data->minumanasamtinggi,
            'minumanberkafein' => $data->minumanberkafein,
            'meningkatkanasupanair' => $data->meningkatkanasupanair,
            'obatkumurbakingsoda' => $data->obatkumurbakingsoda,
            'konsumsimakananminumanberbahandasarsusu' => $data->konsumsimakananminumanberbahandasarsusu,
            'permenkaretxylitolccpacp' => $data->permenkaretxylitolccpacp,
            'pastagigi' => $data->pastagigi,
            'kumursetiaphari' => $data->kumursetiaphari,
            'kumursetiapminggu' => $data->kumursetiapminggu,
            'gelsetiaphari' => $data->gelsetiaphari,
            'gelsetiapminggu' => $data->gelsetiapminggu,
            'perlu' => $data->perlu,
            'tidakperlu' => $data->tidakperlu,
            'evaluasi_sikatgigi2xsehari' => $data->evaluasi_sikatgigi2xsehari,
            'evaluasi_sikatgigi3xsehari' => $data->evaluasi_sikatgigi3xsehari,
            'evaluasi_flossingsetiaphari' => $data->evaluasi_flossingsetiaphari,
            'evaluasi_sikatinterdental' => $data->evaluasi_sikatinterdental,
            'evaluasi_agenantibakteri_obatkumur' => $data->evaluasi_agenantibakteri_obatkumur,
            'evaluasi_guladancemilandiantarawaktumakanutama' => $data->evaluasi_guladancemilandiantarawaktumakanutama,
            'evaluasi_minumanasamtinggi' => $data->evaluasi_minumanasamtinggi,
            'evaluasi_minumanberkafein' => $data->evaluasi_minumanberkafein,
            'evaluasi_meningkatkanasupanair' => $data->evaluasi_meningkatkanasupanair,
            'evaluasi_obatkumurbakingsoda' => $data->evaluasi_obatkumurbakingsoda,
            'evaluasi_konsumsimakananminumanberbahandasarsusu' => $data->evaluasi_konsumsimakananminumanberbahandasarsusu,
            'evaluasi_permenkaretxylitolccpacp' => $data->evaluasi_permenkaretxylitolccpacp,
            'evaluasi_pastagigi' => $data->evaluasi_pastagigi,
            'evaluasi_kumursetiaphari' => $data->evaluasi_kumursetiaphari,
            'evaluasi_kumursetiapminggu' => $data->evaluasi_kumursetiapminggu,
            'evaluasi_gelsetiaphari' => $data->evaluasi_gelsetiaphari,
            'evaluasi_gelsetiapminggu' => $data->evaluasi_gelsetiapminggu,
            'evaluasi_perlu' => $data->evaluasi_perlu,
            'evaluasi_tidakperlu' => $data->evaluasi_tidakperlu,

        ]);
        return $updates;;
    }

    //konservasi
    public function createjob($data)
    { 
        return  emrkonservasi_job::insert($data);
    }
    public function updatejob($data)
    { 

     
        $updates = emrkonservasi_job::where('id', $data['id'])->update([ 
            'tindakan' => $data['tindakan'],
            'keadaangigi' => $data['keadaangigi'], 
            'keterangan' => $data['keterangan'],   
        ]);
        return $updates;
    }
    public function verifydpk($data)
    { 
        $updates = emrkonservasi_job::where('id', $data['id'])->update([ 
            'user_verify' => $data['user_verify'],
            'user_verify_name' => $data['user_verify_name'], 
            'date_verify' => $data['date_verify'],    
        ]);
        return $updates;
    }
    public function deletejob($data)
    { 
        $updates = emrkonservasi_job::where('id', $data['id'])->update([ 
            'active' => $data['active'], 
        ]);
        return $updates;
  
    }
    public function showbyidjob($data)
    { 
        return emrkonservasi_job::where('id',$data->id)->where('active','1')->get();
    }
    public function showalljob($data)
    { 
        return emrkonservasi_job::where('idemr',$data->idemr)->where('active','1')->orderBy('id', 'DESC')->latest()->paginate(10);
    }
    public function uploadrestorasibefore($data,$awsurl)
    { 
        $updates = emrkonservasi::where('id', $data->id)->update([ 
            'uploadrestorasibefore' => $awsurl 
        ]);
        return $updates;
    }
    public function uploadrestorasiafter($data,$awsurl)
    { 
        $updates = emrkonservasi::where('id', $data->id)->update([ 
            'uploadrestorasiafter' => $awsurl 
        ]);
        return $updates;
    }
}