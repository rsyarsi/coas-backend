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
use App\Repositories\Interfaces\EmrPeriodontieRepositoryInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface;

class EmrPeriodontieService extends Controller
{
    use AwsTrait;
    private $emrperiodontieRepository;

    public function __construct(
        EmrPeriodontieRepositoryInterface $emrperiodontieRepository,
        PatientRepositoryInterface $patientRepository
        )
    {
        $this->emrperiodontieRepository = $emrperiodontieRepository;
        $this->patientRepository = $patientRepository;
    }
    public function createwaktuperawatan(Request $request)
    {
        // validate 
        $request->validate([
            "noregister" => "required",
            "noepisode" => "required",
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'npm' => $request->npm,
                'tahun_klinik' => $request->tahun_klinik,
                'opsi_imagemahasiswa' => $request->opsi_imagemahasiswa,
                'noregister' => $request->noregister,
                'noepisode' => $request->noepisode,
                'no_rekammedik' => $request->no_rekammedik,
                'kasus_pasien' => $request->kasus_pasien,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'pendidikan_pasien' => $request->pendidikan_pasien,
                'nama_pasien' => $request->nama_pasien,
                'umur_pasien' => $request->umur_pasien,
                'jenis_kelamin_pasien' => $request->jenis_kelamin_pasien,
                'no_telephone_pasien' => $request->no_telephone_pasien,
                'pemeriksa' => $request->pemeriksa,
                'operator1' => $request->operator1,
                'operator2' => $request->operator2,
                'operator3' => $request->operator3,
                'operator4' => $request->operator4,
                'konsuldari' => $request->konsuldari,
                'keluhanutama' => $request->keluhanutama,
                'anamnesis' => $request->anamnesis,
                'gusi_mudah_berdarah' => $request->gusi_mudah_berdarah,
                'gusi_mudah_berdarah_lainlain' => $request->gusi_mudah_berdarah_lainlain,
                'penyakit_sistemik' => $request->penyakit_sistemik,
                'penyakit_sistemik_bilaada' => $request->penyakit_sistemik_bilaada,
                'penyakit_sistemik_obat' => $request->penyakit_sistemik_obat,
                'diabetes_melitus' => $request->diabetes_melitus,
                'diabetes_melituskadargula' => $request->diabetes_melituskadargula,
                'merokok' => $request->merokok,
                'merokok_perhari' => $request->merokok_perhari,
                'merokok_tahun_awal' => $request->merokok_tahun_awal,
                'merokok_tahun_akhir' => $request->merokok_tahun_akhir,
                'gigi_pernah_tanggal_dalam_keadaan_baik' => $request->gigi_pernah_tanggal_dalam_keadaan_baik,
                'keadaan_umum' => $request->keadaan_umum,
                'tekanan_darah' => $request->tekanan_darah,
                'extra_oral' => $request->extra_oral,
                'intra_oral' => $request->intra_oral,
                'oral_hygiene_bop' => $request->oral_hygiene_bop,
                'oral_hygiene_ci' => $request->oral_hygiene_ci,
                'oral_hygiene_pi' => $request->oral_hygiene_pi,
                'oral_hygiene_ohis' => $request->oral_hygiene_ohis,
                'kesimpulan_ohis' => $request->kesimpulan_ohis,
                'rakn_keaadan_gingiva' => $request->rakn_keaadan_gingiva,
                'rakn_karang_gigi' => $request->rakn_karang_gigi,
                'rakn_oklusi' => $request->rakn_oklusi,
                'rakn_artikulasi' => $request->rakn_artikulasi,
                'rakn_abrasi_atrisi_abfraksi' => $request->rakn_abrasi_atrisi_abfraksi,
                'ram_keaadan_gingiva' => $request->ram_keaadan_gingiva,
                'ram_karang_gigi' => $request->ram_karang_gigi,
                'ram_oklusi' => $request->ram_oklusi,
                'ram_artikulasi' => $request->ram_artikulasi,
                'ram_abrasi_atrisi_abfraksi' => $request->ram_abrasi_atrisi_abfraksi,
                'rakr_keaadan_gingiva' => $request->rakr_keaadan_gingiva,
                'rakr_karang_gigi' => $request->rakr_karang_gigi,
                'rakr_oklusi' => $request->rakr_oklusi,
                'rakr_artikulasi' => $request->rakr_artikulasi,
                'rakr_abrasi_atrisi_abfraksi' => $request->rakr_abrasi_atrisi_abfraksi,
                'rbkn_keaadan_gingiva' => $request->rbkn_keaadan_gingiva,
                'rbkn_karang_gigi' => $request->rbkn_karang_gigi,
                'rbkn_oklusi' => $request->rbkn_oklusi,
                'rbkn_artikulasi' => $request->rbkn_artikulasi,
                'rbkn_abrasi_atrisi_abfraksi' => $request->rbkn_abrasi_atrisi_abfraksi,
                'rbm_keaadan_gingiva' => $request->rbm_keaadan_gingiva,
                'rbm_karang_gigi' => $request->rbm_karang_gigi,
                'rbm_oklusi' => $request->rbm_oklusi,
                'rbm_artikulasi' => $request->rbm_artikulasi,
                'rbm_abrasi_atrisi_abfraksi' => $request->rbm_abrasi_atrisi_abfraksi,
                'rbkr_keaadan_gingiva' => $request->rbkr_keaadan_gingiva,
                'rbkr_karang_gigi' => $request->rbkr_karang_gigi,
                'rbkr_oklusi' => $request->rbkr_oklusi,
                'rbkr_artikulasi' => $request->rbkr_artikulasi,
                'rbkr_abrasi_atrisi_abfraksi' => $request->rbkr_abrasi_atrisi_abfraksi,
                'rakn_1_v' => $request->rakn_1_v,
                'rakn_1_g' => $request->rakn_1_g,
                'rakn_1_pm' => $request->rakn_1_pm,
                'rakn_1_pb' => $request->rakn_1_pb,
                'rakn_1_pd' => $request->rakn_1_pd,
                'rakn_1_o' => $request->rakn_1_o,
                'rakn_1_r' => $request->rakn_1_r,
                'rakn_1_la' => $request->rakn_1_la,
                'rakn_1_mp' => $request->rakn_1_mp,
                'rakn_1_bop' => $request->rakn_1_bop,
                'rakn_1_tk' => $request->rakn_1_tk,
                'rakn_1_fi' => $request->rakn_1_fi,
                'rakn_1_k' => $request->rakn_1_k,
                'rakn_1_t' => $request->rakn_1_t,
                'rakn_2_v' => $request->rakn_2_v,
                'rakn_2_g' => $request->rakn_2_g,
                'rakn_2_pm' => $request->rakn_2_pm,
                'rakn_2_pb' => $request->rakn_2_pb,
                'rakn_2_pd' => $request->rakn_2_pd,
                'rakn_2_o' => $request->rakn_2_o,
                'rakn_2_r' => $request->rakn_2_r,
                'rakn_2_la' => $request->rakn_2_la,
                'rakn_2_mp' => $request->rakn_2_mp,
                'rakn_2_bop' => $request->rakn_2_bop,
                'rakn_2_tk' => $request->rakn_2_tk,
                'rakn_2_fi' => $request->rakn_2_fi,
                'rakn_2_k' => $request->rakn_2_k,
                'rakn_2_t' => $request->rakn_2_t,
                'rakn_3_v' => $request->rakn_3_v,
                'rakn_3_g' => $request->rakn_3_g,
                'rakn_3_pm' => $request->rakn_3_pm,
                'rakn_3_pb' => $request->rakn_3_pb,
                'rakn_3_pd' => $request->rakn_3_pd,
                'rakn_3_o' => $request->rakn_3_o,
                'rakn_3_r' => $request->rakn_3_r,
                'rakn_3_la' => $request->rakn_3_la,
                'rakn_3_mp' => $request->rakn_3_mp,
                'rakn_3_bop' => $request->rakn_3_bop,
                'rakn_3_tk' => $request->rakn_3_tk,
                'rakn_3_fi' => $request->rakn_3_fi,
                'rakn_3_k' => $request->rakn_3_k,
                'rakn_3_t' => $request->rakn_3_t,
                'rakn_4_v' => $request->rakn_4_v,
                'rakn_4_g' => $request->rakn_4_g,
                'rakn_4_pm' => $request->rakn_4_pm,
                'rakn_4_pb' => $request->rakn_4_pb,
                'rakn_4_pd' => $request->rakn_4_pd,
                'rakn_4_o' => $request->rakn_4_o,
                'rakn_4_r' => $request->rakn_4_r,
                'rakn_4_la' => $request->rakn_4_la,
                'rakn_4_mp' => $request->rakn_4_mp,
                'rakn_4_bop' => $request->rakn_4_bop,
                'rakn_4_tk' => $request->rakn_4_tk,
                'rakn_4_fi' => $request->rakn_4_fi,
                'rakn_4_k' => $request->rakn_4_k,
                'rakn_4_t' => $request->rakn_4_t,
                'rakn_5_v' => $request->rakn_5_v,
                'rakn_5_g' => $request->rakn_5_g,
                'rakn_5_pm' => $request->rakn_5_pm,
                'rakn_5_pb' => $request->rakn_5_pb,
                'rakn_5_pd' => $request->rakn_5_pd,
                'rakn_5_o' => $request->rakn_5_o,
                'rakn_5_r' => $request->rakn_5_r,
                'rakn_5_la' => $request->rakn_5_la,
                'rakn_5_mp' => $request->rakn_5_mp,
                'rakn_5_bop' => $request->rakn_5_bop,
                'rakn_5_tk' => $request->rakn_5_tk,
                'rakn_5_fi' => $request->rakn_5_fi,
                'rakn_5_k' => $request->rakn_5_k,
                'rakn_5_t' => $request->rakn_5_t,
                'rakn_6_v' => $request->rakn_6_v,
                'rakn_6_g' => $request->rakn_6_g,
                'rakn_6_pm' => $request->rakn_6_pm,
                'rakn_6_pb' => $request->rakn_6_pb,
                'rakn_6_pd' => $request->rakn_6_pd,
                'rakn_6_o' => $request->rakn_6_o,
                'rakn_6_r' => $request->rakn_6_r,
                'rakn_6_la' => $request->rakn_6_la,
                'rakn_6_mp' => $request->rakn_6_mp,
                'rakn_6_bop' => $request->rakn_6_bop,
                'rakn_6_tk' => $request->rakn_6_tk,
                'rakn_6_fi' => $request->rakn_6_fi,
                'rakn_6_k' => $request->rakn_6_k,
                'rakn_6_t' => $request->rakn_6_t,
                'rakn_7_v' => $request->rakn_7_v,
                'rakn_7_g' => $request->rakn_7_g,
                'rakn_7_pm' => $request->rakn_7_pm,
                'rakn_7_pb' => $request->rakn_7_pb,
                'rakn_7_pd' => $request->rakn_7_pd,
                'rakn_7_o' => $request->rakn_7_o,
                'rakn_7_r' => $request->rakn_7_r,
                'rakn_7_la' => $request->rakn_7_la,
                'rakn_7_mp' => $request->rakn_7_mp,
                'rakn_7_bop' => $request->rakn_7_bop,
                'rakn_7_tk' => $request->rakn_7_tk,
                'rakn_7_fi' => $request->rakn_7_fi,
                'rakn_7_k' => $request->rakn_7_k,
                'rakn_7_t' => $request->rakn_7_t,
                'rakn_8_v' => $request->rakn_8_v,
                'rakn_8_g' => $request->rakn_8_g,
                'rakn_8_pm' => $request->rakn_8_pm,
                'rakn_8_pb' => $request->rakn_8_pb,
                'rakn_8_pd' => $request->rakn_8_pd,
                'rakn_8_o' => $request->rakn_8_o,
                'rakn_8_r' => $request->rakn_8_r,
                'rakn_8_la' => $request->rakn_8_la,
                'rakn_8_mp' => $request->rakn_8_mp,
                'rakn_8_bop' => $request->rakn_8_bop,
                'rakn_8_tk' => $request->rakn_8_tk,
                'rakn_8_fi' => $request->rakn_8_fi,
                'rakn_8_k' => $request->rakn_8_k,
                'rakn_8_t' => $request->rakn_8_t,
                'rakr_1_v' => $request->rakr_1_v,
                'rakr_1_g' => $request->rakr_1_g,
                'rakr_1_pm' => $request->rakr_1_pm,
                'rakr_1_pb' => $request->rakr_1_pb,
                'rakr_1_pd' => $request->rakr_1_pd,
                'rakr_1_o' => $request->rakr_1_o,
                'rakr_1_r' => $request->rakr_1_r,
                'rakr_1_la' => $request->rakr_1_la,
                'rakr_1_mp' => $request->rakr_1_mp,
                'rakr_1_bop' => $request->rakr_1_bop,
                'rakr_1_tk' => $request->rakr_1_tk,
                'rakr_1_fi' => $request->rakr_1_fi,
                'rakr_1_k' => $request->rakr_1_k,
                'rakr_1_t' => $request->rakr_1_t,
                'rakr_2_v' => $request->rakr_2_v,
                'rakr_2_g' => $request->rakr_2_g,
                'rakr_2_pm' => $request->rakr_2_pm,
                'rakr_2_pb' => $request->rakr_2_pb,
                'rakr_2_pd' => $request->rakr_2_pd,
                'rakr_2_o' => $request->rakr_2_o,
                'rakr_2_r' => $request->rakr_2_r,
                'rakr_2_la' => $request->rakr_2_la,
                'rakr_2_mp' => $request->rakr_2_mp,
                'rakr_2_bop' => $request->rakr_2_bop,
                'rakr_2_tk' => $request->rakr_2_tk,
                'rakr_2_fi' => $request->rakr_2_fi,
                'rakr_2_k' => $request->rakr_2_k,
                'rakr_2_t' => $request->rakr_2_t,
                'rakr_3_v' => $request->rakr_3_v,
                'rakr_3_g' => $request->rakr_3_g,
                'rakr_3_pm' => $request->rakr_3_pm,
                'rakr_3_pb' => $request->rakr_3_pb,
                'rakr_3_pd' => $request->rakr_3_pd,
                'rakr_3_o' => $request->rakr_3_o,
                'rakr_3_r' => $request->rakr_3_r,
                'rakr_3_la' => $request->rakr_3_la,
                'rakr_3_mp' => $request->rakr_3_mp,
                'rakr_3_bop' => $request->rakr_3_bop,
                'rakr_3_tk' => $request->rakr_3_tk,
                'rakr_3_fi' => $request->rakr_3_fi,
                'rakr_3_k' => $request->rakr_3_k,
                'rakr_3_t' => $request->rakr_3_t,
                'rakr_4_v' => $request->rakr_4_v,
                'rakr_4_g' => $request->rakr_4_g,
                'rakr_4_pm' => $request->rakr_4_pm,
                'rakr_4_pb' => $request->rakr_4_pb,
                'rakr_4_pd' => $request->rakr_4_pd,
                'rakr_4_o' => $request->rakr_4_o,
                'rakr_4_r' => $request->rakr_4_r,
                'rakr_4_la' => $request->rakr_4_la,
                'rakr_4_mp' => $request->rakr_4_mp,
                'rakr_4_bop' => $request->rakr_4_bop,
                'rakr_4_tk' => $request->rakr_4_tk,
                'rakr_4_fi' => $request->rakr_4_fi,
                'rakr_4_k' => $request->rakr_4_k,
                'rakr_4_t' => $request->rakr_4_t,
                'rakr_5_v' => $request->rakr_5_v,
                'rakr_5_g' => $request->rakr_5_g,
                'rakr_5_pm' => $request->rakr_5_pm,
                'rakr_5_pb' => $request->rakr_5_pb,
                'rakr_5_pd' => $request->rakr_5_pd,
                'rakr_5_o' => $request->rakr_5_o,
                'rakr_5_r' => $request->rakr_5_r,
                'rakr_5_la' => $request->rakr_5_la,
                'rakr_5_mp' => $request->rakr_5_mp,
                'rakr_5_bop' => $request->rakr_5_bop,
                'rakr_5_tk' => $request->rakr_5_tk,
                'rakr_5_fi' => $request->rakr_5_fi,
                'rakr_5_k' => $request->rakr_5_k,
                'rakr_5_t' => $request->rakr_5_t,
                'rakr_6_v' => $request->rakr_6_v,
                'rakr_6_g' => $request->rakr_6_g,
                'rakr_6_pm' => $request->rakr_6_pm,
                'rakr_6_pb' => $request->rakr_6_pb,
                'rakr_6_pd' => $request->rakr_6_pd,
                'rakr_6_o' => $request->rakr_6_o,
                'rakr_6_r' => $request->rakr_6_r,
                'rakr_6_la' => $request->rakr_6_la,
                'rakr_6_mp' => $request->rakr_6_mp,
                'rakr_6_bop' => $request->rakr_6_bop,
                'rakr_6_tk' => $request->rakr_6_tk,
                'rakr_6_fi' => $request->rakr_6_fi,
                'rakr_6_k' => $request->rakr_6_k,
                'rakr_6_t' => $request->rakr_6_t,
                'rakr_7_v' => $request->rakr_7_v,
                'rakr_7_g' => $request->rakr_7_g,
                'rakr_7_pm' => $request->rakr_7_pm,
                'rakr_7_pb' => $request->rakr_7_pb,
                'rakr_7_pd' => $request->rakr_7_pd,
                'rakr_7_o' => $request->rakr_7_o,
                'rakr_7_r' => $request->rakr_7_r,
                'rakr_7_la' => $request->rakr_7_la,
                'rakr_7_mp' => $request->rakr_7_mp,
                'rakr_7_bop' => $request->rakr_7_bop,
                'rakr_7_tk' => $request->rakr_7_tk,
                'rakr_7_fi' => $request->rakr_7_fi,
                'rakr_7_k' => $request->rakr_7_k,
                'rakr_7_t' => $request->rakr_7_t,
                'rakr_8_v' => $request->rakr_8_v,
                'rakr_8_g' => $request->rakr_8_g,
                'rakr_8_pm' => $request->rakr_8_pm,
                'rakr_8_pb' => $request->rakr_8_pb,
                'rakr_8_pd' => $request->rakr_8_pd,
                'rakr_8_o' => $request->rakr_8_o,
                'rakr_8_r' => $request->rakr_8_r,
                'rakr_8_la' => $request->rakr_8_la,
                'rakr_8_mp' => $request->rakr_8_mp,
                'rakr_8_bop' => $request->rakr_8_bop,
                'rakr_8_tk' => $request->rakr_8_tk,
                'rakr_8_fi' => $request->rakr_8_fi,
                'rakr_8_k' => $request->rakr_8_k,
                'rakr_8_t' => $request->rakr_8_t,
                'rbkn_1_v' => $request->rbkn_1_v,
                'rbkn_1_g' => $request->rbkn_1_g,
                'rbkn_1_pm' => $request->rbkn_1_pm,
                'rbkn_1_pb' => $request->rbkn_1_pb,
                'rbkn_1_pd' => $request->rbkn_1_pd,
                'rbkn_1_o' => $request->rbkn_1_o,
                'rbkn_1_r' => $request->rbkn_1_r,
                'rbkn_1_la' => $request->rbkn_1_la,
                'rbkn_1_mp' => $request->rbkn_1_mp,
                'rbkn_1_bop' => $request->rbkn_1_bop,
                'rbkn_1_tk' => $request->rbkn_1_tk,
                'rbkn_1_fi' => $request->rbkn_1_fi,
                'rbkn_1_k' => $request->rbkn_1_k,
                'rbkn_1_t' => $request->rbkn_1_t,
                'rbkn_2_v' => $request->rbkn_2_v,
                'rbkn_2_g' => $request->rbkn_2_g,
                'rbkn_2_pm' => $request->rbkn_2_pm,
                'rbkn_2_pb' => $request->rbkn_2_pb,
                'rbkn_2_pd' => $request->rbkn_2_pd,
                'rbkn_2_o' => $request->rbkn_2_o,
                'rbkn_2_r' => $request->rbkn_2_r,
                'rbkn_2_la' => $request->rbkn_2_la,
                'rbkn_2_mp' => $request->rbkn_2_mp,
                'rbkn_2_bop' => $request->rbkn_2_bop,
                'rbkn_2_tk' => $request->rbkn_2_tk,
                'rbkn_2_fi' => $request->rbkn_2_fi,
                'rbkn_2_k' => $request->rbkn_2_k,
                'rbkn_2_t' => $request->rbkn_2_t,
                'rbkn_3_v' => $request->rbkn_3_v,
                'rbkn_3_g' => $request->rbkn_3_g,
                'rbkn_3_pm' => $request->rbkn_3_pm,
                'rbkn_3_pb' => $request->rbkn_3_pb,
                'rbkn_3_pd' => $request->rbkn_3_pd,
                'rbkn_3_o' => $request->rbkn_3_o,
                'rbkn_3_r' => $request->rbkn_3_r,
                'rbkn_3_la' => $request->rbkn_3_la,
                'rbkn_3_mp' => $request->rbkn_3_mp,
                'rbkn_3_bop' => $request->rbkn_3_bop,
                'rbkn_3_tk' => $request->rbkn_3_tk,
                'rbkn_3_fi' => $request->rbkn_3_fi,
                'rbkn_3_k' => $request->rbkn_3_k,
                'rbkn_3_t' => $request->rbkn_3_t,
                'rbkn_4_v' => $request->rbkn_4_v,
                'rbkn_4_g' => $request->rbkn_4_g,
                'rbkn_4_pm' => $request->rbkn_4_pm,
                'rbkn_4_pb' => $request->rbkn_4_pb,
                'rbkn_4_pd' => $request->rbkn_4_pd,
                'rbkn_4_o' => $request->rbkn_4_o,
                'rbkn_4_r' => $request->rbkn_4_r,
                'rbkn_4_la' => $request->rbkn_4_la,
                'rbkn_4_mp' => $request->rbkn_4_mp,
                'rbkn_4_bop' => $request->rbkn_4_bop,
                'rbkn_4_tk' => $request->rbkn_4_tk,
                'rbkn_4_fi' => $request->rbkn_4_fi,
                'rbkn_4_k' => $request->rbkn_4_k,
                'rbkn_4_t' => $request->rbkn_4_t,
                'rbkn_5_v' => $request->rbkn_5_v,
                'rbkn_5_g' => $request->rbkn_5_g,
                'rbkn_5_pm' => $request->rbkn_5_pm,
                'rbkn_5_pb' => $request->rbkn_5_pb,
                'rbkn_5_pd' => $request->rbkn_5_pd,
                'rbkn_5_o' => $request->rbkn_5_o,
                'rbkn_5_r' => $request->rbkn_5_r,
                'rbkn_5_la' => $request->rbkn_5_la,
                'rbkn_5_mp' => $request->rbkn_5_mp,
                'rbkn_5_bop' => $request->rbkn_5_bop,
                'rbkn_5_tk' => $request->rbkn_5_tk,
                'rbkn_5_fi' => $request->rbkn_5_fi,
                'rbkn_5_k' => $request->rbkn_5_k,
                'rbkn_5_t' => $request->rbkn_5_t,
                'rbkn_6_v' => $request->rbkn_6_v,
                'rbkn_6_g' => $request->rbkn_6_g,
                'rbkn_6_pm' => $request->rbkn_6_pm,
                'rbkn_6_pb' => $request->rbkn_6_pb,
                'rbkn_6_pd' => $request->rbkn_6_pd,
                'rbkn_6_o' => $request->rbkn_6_o,
                'rbkn_6_r' => $request->rbkn_6_r,
                'rbkn_6_la' => $request->rbkn_6_la,
                'rbkn_6_mp' => $request->rbkn_6_mp,
                'rbkn_6_bop' => $request->rbkn_6_bop,
                'rbkn_6_tk' => $request->rbkn_6_tk,
                'rbkn_6_fi' => $request->rbkn_6_fi,
                'rbkn_6_k' => $request->rbkn_6_k,
                'rbkn_6_t' => $request->rbkn_6_t,
                'rbkn_7_v' => $request->rbkn_7_v,
                'rbkn_7_g' => $request->rbkn_7_g,
                'rbkn_7_pm' => $request->rbkn_7_pm,
                'rbkn_7_pb' => $request->rbkn_7_pb,
                'rbkn_7_pd' => $request->rbkn_7_pd,
                'rbkn_7_o' => $request->rbkn_7_o,
                'rbkn_7_r' => $request->rbkn_7_r,
                'rbkn_7_la' => $request->rbkn_7_la,
                'rbkn_7_mp' => $request->rbkn_7_mp,
                'rbkn_7_bop' => $request->rbkn_7_bop,
                'rbkn_7_tk' => $request->rbkn_7_tk,
                'rbkn_7_fi' => $request->rbkn_7_fi,
                'rbkn_7_k' => $request->rbkn_7_k,
                'rbkn_7_t' => $request->rbkn_7_t,
                'rbkn_8_v' => $request->rbkn_8_v,
                'rbkn_8_g' => $request->rbkn_8_g,
                'rbkn_8_pm' => $request->rbkn_8_pm,
                'rbkn_8_pb' => $request->rbkn_8_pb,
                'rbkn_8_pd' => $request->rbkn_8_pd,
                'rbkn_8_o' => $request->rbkn_8_o,
                'rbkn_8_r' => $request->rbkn_8_r,
                'rbkn_8_la' => $request->rbkn_8_la,
                'rbkn_8_mp' => $request->rbkn_8_mp,
                'rbkn_8_bop' => $request->rbkn_8_bop,
                'rbkn_8_tk' => $request->rbkn_8_tk,
                'rbkn_8_fi' => $request->rbkn_8_fi,
                'rbkn_8_k' => $request->rbkn_8_k,
                'rbkn_8_t' => $request->rbkn_8_t,
                'rbkr_1_v' => $request->rbkr_1_v,
                'rbkr_1_g' => $request->rbkr_1_g,
                'rbkr_1_pm' => $request->rbkr_1_pm,
                'rbkr_1_pb' => $request->rbkr_1_pb,
                'rbkr_1_pd' => $request->rbkr_1_pd,
                'rbkr_1_o' => $request->rbkr_1_o,
                'rbkr_1_r' => $request->rbkr_1_r,
                'rbkr_1_la' => $request->rbkr_1_la,
                'rbkr_1_mp' => $request->rbkr_1_mp,
                'rbkr_1_bop' => $request->rbkr_1_bop,
                'rbkr_1_tk' => $request->rbkr_1_tk,
                'rbkr_1_fi' => $request->rbkr_1_fi,
                'rbkr_1_k' => $request->rbkr_1_k,
                'rbkr_1_t' => $request->rbkr_1_t,
                'rbkr_2_v' => $request->rbkr_2_v,
                'rbkr_2_g' => $request->rbkr_2_g,
                'rbkr_2_pm' => $request->rbkr_2_pm,
                'rbkr_2_pb' => $request->rbkr_2_pb,
                'rbkr_2_pd' => $request->rbkr_2_pd,
                'rbkr_2_o' => $request->rbkr_2_o,
                'rbkr_2_r' => $request->rbkr_2_r,
                'rbkr_2_la' => $request->rbkr_2_la,
                'rbkr_2_mp' => $request->rbkr_2_mp,
                'rbkr_2_bop' => $request->rbkr_2_bop,
                'rbkr_2_tk' => $request->rbkr_2_tk,
                'rbkr_2_fi' => $request->rbkr_2_fi,
                'rbkr_2_k' => $request->rbkr_2_k,
                'rbkr_2_t' => $request->rbkr_2_t,
                'rbkr_3_v' => $request->rbkr_3_v,
                'rbkr_3_g' => $request->rbkr_3_g,
                'rbkr_3_pm' => $request->rbkr_3_pm,
                'rbkr_3_pb' => $request->rbkr_3_pb,
                'rbkr_3_pd' => $request->rbkr_3_pd,
                'rbkr_3_o' => $request->rbkr_3_o,
                'rbkr_3_r' => $request->rbkr_3_r,
                'rbkr_3_la' => $request->rbkr_3_la,
                'rbkr_3_mp' => $request->rbkr_3_mp,
                'rbkr_3_bop' => $request->rbkr_3_bop,
                'rbkr_3_tk' => $request->rbkr_3_tk,
                'rbkr_3_fi' => $request->rbkr_3_fi,
                'rbkr_3_k' => $request->rbkr_3_k,
                'rbkr_3_t' => $request->rbkr_3_t,
                'rbkr_4_v' => $request->rbkr_4_v,
                'rbkr_4_g' => $request->rbkr_4_g,
                'rbkr_4_pm' => $request->rbkr_4_pm,
                'rbkr_4_pb' => $request->rbkr_4_pb,
                'rbkr_4_pd' => $request->rbkr_4_pd,
                'rbkr_4_o' => $request->rbkr_4_o,
                'rbkr_4_r' => $request->rbkr_4_r,
                'rbkr_4_la' => $request->rbkr_4_la,
                'rbkr_4_mp' => $request->rbkr_4_mp,
                'rbkr_4_bop' => $request->rbkr_4_bop,
                'rbkr_4_tk' => $request->rbkr_4_tk,
                'rbkr_4_fi' => $request->rbkr_4_fi,
                'rbkr_4_k' => $request->rbkr_4_k,
                'rbkr_4_t' => $request->rbkr_4_t,
                'rbkr_5_v' => $request->rbkr_5_v,
                'rbkr_5_g' => $request->rbkr_5_g,
                'rbkr_5_pm' => $request->rbkr_5_pm,
                'rbkr_5_pb' => $request->rbkr_5_pb,
                'rbkr_5_pd' => $request->rbkr_5_pd,
                'rbkr_5_o' => $request->rbkr_5_o,
                'rbkr_5_r' => $request->rbkr_5_r,
                'rbkr_5_la' => $request->rbkr_5_la,
                'rbkr_5_mp' => $request->rbkr_5_mp,
                'rbkr_5_bop' => $request->rbkr_5_bop,
                'rbkr_5_tk' => $request->rbkr_5_tk,
                'rbkr_5_fi' => $request->rbkr_5_fi,
                'rbkr_5_k' => $request->rbkr_5_k,
                'rbkr_5_t' => $request->rbkr_5_t,
                'rbkr_6_v' => $request->rbkr_6_v,
                'rbkr_6_g' => $request->rbkr_6_g,
                'rbkr_6_pm' => $request->rbkr_6_pm,
                'rbkr_6_pb' => $request->rbkr_6_pb,
                'rbkr_6_pd' => $request->rbkr_6_pd,
                'rbkr_6_o' => $request->rbkr_6_o,
                'rbkr_6_r' => $request->rbkr_6_r,
                'rbkr_6_la' => $request->rbkr_6_la,
                'rbkr_6_mp' => $request->rbkr_6_mp,
                'rbkr_6_bop' => $request->rbkr_6_bop,
                'rbkr_6_tk' => $request->rbkr_6_tk,
                'rbkr_6_fi' => $request->rbkr_6_fi,
                'rbkr_6_k' => $request->rbkr_6_k,
                'rbkr_6_t' => $request->rbkr_6_t,
                'rbkr_7_v' => $request->rbkr_7_v,
                'rbkr_7_g' => $request->rbkr_7_g,
                'rbkr_7_pm' => $request->rbkr_7_pm,
                'rbkr_7_pb' => $request->rbkr_7_pb,
                'rbkr_7_pd' => $request->rbkr_7_pd,
                'rbkr_7_o' => $request->rbkr_7_o,
                'rbkr_7_r' => $request->rbkr_7_r,
                'rbkr_7_la' => $request->rbkr_7_la,
                'rbkr_7_mp' => $request->rbkr_7_mp,
                'rbkr_7_bop' => $request->rbkr_7_bop,
                'rbkr_7_tk' => $request->rbkr_7_tk,
                'rbkr_7_fi' => $request->rbkr_7_fi,
                'rbkr_7_k' => $request->rbkr_7_k,
                'rbkr_7_t' => $request->rbkr_7_t,
                'rbkr_8_v' => $request->rbkr_8_v,
                'rbkr_8_g' => $request->rbkr_8_g,
                'rbkr_8_pm' => $request->rbkr_8_pm,
                'rbkr_8_pb' => $request->rbkr_8_pb,
                'rbkr_8_pd' => $request->rbkr_8_pd,
                'rbkr_8_o' => $request->rbkr_8_o,
                'rbkr_8_r' => $request->rbkr_8_r,
                'rbkr_8_la' => $request->rbkr_8_la,
                'rbkr_8_mp' => $request->rbkr_8_mp,
                'rbkr_8_bop' => $request->rbkr_8_bop,
                'rbkr_8_tk' => $request->rbkr_8_tk,
                'rbkr_8_fi' => $request->rbkr_8_fi,
                'rbkr_8_k' => $request->rbkr_8_k,
                'rbkr_8_t' => $request->rbkr_8_t,
                'diagnosis_klinik' => $request->diagnosis_klinik,
                'gambaran_radiografis' => $request->gambaran_radiografis,
                'indikasi' => $request->indikasi,
                'terapi' => $request->terapi,
                'keterangan' => $request->keterangan,
                'prognosis_umum' => $request->prognosis_umum,
                'prognosis_lokal' => $request->prognosis_lokal,
                'p1_tanggal' => $request->p1_tanggal,
                'p1_indeksplak_ra_el16_b' => $request->p1_indeksplak_ra_el16_b,
                'p1_indeksplak_ra_el12_b' => $request->p1_indeksplak_ra_el12_b,
                'p1_indeksplak_ra_el11_b' => $request->p1_indeksplak_ra_el11_b,
                'p1_indeksplak_ra_el21_b' => $request->p1_indeksplak_ra_el21_b,
                'p1_indeksplak_ra_el22_b' => $request->p1_indeksplak_ra_el22_b,
                'p1_indeksplak_ra_el24_b' => $request->p1_indeksplak_ra_el24_b,
                'p1_indeksplak_ra_el26_b' => $request->p1_indeksplak_ra_el26_b,
                'p1_indeksplak_ra_el16_l' => $request->p1_indeksplak_ra_el16_l,
                'p1_indeksplak_ra_el12_l' => $request->p1_indeksplak_ra_el12_l,
                'p1_indeksplak_ra_el11_l' => $request->p1_indeksplak_ra_el11_l,
                'p1_indeksplak_ra_el21_l' => $request->p1_indeksplak_ra_el21_l,
                'p1_indeksplak_ra_el22_l' => $request->p1_indeksplak_ra_el22_l,
                'p1_indeksplak_ra_el24_l' => $request->p1_indeksplak_ra_el24_l,
                'p1_indeksplak_ra_el26_l' => $request->p1_indeksplak_ra_el26_l,
                'p1_indeksplak_rb_el36_b' => $request->p1_indeksplak_rb_el36_b,
                'p1_indeksplak_rb_el34_b' => $request->p1_indeksplak_rb_el34_b,
                'p1_indeksplak_rb_el32_b' => $request->p1_indeksplak_rb_el32_b,
                'p1_indeksplak_rb_el31_b' => $request->p1_indeksplak_rb_el31_b,
                'p1_indeksplak_rb_el41_b' => $request->p1_indeksplak_rb_el41_b,
                'p1_indeksplak_rb_el42_b' => $request->p1_indeksplak_rb_el42_b,
                'p1_indeksplak_rb_el46_b' => $request->p1_indeksplak_rb_el46_b,
                'p1_indeksplak_rb_el36_l' => $request->p1_indeksplak_rb_el36_l,
                'p1_indeksplak_rb_el34_l' => $request->p1_indeksplak_rb_el34_l,
                'p1_indeksplak_rb_el32_l' => $request->p1_indeksplak_rb_el32_l,
                'p1_indeksplak_rb_el31_l' => $request->p1_indeksplak_rb_el31_l,
                'p1_indeksplak_rb_el41_l' => $request->p1_indeksplak_rb_el41_l,
                'p1_indeksplak_rb_el42_l' => $request->p1_indeksplak_rb_el42_l,
                'p1_indeksplak_rb_el46_l' => $request->p1_indeksplak_rb_el46_l,
                'p1_bop_ra_el16_b' => $request->p1_bop_ra_el16_b,
                'p1_bop_ra_el12_b' => $request->p1_bop_ra_el12_b,
                'p1_bop_ra_el11_b' => $request->p1_bop_ra_el11_b,
                'p1_bop_ra_el21_b' => $request->p1_bop_ra_el21_b,
                'p1_bop_ra_el22_b' => $request->p1_bop_ra_el22_b,
                'p1_bop_ra_el24_b' => $request->p1_bop_ra_el24_b,
                'p1_bop_ra_el26_b' => $request->p1_bop_ra_el26_b,
                'p1_bop_ra_el16_l' => $request->p1_bop_ra_el16_l,
                'p1_bop_ra_el12_l' => $request->p1_bop_ra_el12_l,
                'p1_bop_ra_el11_l' => $request->p1_bop_ra_el11_l,
                'p1_bop_ra_el21_l' => $request->p1_bop_ra_el21_l,
                'p1_bop_ra_el22_l' => $request->p1_bop_ra_el22_l,
                'p1_bop_ra_el24_l' => $request->p1_bop_ra_el24_l,
                'p1_bop_ra_el26_l' => $request->p1_bop_ra_el26_l,
                'p1_bop_rb_el36_b' => $request->p1_bop_rb_el36_b,
                'p1_bop_rb_el34_b' => $request->p1_bop_rb_el34_b,
                'p1_bop_rb_el32_b' => $request->p1_bop_rb_el32_b,
                'p1_bop_rb_el31_b' => $request->p1_bop_rb_el31_b,
                'p1_bop_rb_el41_b' => $request->p1_bop_rb_el41_b,
                'p1_bop_rb_el42_b' => $request->p1_bop_rb_el42_b,
                'p1_bop_rb_el46_b' => $request->p1_bop_rb_el46_b,
                'p1_bop_rb_el36_l' => $request->p1_bop_rb_el36_l,
                'p1_bop_rb_el34_l' => $request->p1_bop_rb_el34_l,
                'p1_bop_rb_el32_l' => $request->p1_bop_rb_el32_l,
                'p1_bop_rb_el31_l' => $request->p1_bop_rb_el31_l,
                'p1_bop_rb_el41_l' => $request->p1_bop_rb_el41_l,
                'p1_bop_rb_el42_l' => $request->p1_bop_rb_el42_l,
                'p1_bop_rb_el46_l' => $request->p1_bop_rb_el46_l,
                'p1_indekskalkulus_ra_el16_b' => $request->p1_indekskalkulus_ra_el16_b,
                'p1_indekskalkulus_ra_el26_b' => $request->p1_indekskalkulus_ra_el26_b,
                'p1_indekskalkulus_ra_el16_l' => $request->p1_indekskalkulus_ra_el16_l,
                'p1_indekskalkulus_ra_el26_l' => $request->p1_indekskalkulus_ra_el26_l,
                'p1_indekskalkulus_rb_el36_b' => $request->p1_indekskalkulus_rb_el36_b,
                'p1_indekskalkulus_rb_el34_b' => $request->p1_indekskalkulus_rb_el34_b,
                'p1_indekskalkulus_rb_el32_b' => $request->p1_indekskalkulus_rb_el32_b,
                'p1_indekskalkulus_rb_el31_b' => $request->p1_indekskalkulus_rb_el31_b,
                'p1_indekskalkulus_rb_el41_b' => $request->p1_indekskalkulus_rb_el41_b,
                'p1_indekskalkulus_rb_el42_b' => $request->p1_indekskalkulus_rb_el42_b,
                'p1_indekskalkulus_rb_el46_b' => $request->p1_indekskalkulus_rb_el46_b,
                'p1_indekskalkulus_rb_el36_l' => $request->p1_indekskalkulus_rb_el36_l,
                'p1_indekskalkulus_rb_el34_l' => $request->p1_indekskalkulus_rb_el34_l,
                'p1_indekskalkulus_rb_el32_l' => $request->p1_indekskalkulus_rb_el32_l,
                'p1_indekskalkulus_rb_el31_l' => $request->p1_indekskalkulus_rb_el31_l,
                'p1_indekskalkulus_rb_el41_l' => $request->p1_indekskalkulus_rb_el41_l,
                'p1_indekskalkulus_rb_el42_l' => $request->p1_indekskalkulus_rb_el42_l,
                'p1_indekskalkulus_rb_el46_l' => $request->p1_indekskalkulus_rb_el46_l,
                'p2_tanggal' => $request->p2_tanggal,
                'p2_indeksplak_ra_el16_b' => $request->p2_indeksplak_ra_el16_b,
                'p2_indeksplak_ra_el12_b' => $request->p2_indeksplak_ra_el12_b,
                'p2_indeksplak_ra_el11_b' => $request->p2_indeksplak_ra_el11_b,
                'p2_indeksplak_ra_el21_b' => $request->p2_indeksplak_ra_el21_b,
                'p2_indeksplak_ra_el22_b' => $request->p2_indeksplak_ra_el22_b,
                'p2_indeksplak_ra_el24_b' => $request->p2_indeksplak_ra_el24_b,
                'p2_indeksplak_ra_el26_b' => $request->p2_indeksplak_ra_el26_b,
                'p2_indeksplak_ra_el16_l' => $request->p2_indeksplak_ra_el16_l,
                'p2_indeksplak_ra_el12_l' => $request->p2_indeksplak_ra_el12_l,
                'p2_indeksplak_ra_el11_l' => $request->p2_indeksplak_ra_el11_l,
                'p2_indeksplak_ra_el21_l' => $request->p2_indeksplak_ra_el21_l,
                'p2_indeksplak_ra_el22_l' => $request->p2_indeksplak_ra_el22_l,
                'p2_indeksplak_ra_el24_l' => $request->p2_indeksplak_ra_el24_l,
                'p2_indeksplak_ra_el26_l' => $request->p2_indeksplak_ra_el26_l,
                'p2_indeksplak_rb_el36_b' => $request->p2_indeksplak_rb_el36_b,
                'p2_indeksplak_rb_el34_b' => $request->p2_indeksplak_rb_el34_b,
                'p2_indeksplak_rb_el32_b' => $request->p2_indeksplak_rb_el32_b,
                'p2_indeksplak_rb_el31_b' => $request->p2_indeksplak_rb_el31_b,
                'p2_indeksplak_rb_el41_b' => $request->p2_indeksplak_rb_el41_b,
                'p2_indeksplak_rb_el42_b' => $request->p2_indeksplak_rb_el42_b,
                'p2_indeksplak_rb_el46_b' => $request->p2_indeksplak_rb_el46_b,
                'p2_indeksplak_rb_el36_l' => $request->p2_indeksplak_rb_el36_l,
                'p2_indeksplak_rb_el34_l' => $request->p2_indeksplak_rb_el34_l,
                'p2_indeksplak_rb_el32_l' => $request->p2_indeksplak_rb_el32_l,
                'p2_indeksplak_rb_el31_l' => $request->p2_indeksplak_rb_el31_l,
                'p2_indeksplak_rb_el41_l' => $request->p2_indeksplak_rb_el41_l,
                'p2_indeksplak_rb_el42_l' => $request->p2_indeksplak_rb_el42_l,
                'p2_indeksplak_rb_el46_l' => $request->p2_indeksplak_rb_el46_l,
                'p2_bop_ra_el16_b' => $request->p2_bop_ra_el16_b,
                'p2_bop_ra_el12_b' => $request->p2_bop_ra_el12_b,
                'p2_bop_ra_el11_b' => $request->p2_bop_ra_el11_b,
                'p2_bop_ra_el21_b' => $request->p2_bop_ra_el21_b,
                'p2_bop_ra_el22_b' => $request->p2_bop_ra_el22_b,
                'p2_bop_ra_el24_b' => $request->p2_bop_ra_el24_b,
                'p2_bop_ra_el26_b' => $request->p2_bop_ra_el26_b,
                'p2_bop_ra_el16_l' => $request->p2_bop_ra_el16_l,
                'p2_bop_ra_el12_l' => $request->p2_bop_ra_el12_l,
                'p2_bop_ra_el11_l' => $request->p2_bop_ra_el11_l,
                'p2_bop_ra_el21_l' => $request->p2_bop_ra_el21_l,
                'p2_bop_ra_el22_l' => $request->p2_bop_ra_el22_l,
                'p2_bop_ra_el24_l' => $request->p2_bop_ra_el24_l,
                'p2_bop_ra_el26_l' => $request->p2_bop_ra_el26_l,
                'p2_bop_rb_el36_b' => $request->p2_bop_rb_el36_b,
                'p2_bop_rb_el34_b' => $request->p2_bop_rb_el34_b,
                'p2_bop_rb_el32_b' => $request->p2_bop_rb_el32_b,
                'p2_bop_rb_el31_b' => $request->p2_bop_rb_el31_b,
                'p2_bop_rb_el41_b' => $request->p2_bop_rb_el41_b,
                'p2_bop_rb_el42_b' => $request->p2_bop_rb_el42_b,
                'p2_bop_rb_el46_b' => $request->p2_bop_rb_el46_b,
                'p2_bop_rb_el36_l' => $request->p2_bop_rb_el36_l,
                'p2_bop_rb_el34_l' => $request->p2_bop_rb_el34_l,
                'p2_bop_rb_el32_l' => $request->p2_bop_rb_el32_l,
                'p2_bop_rb_el31_l' => $request->p2_bop_rb_el31_l,
                'p2_bop_rb_el41_l' => $request->p2_bop_rb_el41_l,
                'p2_bop_rb_el42_l' => $request->p2_bop_rb_el42_l,
                'p2_bop_rb_el46_l' => $request->p2_bop_rb_el46_l,
                'p2_indekskalkulus_ra_el16_b' => $request->p2_indekskalkulus_ra_el16_b,
                'p2_indekskalkulus_ra_el26_b' => $request->p2_indekskalkulus_ra_el26_b,
                'p2_indekskalkulus_ra_el16_l' => $request->p2_indekskalkulus_ra_el16_l,
                'p2_indekskalkulus_ra_el26_l' => $request->p2_indekskalkulus_ra_el26_l,
                'p2_indekskalkulus_rb_el36_b' => $request->p2_indekskalkulus_rb_el36_b,
                'p2_indekskalkulus_rb_el34_b' => $request->p2_indekskalkulus_rb_el34_b,
                'p2_indekskalkulus_rb_el32_b' => $request->p2_indekskalkulus_rb_el32_b,
                'p2_indekskalkulus_rb_el31_b' => $request->p2_indekskalkulus_rb_el31_b,
                'p2_indekskalkulus_rb_el41_b' => $request->p2_indekskalkulus_rb_el41_b,
                'p2_indekskalkulus_rb_el42_b' => $request->p2_indekskalkulus_rb_el42_b,
                'p2_indekskalkulus_rb_el46_b' => $request->p2_indekskalkulus_rb_el46_b,
                'p2_indekskalkulus_rb_el36_l' => $request->p2_indekskalkulus_rb_el36_l,
                'p2_indekskalkulus_rb_el34_l' => $request->p2_indekskalkulus_rb_el34_l,
                'p2_indekskalkulus_rb_el32_l' => $request->p2_indekskalkulus_rb_el32_l,
                'p2_indekskalkulus_rb_el31_l' => $request->p2_indekskalkulus_rb_el31_l,
                'p2_indekskalkulus_rb_el41_l' => $request->p2_indekskalkulus_rb_el41_l,
                'p2_indekskalkulus_rb_el42_l' => $request->p2_indekskalkulus_rb_el42_l,
                'p2_indekskalkulus_rb_el46_l' => $request->p2_indekskalkulus_rb_el46_l,
                'p3_tanggal' => $request->p3_tanggal,
                'p3_indeksplak_ra_el16_b' => $request->p3_indeksplak_ra_el16_b,
                'p3_indeksplak_ra_el12_b' => $request->p3_indeksplak_ra_el12_b,
                'p3_indeksplak_ra_el11_b' => $request->p3_indeksplak_ra_el11_b,
                'p3_indeksplak_ra_el21_b' => $request->p3_indeksplak_ra_el21_b,
                'p3_indeksplak_ra_el22_b' => $request->p3_indeksplak_ra_el22_b,
                'p3_indeksplak_ra_el24_b' => $request->p3_indeksplak_ra_el24_b,
                'p3_indeksplak_ra_el26_b' => $request->p3_indeksplak_ra_el26_b,
                'p3_indeksplak_ra_el16_l' => $request->p3_indeksplak_ra_el16_l,
                'p3_indeksplak_ra_el12_l' => $request->p3_indeksplak_ra_el12_l,
                'p3_indeksplak_ra_el11_l' => $request->p3_indeksplak_ra_el11_l,
                'p3_indeksplak_ra_el21_l' => $request->p3_indeksplak_ra_el21_l,
                'p3_indeksplak_ra_el22_l' => $request->p3_indeksplak_ra_el22_l,
                'p3_indeksplak_ra_el24_l' => $request->p3_indeksplak_ra_el24_l,
                'p3_indeksplak_ra_el26_l' => $request->p3_indeksplak_ra_el26_l,
                'p3_indeksplak_rb_el36_b' => $request->p3_indeksplak_rb_el36_b,
                'p3_indeksplak_rb_el34_b' => $request->p3_indeksplak_rb_el34_b,
                'p3_indeksplak_rb_el32_b' => $request->p3_indeksplak_rb_el32_b,
                'p3_indeksplak_rb_el31_b' => $request->p3_indeksplak_rb_el31_b,
                'p3_indeksplak_rb_el41_b' => $request->p3_indeksplak_rb_el41_b,
                'p3_indeksplak_rb_el42_b' => $request->p3_indeksplak_rb_el42_b,
                'p3_indeksplak_rb_el46_b' => $request->p3_indeksplak_rb_el46_b,
                'p3_indeksplak_rb_el36_l' => $request->p3_indeksplak_rb_el36_l,
                'p3_indeksplak_rb_el34_l' => $request->p3_indeksplak_rb_el34_l,
                'p3_indeksplak_rb_el32_l' => $request->p3_indeksplak_rb_el32_l,
                'p3_indeksplak_rb_el31_l' => $request->p3_indeksplak_rb_el31_l,
                'p3_indeksplak_rb_el41_l' => $request->p3_indeksplak_rb_el41_l,
                'p3_indeksplak_rb_el42_l' => $request->p3_indeksplak_rb_el42_l,
                'p3_indeksplak_rb_el46_l' => $request->p3_indeksplak_rb_el46_l,
                'p3_bop_ra_el16_b' => $request->p3_bop_ra_el16_b,
                'p3_bop_ra_el12_b' => $request->p3_bop_ra_el12_b,
                'p3_bop_ra_el11_b' => $request->p3_bop_ra_el11_b,
                'p3_bop_ra_el21_b' => $request->p3_bop_ra_el21_b,
                'p3_bop_ra_el22_b' => $request->p3_bop_ra_el22_b,
                'p3_bop_ra_el24_b' => $request->p3_bop_ra_el24_b,
                'p3_bop_ra_el26_b' => $request->p3_bop_ra_el26_b,
                'p3_bop_ra_el16_l' => $request->p3_bop_ra_el16_l,
                'p3_bop_ra_el12_l' => $request->p3_bop_ra_el12_l,
                'p3_bop_ra_el11_l' => $request->p3_bop_ra_el11_l,
                'p3_bop_ra_el21_l' => $request->p3_bop_ra_el21_l,
                'p3_bop_ra_el22_l' => $request->p3_bop_ra_el22_l,
                'p3_bop_ra_el24_l' => $request->p3_bop_ra_el24_l,
                'p3_bop_ra_el26_l' => $request->p3_bop_ra_el26_l,
                'p3_bop_rb_el36_b' => $request->p3_bop_rb_el36_b,
                'p3_bop_rb_el34_b' => $request->p3_bop_rb_el34_b,
                'p3_bop_rb_el32_b' => $request->p3_bop_rb_el32_b,
                'p3_bop_rb_el31_b' => $request->p3_bop_rb_el31_b,
                'p3_bop_rb_el41_b' => $request->p3_bop_rb_el41_b,
                'p3_bop_rb_el42_b' => $request->p3_bop_rb_el42_b,
                'p3_bop_rb_el46_b' => $request->p3_bop_rb_el46_b,
                'p3_bop_rb_el36_l' => $request->p3_bop_rb_el36_l,
                'p3_bop_rb_el34_l' => $request->p3_bop_rb_el34_l,
                'p3_bop_rb_el32_l' => $request->p3_bop_rb_el32_l,
                'p3_bop_rb_el31_l' => $request->p3_bop_rb_el31_l,
                'p3_bop_rb_el41_l' => $request->p3_bop_rb_el41_l,
                'p3_bop_rb_el42_l' => $request->p3_bop_rb_el42_l,
                'p3_bop_rb_el46_l' => $request->p3_bop_rb_el46_l,
                'p3_indekskalkulus_ra_el16_b' => $request->p3_indekskalkulus_ra_el16_b,
                'p3_indekskalkulus_ra_el26_b' => $request->p3_indekskalkulus_ra_el26_b,
                'p3_indekskalkulus_ra_el16_l' => $request->p3_indekskalkulus_ra_el16_l,
                'p3_indekskalkulus_ra_el26_l' => $request->p3_indekskalkulus_ra_el26_l,
                'p3_indekskalkulus_rb_el36_b' => $request->p3_indekskalkulus_rb_el36_b,
                'p3_indekskalkulus_rb_el34_b' => $request->p3_indekskalkulus_rb_el34_b,
                'p3_indekskalkulus_rb_el32_b' => $request->p3_indekskalkulus_rb_el32_b,
                'p3_indekskalkulus_rb_el31_b' => $request->p3_indekskalkulus_rb_el31_b,
                'p3_indekskalkulus_rb_el41_b' => $request->p3_indekskalkulus_rb_el41_b,
                'p3_indekskalkulus_rb_el42_b' => $request->p3_indekskalkulus_rb_el42_b,
                'p3_indekskalkulus_rb_el46_b' => $request->p3_indekskalkulus_rb_el46_b,
                'p3_indekskalkulus_rb_el36_l' => $request->p3_indekskalkulus_rb_el36_l,
                'p3_indekskalkulus_rb_el34_l' => $request->p3_indekskalkulus_rb_el34_l,
                'p3_indekskalkulus_rb_el32_l' => $request->p3_indekskalkulus_rb_el32_l,
                'p3_indekskalkulus_rb_el31_l' => $request->p3_indekskalkulus_rb_el31_l,
                'p3_indekskalkulus_rb_el41_l' => $request->p3_indekskalkulus_rb_el41_l,
                'p3_indekskalkulus_rb_el42_l' => $request->p3_indekskalkulus_rb_el42_l,
                'p3_indekskalkulus_rb_el46_l' => $request->p3_indekskalkulus_rb_el46_l,
                 
                'terapi_s' => $request->terapi_s,
                'terapi_o' => $request->terapi_o,
                'terapi_a' => $request->terapi_a,
                'terapi_p' => $request->terapi_p,
                'terapi_ohis' => $request->terapi_ohis,
                'terapi_bop' => $request->terapi_bop,
                'terapi_pm18' => $request->terapi_pm18,
                'terapi_pm17' => $request->terapi_pm17,
                'terapi_pm16' => $request->terapi_pm16,
                'terapi_pm15' => $request->terapi_pm15,
                'terapi_pm14' => $request->terapi_pm14,
                'terapi_pm13' => $request->terapi_pm13,
                'terapi_pm12' => $request->terapi_pm12,
                'terapi_pm11' => $request->terapi_pm11,
                'terapi_pm21' => $request->terapi_pm21,
                'terapi_pm22' => $request->terapi_pm22,
                'terapi_pm23' => $request->terapi_pm23,
                'terapi_pm24' => $request->terapi_pm24,
                'terapi_pm25' => $request->terapi_pm25,
                'terapi_pm26' => $request->terapi_pm26,
                'terapi_pm27' => $request->terapi_pm27,
                'terapi_pm28' => $request->terapi_pm28,
                'terapi_pm38' => $request->terapi_pm38,
                'terapi_pm37' => $request->terapi_pm37,
                'terapi_pm36' => $request->terapi_pm36,
                'terapi_pm35' => $request->terapi_pm35,
                'terapi_pm34' => $request->terapi_pm34,
                'terapi_pm33' => $request->terapi_pm33,
                'terapi_pm32' => $request->terapi_pm32,
                'terapi_pm31' => $request->terapi_pm31,
                'terapi_pm41' => $request->terapi_pm41,
                'terapi_pm42' => $request->terapi_pm42,
                'terapi_pm43' => $request->terapi_pm43,
                'terapi_pm44' => $request->terapi_pm44,
                'terapi_pm45' => $request->terapi_pm45,
                'terapi_pm46' => $request->terapi_pm46,
                'terapi_pm47' => $request->terapi_pm47,
                'terapi_pm48' => $request->terapi_pm48,
                'terapi_pb18' => $request->terapi_pb18,
                'terapi_pb17' => $request->terapi_pb17,
                'terapi_pb16' => $request->terapi_pb16,
                'terapi_pb15' => $request->terapi_pb15,
                'terapi_pb14' => $request->terapi_pb14,
                'terapi_pb13' => $request->terapi_pb13,
                'terapi_pb12' => $request->terapi_pb12,
                'terapi_pb11' => $request->terapi_pb11,
                'terapi_pb21' => $request->terapi_pb21,
                'terapi_pb22' => $request->terapi_pb22,
                'terapi_pb23' => $request->terapi_pb23,
                'terapi_pb24' => $request->terapi_pb24,
                'terapi_pb25' => $request->terapi_pb25,
                'terapi_pb26' => $request->terapi_pb26,
                'terapi_pb27' => $request->terapi_pb27,
                'terapi_pb28' => $request->terapi_pb28,
                'terapi_pb38' => $request->terapi_pb38,
                'terapi_pb37' => $request->terapi_pb37,
                'terapi_pb36' => $request->terapi_pb36,
                'terapi_pb35' => $request->terapi_pb35,
                'terapi_pb34' => $request->terapi_pb34,
                'terapi_pb33' => $request->terapi_pb33,
                'terapi_pb32' => $request->terapi_pb32,
                'terapi_pb31' => $request->terapi_pb31,
                'terapi_pb41' => $request->terapi_pb41,
                'terapi_pb42' => $request->terapi_pb42,
                'terapi_pb43' => $request->terapi_pb43,
                'terapi_pb44' => $request->terapi_pb44,
                'terapi_pb45' => $request->terapi_pb45,
                'terapi_pb46' => $request->terapi_pb46,
                'terapi_pb47' => $request->terapi_pb47,
                'terapi_pb48' => $request->terapi_pb48,
                'terapi_pd18' => $request->terapi_pd18,
                'terapi_pd17' => $request->terapi_pd17,
                'terapi_pd16' => $request->terapi_pd16,
                'terapi_pd15' => $request->terapi_pd15,
                'terapi_pd14' => $request->terapi_pd14,
                'terapi_pd13' => $request->terapi_pd13,
                'terapi_pd12' => $request->terapi_pd12,
                'terapi_pd11' => $request->terapi_pd11,
                'terapi_pd21' => $request->terapi_pd21,
                'terapi_pd22' => $request->terapi_pd22,
                'terapi_pd23' => $request->terapi_pd23,
                'terapi_pd24' => $request->terapi_pd24,
                'terapi_pd25' => $request->terapi_pd25,
                'terapi_pd26' => $request->terapi_pd26,
                'terapi_pd27' => $request->terapi_pd27,
                'terapi_pd28' => $request->terapi_pd28,
                'terapi_pd38' => $request->terapi_pd38,
                'terapi_pd37' => $request->terapi_pd37,
                'terapi_pd36' => $request->terapi_pd36,
                'terapi_pd35' => $request->terapi_pd35,
                'terapi_pd34' => $request->terapi_pd34,
                'terapi_pd33' => $request->terapi_pd33,
                'terapi_pd32' => $request->terapi_pd32,
                'terapi_pd31' => $request->terapi_pd31,
                'terapi_pd41' => $request->terapi_pd41,
                'terapi_pd42' => $request->terapi_pd42,
                'terapi_pd43' => $request->terapi_pd43,
                'terapi_pd44' => $request->terapi_pd44,
                'terapi_pd45' => $request->terapi_pd45,
                'terapi_pd46' => $request->terapi_pd46,
                'terapi_pd47' => $request->terapi_pd47,
                'terapi_pd48' => $request->terapi_pd48,
                'terapi_pl18' => $request->terapi_pl18,
                'terapi_pl17' => $request->terapi_pl17,
                'terapi_pl16' => $request->terapi_pl16,
                'terapi_pl15' => $request->terapi_pl15,
                'terapi_pl14' => $request->terapi_pl14,
                'terapi_pl13' => $request->terapi_pl13,
                'terapi_pl12' => $request->terapi_pl12,
                'terapi_pl11' => $request->terapi_pl11,
                'terapi_pl21' => $request->terapi_pl21,
                'terapi_pl22' => $request->terapi_pl22,
                'terapi_pl23' => $request->terapi_pl23,
                'terapi_pl24' => $request->terapi_pl24,
                'terapi_pl25' => $request->terapi_pl25,
                'terapi_pl26' => $request->terapi_pl26,
                'terapi_pl27' => $request->terapi_pl27,
                'terapi_pl28' => $request->terapi_pl28,
                'terapi_pl38' => $request->terapi_pl38,
                'terapi_pl37' => $request->terapi_pl37,
                'terapi_pl36' => $request->terapi_pl36,
                'terapi_pl35' => $request->terapi_pl35,
                'terapi_pl34' => $request->terapi_pl34,
                'terapi_pl33' => $request->terapi_pl33,
                'terapi_pl32' => $request->terapi_pl32,
                'terapi_pl31' => $request->terapi_pl31,
                'terapi_pl41' => $request->terapi_pl41,
                'terapi_pl42' => $request->terapi_pl42,
                'terapi_pl43' => $request->terapi_pl43,
                'terapi_pl44' => $request->terapi_pl44,
                'terapi_pl45' => $request->terapi_pl45,
                'terapi_pl46' => $request->terapi_pl46,
                'terapi_pl47' => $request->terapi_pl47,
                'terapi_pl48' => $request->terapi_pl48,
            ];
            $cekdata = $this->emrperiodontieRepository->findwaktuperawatan($request);

            if ($cekdata->count() < 1) {
                $execute = $this->emrperiodontieRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Periodonti Berhasil Dibuat !';
            } else {
                $execute = $this->emrperiodontieRepository->updatewaktuperawatan($request);
                $message = 'Assesment Periodonti Berhasil Diperbarui !';
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
            "nim" => "required",
        ]);
      
        try {    
            
            $cekdata = $this->emrperiodontieRepository->viewemrbyRegOperator($request);

            if($cekdata->count() < 1){
              
                $uuid = Uuid::uuid4();
                $data = [
                    'id' => $uuid,
                    'npm' => $request->nim,
                    "noregister" => $request->noregister,
                    "noepisode" => null,
                ];

                $this->emrperiodontieRepository->createwaktuperawatan($data, $uuid);
                $message = 'Assesment Periodonti Berhasil Dibuat !';

                //update status_emr to write
                $this->patientRepository->updateStatusEmrWrite($request->noregister);

                 DB::commit();
 
                return $this->sendResponse($data, $message);
            }else{
                $uuiddata = $cekdata->first(); 
                return $this->sendResponse($uuiddata, 'Data EMR ditemukan !');
            }
           
           

        } catch (Exception $e) {
            
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function uploadfotoklinisintraoral(Request $request)
    {
      
            $request->validate([ 
                "id" => "required",                  
                "idfotoklinisintraoral" => "required",  
                "select_file" => "required|max:10000" 
            ]);
          
            try {
               
                // Db Transaction
                DB::beginTransaction(); 
                 
                $image = $request->file('select_file');
                $uuid = Uuid::uuid4();
                $new_name = $uuid. '.' . $image->getClientOriginalExtension();
                $image->move(storage_path('app/'), $new_name);
                $keyaws = 'emr/periodonti/fotoklinisintraoral/';
                $upload = $this->UploadtoAWS($new_name,$keyaws);
    
                $data = [
                    'id' => $request->id,
                    'select_file' => $upload
                ];
                if($request->idfotoklinisintraoral == "1"){
                    $this->emrperiodontieRepository->foto_klinis_oklusi_arah_kiri($request,$upload);
                }elseif($request->idfotoklinisintraoral == "2"){
                    $this->emrperiodontieRepository->foto_klinis_oklusi_arah_kanan($request,$upload);
                }elseif($request->idfotoklinisintraoral == "3"){
                    $this->emrperiodontieRepository->foto_klinis_oklusi_arah_anterior($request,$upload);
                }elseif($request->idfotoklinisintraoral == "4"){
                    $this->emrperiodontieRepository->foto_klinis_oklusal_rahang_atas($request,$upload);
                }elseif($request->idfotoklinisintraoral == "5"){
                    $this->emrperiodontieRepository->foto_klinis_oklusal_rahang_bawah($request,$upload);
                }elseif($request->idfotoklinisintraoral == "6"){
                    $this->emrperiodontieRepository->foto_klinis_before($request,$upload);
                }elseif($request->idfotoklinisintraoral == "7"){
                    $this->emrperiodontieRepository->foto_klinis_after($request,$upload);
                }
              
                DB::commit();
    
                unlink(storage_path() . "/app/". $new_name);
                return $this->sendResponse($data, 'Foto Klinis Intra Oral berhasil di upload !');
    
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
    
     

    }
    public function uploadfotopanoramik(Request $request)
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
                $keyaws = 'emr/periodonti/fotopanoramik/';
                $upload = $this->UploadtoAWS($new_name,$keyaws);
    
                $data = [
                    'id' => $request->id,
                    'select_file' => $upload
                ];
                
                $this->emrperiodontieRepository->foto_ronsen_panoramik($request,$upload);
                 
              
                DB::commit();
    
                unlink(storage_path() . "/app/". $new_name);
                return $this->sendResponse($data, 'Foto Rontgen Panoramik berhasil di upload !');
    
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
    
     

    }
    //soap
    public function createsoap(Request $request)
    {
        // validate 
        $request->validate([  
            'terapi_s' => "required", 
            'terapi_o' => "required",  
            'terapi_a' => "required",          
            'terapi_p' => "required",  
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
                'datesoap' => Carbon::now(),
                'terapi_s' => $request->terapi_s, 
                'terapi_o' => $request->terapi_o,  
                'terapi_a' => $request->terapi_a,                
                'terapi_p' => $request->terapi_p,
                'user_entry' => $request->user_entry, 
                'user_entry_name' => $request->user_entry_name, 
                'idemr' => $request->idemr  
            ];
            $execute = $this->emrperiodontieRepository->createsoap($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'SOAP Berhasil dibuat !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

    public function updatesoap(Request $request)
    {
        // validate 
        $request->validate([  
            'terapi_s' => "required", 
            'terapi_o' => "required",  
            'terapi_a' => "required",          
            'terapi_p' => "required",  
            'user_entry' => "required", 
            'user_entry_name' => "required",             
            'idemr' => "required",    
        ]);

        try {

            // Db Transaction
            DB::beginTransaction(); 
            
            $data = [
                'id' => $request->id,                
                'datesoap' => Carbon::now(),
                'terapi_s' => $request->terapi_s, 
                'terapi_o' => $request->terapi_o,  
                'terapi_a' => $request->terapi_a,                
                'terapi_p' => $request->terapi_p,
                'user_entry' => $request->user_entry, 
                'user_entry_name' => $request->user_entry_name, 
                'idemr' => $request->idemr  
            ];

            $cekdata = $this->emrperiodontieRepository->showbyidsoap($request)->first();

            if($cekdata->count() < 1 ){
                return $this->sendError('Data SOAP tidak ditemukan !', []);
            }
            $execute = $this->emrperiodontieRepository->updatesoap($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'SOAP Berhasil diedit !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function deletesoap(Request $request)
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

            $cekdata = $this->emrperiodontieRepository->showbyidsoap($request);

            if($cekdata->count() < 1 ){
                return $this->sendError('Data SOAP tidak ditemukan !', []);
            }

            $execute = $this->emrperiodontieRepository->deletesoap($data);
            DB::commit();
         
            if($execute){
                return $this->sendResponse($data, 'SOAP Berhasil dihapus !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function showbyidsoap(Request $request)
    {

        // validate 
        $request->validate([  
            'id' => "required"    
        ]);

            try {
                
                $cekdata = $this->emrperiodontieRepository->showbyidsoap($request)->first();

                if($cekdata->count() < 1 ){
                    return $this->sendError('Data SOAP tidak ditemukan !', []);
                }

                return $this->sendResponse($cekdata, 'SOAP Berhasil ditemukan !');

            } catch (Exception $e) { 
                Log::info($e->getMessage());
                return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
            }
                
    }

    public function showallsoap(Request $request)
    {
             // validate 
            $request->validate([  
                'idemr' => "required"    
            ]);

            try {
                
                $cekdata = $this->emrperiodontieRepository->showallsoap($request);

                if($cekdata->count() < 1 ){
                    return $this->sendError('Data SOAP tidak ditemukan !', []);
                }

                return $this->sendResponse($cekdata, 'SOAP Berhasil ditemukan !');

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

            $cekdata = $this->emrperiodontieRepository->showbyidsoap($request)->first();

            if($cekdata->count() < 1 ){
                return $this->sendError('Data SOAP tidak ditemukan !', []);
            }

            $execute = $this->emrperiodontieRepository->verifydpk($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'SOAP Berhasil diverifikasi !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}
