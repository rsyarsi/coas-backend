<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emrortodonsies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('noregister', 25)->nullable();
            $table->string('noepisode', 25)->nullable();
            $table->string('pendaftaran', 225)->nullable();
            $table->string('pencetakan', 225)->nullable();
            $table->string('pemasanganalat', 225)->nullable();
            $table->string('waktuperawatan_retainer', 225)->nullable();
            $table->text('keluhanutama')->nullable();
            $table->string('kelainanendoktrin', 225)->nullable();
            $table->string('penyakitpadamasaanak', 225)->nullable();
            $table->string('alergi', 225)->nullable();
            $table->string('kelainansaluranpernapasan', 225)->nullable();
            $table->string('tindakanoperasi', 225)->nullable();
            $table->string('gigidesidui', 225)->nullable();
            $table->string('gigibercampur', 225)->nullable();
            $table->string('gigipermanen', 225)->nullable();
            $table->string('durasi', 225)->nullable();
            $table->string('frekuensi', 225)->nullable();
            $table->string('intensitas', 225)->nullable();
            $table->string('kebiasaanjelekketerangan', 225)->nullable();
            $table->string('riwayatkeluarga', 225)->nullable();
            $table->string('ayah', 225)->nullable();
            $table->string('ibu', 225)->nullable();
            $table->string('saudara', 225)->nullable();
            $table->string('riwayatkeluargaketerangan', 225)->nullable();
            $table->string('jasmani', 25)->nullable();
            $table->string('mental', 25)->nullable();
            $table->decimal('tinggibadan', 10, 2)->nullable();
            $table->decimal('beratbadan', 10, 2)->nullable();
            $table->decimal('indeksmassatubuh', 10, 2)->nullable();
            $table->string('statusgizi', 25)->nullable();
            $table->string('kategori', 350)->nullable();
            $table->decimal('lebarkepala', 10, 2)->nullable();
            $table->decimal('panjangkepala', 10, 2)->nullable();
            $table->string('indekskepala', 225)->nullable();
            $table->string('bentukkepala', 225)->nullable();
            $table->decimal('panjangmuka', 10, 2)->nullable();
            $table->decimal('lebarmuka', 10, 2)->nullable();
            $table->string('indeksmuka', 225)->nullable();
            $table->string('bentukmuka', 225)->nullable();
            $table->string('bentuk', 25)->nullable();
            $table->string('profilmuka', 25)->nullable();
            $table->string('senditemporomandibulat_tmj', 25)->nullable();
            $table->text('tmj_keterangan')->nullable();
            $table->string('bibirposisiistirahat', 25)->nullable();
            $table->string('tunusototmastikasi', 25)->nullable();
            $table->text('tunusototmastikasi_keterangan')->nullable();
            $table->string('tunusototbibir', 25)->nullable();
            $table->text('tunusototbibir_keterangan')->nullable();
            $table->decimal('freewayspace', 10, 2)->nullable();
            $table->string('pathofclosure', 225)->nullable();
            $table->string('higienemulutohi', 25)->nullable();
            $table->string('polaatrisi', 25)->nullable();
            $table->string('regio', 225)->nullable();
            $table->string('lingua', 25)->nullable();
            $table->text('intraoral_lainlain')->nullable();
            $table->string('palatumvertikal', 25)->nullable();
            $table->string('palatumlateral', 25)->nullable();
            $table->string('gingiva', 25)->nullable();
            $table->text('gingiva_keterangan')->nullable();
            $table->string('mukosa', 25)->nullable();
            $table->text('mukosa_keterangan')->nullable();
            $table->string('frenlabiisuperior', 25)->nullable();
            $table->string('frenlabiiinferior', 25)->nullable();
            $table->string('frenlingualis', 25)->nullable();
            $table->string('ketr', 25)->nullable();
            $table->string('tonsila', 25)->nullable();
            $table->string('fonetik', 225)->nullable();
            $table->string('tampakdepantakterlihatgigi', 225)->nullable();
            $table->string('fotomuka_bentukmuka', 225)->nullable();
            $table->string('tampaksamping', 225)->nullable();
            $table->string('fotomuka_profilmuka', 225)->nullable();
            $table->string('tampakdepansenyumterlihatgigi', 225)->nullable();
            $table->string('tampakmiring', 225)->nullable();
            $table->string('tampaksampingkanan', 225)->nullable();
            $table->string('tampakdepan', 225)->nullable();
            $table->string('tampaksampingkiri', 225)->nullable();
            $table->string('tampakoklusalatas', 225)->nullable();
            $table->string('tampakoklusalbawah', 225)->nullable();
            $table->string('bentuklengkunggigi_ra', 25)->nullable();
            $table->string('bentuklengkunggigi_rb', 25)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan1', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan2', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan3', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan4', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan5', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan6', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kanan7', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri1', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri2', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri3', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri4', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri5', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri6', 225)->nullable();
            $table->string('malposisigigiindividual_rahangatas_kiri7', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan1', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan2', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan3', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan4', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan5', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan6', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kanan7', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri1', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri2', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri3', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri4', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri5', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri6', 225)->nullable();
            $table->string('malposisigigiindividual_rahangbawah_kiri7', 225)->nullable();
            $table->decimal('overjet', 10, 2)->nullable();
            $table->decimal('overbite', 10, 2)->nullable();
            $table->string('palatalbite', 10)->nullable();
            $table->string('deepbite', 10)->nullable();
            $table->string('anterior_openbite', 10)->nullable();
            $table->string('edgetobite', 10)->nullable();
            $table->string('anterior_crossbite', 10)->nullable();
            $table->string('posterior_openbite', 10)->nullable();
            $table->string('scissorbite', 10)->nullable();
            $table->string('cusptocuspbite', 10)->nullable();
            $table->string('relasimolarpertamakanan', 10)->nullable();
            $table->string('relasimolarpertamakiri', 10)->nullable();
            $table->string('relasikaninuskanan', 10)->nullable();
            $table->string('relasikaninuskiri', 10)->nullable();
            $table->string('garistengahrahangbawahterhadaprahangatas', 225)->nullable();
            $table->string('garisinterinsisivisentralterhadapgaristengahrahangra', 225)->nullable();
            $table->decimal('garisinterinsisivisentralterhadapgaristengahrahangra_mm', 10, 2)->nullable();
            $table->string('garisinterinsisivisentralterhadapgaristengahrahangrb', 225)->nullable();
            $table->decimal('garisinterinsisivisentralterhadapgaristengahrahangrb_mm', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan1', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan2', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan3', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan4', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan5', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan6', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kanan7', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri1', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri2', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri3', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri4', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri5', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri6', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangatas_kiri7', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan1', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan2', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan3', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan4', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan5', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan6', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kanan7', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri1', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri2', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri3', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri4', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri5', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri6', 10, 2)->nullable();
            $table->decimal('lebarmesiodistalgigi_rahangbawah_kiri7', 10, 2)->nullable();
            $table->string('skemafotooklusalgigidarimodelstudi', 225)->nullable();
            $table->decimal('jumlahmesiodistal', 10, 2)->nullable();
            $table->decimal('jarakp1p2pengukuran', 10, 2)->nullable();
            $table->decimal('jarakp1p2perhitungan', 10, 2)->nullable();
            $table->decimal('diskrepansip1p2_mm', 10, 2)->nullable();
            $table->string('diskrepansip1p2', 25)->nullable();
            $table->decimal('jarakm1m1pengukuran', 10, 2)->nullable();
            $table->decimal('jarakm1m1perhitungan', 10, 2)->nullable();
            $table->decimal('diskrepansim1m2_mm', 10, 2)->nullable();
            $table->string('diskrepansim1m2', 225)->nullable();
            $table->string('diskrepansi_keterangan', 225)->nullable();
            $table->decimal('jumlahlebarmesiodistalgigidarim1m1', 10, 2)->nullable();
            $table->decimal('jarakp1p1tonjol', 10, 2)->nullable();
            $table->decimal('indeksp', 10, 2)->nullable();
            $table->decimal('lengkunggigiuntukmenampunggigigigi', 10, 2)->nullable();
            $table->decimal('jarakinterfossacaninus', 10, 2)->nullable();
            $table->decimal('indeksfc', 10, 2)->nullable();
            $table->string('lengkungbasaluntukmenampunggigigigi', 25)->nullable();
            $table->string('inklinasigigigigiregioposterior', 25)->nullable();
            $table->text('metodehowes_keterangan')->nullable();
            $table->text('aldmetode')->nullable();
            $table->decimal('overjetawal', 10, 2)->nullable();
            $table->decimal('overjetakhir', 10, 2)->nullable();
            $table->decimal('rahangatasdiskrepansi', 10, 2)->nullable();
            $table->decimal('rahangbawahdiskrepansi', 10, 2)->nullable();
            $table->string('fotosefalometri', 225)->nullable();
            $table->string('fotopanoramik', 225)->nullable();
            $table->string('maloklusiangleklas', 225)->nullable();
            $table->string('hubunganskeletal', 225)->nullable();
            $table->string('malrelasi', 225)->nullable();
            $table->string('malposisi', 225)->nullable();
            $table->string('estetik', 25)->nullable();
            $table->string('dental', 25)->nullable();
            $table->string('skeletal', 25)->nullable();
            $table->string('fungsipenguyahanal', 25)->nullable();
            $table->string('crowding', 25)->nullable();
            $table->string('spacing', 25)->nullable();
            $table->string('protrusif', 25)->nullable();
            $table->string('retrusif', 25)->nullable();
            $table->string('malposisiindividual', 25)->nullable();
            $table->string('maloklusi_crossbite', 25)->nullable();
            $table->string('maloklusi_lainlain', 25)->nullable();
            $table->text('maloklusi_lainlainketerangan')->nullable();
            $table->string('rapencabutan', 25)->nullable();
            $table->string('raekspansi', 25)->nullable();
            $table->string('ragrinding', 25)->nullable();
            $table->string('raplataktif', 25)->nullable();
            $table->string('rbpencabutan', 25)->nullable();
            $table->string('rbekspansi', 25)->nullable();
            $table->string('rbgrinding', 25)->nullable();
            $table->string('rbplataktif', 25)->nullable();
            $table->string('analisisetiologimaloklusi', 225)->nullable();
            $table->string('pasiendirujukkebagian', 225)->nullable();
            $table->string('pencarianruanguntuk', 225)->nullable();
            $table->string('koreksimalposisigigiindividual', 225)->nullable();
            $table->string('retensi', 225)->nullable();
            $table->string('pencarianruang', 225)->nullable();
            $table->string('koreksimalposisigigiindividual_rahangatas', 225)->nullable();
            $table->string('koreksimalposisigigiindividual_rahangbawah', 225)->nullable();
            $table->string('intruksipadapasien', 225)->nullable();
            $table->string('retainer', 225)->nullable();
            $table->string('gambarplataktif_rahangatas', 225)->nullable();
            $table->string('gambarplataktif_rahangbawah', 225)->nullable();
            $table->string('keterangangambar', 225)->nullable();
            $table->string('prognosis', 25)->nullable();
            $table->string('prognosis_a', 25)->nullable();
            $table->string('prognosis_b', 25)->nullable();
            $table->string('prognosis_c', 25)->nullable();
            $table->string('indikasiperawatan', 25)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emrortodonsies');
    }
};