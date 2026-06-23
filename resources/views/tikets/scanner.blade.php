@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden p-8 text-center border-t-8 border-indigo-600">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Scanner Tiket Bioskop</h2>
        <p class="text-gray-500 mb-8">Arahkan kamera ke QR Code milik penonton</p>

        <div class="mx-auto bg-gray-100 p-2 rounded-xl mb-6 shadow-inner max-w-md">
            <div id="reader" class="rounded-lg overflow-hidden"></div>
        </div>

        <div id="resultBox" class="hidden mx-auto max-w-md p-4 rounded-lg font-bold text-lg shadow-md transition-all duration-300">
            </div>

        <div class="mt-10">
            <a href="{{ route('tikets.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg transition duration-200">
                &larr; Kembali ke Daftar Tiket
            </a>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    // Ambil token keamanan dari layout utama
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const resultBox = document.getElementById('resultBox');
    
    // Kunci gembok agar tidak terjadi scan dobel saat proses masih berjalan
    let isProcessing = false; 

    // Setting ukuran kotak kamera
    const html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", 
        { fps: 10, qrbox: {width: 250, height: 250} },
        false
    );

    function onScanSuccess(decodedText) {
        if (isProcessing) return; 

        isProcessing = true; 
        
        resultBox.classList.remove('hidden');
        resultBox.className = "mt-6 mx-auto max-w-md p-4 rounded-lg font-bold text-lg text-white bg-blue-500 shadow-lg";
        resultBox.innerHTML = "Memproses tiket...";

        fetch("{{ route('tikets.scan') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ kode_tiket: decodedText })
        })
        .then(response => response.json())
        .then(data => {
            // Jika sukses (Status berubah jadi scanned)
            if(data.success) {
                resultBox.className = "mt-6 mx-auto max-w-md p-4 rounded-lg font-bold text-lg text-white bg-green-500 shadow-lg";
                resultBox.innerHTML = "✅ " + data.message;
            } 
            // Jika gagal (Tiket tidak valid / sudah dipakai)
            else {
                resultBox.className = "mt-6 mx-auto max-w-md p-4 rounded-lg font-bold text-lg text-white bg-red-600 shadow-lg";
                resultBox.innerHTML = "❌ " + data.message;
            }

            // Hilangkan pesan setelah 3 detik dan buka gembok agar bisa scan tiket selanjutnya
            setTimeout(() => {
                resultBox.classList.add('hidden');
                isProcessing = false; 
            }, 3000);
        })
        .catch(error => {
            resultBox.className = "mt-6 mx-auto max-w-md p-4 rounded-lg font-bold text-lg text-white bg-red-600 shadow-lg";
            resultBox.innerHTML = "❌ Terjadi kesalahan jaringan.";
            setTimeout(() => { 
                resultBox.classList.add('hidden'); 
                isProcessing = false; 
            }, 3000);
        });
    }

    html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection