    

    <!-- error handler -->
    <script>
        <?php if(error("message")) :?>
            Toastify({
            text: "<?= error("message") ?>",
            }).showToast();
        <?php endif ;?>
        <?php if(isset($_SESSION["success"])) :?>
            Toastify({
            text: "<?= $_SESSION["success"] ?>",
            }).showToast();
        <?php endif ;?>
    </script>
</body>
</html>