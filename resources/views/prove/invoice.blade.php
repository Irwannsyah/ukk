<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            width: 100%;
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f4f4f4;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="header">
            <h2>Invoice</h2>
            <p><strong>Status:</strong> {{ $data->status }}</p>
        </div>

        <div class="info">
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Destinasi:</strong> {{ $data->destination->title }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jumlah Tiket</th>
                    <th>Harga Tiket</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Kunjungan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $data->ticket }}</td>
                    <td>Rp {{ number_format($data->destination->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($data->gross_amount, 0, ',', '.') }}</td>
                    <td>{{ $data->paymen_type }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->visit_date)) }}</td>
                </tr>
            </tbody>
        </table>

        <p class="total">Total Bayar: Rp {{ number_format($data->gross_amount, 0, ',', '.') }}</p>
    </div>

</body>
</html>
