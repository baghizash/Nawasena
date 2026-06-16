<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($judul) ?></title>
    <style>
        /* Reset dan gaya dasar */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            max-width: 1000px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Pesan jika tidak ada data */
        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>

    <h1><?= esc($judul) ?></h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th style="justify-content : center;">Email</th>
                <th>Jenis Kelamin</th>
                <th>Handphone</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users) && is_array($users)): ?>
                <?php foreach ($users as $index => $user): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($user->username) ?></td>
                        <td><?= esc($user->email) ?></td>
                        <td><?= esc($user->jenis_kelamin) ?></td>
                        <td><?= esc($user->handphone) ?></td>
                        <td><?= esc($user->created_at) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">Tidak ada data pengguna</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>