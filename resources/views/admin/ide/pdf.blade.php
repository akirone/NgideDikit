<!DOCTYPE html>
<html>
<head>
    <title>Daftar Ide</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .header-info {
            text-align: right;
            margin-bottom: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Daftar Ide</h2>
    <div class="header-info">
        Tanggal: {{ date('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Favorit</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ideas as $index => $idea)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $idea->title }}</td>
                <td>{{ $idea->categories->pluck('name')->join(', ') }}</td>
                <td>{{ $idea->is_favorite ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $idea->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
