<!-- Scripts Placed at the end of the document so the pages load faster -->
<!--================================================== -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script> --}}
{{-- <script>window.jQuery || document.write('<script src="{{ asset('assets/jquery/dist/jquery.min.js') }}">\x3C/script<\/script>');</script> --}}
{{-- <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script> --}}
<script>window.jQuery || document.write('<script src="{{ asset('js/jquery-1.11.3.min.js') }}">\x3C/script<\/script>');</script>
<script>window.Modernizr || document.write('<script src="{{ asset('js/modernizr-2.6.2.min.js') }}">\x3C/script<\/script>');</script>
<script src="{{ asset("assets/datepicker/bootstrap-datepicker.js") }}"></script>
<script type="text/javascript">
     //Date picker
    $('.datepicker').datepicker({
      	format: 'yyyy-mm-dd',
      	autoclose: true
    });

</script>
