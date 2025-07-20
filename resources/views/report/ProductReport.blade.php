<html>
<head>
    <style>
        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px !important;
        }

        .customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .customers tr:nth-child(even){background-color: #f2f2f2;}

        .customers tr:hover {background-color: #ddd;}

        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 6px;
            text-align: left;
            background-color: #212529;
            color: white;
        }
    </style>
</head>
<body>

<h3>Summary</h3>

<table class="customers" >
    <thead>
    <tr>
        <th>Report</th>
        <th>Date</th>
        <th>Total Product</th>
        <th>Total price</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Product Report</td>
        <td>{{$FormDateProduct}} to {{$ToDateProduct}}</td>
        <td>{{$productName}}</td>
        <td>{{$productPrice}}</td>
    </tr>
    </tbody>
</table>


<h3>Details</h3>
<table class="customers" >
    <thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Unit</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($list as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->unit}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach

    </tbody>
</table>
</body>
</html>