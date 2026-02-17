<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analytics - VetCare</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        :root {
            --bg: #f5f7fb;
            --bg-alt: #eef2ff;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #2563eb;
            --primary-strong: #1d4ed8;
            --accent: #16a34a;
            --accent-strong: #15803d;
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 20px 40px rgba(15, 23, 42, 0.12);
            --radius: 14px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 40px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: var(--text);
        }

        body::before,
        body::after {
            content: '';
            position: fixed;
            z-index: -1;
            border-radius: 50%;
        }

        body::before {
            width: 460px;
            height: 460px;
            top: -160px;
            right: -140px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
        }

        body::after {
            width: 380px;
            height: 380px;
            bottom: -160px;
            left: -120px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.16) 0%, rgba(22, 163, 74, 0) 70%);
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .header {
            background: var(--card);
            padding: 28px 32px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--line);
            transition: all 0.3s ease;
            animation: pageEnter 0.5s ease;
        }
        
        .header:hover {
            box-shadow: var(--shadow-lg);
        }

        .header-left h1 {
            font-size: 32px;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .header-left p {
            font-size: 14px;
            color: var(--muted);
            font-weight: 500;
        }

        .tech-badge {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 24px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
        }

        .back-btn {
            background: white;
            color: var(--text);
            border: 1px solid var(--line);
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .back-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
        }

        .metric-card {
            background: var(--card);
            padding: 24px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
        }
        
        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 90px;
            height: 90px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .metric-label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .metric-value {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 10px;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .metric-trend {
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 10px;
            display: inline-block;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .trend-up {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .trend-down {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .trend-neutral {
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            color: #3730a3;
        }

        .insights-section {
            background: var(--card);
            padding: 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 32px;
            border: 1px solid var(--line);
            transition: all 0.3s ease;
        }
        
        .insights-section:hover {
            box-shadow: var(--shadow-lg);
        }

        .insights-section h3 {
            color: #111827;
            margin-bottom: 28px;
            font-size: 22px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.02em;
        }

        .insight-item {
            padding: 20px;
            margin-bottom: 16px;
            border-left: 4px solid var(--accent);
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .insight-item:hover {
            background: #f1f5f9;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12);
            transform: translateX(4px);
        }

        .insight-item h4 {
            color: #059669;
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .insight-item p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.7;
            font-weight: 500;
        }

        .charts-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 24px;
            color: #111827;
            font-weight: 800;
            margin-bottom: 28px;
            padding-left: 6px;
            letter-spacing: -0.02em;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 28px;
        }

        .chart-card {
            background: var(--card);
            padding: 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid var(--line);
        }

        .chart-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chart-card h3 {
            color: #111827;
            margin-bottom: 28px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.01em;
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
        <a href="{{ route('dashboard') }}" class="back-btn" style="margin-bottom: 16px;">← Back to Dashboard</a>
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>
                    <span>Data Analytics</span>
                </h1>
                <p>Advanced insights and predictive analytics for data-driven veterinary care decisions</p>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-label">Total Pets</div>
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
                <div class="metric-label">Vaccination Completion</div>
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
            <h3><i class="bi bi-lightbulb-fill"></i> Predictive Insights & Recommendations</h3>
            
            <div class="insight-item">
                <h4>Visit Forecast</h4>
                <p>Based on the last 3 months average ({{ $metrics['avg_monthly_visits'] }} visits/month) and current growth rate ({{ $metrics['visit_growth_rate'] }}%), we predict approximately <strong>{{ $metrics['predicted_next_month'] }} visits next month</strong>. Consider staffing adjustments accordingly.</p>
            </div>

            @if($metrics['visit_growth_rate'] > 15)
            <div class="insight-item">
                <h4>High Growth Alert</h4>
                <p>Pet visits are increasing significantly (+{{ $metrics['visit_growth_rate'] }}%). This indicates growing demand for services. Recommend expanding clinic hours or adding staff to maintain service quality.</p>
            </div>
            @elseif($metrics['visit_growth_rate'] < -15)
            <div class="insight-item">
                <h4>Declining Trend Alert</h4>
                <p>Pet visits have decreased by {{ abs($metrics['visit_growth_rate']) }}%. Consider implementing community outreach programs or reviewing service accessibility to re-engage pet owners.</p>
            </div>
            @endif

            @if($metrics['completion_rate'] < 50)
            <div class="insight-item">
                <h4>Vaccination Follow-up Needed</h4>
                <p>Only {{ $metrics['completion_rate'] }}% of vaccinations are completed. Many pets need follow-up doses. Implement automated reminder system to improve completion rates.</p>
            </div>
            @endif

            @if($metrics['high_risk_breeding'] > 5)
            <div class="insight-item">
                <h4>High-Risk Breeding Cases</h4>
                <p>Currently tracking {{ $metrics['high_risk_breeding'] }} high-risk breeding cases. Ensure regular monitoring and consider specialized care coordination for these animals.</p>
            </div>
            @endif
        </div>

        <!-- Pet Activity & Retention Analytics -->
        <div class="insights-section" style="margin-top: 32px;">
            <h3><i class="bi bi-graph-up-arrow"></i> Pet Activity & Retention Predictive Analytics</h3>
            
            <div class="metrics-grid" style="margin-bottom: 24px;">
                <div class="metric-card">
                    <div class="metric-label">Active Pets (30 days)</div>
                    <div class="metric-value">{{ number_format($patientActivityMetrics['patients_with_recent_visits']) }}</div>
                    <span class="metric-trend trend-up">{{ $metrics['total_patients'] > 0 ? round(($patientActivityMetrics['patients_with_recent_visits'] / $metrics['total_patients']) * 100, 1) : 0 }}% of total</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Inactive Pets (90+ days)</div>
                    <div class="metric-value">{{ number_format($patientActivityMetrics['inactive_patients']) }}</div>
                    <span class="metric-trend trend-down">Need re-engagement</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Never Visited</div>
                    <div class="metric-value">{{ number_format($patientActivityMetrics['never_visited']) }}</div>
                    <span class="metric-trend trend-neutral">Registered only</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Pet Retention Rate</div>
                    <div class="metric-value">{{ $patientActivityMetrics['retention_rate'] }}%</div>
                    <span class="metric-trend {{ $patientActivityMetrics['retention_rate'] >= 70 ? 'trend-up' : 'trend-down' }}">
                        {{ $patientActivityMetrics['retention_rate'] >= 70 ? 'Good retention' : 'Needs improvement' }}
                    </span>
                </div>
            </div>

            <div class="insight-item">
                <h4><i class="bi bi-people-fill"></i> Pet Visit Patterns</h4>
                <p>Out of <strong>{{ number_format($metrics['total_patients']) }} total pets</strong>, <strong>{{ number_format($patientActivityMetrics['patients_with_recent_visits']) }} pets ({{ $metrics['total_patients'] > 0 ? round(($patientActivityMetrics['patients_with_recent_visits'] / $metrics['total_patients']) * 100, 1) : 0 }}%) have visited in the last 30 days</strong>. Meanwhile, <strong>{{ number_format($patientActivityMetrics['inactive_patients']) }} pets</strong> haven't visited in over 90 days and may need follow-up contact.</p>
            </div>

            @if($patientActivityMetrics['at_risk_patients'] > 0)
            <div class="insight-item">
                <h4><i class="bi bi-exclamation-circle-fill"></i> At-Risk Pet Alert</h4>
                <p><strong>{{ number_format($patientActivityMetrics['at_risk_patients']) }} pets</strong> are at risk of becoming inactive. They last visited 60-90 days ago. Consider proactive outreach through SMS reminders or calls to re-engage pet owners before they become fully inactive.</p>
            </div>
            @endif

            @if($patientActivityMetrics['never_visited'] > 0)
            <div class="insight-item">
                <h4><i class="bi bi-clipboard-data"></i> Never Visited Pets</h4>
                <p><strong>{{ number_format($patientActivityMetrics['never_visited']) }} pets ({{ $metrics['total_patients'] > 0 ? round(($patientActivityMetrics['never_visited'] / $metrics['total_patients']) * 100, 1) : 0 }}%)</strong> are registered but have never visited the clinic. These may be pre-registered pets or those who registered but didn't complete their first visit. Follow up to confirm their records and encourage a first visit.</p>
            </div>
            @endif

            @if($patientActivityMetrics['retention_rate'] < 70)
            <div class="insight-item">
                <h4><i class="bi bi-arrow-down-circle-fill"></i> Low Retention Warning</h4>
                <p>Current pet retention rate is <strong>{{ $patientActivityMetrics['retention_rate'] }}%</strong>, which is below the recommended 70% threshold. This indicates that many pets are not returning for follow-up care. Recommended actions: implement automated appointment reminders, conduct client satisfaction surveys, and improve follow-up protocols.</p>
            </div>
            @elseif($patientActivityMetrics['retention_rate'] >= 80)
            <div class="insight-item">
                <h4><i class="bi bi-check-circle-fill"></i> Excellent Retention</h4>
                <p>Pet retention rate of <strong>{{ $patientActivityMetrics['retention_rate'] }}%</strong> is excellent! Pets are regularly returning for care, indicating good service quality and effective follow-up systems. Continue current practices and consider documenting successful strategies.</p>
            </div>
            @endif
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <h2 class="section-title"><i class="bi bi-bar-chart-fill"></i> Visual Analytics</h2>
            
            <div class="charts-grid">
                <!-- Patient Growth -->
                <div class="chart-card">
                    <h3><i class="bi bi-graph-up"></i> Pet Registration Trend (6 Months)</h3>
                    <div class="chart-container">
                        <canvas id="patientGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Visit Trends -->
                <div class="chart-card">
                    <h3><i class="bi bi-hospital"></i> Daily Visit Patterns (30 Days)</h3>
                    <div class="chart-container">
                        <canvas id="visitTrendsChart"></canvas>
                    </div>
                </div>

                <!-- Service Distribution -->
                <div class="chart-card">
                    <h3><i class="bi bi-bullseye"></i> Service Type Distribution</h3>
                    <div class="chart-container">
                        <canvas id="serviceDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Age Demographics -->
                <div class="chart-card">
                    <h3><i class="bi bi-people-fill"></i> Age Distribution</h3>
                    <div class="chart-container">
                        <canvas id="ageDemographicsChart"></canvas>
                    </div>
                </div>

                <!-- Gender Distribution -->
                <div class="chart-card">
                    <h3><i class="bi bi-person-badge"></i> Sex Distribution</h3>
                    <div class="chart-container">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Vaccination Coverage -->
                <div class="chart-card">
                    <h3><i class="bi bi-shield-check-fill"></i> Vaccination Coverage</h3>
                    <div class="chart-container">
                        <canvas id="vaccinationCoverageChart"></canvas>
                    </div>
                </div>

                <!-- High-Risk Breeding Trend -->
                <div class="chart-card">
                    <h3><i class="bi bi-exclamation-triangle-fill"></i> High-Risk Breeding Cases Trend</h3>
                    <div class="chart-container">
                        <canvas id="highRiskBreedingChart"></canvas>
                    </div>
                </div>

                <!-- Top Complaints -->
                <div class="chart-card">
                    <h3><i class="bi bi-chat-text"></i> Top 5 Chief Complaints</h3>
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
                    label: 'New Pets',
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
                    label: 'Pets',
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

        // Vaccination Coverage Chart
        new Chart(document.getElementById('vaccinationCoverageChart'), {
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

        // High-Risk Breeding Trend Chart
        new Chart(document.getElementById('highRiskBreedingChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($highRiskBreedingTrend->pluck('month')) !!},
                datasets: [{
                    label: 'High-Risk Cases',
                    data: {!! json_encode($highRiskBreedingTrend->pluck('count')) !!},
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
