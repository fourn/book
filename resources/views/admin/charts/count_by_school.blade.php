<canvas id="{{ $id }}" width="10" height="11"></canvas>
<script>

    $(function () {
        var ctx = document.getElementById("{{ $id }}").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: {!! $labels !!},
                datasets: [{
                    label: '{{ $label }}',
                    data: {!! $data !!},
                    borderWidth: 1,
                }],

            },
            options: {
                defaultColor:'rgba(54, 162, 235, 1)',
                tooltips:{

                    intersect:false,

                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },



            }
        });
    });
</script>