@extends('layouts.admin')
@section('title', 'Laporan Kehadiran Siswa')
@section('header', 'Laporan Kehadiran Siswa')
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
                <label class="font-semibold text-gray-700 text-sm">Kelas:</label>
                <select name="kelas" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" onchange="this.form.submit()">
                    <option value="A" {{ $kelas == 'A' ? 'selected' : '' }}>Kelas A</option>
                    <option value="B" {{ $kelas == 'B' ? 'selected' : '' }}>Kelas B</option>
                </select>
            </div>

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

        <!-- Export Buttons Group -->
        <div class="flex flex-wrap items-center gap-2">
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
    <!-- Kop Surat -->
    <x-kop-surat 
        judul="LAPORAN KEHADIRAN SISWA" 
        subjudul="Kelas {{ $kelas }} • Periode Bulan: {{ $namaBulan }} {{ $tahun }}" 
    />

    <!-- Table Laporan -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-800 font-semibold">
                    <th class="border border-gray-300 px-3 py-2.5 text-center w-12">No</th>
                    <th class="border border-gray-300 px-4 py-2.5 text-left">Nama Siswa</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-green-50 text-green-800 w-24">Hadir (H)</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-blue-50 text-blue-800 w-24">Izin (I)</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-yellow-50 text-yellow-800 w-24">Sakit (S)</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center bg-red-50 text-red-800 w-24">Alpa (A)</th>
                    <th class="border border-gray-300 px-3 py-2.5 text-center w-28">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totHadir = 0;
                    $totIzin = 0;
                    $totSakit = 0;
                    $totAlpa = 0;
                @endphp
                @forelse($siswas as $index => $siswa)
                    @php
                        $h = $siswa->kehadiran->where('status', 'Hadir')->count();
                        $i = $siswa->kehadiran->where('status', 'Izin')->count();
                        $s = $siswa->kehadiran->where('status', 'Sakit')->count();
                        $a = $siswa->kehadiran->where('status', 'Alpa')->count();
                        
                        $totHadir += $h;
                        $totIzin += $i;
                        $totSakit += $s;
                        $totAlpa += $a;

                        $totalHari = $h + $i + $s + $a;
                        $persen = $totalHari > 0 ? round(($h / $totalHari) * 100, 1) : 0;
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="border border-gray-300 px-3 py-2 text-center text-gray-500 font-medium">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-800">{{ $siswa->nama }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold text-green-700 bg-green-50/30">{{ $h }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold text-blue-700 bg-blue-50/30">{{ $i }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold text-yellow-700 bg-yellow-50/30">{{ $s }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold text-red-600 bg-red-50/30">{{ $a }}</td>
                        <td class="border border-gray-300 px-3 py-2 text-center font-bold text-gray-700">
                            {{ $persen }}%
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-6 text-center text-gray-500">Belum ada data kehadiran siswa untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($siswas) > 0)
            <tfoot>
                <tr class="bg-gray-100 font-bold text-gray-900">
                    <td colspan="2" class="border border-gray-300 px-4 py-2.5 text-right">TOTAL KESELURUHAN</td>
                    <td class="border border-gray-300 px-3 py-2.5 text-center text-green-700">{{ $totHadir }}</td>
                    <td class="border border-gray-300 px-3 py-2.5 text-center text-blue-700">{{ $totIzin }}</td>
                    <td class="border border-gray-300 px-3 py-2.5 text-center text-yellow-700">{{ $totSakit }}</td>
                    <td class="border border-gray-300 px-3 py-2.5 text-center text-red-600">{{ $totAlpa }}</td>
                    <td class="border border-gray-300 px-3 py-2.5 text-center">
                        @php $grandTotal = $totHadir + $totIzin + $totSakit + $totAlpa; @endphp
                        {{ $grandTotal > 0 ? round(($totHadir / $grandTotal) * 100, 1) : 0 }}%
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    <!-- Tanda Tangan Pembukuan -->
    <div class="mt-12 grid grid-cols-2 gap-8 text-center text-sm font-semibold text-gray-800">
        <div>
            <p>Mengetahui,</p>
            <p class="mb-16">Guru Kelas {{ $kelas }}</p>
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
    var bName = "{{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bulan] ?? $bulan }}";
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
        "xmlns:w='urn:schemas-microsoft-com:office:word' "+
        "xmlns='http://www.w3.org/TR/REC-html40'>"+
        "<head><meta charset='utf-8'><title>Laporan Kehadiran Siswa</title>"+
        "<style>"+
        "body { font-family: Arial, sans-serif; font-size: 11pt; }"+
        "table { border-collapse: collapse; width: 100%; margin-top: 15px; }"+
        "th, td { border: 1px solid #000; padding: 6px 8px; text-align: center; }"+
        "th { background-color: #f3f4f6; font-weight: bold; }"+
        "td.text-left, th.text-left { text-align: left; }"+
        ".kop { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }"+
        ".kop h2 { margin: 0; font-size: 16pt; font-weight: bold; }"+
        ".kop h3 { margin: 5px 0; font-size: 13pt; }"+
        ".kop p { margin: 0; font-size: 9pt; }"+
        "<" + "/style><" + "/head><body>";
    var footer = "<" + "/body><" + "/html>";
    
    var printContent = document.getElementById("print-area").innerHTML;
    var sourceHTML = header + printContent + footer;
    
    var blob = new Blob(['\ufeff' + sourceHTML], {
        type: 'application/msword'
    });
    
    var fileName = 'Laporan_Kehadiran_Siswa_Kelas_{{ $kelas }}_' + bName + '_{{ $tahun }}.doc';
    
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
    var bName = "{{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bulan] ?? $bulan }}";
    var element = document.getElementById('print-area');
    var opt = {
      margin:       [0.4, 0.4, 0.4, 0.4],
      filename:     'Laporan_Kehadiran_Siswa_Kelas_{{ $kelas }}_' + bName + '_{{ $tahun }}.pdf',
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

