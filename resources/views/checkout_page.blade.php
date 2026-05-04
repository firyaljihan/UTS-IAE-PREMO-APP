<div style="text-align: center; font-family: sans-serif;">
    <h1>Selesaikan Pembayaran</h1>
    <p>Order ID: {{ $order->idOrder }}</p>
    <p>Produk: {{ $order->nama_app }}</p>
    <h3>Total: Rp{{ number_format($order->total_harga) }}</h3>
    <img src="{{ $qr_link }}" alt="QRIS" style="width: 300px;">
    <p>Silakan scan QRIS di atas untuk membayar.</p>
</div>
