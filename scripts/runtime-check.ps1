$ErrorActionPreference = 'Stop'

Write-Host '[1/5] Verifying .env exists...'
if (-not (Test-Path '.env')) {
    Write-Error '.env not found. Copy .env.offline.example or .env.online.example to .env first.'
}

Write-Host '[2/5] Ensuring required storage directories exist...'
$requiredDirs = @(
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs'
)
foreach ($dir in $requiredDirs) {
    if (-not (Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
    }
}

Write-Host '[3/5] Running Laravel runtime checks...'
php artisan optimize:clear
php artisan about

Write-Host '[4/5] Verifying database migrations...'
php artisan migrate:status

Write-Host '[5/5] Verifying production frontend build...'
npm run build

Write-Host 'Runtime check passed. Current profile is ready for use.'
