<input class="form-control" type="text" name="birthday" value="10/24/1984" />






<script type="text/javascript" src="/src/js/jquery.min.js"></script>
<script type="text/javascript" src="/src/js/moment.min.js"></script>
<script type="text/javascript" src="/src/js/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="/src/css/daterangepicker.css" />
<script>
    $(function() {
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePicker24Hour: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
            // var years = moment().diff(start, 'years');
            // alert("You are " + years + " years old!");
        });
    });
</script>
