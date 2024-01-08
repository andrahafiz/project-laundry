<script>
    dashboard_transaksi();
    dashboard_feedback_1();
    dashboard_feedback_2();
    dashboard_feedback_3();
    dashboard_feedback_4();
    dashboard_feedback_5();

    function dashboard_transaksi() {
        var ctx = document.getElementById("myChart").getContext("2d");
        var dataLabels = {{ Js::from($data['chartTransactions']['labels']) }};
        var data = {{ Js::from($data['chartTransactions']['data']) }};
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var labels = dataLabels.map(item => {
            return monthNames[item - 1];
        })
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: dataLabels,
                datasets: [{
                    label: "Transaksi",
                    data: data,
                    borderWidth: 2,
                    backgroundColor: "rgba(63,82,227,.8)",
                    borderWidth: 0,
                    borderColor: "transparent",
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,.8)",
                }],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return "Rp. " + parseInt(value).toLocaleString();
                            },
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            display: true,
                            tickMarkLength: 15,
                        },
                    }, ],
                },
            },
        });
    }

    //Dashboard Feedback Pertanyaan 1
    function dashboard_feedback_1() {
        var ctx = document.getElementById("myChart4").getContext("2d");
        var dataLabels = {{ Js::from($data['Pertanyaan1']['labels']) }};
        var labels = dataLabels.map(item => {
            switch (item) {
                case 1:
                    return "Sangat Kurang"
                    break;

                case 2:
                    return "Kurang"
                    break;

                case 3:
                    return "Cukup"
                    break;

                case 4:
                    return "Baik"
                    break;

                case 5:
                    return "Sangat Baik"
                    break;

            }
        })

        var data = {{ Js::from($data['Pertanyaan1']['data']) }};
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: [
                        "#6050DC",
                        "#D52DB7",
                        "#FF2E7E",
                        "#FF6B45",
                        "#FFAB05",
                    ],
                    label: "Pertanyaan",
                }, ],
                labels: labels,
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                },
            },
        });
    }

    function dashboard_feedback_2() {
        var ctx = document.getElementById("myChart5").getContext("2d");
        var dataLabels = {{ Js::from($data['Pertanyaan2']['labels']) }};
        var labels = dataLabels.map(item => {
            switch (item) {
                case 1:
                    return "Sangat Kurang"
                    break;

                case 2:
                    return "Kurang"
                    break;

                case 3:
                    return "Cukup"
                    break;

                case 4:
                    return "Baik"
                    break;

                case 5:
                    return "Sangat Baik"
                    break;

            }
        })

        var data = {{ Js::from($data['Pertanyaan2']['data']) }};
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: [
                        "#6050DC",
                        "#D52DB7",
                        "#FF2E7E",
                        "#FF6B45",
                        "#FFAB05",
                    ],
                    label: "Pertanyaan",
                }, ],
                labels: labels,
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                },
            },
        });
    }

    function dashboard_feedback_3() {
        var ctx = document.getElementById("myChart6").getContext("2d");
        var dataLabels = {{ Js::from($data['Pertanyaan3']['labels']) }};
        var labels = dataLabels.map(item => {
            switch (item) {
                case 1:
                    return "Sangat Kurang"
                    break;

                case 2:
                    return "Kurang"
                    break;

                case 3:
                    return "Cukup"
                    break;

                case 4:
                    return "Baik"
                    break;

                case 5:
                    return "Sangat Baik"
                    break;

            }
        })

        var data = {{ Js::from($data['Pertanyaan3']['data']) }};
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: [
                        "#6050DC",
                        "#D52DB7",
                        "#FF2E7E",
                        "#FF6B45",
                        "#FFAB05",
                    ],
                    label: "Pertanyaan",
                }, ],
                labels: labels,
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                },
            },
        });
    }

    function dashboard_feedback_4() {
        var ctx = document.getElementById("myChart7").getContext("2d");
        var dataLabels = {{ Js::from($data['Pertanyaan4']['labels']) }};
        var labels = dataLabels.map(item => {
            switch (item) {
                case 1:
                    return "Sangat Kurang"
                    break;

                case 2:
                    return "Kurang"
                    break;

                case 3:
                    return "Cukup"
                    break;

                case 4:
                    return "Baik"
                    break;

                case 5:
                    return "Sangat Baik"
                    break;

            }
        })

        var data = {{ Js::from($data['Pertanyaan4']['data']) }};
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: [
                        "#6050DC",
                        "#D52DB7",
                        "#FF2E7E",
                        "#FF6B45",
                        "#FFAB05",
                    ],
                    label: "Pertanyaan",
                }, ],
                labels: labels,
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                },
            },
        });
    }

    function dashboard_feedback_5() {
        var ctx = document.getElementById("myChart8").getContext("2d");
        var dataLabels = {{ Js::from($data['Pertanyaan5']['labels']) }};
        var labels = dataLabels.map(item => {
            switch (item) {
                case 1:
                    return "Sangat Kurang"
                    break;

                case 2:
                    return "Kurang"
                    break;

                case 3:
                    return "Cukup"
                    break;

                case 4:
                    return "Baik"
                    break;

                case 5:
                    return "Sangat Baik"
                    break;

            }
        })

        var data = {{ Js::from($data['Pertanyaan3']['data']) }};
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: [
                        "#6050DC",
                        "#D52DB7",
                        "#FF2E7E",
                        "#FF6B45",
                        "#FFAB05",
                    ],
                    label: "Pertanyaan",
                }, ],
                labels: labels,
            },
            options: {
                responsive: true,
                legend: {
                    position: "bottom",
                },
            },
        });
    }

    //Pertanyaan 2
</script>
