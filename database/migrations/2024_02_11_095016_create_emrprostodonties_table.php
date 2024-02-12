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
        Schema::create('emrprostodonties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('noregister', 25)->nullable();
            $table->string('noepisode', 25)->nullable();
            $table->string('nomorrekammedik', 25)->nullable();
            $table->dateTime('tanggal');
            $table->string('namapasien', 350)->nullable();
            $table->string('pekerjaan', 255)->nullable();
            $table->string('jeniskelamin', 25)->nullable();
            $table->text('alamatpasien')->nullable();
            $table->string('namaoperator', 350)->nullable();
            $table->string('nomortelpon', 25)->nullable();
            $table->string('npm', 25)->nullable();
            $table->text('keluhanutama')->nullable();
            $table->text('riwayatgeligi')->nullable();
            $table->string('pengalamandengangigitiruan', 255)->nullable();
            $table->string('estetis', 255)->nullable();
            $table->string('fungsibicara', 255)->nullable();
            $table->string('penguyahan', 255)->nullable();
            $table->string('pembiayaan', 255)->nullable();
            $table->text('lainlain')->nullable();
            $table->string('wajah', 25)->nullable();
            $table->string('profilmuka', 25)->nullable();
            $table->string('pupil', 25)->nullable();
            $table->string('tragus', 25)->nullable();
            $table->string('hidung', 25)->nullable();
            $table->string('pernafasanmelaluihidung', 25)->nullable();
            $table->string('bibiratas', 25)->nullable();
            $table->string('bibiratas_b', 25)->nullable();
            $table->string('bibirbawah', 25)->nullable();
            $table->string('bibirbawah_b', 25)->nullable();
            $table->string('submandibulariskanan', 25)->nullable();
            $table->string('submandibulariskanan_b', 25)->nullable();
            $table->string('submandibulariskiri', 25)->nullable();
            $table->string('submandibulariskiri_b', 25)->nullable();
            $table->string('sublingualis', 25)->nullable();
            $table->string('sublingualis_b', 25)->nullable();
            $table->string('sisikiri', 25)->nullable();
            $table->string('sisikirisejak', 100)->nullable();
            $table->string('sisikanan', 25)->nullable();
            $table->string('sisikanansejak', 100)->nullable();
            $table->string('membukamulut', 25)->nullable();
            $table->string('membukamulut_b', 25)->nullable();
            $table->text('kelainanlain')->nullable();
            $table->string('higienemulut', 25)->nullable();
            $table->string('salivakuantitas', 25)->nullable();
            $table->string('salivakonsisten', 25)->nullable();
            $table->string('lidahukuran', 25)->nullable();
            $table->string('lidahposisiwright', 25)->nullable();
            $table->string('lidahmobilitas', 25)->nullable();
            $table->string('refleksmuntah', 25)->nullable();
            $table->string('mukosamulut', 25)->nullable();
            $table->string('mukosamulutberupa', 255)->nullable();
            $table->string('gigitan', 25)->nullable();
            $table->string('gigitanbilaada', 25)->nullable();
            $table->string('gigitanterbuka', 25)->nullable();
            $table->string('gigitanterbukaregion', 255)->nullable();
            $table->string('gigitansilang', 25)->nullable();
            $table->string('gigitansilangregion', 255)->nullable();
            $table->string('hubunganrahang', 25)->nullable();
            $table->string('pemeriksaanrontgendental', 25)->nullable();
            $table->string('elemengigi', 255)->nullable();
            $table->string('pemeriksaanrontgenpanoramik', 25)->nullable();
            $table->string('pemeriksaanrontgentmj', 25)->nullable();
            $table->string('frakturgigi', 25)->nullable();
            $table->string('frakturarah', 25)->nullable();
            $table->string('frakturbesar', 25)->nullable();
            $table->text('intraorallainlain')->nullable();
            $table->string('perbandinganmahkotadanakargigi', 255)->nullable();
            $table->string('interprestasifotorontgen', 255)->nullable();
            $table->string('intraoralkebiasaanburuk', 25)->nullable();
            $table->string('intraoralkebiasaanburukberupa', 255)->nullable();
            $table->string('pemeriksaanodontogram_11_51', 25)->nullable();
            $table->string('pemeriksaanodontogram_12_52', 25)->nullable();
            $table->string('pemeriksaanodontogram_13_53', 25)->nullable();
            $table->string('pemeriksaanodontogram_14_54', 25)->nullable();
            $table->string('pemeriksaanodontogram_15_55', 25)->nullable();
            $table->string('pemeriksaanodontogram_16', 25)->nullable();
            $table->string('pemeriksaanodontogram_17', 25)->nullable();
            $table->string('pemeriksaanodontogram_18', 25)->nullable();
            $table->string('pemeriksaanodontogram_61_21', 25)->nullable();
            $table->string('pemeriksaanodontogram_62_22', 25)->nullable();
            $table->string('pemeriksaanodontogram_63_23', 25)->nullable();
            $table->string('pemeriksaanodontogram_64_24', 25)->nullable();
            $table->string('pemeriksaanodontogram_65_25', 25)->nullable();
            $table->string('pemeriksaanodontogram_26', 25)->nullable();
            $table->string('pemeriksaanodontogram_27', 25)->nullable();
            $table->string('pemeriksaanodontogram_28', 25)->nullable();
            $table->string('pemeriksaanodontogram_48', 25)->nullable();
            $table->string('pemeriksaanodontogram_47', 25)->nullable();
            $table->string('pemeriksaanodontogram_46', 25)->nullable();
            $table->string('pemeriksaanodontogram_45_85', 25)->nullable();
            $table->string('pemeriksaanodontogram_44_84', 25)->nullable();
            $table->string('pemeriksaanodontogram_43_83', 25)->nullable();
            $table->string('pemeriksaanodontogram_42_82', 25)->nullable();
            $table->string('pemeriksaanodontogram_41_81', 25)->nullable();
            $table->string('pemeriksaanodontogram_38', 25)->nullable();
            $table->string('pemeriksaanodontogram_37', 25)->nullable();
            $table->string('pemeriksaanodontogram_36', 25)->nullable();
            $table->string('pemeriksaanodontogram_75_35', 25)->nullable();
            $table->string('pemeriksaanodontogram_74_34', 25)->nullable();
            $table->string('pemeriksaanodontogram_73_33', 25)->nullable();
            $table->string('pemeriksaanodontogram_72_32', 25)->nullable();
            $table->string('pemeriksaanodontogram_71_31', 25)->nullable();
            $table->string('rahangataspostkiri', 25)->nullable();
            $table->string('rahangataspostkanan', 25)->nullable();
            $table->string('rahangatasanterior', 25)->nullable();
            $table->string('rahangbawahpostkiri', 25)->nullable();
            $table->string('rahangbawahpostkanan', 25)->nullable();
            $table->string('rahangbawahanterior', 25)->nullable();
            $table->string('rahangatasbentukpostkiri', 25)->nullable();
            $table->string('rahangatasbentukpostkanan', 25)->nullable();
            $table->string('rahangatasbentukanterior', 25)->nullable();
            $table->string('rahangatasketinggianpostkiri', 25)->nullable();
            $table->string('rahangatasketinggianpostkanan', 25)->nullable();
            $table->string('rahangatasketinggiananterior', 25)->nullable();
            $table->string('rahangatastahananjaringanpostkiri', 25)->nullable();
            $table->string('rahangatastahananjaringanpostkanan', 25)->nullable();
            $table->string('rahangatastahananjaringananterior', 25)->nullable();
            $table->string('rahangatasbentukpermukaanpostkiri', 25)->nullable();
            $table->string('rahangatasbentukpermukaanpostkanan', 25)->nullable();
            $table->string('rahangatasbentukpermukaananterior', 25)->nullable();
            $table->string('rahangbawahbentukpostkiri', 25)->nullable();
            $table->string('rahangbawahbentukpostkanan', 25)->nullable();
            $table->string('rahangbawahbentukanterior', 25)->nullable();
            $table->string('rahangbawahketinggianpostkiri', 25)->nullable();
            $table->string('rahangbawahketinggianpostkanan', 25)->nullable();
            $table->string('rahangbawahketinggiananterior', 25)->nullable();
            $table->string('rahangbawahtahananjaringanpostkiri', 25)->nullable();
            $table->string('rahangbawahtahananjaringanpostkanan', 25)->nullable();
            $table->string('rahangbawahtahananjaringananterior', 25)->nullable();
            $table->string('rahangbawahbentukpermukaanpostkiri', 25)->nullable();
            $table->string('rahangbawahbentukpermukaanpostkanan', 25)->nullable();
            $table->string('rahangbawahbentukpermukaananterior', 25)->nullable();
            $table->string('anterior', 25)->nullable();
            $table->string('prosteriorkiri', 25)->nullable();
            $table->string('prosteriorkanan', 25)->nullable();
            $table->string('labialissuperior', 25)->nullable();
            $table->string('labialisinferior', 25)->nullable();
            $table->string('bukalisrahangataskiri', 25)->nullable();
            $table->string('bukalisrahangataskanan', 25)->nullable();
            $table->string('bukalisrahangbawahkiri', 25)->nullable();
            $table->string('bukalisrahangbawahkanan', 25)->nullable();
            $table->string('lingualis', 25)->nullable();
            $table->string('palatum', 25)->nullable();
            $table->string('kedalaman', 25)->nullable();
            $table->string('toruspalatinus', 25)->nullable();
            $table->string('palatummolle', 25)->nullable();
            $table->string('tuberorositasalveolariskiri', 25)->nullable();
            $table->string('tuberorositasalveolariskanan', 25)->nullable();
            $table->string('ruangretromilahioidkiri', 25)->nullable();
            $table->string('ruangretromilahioidkanan', 25)->nullable();
            $table->string('bentuklengkungrahangatas', 25)->nullable();
            $table->string('bentuklengkungrahangbawah', 25)->nullable();
            $table->string('perlekatandasarmulut', 25)->nullable();
            $table->text('pemeriksaanlain_lainlain')->nullable();
            $table->string('sikapmental', 25)->nullable();
            $table->text('diagnosa')->nullable();
            $table->string('rahangatas', 25)->nullable();
            $table->string('rahangataselemen', 255)->nullable();
            $table->string('rahangbawah', 25)->nullable();
            $table->string('rahangbawahelemen', 255)->nullable();
            $table->string('gigitiruancekat', 25)->nullable();
            $table->string('gigitiruancekatelemen', 255)->nullable();
            $table->string('perawatanperiodontal', 25)->nullable();
            $table->string('perawatanbedah', 25)->nullable();
            $table->string('perawatanbedah_ada', 25)->nullable();
            $table->string('perawatanbedahelemen', 25)->nullable();
            $table->text('perawatanbedahlainlain')->nullable();
            $table->string('konservasigigi', 25)->nullable();
            $table->string('konservasigigielemen', 255)->nullable();
            $table->string('rekonturing', 25)->nullable();
            $table->string('adapembuatanmahkota', 255)->nullable();
            $table->string('pengasahangigimiring', 255)->nullable();
            $table->string('pengasahangigiextruded', 255)->nullable();
            $table->text('rekonturinglainlain')->nullable();
            $table->string('macamcetakan_ra', 25)->nullable();
            $table->string('acamcetakan_rb', 25)->nullable();
            $table->string('warnagigi', 255)->nullable();
            $table->string('klasifikasidaerahtidakbergigirahangatas', 255)->nullable();
            $table->string('klasifikasidaerahtidakbergigirahangbawah', 255)->nullable();
            $table->string('gigipenyangga', 255)->nullable();
            $table->string('direk', 255)->nullable();
            $table->string('indirek', 255)->nullable();
            $table->string('platdasar', 255)->nullable();
            $table->string('anasirgigi', 255)->nullable();
            $table->string('prognosis', 25)->nullable();
            $table->text('prognosisalasan')->nullable();
            $table->string('reliningregio', 255)->nullable();
            $table->dateTime('reliningregiotanggal')->nullable();
            $table->string('reparasiregio', 25)->nullable();
            $table->dateTime('reparasiregiotanggal')->nullable();
            $table->string('perawatanulangsebab', 255)->nullable();
            $table->string('perawatanulanglainlain', 255)->nullable();
            $table->dateTime('perawatanulanglainlaintanggal')->nullable();
            $table->text('perawatanulangketerangan')->nullable();

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
        Schema::dropIfExists('emrprostodonties');
    }
};
