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
                <th>TSTAMP</th>
                <th>PH</th>
                <th>TSS</th>
                <th>AMONIA</th>
                <th>COD</th>
                <th>FLOW_METER</th>
     
                <th>controller_name</th>
            </tr>
            @foreach ($backup as $b)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$b->tstamp}}</td>
                <td>{{ number_format($b->ph,2,",",".")}}</td>
                <td>{{ number_format($b->tss,2,",",".")}}</td>
                <td>{{ number_format($b->amonia,2,",",".")}}</td>
                <td>{{ number_format($b->cod,2,",",".")}}</td>
                <td>{{ number_format($b->flow_meter,2,",",".")}}</td>
               
                <td>{{$b->controller_name}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
