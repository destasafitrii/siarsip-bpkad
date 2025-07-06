<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArsipSuratKeluar;

class ArsipSuratKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_surat_keluar' => '600/SP2D/2025',
                'nama_surat_keluar' => 'Pengiriman SP2D Belanja Barang',
                'tanggal_surat_keluar' => '2025-07-04',
                'tujuan_surat_keluar' => 'Bank Kalbar',
                'bidang_id' => 19, // Perbendaharaan
                'kategori_id' => 25, // SP2D
                'box_id' => 14,
                'urutan_surat_keluar' => 1,
                'file_surat_keluar' => 'sp2d_keluar_barang.pdf',
                'keterangan_surat_keluar' => 'SP2D untuk belanja barang operasional',
                'opd_id' => 15,
            ],
            [
                'no_surat_keluar' => '601/SPD/2025',
                'nama_surat_keluar' => 'SPD Kegiatan Sosialisasi',
                'tanggal_surat_keluar' => '2025-07-05',
                'tujuan_surat_keluar' => 'Kecamatan Delta Pawan',
                'bidang_id' => 19, // Perbendaharaan
                'kategori_id' => 35, // SPD
                'box_id' => 15,
                'urutan_surat_keluar' => 2,
                'file_surat_keluar' => 'spd_keluar_sosialisasi.pdf',
                'keterangan_surat_keluar' => 'Surat Penyediaan Dana untuk kegiatan sosialisasi',
                'opd_id' => 15,
            ],
            [
                'no_surat_keluar' => '602/APBD/2025',
                'nama_surat_keluar' => 'Pengiriman Dokumen APBD',
                'tanggal_surat_keluar' => '2025-07-06',
                'tujuan_surat_keluar' => 'Bappeda Kabupaten Ketapang',
                'bidang_id' => 26, // Anggaran
                'kategori_id' => 36, // APBD
                'box_id' => 16,
                'urutan_surat_keluar' => 1,
                'file_surat_keluar' => 'apbd_keluar.pdf',
                'keterangan_surat_keluar' => 'Dokumen APBD untuk Bappeda',
                'opd_id' => 15,
            ],
            [
                'no_surat_keluar' => '603/SPJ/2025',
                'nama_surat_keluar' => 'SPJ Dana Operasional Semester I',
                'tanggal_surat_keluar' => '2025-07-07',
                'tujuan_surat_keluar' => 'Inspektorat Daerah',
                'bidang_id' => 27, // Akuntansi
                'kategori_id' => 37, // SPJ
                'box_id' => 16,
                'urutan_surat_keluar' => 2,
                'file_surat_keluar' => 'spj_keluar_operasional.pdf',
                'keterangan_surat_keluar' => 'Laporan SPJ kegiatan semester pertama',
                'opd_id' => 15,
            ],
            [
                'no_surat_keluar' => '604/UND/2025',
                'nama_surat_keluar' => 'Undangan Pembahasan APBD-P',
                'tanggal_surat_keluar' => '2025-07-08',
                'tujuan_surat_keluar' => 'Seluruh Bidang BPKAD',
                'bidang_id' => 29, // Sekretariat
                'kategori_id' => 38, // Undangan
                'box_id' => 16,
                'urutan_surat_keluar' => 3,
                'file_surat_keluar' => 'undangan_apbdp.pdf',
                'keterangan_surat_keluar' => 'Rapat pembahasan perubahan anggaran',
                'opd_id' => 15,
            ],
        ];

        foreach ($data as $item) {
            ArsipSuratKeluar::create($item);
        }
    }
}
