<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/dataTables.foundation.js"></script>
<script src="js/dataTables.jqueryui.js"></script>
<script src="js/dataTables.select.min.js"></script>
<script src="js/toastr.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script>
    $("table").on('click',".dropdown-toggle",function () {
                var temp =  $(this).siblings('ul')[0];
                dropDownFixPosition($(this), $(temp));
            });

            function dropDownFixPosition(button, dropdown) {
                var dropDownTop = button.offset().top + button.outerHeight();
                dropdown.css('top', dropDownTop + "px");
                dropdown.css('right', ($(window).width() - (button.offset().left + button.outerWidth())) + "px");
                dropdown.css('position', "fixed");
            }
</script>