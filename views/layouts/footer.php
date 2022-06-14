    

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
        <?php if(success()) :?>
            <?php foreach(success() as $success) : ?>
                Toastify({
                text: "<?= $success ?>",
                className: "success",
                }).showToast();
            <?php endforeach ; ?>
        <?php endif ;?>
    </script>
</body>
</html>