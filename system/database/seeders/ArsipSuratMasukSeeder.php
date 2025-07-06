<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArsipSuratMasuk;

class ArsipSuratMasukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_surat_masuk' => '900/SP2D/2025',
                'nama_surat_masuk' => 'Surat Perintah Pencairan Dana - SP2D',
                'tanggal_surat_masuk' => '2025-06-25',
                'asal_surat_masuk' => 'Bidang Perbendaharaan',
                'bidang_id' => 19, // Perbendaharaan
                'kategori_id' => 25, // SP2D
                'box_id' => 14,
                'urutan_surat_masuk' => 1,
                'file_surat_masuk' => 'sp2d_juni.pdf',
                'keterangan' => 'Pencairan dana kegiatan OPD',
                'opd_id' => 15,
            ],
            [
                'no_surat_masuk' => '901/SPD/2025',
                'nama_surat_masuk' => 'Surat Penyediaan Dana - SPD',
                'tanggal_surat_masuk' => '2025-06-26',
                'asal_surat_masuk' => 'Bidang Perbendaharaan',
                'bidang_id' => 19, // Perbendaharaan
                'kategori_id' => 35, // SPD
                'box_id' => 15,
                'urutan_surat_masuk' => 2,
                'file_surat_masuk' => 'spd_juni.pdf',
                'keterangan' => 'Penyediaan dana kegiatan triwulan',
                'opd_id' => 15,
            ],
            [
                'no_surat_masuk' => '800/APBD/2025',
                'nama_surat_masuk' => 'Dokumen APBD Tahun 2025',
                'tanggal_surat_masuk' => '2025-07-01',
                'asal_surat_masuk' => 'Bidang Anggaran',
                'bidang_id' => 26, // Anggaran
                'kategori_id' => 36, // APBD
                'box_id' => 16,
                'urutan_surat_masuk' => 1,
                'file_surat_masuk' => 'apbd_2025.pdf',
                'keterangan' => 'APBD Ketapang 2025',
                'opd_id' => 15,
            ],
            [
                'no_surat_masuk' => '801/SPJ/2025',
                'nama_surat_masuk' => 'Surat Pertanggungjawaban',
                'tanggal_surat_masuk' => '2025-07-02',
                'asal_surat_masuk' => 'Bidang Akuntansi',
                'bidang_id' => 27, // Akuntansi
                'kategori_id' => 37, // SPJ
                'box_id' => 16,
                'urutan_surat_masuk' => 1,
                'file_surat_masuk' => 'spj_juli.pdf',
                'keterangan' => 'SPJ kegiatan semester 1',
                'opd_id' => 15,
            ],
            [
                'no_surat_masuk' => '802/UND/2025',
                'nama_surat_masuk' => 'Undangan Rakor Aset',
                'tanggal_surat_masuk' => '2025-07-03',
                'asal_surat_masuk' => 'Sekretariat BPKAD',
                'bidang_id' => 29, // Sekretariat
                'kategori_id' => 38, // Undangan
                'box_id' => 16,
                'urutan_surat_masuk' => 1,
                'file_surat_masuk' => 'undangan_rakor.pdf',
                'keterangan' => 'Undangan rapat koordinasi pengelolaan aset daerah',
                'opd_id' => 15,
            ],
        ];

        foreach ($data as $item) {
            ArsipSuratMasuk::create($item);
        }
    }
}
