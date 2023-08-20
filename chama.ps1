$userList = query user | Select-String -Pattern '^\s*(\S+)' | ForEach-Object { $_.Matches.Groups[1].Value }

$userList = $userList -replace '^>', ''
#$userList

foreach($user in $userList){

    if ($user -eq "USERNAME") {

        
    }else {
          
        .\memory_insight.ps1 -username "$user"
       
    }    

} 