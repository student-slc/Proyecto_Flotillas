<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.1/howler.min.js"></script>

@if (session('SweetAlert'))
    <script>
        $(window).on('load', function() {
            let $SweetAlert = {!! json_encode(session('SweetAlert') ?? $SweetAlert) !!};
            Swal.fire({
                icon: $SweetAlert.icon,
                title: $SweetAlert.title,
                text: $SweetAlert.text,
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
@endif