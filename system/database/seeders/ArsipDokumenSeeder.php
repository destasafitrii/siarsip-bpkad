<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArsipDokumen;

class ArsipDokumenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_dokumen' => 'DOK/001/SP2D/2025',
                'nama_dokumen' => 'Lampiran SP2D Gaji ASN',
                'tanggal_dokumen' => '2025-06-20',
                'bidang_id' => 19, // Perbendaharaan
                'kategori_id' => 25, // SP2D
                'ruangan_id' => 16,
                'lemari_id' => 10,
                'box_id' => 14,
                'urutan' => 1,
                'file_dokumen' => 'lampiran_sp2d.pdf',
                'keterangan' => 'Dokumen pendukung SP2D gaji ASN bulan Juni',
                'opd_id' => 15,
            ],
            [
                'no_dokumen' => 'DOK/002/SPD/2025',
                'nama_dokumen' => 'Lampiran SPD Operasional',
                'tanggal_dokumen' => '2025-06-21',
                'bidang_id' => 19,
                'kategori_id' => 35, // SPD
                'ruangan_id' => 15,
                'lemari_id' => 11,
                'box_id' => 15,
                'urutan' => 2,
                'file_dokumen' => 'lampiran_spd.pdf',
                'keterangan' => 'Dokumen pendukung SPD operasional kantor',
                'opd_id' => 15,
            ],
            [
                'no_dokumen' => 'DOK/003/APBD/2025',
                'nama_dokumen' => 'RKA APBD TA 2025',
                'tanggal_dokumen' => '2025-06-22',
                'bidang_id' => 26, // Anggaran
                'kategori_id' => 36, // APBD
                'ruangan_id' => 16,
                'lemari_id' => 12,
                'box_id' => 16,
                'urutan' => 1,
                'file_dokumen' => 'rka_apbd.pdf',
                'keterangan' => 'Rencana kerja anggaran APBD TA 2025',
                'opd_id' => 15,
            ],
            [
                'no_dokumen' => 'DOK/004/SPJ/2025',
                'nama_dokumen' => 'Laporan SPJ Triwulan I',
                'tanggal_dokumen' => '2025-06-23',
                'bidang_id' => 27, // Akuntansi
                'kategori_id' => 37, // SPJ
                'ruangan_id' => 16,
                'lemari_id' => 12,
                'box_id' => 16,
                'urutan' => 2,
                'file_dokumen' => 'spj_triwulan1.pdf',
                'keterangan' => 'SPJ triwulan pertama tahun anggaran 2025',
                'opd_id' => 15,
            ],
            [
                'no_dokumen' => 'DOK/005/UND/2025',
                'nama_dokumen' => 'Undangan Rapat Koordinasi Bidang Aset',
                'tanggal_dokumen' => '2025-06-24',
                'bidang_id' => 29, // Sekretariat
                'kategori_id' => 38, // Undangan
                'ruangan_id' => 15,
                'lemari_id' => 10,
                'box_id' => 16,
                'urutan' => 3,
                'file_dokumen' => 'undangan_aset.pdf',
                'keterangan' => 'Dokumen undangan rakor pengelolaan aset',
                'opd_id' => 15,
            ],
        ];

        foreach ($data as $item) {
            ArsipDokumen::create($item);
        }
    }
}
