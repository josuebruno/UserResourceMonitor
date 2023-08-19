param(
    [string]$username
)

$pythonScript = "C:\xampp\htdocs\converteimagem\testepy.py"
$args = @("-u", $username, "-MemoryUsage")

$totalMemory = Get-WmiObject Win32_ComputerSystem | Select-Object TotalPhysicalMemory
$totalMemoryGB = [math]::Round($totalMemory.TotalPhysicalMemory / 1GB, 2)

$userMemoryUsage = & "C:\Python312\python.exe" $pythonScript $args

if ($userMemoryUsage -is [System.Object[]]) {
    $userMemoryUsage = $userMemoryUsage[0]  # Assuming the value is in the first element of the array
}

#$userMemoryUsagePercent = [math]::Round(($userMemoryUsage / $totalMemory.TotalPhysicalMemory) * 100, 2)

$cpuUsage = Get-WmiObject Win32_Processor | Select-Object LoadPercentage

Write-Host "Total de memória do servidor: $totalMemoryGB GB"
#Write-Host "Uso de memória do usuário $username: $userMemoryUsagePercent%"
#Write-Host "Uso de CPU do servidor: $($cpuUsage.LoadPercentage)%"

Write-Host "Executando o script Python para o usuário $username..."
& "C:\Python312\python.exe" $pythonScript $args
