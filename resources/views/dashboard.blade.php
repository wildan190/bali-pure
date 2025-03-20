<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-4 rounded-xl">
        <!-- Card Statistik -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h3 class="text-xl font-bold mb-2">Pendapatan</h3>
                <p class="text-3xl font-semibold text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h3 class="text-xl font-bold mb-2">Jumlah Pembeli</h3>
                <p class="text-3xl font-semibold text-blue-600">{{ $totalCustomers }}</p>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h3 class="text-xl font-bold mb-2">Pesanan Sukses</h3>
                <p class="text-3xl font-semibold text-indigo-600">{{ $totalCustomers }}</p>
                <!-- Asumsi pesanan sukses sama dengan jumlah pembeli -->
            </div>
        </div>

        <!-- Chart Pendapatan Bulanan -->
        <div
            class="relative h-96 w-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <h3 class="text-xl font-bold mb-4">Pendapatan Bulanan</h3>
            <canvas id="monthlyChart"></canvas>
        </div>

        <!-- Chart Pendapatan Tahunan -->
        <div
            class="relative h-96 w-full overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <h3 class="text-xl font-bold mb-4">Pendapatan Tahunan</h3>
            <canvas id="yearlyChart"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart Pendapatan Bulanan
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'bar', // Menggunakan bar chart untuk bulanan
                data: {
                    //labels: @json($months), // Nama bulan
                    datasets: [{
                        label: 'Pendapatan Bulanan',
                        data: @json($monthlyRevenue), // Data pendapatan bulanan
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Pendapatan (Rp)'
                            }
                        }
                    }
                }
            });

            // Chart Pendapatan Tahunan
            const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
            const yearlyChart = new Chart(yearlyCtx, {
                type: 'bar', // Menggunakan bar chart untuk tahunan
                data: {
                    labels: @json($years), // Tahun
                    datasets: [{
                        label: 'Pendapatan Tahunan',
                        data: @json($yearlyRevenue), // Data pendapatan tahunan
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Pendapatan (Rp)'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layouts.app>
