</div>
</div>
</div>
</div>
</div>
<script>
        $('.ui.search.dropdown').dropdown({
            fullTextSearch: true, 
            sortSelect: true, 
            match:'text',
            onChange: function(value) {
            var arraypos = value;
            jQuery.ajax({
                url: '/wallfly-mvc/public/dashboard/selectedProperty',
                type: "POST",
                data: {
                    selected: arraypos
                },
                success: function (result) {
                 window.location.reload();
              
                },
                error: function (result) {
                    alert('Exeption:' + exception);
                }
            });
            }

    });

</script>