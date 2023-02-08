<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td align="center">{{ $coupon->id }}</td>
            <td>{{ $coupon->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
