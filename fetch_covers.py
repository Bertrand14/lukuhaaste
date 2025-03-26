#!/usr/bin/env python3
# -*- coding: utf-8 -*-


import requests
import os
 
idimages = [
    "5432644", "5527512", "5527187", "5428622", "5564511", "5256051",
    "5486264", "5443539", "5127622", "5420763", "5443531", "5428624",
    "5443734", "5420855", "5443733", "5244894", "5443736", "5244892",
    "5263012", "5244763", "5220489", "5220456", "5140330", "5114756",
    "5144679", "5214238", "5134273", "5079783", "5134172", "5134173",
    "5133301", "5033623", "5039820", "5033622", "5020941", "4952559",
    "5033627", "5020936", "5046932", "4952557", "4952679", "4927616",
    "4947517", "4868026", "4952556", "4849606", "4631749", "4854055",
    "4849607", "3879948", "4556709", "3469569", "4217382", "4776186",
    "4434519", "4129710", "4643116"
]

# Set current working directory to script's location
abspath = os.path.abspath(__file__)
dname = os.path.dirname(abspath)
os.chdir(dname)
cwd = os.getcwd()

 
# Create "images" folder in current working directory
img_folder_path = cwd + "/web-app/public/assets/images/covers/"
if not os.path.exists(img_folder_path):
    os.makedirs(img_folder_path)
 
for idimage in idimages:
    url = f"https://piki.finna.fi/Cover/Show?id=piki.{idimage}&size=medium"
    try:
        response = requests.get(url, stream=True)
        response.raise_for_status()  # Raise exception for HTTP errors (4xx or 5xx)
 
        # Get file extension from Content-Type
        content_type = response.headers.get("Content-Type")
        if content_type and "image/jpeg" in content_type:
            extension = ".jpg"
        elif content_type and "image/png" in content_type:
            extension = ".png"
        else:
            extension = ".jpg" # default
 
        filepath = os.path.join(img_folder_path, f"{idimage}{extension}")
        print(filepath)
        with open(filepath, "wb") as f:
            for chunk in response.iter_content(chunk_size=8192):
                f.write(chunk)
        print(f"Image {idimage} download: success.")
 
    except requests.exceptions.RequestException as e:
        print(f"Erreor while downloading image {idimage}: {e}")
    except IOError as e:
        print(f"Input/output error when downloading image {idimage}: {e}")
 
print("Download completed.")
 