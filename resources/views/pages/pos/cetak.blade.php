<style>
    table {
        width: 300px;
    }
</style>

<a href="{{ URL::to('/admin/pos') }}">kembali</a>

<table border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td align="center" colspan="3">Villa and resto</td>
    </tr>
    <tr>
        <td align="center" colspan="3">-----------------------------------------------------</td>
    </tr>
    @php
        $total = 0;
    @endphp
    @foreach ($tagihan as $row)
        @php
            $total += $row->menu->harga * $row->qty;
        @endphp
        <tr>
            <td align="right">{{ $row->qty }} x </td>
            <td>{{ $row->menu->nama_menu }}</td>
            <td align="right">Rp. {{ number_format($row->menu->harga * $row->qty) }}</td>
        </tr>
    @endforeach
    <tr>
        <td align="center" colspan="3">-----------------------------------------------------</td>
    </tr>
    <tr>
        <td align="center" colspan="2">Total</td>
        <td align="right">Rp. {{ number_format($total) }}</td>
    </tr>
    <tr>
        <td align="center" colspan="2">Pembayaran</td>
        <td align="right">Rp. {{ number_format($pembayaran) }}</td>
    </tr>
    <tr>
        <td align="center" colspan="2">Kembalian</td>
        <td align="right">Rp. {{ number_format($pembayaran - $total) }}</td>
    </tr>
</table>
