<!-- Footer -->

    <!-- jQuery -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/sb-admin-2.js"></script>

    <script>
    //animate bootstrap notification boxes
        window.setTimeout(function () {
            jQuery(".alert").fadeTo(500, 0).slideUp(1000, function () {
                jQuery(this).remove();
            });
        }, 3000);
    </script>