<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian - Bali Pure Manufacturer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 900px;
            background: white;
            margin: 20px auto;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #333;
            font-size: 28px;
        }

        .business-name {
            font-size: 16px;
            color: #555;
            margin-top: 5px;
        }

        .info {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .info p {
            margin: 8px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        .table th {
            background-color: #f8f8f8;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            font-size: 16px;
            color: #555;
            margin-top: 30px;
        }

        .print-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 12px;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Struk Pembelian</h2>
            <p class="business-name">Bali Pure Manufacturer</p>
        </div>

        <!-- Informasi Pesanan -->
        <div class="info">
            <p><strong>Order ID:</strong> {{ $order->order_number }}</p>
            <p><strong>Nama:</strong> {{ $order->name }}</p>
            <p><strong>Telepon:</strong> {{ $order->phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}, {{ $order->postal_code }}</p>
        </div>

        <!-- Tabel Produk -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>Rp{{ number_format($order->product->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Harga -->
        <div class="total">
            Total Pembayaran: Rp{{ number_format($order->total, 0, ',', '.') }}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah berbelanja di Bali Pure Manufacturer!</p>
        </div>
    </div>

</body>

</html>
