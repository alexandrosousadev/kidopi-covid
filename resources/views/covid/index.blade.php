<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19 Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .country-card {
            margin-bottom: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Covid-19 Tracker</h1>
        
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <select id="countrySelect" class="form-select">
                    <option value="">Select a country</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Canada">Canada</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>
        </div>

        <div id="covidData" class="row">
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            @if($lastAccess)
                Last access: {{ $lastAccess->accessed_at }} - Country: {{ $lastAccess->country }}
            @endif
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#countrySelect').change(function() {
                const country = $(this).val();
                if (country) {
                    $.get(`/covid-data/${country}`, function(data) {
                        displayCovidData(data);
                    });
                }
            });

            function displayCovidData(data) {
                let totalConfirmed = 0;
                let totalDeaths = 0;
                let html = '';

                Object.values(data).forEach(region => {
                    totalConfirmed += region.Confirmados;
                    totalDeaths += region.Mortos;
                    
                    html += `
                        <div class="col-md-4">
                            <div class="card country-card">
                                <div class="card-body">
                                    <h5 class="card-title">${region.ProvinciaEstado}</h5>
                                    <p class="card-text">
                                        Confirmed: ${region.Confirmados.toLocaleString()}<br>
                                        Deaths: ${region.Mortos.toLocaleString()}
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $('#covidData').html(`
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>Total Cases: ${totalConfirmed.toLocaleString()}</h4>
                                <h4>Total Deaths: ${totalDeaths.toLocaleString()}</h4>
                            </div>
                        </div>
                    </div>
                    ${html}
                `);
            }
        });
    </script>
</body>
</html>