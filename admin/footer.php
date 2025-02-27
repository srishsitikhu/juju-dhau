<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="script.js"></script>
<div id="notification-container" style="position: fixed; top: 10px; right: 10px; z-index: 1050; width: 300px;">
    <div class="alert alert-dismissible fade" role="alert">
        <i style="margin right: 10px;"></i>
        <span class="notifyMsg"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".btn-close").on("click", function () {
            $(".alert").remove();
        });
    });
    setTimeout(function () {
        $(".alert.show").fadeOut(500, function () {
            $(this).remove();
        });
    }, 3000);
</script>

</body>

</html>