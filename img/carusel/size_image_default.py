from PIL import Image
from pathlib import Path
from os import listdir

def proverka(name) -> bool:
    if Path(name).suffix == ".jpg":
        return True
    else:
        return False
mylist = listdir()
size = 360, 270
for name in mylist:
    if proverka(name) != True:
        continue
    img = Image.open(name)
    new_image = img.resize(size)
    #new_image.show()
    new_image.save(name)
