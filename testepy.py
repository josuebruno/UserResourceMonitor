import psutil
import sys
import time
import json

def get_logged_users():
    logged_users = []
    users = psutil.users()
    for user in users:
        username = user.name
        terminal = user.terminal
        logged_users.append((username, terminal))
    return logged_users

def get_memory_usage(username):
    memory_total = 0
    for process in psutil.process_iter(['pid', 'name', 'memory_info', 'username']):
        try:
            process_info = process.info
            if process_info['username'] and "\\" + username in process_info['username']:
                memory_total += process_info['memory_info'].vms
        except (psutil.NoSuchProcess, psutil.AccessDenied, psutil.ZombieProcess):
            pass
    return memory_total

def get_process_cpu_usage(username):
    cpu_total = 0
    for process in psutil.process_iter(['pid', 'name', 'cpu_percent', 'username']):
        try:
            process_info = process.info
            if process_info['username'] and "\\" + username in process_info['username']:
                cpu_total += process_info['cpu_percent']
        except (psutil.NoSuchProcess, psutil.AccessDenied, psutil.ZombieProcess):
            pass
    return cpu_total

if __name__ == "__main__":
    if "-u" in sys.argv:
        username = sys.argv[sys.argv.index("-u") + 1]

        users = get_logged_users()

        for user, terminal in users:
            if user == username:
                initial_memory = get_memory_usage(user)
                initial_cpu = get_process_cpu_usage(user)

                time.sleep(5)  # Aguarda 5 segundos para coletar mais dados

                final_memory = get_memory_usage(user)
                final_cpu = get_process_cpu_usage(user)

                memory_usage = final_memory - initial_memory
                memory_usage_bytes = memory_usage
                cpu_percent = final_cpu

                total_memory = psutil.virtual_memory().total
                memory_percent = (memory_usage / total_memory) * 100

                user_info = {
                    "username": user,
                    "memory_usage_bytes": memory_usage_bytes,
                    "memory_percent": memory_percent,
                    "cpu_percent": cpu_percent
                }

                json_output = json.dumps(user_info, indent=4)

                with open("user_info.json", "w") as json_file:
                    json_file.write(json_output)

                break
