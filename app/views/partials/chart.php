<script type="module">
    $('.chart-container>.loader').html('');
    // Graphs
    var ctx = document.getElementById("<?= $id ?>").getContext('2d');
    var myChart = new Chart(ctx, {
        type: "<?= $type ?>",
        data: {
            labels: <?= $labels ?>,
            datasets: [{
                label: "<?= $label ?>",
                data: [<?= implode(",", $data) ?>],
                backgroundColor: [
                    '<?= $backgroundColor  ?>'
                ],
                borderColor: [
                    '<?= $backgroundColor  ?>'
                ],
                <?= isset($_extra) ? $_extra : null ?>,
            }]
        },
        options: {
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: 'black'
                }
            },
            scales: {
                angleLines: {
                    display: false
                },
            }
        }
    });
</script>