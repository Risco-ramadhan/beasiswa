<script>
    var ctx = document.getElementById("barChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach ($NIM as $A) {

                ?> '<?= $A->NIM ?>',

                <?php } ?>
            ],
            datasets: [
                <?php $j = 0 ?>
                <?php foreach ($datakriteria as $x) {
                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                    $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
                ?> {
                        label: "<?= $x->Nama_Kriteria ?>",
                        backgroundColor: "<?= $color ?>",
                        data: [
                            <?php
                            for ($i = 0; $i < count($NIM); $i++) {
                            ?>
                                <?php print_r($chart[$j][$i]->Nilai)  ?>,

                            <?php } ?>
                        ],
                    },
                <?php $j++;
                } ?>
            ],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: true
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        stepSize: 100
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                    }
                }]
            },
        }
    });
</script>