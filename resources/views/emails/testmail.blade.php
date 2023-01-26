<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>

<div class="card m-3 p-3 w-50">
    <center>
        <h3>Order Confirmation</h3>

        Dear {{$sale->customer->name}}, thank you for your order!<br>
        We have received your order and we will contact you as soon.<br>
        You can find your purchase information below
        <br>
        <h3>Order Summary</h3>
        @foreach($sale->items as $item)
            <div class="card p-1 m-2">
                <div class="d-flex">
                    <img src="{{$item->product->image}}" width="100" height="100"/>
                    <div class="m-2 align-left">
                        <strong>{{$item->product->name}}</strong>
                        <br>
                        <strong> Rs {{$item->product->sale_price}}</strong>
                        <br>
                        <strong>Qty: {{$item->quantity}}</strong>
                    </div>
                </div>
            </div>
        @endforeach

        <h3>Order Total: Rs {{$sale->getTotal()}}</h3>


        <h3>Shipping address</h3>
        {{$sale->customer->name}}<br>
        {{$sale->customer->phone_number}}<br>
        H#{{$sale->site->house}}, St#{{$sale->site->street}}, Sec#{{$sale->site->sector}}<br>


    </center>

</div>

</body>
</html>
