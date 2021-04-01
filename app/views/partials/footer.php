<footer>
    <!-- Footer here !!  -->    
</footer>

<!-- Scripts -->
<?php foreach ($js as $_js) : ?>
    <script src="<?= HTTP_ASSET_PATH . $_js ?>"></script>
<?php endforeach; ?>
<script>
    console.log('All Loads!!');
</script>
<!-- Scripts Ends -->

</body>

</html>