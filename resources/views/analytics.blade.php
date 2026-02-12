<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analytics - CareSync</title>
    <link rel="icon" href="/favicon.ico?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            padding: 40px;
            min-height: 100vh;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 32px 40px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .header-left h1 {
            font-size: 36px;
            font-weight: 800;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        .header-left p {
            font-size: 15px;
            color: #6b7280;
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
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(5, 150, 105, 0.4);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
        }

        .metric-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 32px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 5px solid #059669;
            position: relative;
            overflow: hidden;
        }
        
        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(5, 150, 105, 0.1) 0%, transparent 70%);
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
            font-size: 44px;
            font-weight: 900;
            color: #059669;
            margin-bottom: 12px;
            line-height: 1;
            letter-spacing: -0.03em;
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
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
            padding: 36px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 40px;
            border: 1px solid rgba(5, 150, 105, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .insights-section:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
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
            padding: 24px;
            margin-bottom: 16px;
            border-left: 5px solid #059669;
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
            border-radius: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .insight-item:hover {
            background: linear-gradient(135deg, #ecfdf5 0%, #f9fafb 100%);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.15);
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
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 36px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .chart-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
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
            <h3><i class="bi bi-lightbulb-fill"></i> Predictive Insights & Recommendations</h3>
            
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

        <!-- Patient Activity & Retention Analytics -->
        <div class="insights-section" style="margin-top: 32px;">
            <h3><i class="bi bi-graph-up-arrow"></i> Patient Activity & Retention Predictive Analytics</h3>
            
            <div class="metrics-grid" style="margin-bottom: 24px;">
                <div class="metric-card">
                    <div class="metric-label">Active Patients (30 days)</div>
                    <div class="metric-value">{{ number_format($patientActivityMetrics['patients_with_recent_visits']) }}</div>
                    <span class="metric-trend trend-up">{{ $metrics['total_patients'] > 0 ? round(($patientActivityMetrics['patients_with_recent_visits'] / $metrics['total_patients']) * 100, 1) : 0 }}% of total</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Inactive Patients (90+ days)</div>
                    <div class="metric-value">{{ number_format($patientActivityMetrics['inactive_patients']) }}</div>
                    <span class="metric-trend trend-down">Need re-engagement</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Never Visited</div>
                    <div class="metric-value">{{ number_format($patientActivityMetrics['never_visited']) }}</div>
                    <span class="metric-trend trend-neutral">Registered only</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Patient Retention Rate</div>
                    <div class="metric-value">{{ $patientActivityMetrics['retention_rate'] }}%</div>
                    <span class="metric-trend {{ $patientActivityMetrics['retention_rate'] >= 70 ? 'trend-up' : 'trend-down' }}">
                        {{ $patientActivityMetrics['retention_rate'] >= 70 ? 'Good retention' : 'Needs improvement' }}
                    </span>
                </div>
            </div>

            <div class="insight-item">
                <h4><i class="bi bi-people-fill"></i> Patient Visit Patterns</h4>
                <p>Out of <strong>{{ number_format($metrics['total_patients']) }} total patients</strong>, <strong>{{ number_format($patientActivityMetrics['patients_with_recent_visits']) }} patients ({{ $metrics['total_patients'] > 0 ? round(($patientActivityMetrics['patients_with_recent_visits'] / $metrics['total_patients']) * 100, 1) : 0 }}%) have visited in the last 30 days</strong>. Meanwhile, <strong>{{ number_format($patientActivityMetrics['inactive_patients']) }} patients</strong> haven't visited in over 90 days and may need follow-up contact.</p>
            </div>

            @if($patientActivityMetrics['at_risk_patients'] > 0)
            <div class="insight-item">
                <h4><i class="bi bi-exclamation-circle-fill"></i> At-Risk Patient Alert</h4>
                <p><strong>{{ number_format($patientActivityMetrics['at_risk_patients']) }} patients</strong> are at risk of becoming inactive. They last visited 60-90 days ago. Consider proactive outreach through SMS reminders or calls to re-engage these patients before they become fully inactive.</p>
            </div>
            @endif

            @if($patientActivityMetrics['never_visited'] > 0)
            <div class="insight-item">
                <h4><i class="bi bi-clipboard-data"></i> Never Visited Patients</h4>
                <p><strong>{{ number_format($patientActivityMetrics['never_visited']) }} patients ({{ $metrics['total_patients'] > 0 ? round(($patientActivityMetrics['never_visited'] / $metrics['total_patients']) * 100, 1) : 0 }}%)</strong> are registered but have never visited the health center. These may be pre-registered patients or those who registered but didn't complete their first visit. Follow up to confirm their records and encourage first visit.</p>
            </div>
            @endif

            @if($patientActivityMetrics['retention_rate'] < 70)
            <div class="insight-item">
                <h4><i class="bi bi-arrow-down-circle-fill"></i> Low Retention Warning</h4>
                <p>Current patient retention rate is <strong>{{ $patientActivityMetrics['retention_rate'] }}%</strong>, which is below the recommended 70% threshold. This indicates that many patients are not returning for follow-up care. Recommended actions: implement automated appointment reminders, conduct patient satisfaction surveys, and improve follow-up protocols.</p>
            </div>
            @elseif($patientActivityMetrics['retention_rate'] >= 80)
            <div class="insight-item">
                <h4><i class="bi bi-check-circle-fill"></i> Excellent Retention</h4>
                <p>Patient retention rate of <strong>{{ $patientActivityMetrics['retention_rate'] }}%</strong> is excellent! Patients are regularly returning for care, indicating good service quality and effective follow-up systems. Continue current practices and consider documenting successful strategies.</p>
            </div>
            @endif
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <h2 class="section-title"><i class="bi bi-bar-chart-fill"></i> Visual Analytics</h2>
            
            <div class="charts-grid">
                <!-- Patient Growth -->
                <div class="chart-card">
                    <h3><i class="bi bi-graph-up"></i> Patient Registration Trend (6 Months)</h3>
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
                    <h3><i class="bi bi-people-fill"></i> Age Demographics</h3>
                    <div class="chart-container">
                        <canvas id="ageDemographicsChart"></canvas>
                    </div>
                </div>

                <!-- Gender Distribution -->
                <div class="chart-card">
                    <h3><i class="bi bi-person-badge"></i> Gender Distribution</h3>
                    <div class="chart-container">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Immunization Coverage -->
                <div class="chart-card">
                    <h3><i class="bi bi-shield-fill-check"></i> Top 10 Vaccines Administered</h3>
                    <div class="chart-container">
                        <canvas id="immunizationCoverageChart"></canvas>
                    </div>
                </div>

                <!-- High-Risk Prenatal Trend -->
                <div class="chart-card">
                    <h3><i class="bi bi-exclamation-triangle-fill"></i> High-Risk Prenatal Cases Trend</h3>
                    <div class="chart-container">
                        <canvas id="highRiskPrenatalChart"></canvas>
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
