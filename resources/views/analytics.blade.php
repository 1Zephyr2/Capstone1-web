<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analytics - CareSync</title>
    <link rel="icon" href="/favicon.ico?v={{ time() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 40px;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 28px 36px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left h1 {
            font-size: 32px;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .header-left p {
            font-size: 14px;
            color: #6b7280;
        }

        .tech-badge {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .back-btn {
            background: #059669;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: #047857;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .metric-card {
            background: white;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 4px solid #059669;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .metric-label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-value {
            font-size: 40px;
            font-weight: 800;
            color: #059669;
            margin-bottom: 10px;
            line-height: 1;
        }

        .metric-trend {
            font-size: 13px;
            padding: 5px 12px;
            border-radius: 6px;
            display: inline-block;
            font-weight: 600;
        }

        .trend-up {
            background: #d1fae5;
            color: #065f46;
        }

        .trend-down {
            background: #fee2e2;
            color: #991b1b;
        }

        .trend-neutral {
            background: #e0e7ff;
            color: #3730a3;
        }

        .insights-section {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
        }

        .insights-section h3 {
            color: #111827;
            margin-bottom: 24px;
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .insight-item {
            padding: 20px;
            margin-bottom: 14px;
            border-left: 4px solid #059669;
            background: linear-gradient(to right, #f0fdf4 0%, #ffffff 100%);
            border-radius: 8px;
            transition: all 0.2s;
        }

        .insight-item:hover {
            background: linear-gradient(to right, #ecfdf5 0%, #f9fafb 100%);
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.1);
        }

        .insight-item h4 {
            color: #059669;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 700;
        }

        .insight-item p {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.7;
        }

        .charts-section {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 22px;
            color: #111827;
            font-weight: 700;
            margin-bottom: 24px;
            padding-left: 4px;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
        }

        .chart-card {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.2s;
        }

        .chart-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .chart-card h3 {
            color: #111827;
            margin-bottom: 24px;
            font-size: 17px;
            font-weight: 700;
        }

        .chart-container {
            position: relative;
            height: 320px;
        }

        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>
                    <span>Data Analytics</span>
                </h1>
                <p>Advanced insights and predictive analytics for data-driven healthcare decisions</p>
            </div>
            <a href="{{ route('dashboard') }}" class="back-btn">
                <span>←</span>
                <span>Back to Dashboard</span>
            </a>
        </div>

        <!-- Key Metrics -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-label">Total Patients</div>
                <div class="metric-value">{{ number_format($metrics['total_patients']) }}</div>
                <span class="metric-trend trend-neutral">All time</span>
            </div>

            <div class="metric-card">
                <div class="metric-label">Visits This Month</div>
                <div class="metric-value">{{ number_format($metrics['current_month_visits']) }}</div>
                <span class="metric-trend {{ $metrics['visit_growth_rate'] > 0 ? 'trend-up' : ($metrics['visit_growth_rate'] < 0 ? 'trend-down' : 'trend-neutral') }}">
                    {{ $metrics['visit_growth_rate'] > 0 ? '+' : '' }}{{ $metrics['visit_growth_rate'] }}% vs last month
                </span>
            </div>

            <div class="metric-card">
                <div class="metric-label">Immunization Completion</div>
                <div class="metric-value">{{ $metrics['completion_rate'] }}%</div>
                <span class="metric-trend trend-neutral">{{ number_format($metrics['total_immunizations']) }} total records</span>
            </div>

            <div class="metric-card">
                <div class="metric-label">Predicted Next Month</div>
                <div class="metric-value">{{ number_format($metrics['predicted_next_month']) }}</div>
                <span class="metric-trend trend-up">Based on trend analysis</span>
            </div>
        </div>

        <!-- Predictive Insights -->
        <div class="insights-section">
            <h3>🔮 Predictive Insights & Recommendations</h3>
            
            <div class="insight-item">
                <h4>Visit Forecast</h4>
                <p>Based on the last 3 months average ({{ $metrics['avg_monthly_visits'] }} visits/month) and current growth rate ({{ $metrics['visit_growth_rate'] }}%), we predict approximately <strong>{{ $metrics['predicted_next_month'] }} visits next month</strong>. Consider staffing adjustments accordingly.</p>
            </div>

            @if($metrics['visit_growth_rate'] > 15)
            <div class="insight-item">
                <h4>High Growth Alert</h4>
                <p>Patient visits are increasing significantly (+{{ $metrics['visit_growth_rate'] }}%). This indicates growing demand for services. Recommend expanding clinic hours or adding staff to maintain service quality.</p>
            </div>
            @elseif($metrics['visit_growth_rate'] < -15)
            <div class="insight-item">
                <h4>Declining Trend Alert</h4>
                <p>Patient visits have decreased by {{ abs($metrics['visit_growth_rate']) }}%. Consider implementing community outreach programs or reviewing service accessibility to re-engage patients.</p>
            </div>
            @endif

            @if($metrics['completion_rate'] < 50)
            <div class="insight-item">
                <h4>Immunization Follow-up Needed</h4>
                <p>Only {{ $metrics['completion_rate'] }}% of immunizations are completed. Many patients need follow-up doses. Implement automated reminder system to improve completion rates.</p>
            </div>
            @endif

            @if($metrics['high_risk_prenatal'] > 5)
            <div class="insight-item">
                <h4>High-Risk Prenatal Cases</h4>
                <p>Currently tracking {{ $metrics['high_risk_prenatal'] }} high-risk prenatal cases. Ensure regular monitoring and consider specialized care coordination for these patients.</p>
            </div>
            @endif
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <h2 class="section-title">📊 Visual Analytics</h2>
            
            <div class="charts-grid">
                <!-- Patient Growth -->
                <div class="chart-card">
                    <h3>📈 Patient Registration Trend (6 Months)</h3>
                    <div class="chart-container">
                        <canvas id="patientGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Visit Trends -->
                <div class="chart-card">
                    <h3>🏥 Daily Visit Patterns (30 Days)</h3>
                    <div class="chart-container">
                        <canvas id="visitTrendsChart"></canvas>
                    </div>
                </div>

                <!-- Service Distribution -->
                <div class="chart-card">
                    <h3>🎯 Service Type Distribution</h3>
                    <div class="chart-container">
                        <canvas id="serviceDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Age Demographics -->
                <div class="chart-card">
                    <h3>👥 Age Demographics</h3>
                    <div class="chart-container">
                        <canvas id="ageDemographicsChart"></canvas>
                    </div>
                </div>

                <!-- Gender Distribution -->
                <div class="chart-card">
                    <h3>⚧ Gender Distribution</h3>
                    <div class="chart-container">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Immunization Coverage -->
                <div class="chart-card">
                    <h3>💉 Top 10 Vaccines Administered</h3>
                    <div class="chart-container">
                        <canvas id="immunizationCoverageChart"></canvas>
                    </div>
                </div>

                <!-- High-Risk Prenatal Trend -->
                <div class="chart-card">
                    <h3>⚠️ High-Risk Prenatal Cases Trend</h3>
                    <div class="chart-container">
                        <canvas id="highRiskPrenatalChart"></canvas>
                    </div>
                </div>

                <!-- Top Complaints -->
                <div class="chart-card">
                    <h3>💬 Top 5 Chief Complaints</h3>
                    <div class="chart-container">
                        <canvas id="topComplaintsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart.js Configuration
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
        Chart.defaults.color = '#6b7280';

        // Patient Growth Chart
        new Chart(document.getElementById('patientGrowthChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($patientGrowth->pluck('month')) !!},
                datasets: [{
                    label: 'New Patients',
                    data: {!! json_encode($patientGrowth->pluck('count')) !!},
                    borderColor: '#059669',
                    backgroundColor: 'rgba(5, 150, 105, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Visit Trends Chart
        new Chart(document.getElementById('visitTrendsChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($visitTrends->pluck('date')) !!},
                datasets: [{
                    label: 'Daily Visits',
                    data: {!! json_encode($visitTrends->pluck('count')) !!},
                    borderColor: '#047857',
                    backgroundColor: 'rgba(4, 120, 87, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Service Distribution Chart
        new Chart(document.getElementById('serviceDistributionChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($serviceDistribution->pluck('service_type')) !!},
                datasets: [{
                    data: {!! json_encode($serviceDistribution->pluck('count')) !!},
                    backgroundColor: [
                        '#059669',
                        '#f59e0b',
                        '#3b82f6',
                        '#8b5cf6',
                        '#ec4899',
                        '#14b8a6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Age Demographics Chart
        new Chart(document.getElementById('ageDemographicsChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($ageDemographics->pluck('age_group')) !!},
                datasets: [{
                    label: 'Patients',
                    data: {!! json_encode($ageDemographics->pluck('count')) !!},
                    backgroundColor: 'rgba(5, 150, 105, 0.8)',
                    borderColor: '#059669',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Gender Distribution Chart
        new Chart(document.getElementById('genderDistributionChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($genderDistribution->pluck('sex')) !!},
                datasets: [{
                    data: {!! json_encode($genderDistribution->pluck('count')) !!},
                    backgroundColor: [
                        '#059669',
                        '#f59e0b',
                        '#3b82f6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Immunization Coverage Chart
        new Chart(document.getElementById('immunizationCoverageChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($immunizationCoverage->pluck('vaccine_name')) !!},
                datasets: [{
                    label: 'Doses Administered',
                    data: {!! json_encode($immunizationCoverage->pluck('count')) !!},
                    backgroundColor: 'rgba(4, 120, 87, 0.8)',
                    borderColor: '#047857',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // High-Risk Prenatal Trend Chart
        new Chart(document.getElementById('highRiskPrenatalChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($highRiskPrenatalTrend->pluck('month')) !!},
                datasets: [{
                    label: 'High-Risk Cases',
                    data: {!! json_encode($highRiskPrenatalTrend->pluck('count')) !!},
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220, 38, 38, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Top Complaints Chart
        new Chart(document.getElementById('topComplaintsChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($topComplaints->pluck('chief_complaint')) !!},
                datasets: [{
                    label: 'Occurrences',
                    data: {!! json_encode($topComplaints->pluck('count')) !!},
                    backgroundColor: [
                        '#059669',
                        '#047857',
                        '#f59e0b',
                        '#3b82f6',
                        '#8b5cf6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
