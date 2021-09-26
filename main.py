import os
from PIL import Image


def convert(sub):
    
    src = './src/images/' + sub + '/'
    dest = './assets/images/' + sub + '/'

    paths = os.listdir(src)

    for path in paths:
        image = Image.open(src + path)
        
        if image.size[0] > 1920:
            width = 1920
            height = round((width * image.size[1]) / image.size[0])
            image = image.resize((width, height), Image.ANTIALIAS)
        
        name = path.replace(".png", ".jpg")
        if path != name:
            image = image.convert('RGB')
        
        image.save(dest + name, optimize = True, quality = 75)

#end convert()


for sub in ['1920', '960', '640']:
    convert(sub)



"""
PATH = 'pexels-adrienne-andersen-2254065.png'
NEW_NAME = 'quem-somos.jpg'

im = Image.open(PATH)
width = 815
height = round((width * im.size[1]) / im.size[0])

im = im.resize((width, height), Image.ANTIALIAS)
rgb_im = im.convert('RGB')

rgb_im.save(NEW_NAME, optimize=True, quality=75)
"""