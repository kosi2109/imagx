    

    <!-- error handler -->
    <script>
        <?php if(error()) :?>
            <?php foreach(error() as $error) : ?>
                Toastify({
                text: "<?= $error ?>",
                className: "error",
                }).showToast();
            <?php endforeach ; ?>
        <?php endif ;?>
        <?php if(isset($_SESSION["success"])) :?>
            Toastify({
            text: "<?= $_SESSION["success"] ?>",
            className: "info",
            }).showToast();
        <?php endif ;?>
    </script>
</body>
</html>