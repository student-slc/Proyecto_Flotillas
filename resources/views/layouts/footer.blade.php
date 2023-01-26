<div class="footer-left">
    Derechos Reservados Empresa Virtual
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/selectize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
<script>
    $('.selectsearch').selectize({
        plugins: ['remove_button'],
        sortField: 'text'
    });
</script>
{{-- SCRIPT BUSCADOR --}}
<script>
    // Write on keyup event of keyword input element
    $(document).ready(function() {
        $("#search").keyup(function() {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#tabla tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>
{{--  --}}
