<script>
    var ctx = document.getElementById("barChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5'],
            label: 'My First Dataset',
            fill: false,
            datasets: [65, 59, 80, 81, 56],
            backgroundColor: '#4287f5'
        },
        options: {
            indexAxis: 'y',
        }
    });
</script>