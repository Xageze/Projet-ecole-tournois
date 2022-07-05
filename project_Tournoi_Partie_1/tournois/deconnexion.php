<script type="text/javascript">
function deco() {
    <?php
        session_start();
        session_destroy();
        //Variable utilisateur connecté ou pas
        header("Location: ./");
    ?>
}
window.onload = deco;
</script>
