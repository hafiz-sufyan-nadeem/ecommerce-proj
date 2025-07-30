@component('mail::message')
    # Thanks!, {{ $order->name }}!

    Your order has been received and is in **Pending** status.

    **Order ID:** #{{ $order->id }}
    **Total Price:** Rs {{ $order->total_price }}

    We will update you when the order is approved or canceled.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
