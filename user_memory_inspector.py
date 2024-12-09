import psutil
import sys
import json

def get_logged_users():
    logged_users = []
    users = psutil.users()
    for user in users:
        username = user.name
        terminal = user.terminal
        logged_users.append((username, terminal))
    return logged_users

def get_user_cpu_percent(username):
    user_cpu_percent = 0
    for process in psutil.process_iter(['pid', 'username', 'cpu_percent']):
        if process.info['username'] == username:
            try:
                user_cpu_percent += process.info['cpu_percent']
            except (psutil.NoSuchProcess, psutil.AccessDenied, psutil.ZombieProcess):
                pass
    return user_cpu_percent

if _name_ == "_main_":
    if "-u" in sys.argv:
        username = sys.argv[sys.argv.index("-u") + 1].lower()

        users = get_logged_users()

        for user, terminal in users:
            if user.lower() == username:
                total_memory = psutil.virtual_memory().total
                used_memory = psutil.Process().memory_info().vms
                cpu_percent = get_user_cpu_percent(user)

                user_info = {
                    "username": user,
                    "total_memory_bytes": total_memory,
                    "used_memory_bytes": used_memory,
                    "cpu_percent": cpu_percent
                }

                json_output = json.dumps(user_info, indent=4)

                json_folder = "json"
                os.makedirs(json_folder, exist_ok=True)

                filename = os.path.join(json_folder, f"user_{user.lower()}.json")
                with open(filename, "w") as json_file:
                    json_file.write(json_output)

                break