# ResourceMonitorX

ResourceMonitorX is a lightweight monitoring tool designed to track and analyze memory and CPU usage by specific users on server environments. This tool aims to provide valuable insights into resource consumption patterns, helping system administrators and developers optimize server performance and resource allocation.

## Features

- **Real-time Monitoring:** Continuously monitor memory and CPU usage by active users in real-time, enabling quick identification of resource-intensive processes.

- **Accurate Data:** Utilizes the `psutil` Python library to gather precise information about running processes and their contribution to system resources.

- **Detailed Analysis:** Captures collected data and stores it in a structured JSON format, facilitating thorough analysis of resource usage trends and patterns over time.

- **Usage Trends:** By analyzing historical data, identify long-term trends in memory and CPU usage, enabling proactive resource planning.

- **Easy Integration:** ResourceMonitorX is designed for easy integration into existing scripts and workflows, allowing users to tailor resource monitoring to their specific needs.

## Usage

1. **Prerequisites:** Install the required `psutil` library using `pip install psutil`.

2. **Execution:** Run the script and provide the target username as a parameter:

```shell
python user_memory_isnpector.py  -u username

 3. **Execution:** Run the script in server.

```shell

memory_insight.ps1