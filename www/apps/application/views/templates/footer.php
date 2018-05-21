
</div>
<script>
  $(document).ready(function() {
    // matchHeight the contents of each .card-pf and then the .card-pf itself
    $(".row-cards-pf > [class*='col'] > .card-pf .card-pf-title").matchHeight();
    $(".row-cards-pf > [class*='col'] > .card-pf > .card-pf-body").matchHeight();
    $(".row-cards-pf > [class*='col'] > .card-pf > .card-pf-footer").matchHeight();
    $(".row-cards-pf > [class*='col'] > .card-pf").matchHeight();

    // Initialize the vertical navigation
    $().setupVerticalNavigation(true);

    var title = "<?php echo $title; ?>";
    window.document.title = title;

    $('.table').not('.table-normal').DataTable({
      'pageLength': $('.table').hasClass('table-limit-10') ? 10 : 50,
    });

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
  });
</script>
</body>

</html>
