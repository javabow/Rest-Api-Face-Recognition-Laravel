#!C:/ProgramData/Anaconda3/python.exe

import face_recognition
import pickle
import os
from PIL import Image
import glob
import sys

dataset_file = 'all-dataset-faces.dat'

nimBaru = sys.argv[1]

nimLama = sys.argv[2]

all_face_encodings = {}
image_list = []

print(os.path.join('C:/xampp/htdocs/Rest-Api-Face-Recognition-Laravel/public/gambar_mahasiswa/',nimBaru))

if os.path.exists(dataset_file):
    # "with" statements are very handy for opening files.
    with open(dataset_file,'rb') as rfp:
        all_face_encodings = pickle.load(rfp)
    # Notice that there's no "rfp.close()"
    #   ... the "with" clause calls close() automatically!

all_face_encodings.pop(nimLama, None)

for root, dirs, files in os.walk(os.path.join('C:/xampp/htdocs/Rest-Api-Face-Recognition-Laravel/public/gambar_mahasiswa/',nimBaru)):
    print(os.path.join(root,'*.jpg'))
    for filename in glob.glob(os.path.join(root,'*.jpg')):
        im = Image.open(filename)

        # Load a sample picture and learn how to recognize it.
        image_to_dataset = face_recognition.load_image_file(im.filename)
        all_face_encodings[os.path.basename(nimBaru)] = face_recognition.face_encodings(image_to_dataset)[0]

# Now we "sync" our database
with open(dataset_file,'wb') as wfp:
    pickle.dump(all_face_encodings, wfp)

print(all_face_encodings)