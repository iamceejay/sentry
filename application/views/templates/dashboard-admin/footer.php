

</div>

<toaster-container toaster-options="{'close-button': true}"></toaster-container>

<!-- Menu Toggle Script -->
<script>
var toggled = false;

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");

    if(!toggled) {
        $("#builder-area").removeClass("col-sm-7");
        $("#builder-area").addClass("col-sm-6 col-sm-offset-1");
        toggled = true;
    } else {
        $("#builder-area").addClass("col-sm-7");
        $("#builder-area").removeClass("col-sm-6 col-sm-offset-1");
        toggled = false;
    }
});
</script>

</body>
</html>