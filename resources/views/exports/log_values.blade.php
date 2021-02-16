<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        th,
        td {
            padding: 15px;
            text-align: left;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body>
    <div>
        <table>
            <tr>
                <th>NO</th>
                <th>DATETIME</th>
                <th>TANK 1</th>
                <th>TANK 2</th>
                <th>FLOW RATE</th>
                <th>TOTALIZER</th>
                <th>GALLON</th>
            </tr>
            @foreach ($data['ultrasonic_sensor11'] as $log)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data['ultrasonic_sensor11'][$loop->index]->datetime}}</td>
                <td>{{$data['ultrasonic_sensor11'][$loop->index]->value}}</td>
                <td>{{$data['ultrasonic_sensor12'][$loop->index]->value}}</td>
                <td>{{$data['liter_permenit1'][$loop->index]->value}}</td>
                <td>{{$data['flow_litre1'][$loop->index]->value}}</td>
                <td>{{floor($data['flow_litre1'][$loop->index]->value / 19)}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
