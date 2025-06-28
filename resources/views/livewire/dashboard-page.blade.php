<div>
    <x-partials.sidebar currentUrl="{{ $currentUrl }}">
        <div class="p-2">
            <!-- Header -->
            <h1 class="text-2xl font-bold mb-6">Dashboard QC</h1>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="p-5 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Total Pemeriksaan</p>
                    <p class="text-2xl font-bold">{{ $totalPemeriksaan }}</p>
                </div>
                <div class="p-5 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Produk OK</p>
                    <p class="text-2xl font-bold">{{ $totalOK }}</p>
                </div>
                <div class="p-5 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Produk Defect</p>
                    <p class="text-2xl font-bold">{{ $totalNG }}</p>
                </div>
            </div>

            <!-- Chart Area -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <h2 class="text-lg font-semibold mb-4">Jumlah Pemeriksaan per Produk</h2>

                <!-- Chart wrapper with fixed height -->
                <div class="relative w-full h-[400px]">
                    <canvas id="qcChart" class="w-full h-full"></canvas>
                </div>

                <div class="flex justify-center mt-4 space-x-6 text-sm text-gray-600">
                    <div><span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>OK</div>
                    <div><span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>Defect</div>
                </div>
            </div>

        </div>
    </x-partials.sidebar>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("livewire:navigated", () => {
            setTimeout(() => {
                console.log("navigated");

                const canvas = document.getElementById('qcChart');
                if (!canvas) {
                    console.warn('qcChart not found');
                    return;
                }

                const ctx = canvas.getContext('2d');

                // Hapus chart lama jika ada
                if (window.qcChart instanceof Chart) {
                    window.qcChart.destroy();
                }

                // Buat chart baru
                window.qcChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($labels),
                        datasets: [
                            {
                                label: 'OK',
                                data: @json($okData),
                                borderColor: '#3b82f6',
                                backgroundColor: '#3b82f6',
                                fill: false,
                                tension: 0.3
                            },
                            {
                                label: 'Defect',
                                data: @json($ngData),
                                borderColor: '#ef4444',
                                backgroundColor: '#ef4444',
                                fill: false,
                                tension: 0.3
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }, 200); // beri waktu DOM selesai render
        });
    </script>

</div>
