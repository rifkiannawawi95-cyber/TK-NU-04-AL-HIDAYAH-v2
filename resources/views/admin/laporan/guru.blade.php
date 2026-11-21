@extends('layouts.admin')
@section('title', 'Laporan Kehadiran Guru')
@section('header', 'Laporan Kehadiran & Potongan Guru')
@section('content')

@php
    $namaBulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ][$bulan] ?? date('F', mktime(0, 0, 0, (int)$bulan, 1));
@endphp

<!-- Filter & Export Toolbar -->
<div class="bg-white rounded-xl shadow-sm mb-6 p-4 border border-gray-100 no-print">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-700 text-sm">Bulan:</label>
                <select name="bulan" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" onchange="this.form.submit()">
                    @for($i=1; $i<=12; $i++)
                        @php $bVal = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                        <option value="{{ $bVal }}" {{ $bulan == $bVal ? 'selected' : '' }}>
                            {{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bVal] }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-700 text-sm">Tahun:</label>
                <select name="tahun" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" onchange="this.form.submit()">
                    @for($i=date('Y'); $i>=2020; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </form>

        <div class="flex items-center gap-2">
            <button type="button" onclick="exportToWord()" class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-colors">
                <i class="fas fa-file-word"></i> Export Word
            </button>
            <button type="button" onclick="exportToPDF()" class="inline-flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-colors">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-colors">
                <i class="fas fa-print"></i> Cetak / Print
            </button>
        </div>
    </div>
</div>

<!-- Printable Area -->
<div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 border border-gray-100" id="print-area">
    <!-- Kop Surat Resmi -->
    <x-kop-surat 
        judul="LAPORAN KEHADIRAN & POTONGAN GURU" 
        subjudul="Periode Bulan: {{ $namaBulan }} {{ $tahun }}" 
    />

    <!-- Table Laporan -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-800 font-semibold">
                    <th class="border border-gray-300 px-3 py-2.5 text-center w-12">No</th>
                    <th class="border border-gray-300 px-4 py-2.5 text-left">Nama Guru</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-green-50 text-green-800 w-24">Hadir</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-blue-50 text-blue-800 w-24">Izin</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-yellow-50 text-yellow-800 w-24">Sakit</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-red-50 text-red-800 w-24">Alpa</th>
                    <th class="border border-gray-300 px-4 py-2.5 text-right w-36">Total Potongan</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSemuaPotongan = 0; @endphp
                @forelse($gurus as $index => $guru)
                    @php
                        $hadir = $guru->kehadiran->where('status', 'Hadir')->count();
                        $izin = $guru->kehadiran->where('status', 'Izin')->count();
                        $sakit = $guru->kehadiran->where('status', 'Sakit')->count();
                        $alpa = $guru->kehadiran->where('status', 'Alpa')->count();
                        $potongan = ($izin + $sakit + $alpa) * 5000;
                        $totalSemuaPotongan += $potongan;
                    @endphp
                    <tr class="hover:bg-gray-50/50">
                        <td class="border border-gray-300 px-3 py-2 text-center text-gray-500">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold text-gray-900">{{ $guru->nama }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-green-700 bg-green-50/30">{{ $hadir }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-blue-700 bg-blue-50/30">{{ $izin }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-yellow-700 bg-yellow-50/30">{{ $sakit }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-red-700 bg-red-50/30">{{ $alpa }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right font-bold text-red-600">Rp {{ number_format($potongan, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-8 text-center text-gray-500 italic">
                            Tidak ada data kehadiran guru pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-bold text-gray-800">
                    <td colspan="6" class="border border-gray-300 px-4 py-2.5 text-right">TOTAL POTONGAN KESELURUHAN:</td>
                    <td class="border border-gray-300 px-4 py-2.5 text-right text-red-700 font-extrabold text-base">
                        Rp {{ number_format($totalSemuaPotongan, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Tanda Tangan Laporan -->
    <div class="mt-12 grid grid-cols-2 text-center text-sm font-medium text-gray-800 break-inside-avoid">
        <div>
            <p>Mengetahui,</p>
            <p class="mb-16">Pengelola Presensi Guru</p>
            <p class="underline font-bold">( ............................................ )</p>
        </div>
        <div>
            <p>Situbondo, {{ date('d') }} {{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][date('m')] }} {{ date('Y') }}</p>
            <p class="mb-16">Kepala TK NU 04 AL-HIDAYAH</p>
            <p class="underline font-bold">Siti Hanawiyun Nasyiin, S.Pd</p>
        </div>
    </div>
</div>

<!-- html2pdf CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function exportToWord() {
    var bName = "{{ $namaBulan }}";
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
        "xmlns:w='urn:schemas-microsoft-com:office:word' "+
        "xmlns='http://www.w3.org/TR/REC-html40'>"+
        "<head><meta charset='utf-8'><title>Laporan Kehadiran Guru</title>"+
        "<style>"+
        "body { font-family: Arial, sans-serif; font-size: 11pt; }"+
        "table { border-collapse: collapse; width: 100%; margin-top: 15px; }"+
        "th, td { border: 1px solid #000; padding: 6px 8px; text-align: center; }"+
        "th { background-color: #f3f4f6; font-weight: bold; }"+
        "td.text-left, th.text-left { text-align: left; }"+
        "td.text-right, th.text-right { text-align: right; }"+
        ".kop { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }"+
        "<" + "/style><" + "/head><body>";
    var footer = "<" + "/body><" + "/html>";
    
    var printContent = document.getElementById("print-area").innerHTML;
    var sourceHTML = header + printContent + footer;
    
    var blob = new Blob(['\ufeff' + sourceHTML], {
        type: 'application/msword'
    });
    
    var fileName = 'Laporan_Kehadiran_Guru_' + bName + '_{{ $tahun }}.doc';
    
    if (navigator.msSaveOrOpenBlob) {
        navigator.msSaveOrOpenBlob(blob, fileName);
    } else {
        var elem = window.document.createElement('a');
        elem.href = window.URL.createObjectURL(blob);
        elem.download = fileName;
        document.body.appendChild(elem);
        elem.click();
        document.body.removeChild(elem);
    }
}

function exportToPDF() {
    var bName = "{{ $namaBulan }}";
    var element = document.getElementById('print-area');
    var opt = {
      margin:       [0.4, 0.4, 0.4, 0.4],
      filename:     'Laporan_Kehadiran_Guru_' + bName + '_{{ $tahun }}.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2, useCORS: true },
      jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    if (typeof html2pdf !== 'undefined') {
        html2pdf().set(opt).from(element).save();
    } else {
        window.print();
    }
}
</script>

<style>
    @media print {
        body * { visibility: hidden; }
        #print-area, #print-area * { visibility: visible; }
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            box-shadow: none !important;
        }
        .no-print { display: none !important; }
    }
</style>
@endsection
