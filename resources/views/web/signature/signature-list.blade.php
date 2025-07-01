<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Signatures</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        img {
            max-width: 150px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <h1>Submitted Signatures</h1>

    @if($signatures->isEmpty())
        <p>No signatures found.</p>
    @else
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Signature</th>
                <th>IP Address</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($signatures as $signature)
                <tr>
                    <td>{{ $signature->id }}</td>
                    <td>{{ ucfirst($signature->signature_type) }}</td>
                    <td>
                        @if ($signature->signature_type === 'draw')
                            <img src="{{ $signature->signature_data }}" alt="Signature" style="max-width: 150px;">
                        @else
                            {!! $signature->signature_data !!}
                        @endif
                    </td>
                    <td>{{ $signature->ip_address }}</td>
                    <td>{{ $signature->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>
