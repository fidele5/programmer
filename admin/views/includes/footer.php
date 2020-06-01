
        <!-- jQuery -->
        <script type="text/javascript" src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/jquery-3.4.0.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/mdb.min.js"></script>
        <script type="text/javascript" src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/addons/datatables.min.js"></script>
        <script type="text/javascript" src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/addons/datatables-select.js"></script>
        <script src="http://<?=$_SERVER["HTTP_HOST"]?>/programator/public/js/datable.js" type="text/javascript"></script>
        <script>
            new WOW().init();
            // SideNav Button Initialization
            $(".button-collapse").sideNav();
            // SideNav Scrollbar Initialization
            var sideNavScrollbar = document.querySelector(".custom-scrollbar");
            Ps.initialize(sideNavScrollbar);
    </script>
    <script>
        $("#dt-less-columns").mdbEditor();
        $(".dataTables_length").addClass("bs-select");
    </script>
    <script>
        // Data Picker Initialization
        $(".datepicker").pickadate();
    </script>
    <script>
        // Material Select Initialization
        $(document).ready(function() {
        $(".mdb-select").materialSelect();
        });
    </script>
    </body>
</html>