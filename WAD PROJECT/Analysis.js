fetch('Analysis1.php')
            .then(response => response.json())
            .then(data => {
                // Prepare data for the chart
                const branches = data.map(item => item.branch);
                const totalStudents = data.map(item => item.total_students);
                const placedStudents = data.map(item => item.placed_students);

                // Create the chart data object
                const chartData = {
                    labels: branches,
                    datasets: [
                        {
                            label: 'Total Students',
                            data: totalStudents,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)'
                        },
                        {
                            label: 'Placed Students',
                            data: placedStudents,
                            backgroundColor: 'rgba(153, 102, 255, 0.6)'
                        }
                    ]
                };

                // Create the chart configuration
                const config = {
                    type: 'bar',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                // Render the chart
                const jobStatusChart = new Chart(
                    document.getElementById('barChart'),
                    config
                );
            })
            .catch(error => console.error(error));

        // Helper function to generate random colors
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }