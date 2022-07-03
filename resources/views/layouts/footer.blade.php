<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {{ setting('copyright', now()->year) }} <i class="bx bx-copyright"></i> {{ strtoupper(setting('nama_kantor')) }}
                - {{ setting('footer', 'Pemerintah Kabupaten Kolaka Utara') }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Dikembangkan Oleh <a href="https://resometoda.com" class="text-decoration-underline">RESOMETODA</a>
                </div>
            </div>
        </div>
    </div>
</footer>
