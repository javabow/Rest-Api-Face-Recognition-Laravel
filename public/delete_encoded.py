#!C:/Users/Javabow/AppData/Local/Programs/Python/Python37/python.exe
print ("Content-Type: text/html\n")
import pickle
import os
import sys


dataset_file = 'dataset-faces.dat'

all_face_encodings = {}
image_list = []
nim = sys.argv[1]

if os.path.exists(dataset_file):
    # "with" statements are very handy for opening files.
    with open(dataset_file,'rb') as rfp:
        all_face_encodings = pickle.load(rfp)
    # Notice that there's no "rfp.close()"
    #   ... the "with" clause calls close() automatically!

all_face_encodings.pop(nim, None)

# for root, dirs, files in os.walk('C:/Users/Javabow/Documents/Hilmi Past Document/UGM/JST/pict_face/'):
#     print(os.path.join(root,'*.jpg'))
#     for filename in glob.glob(os.path.join(root,'*.jpg')):
#         im = Image.open(filename)
#
#         # Load a sample picture and learn how to recognize it.
#         image_to_dataset = face_recognition.load_image_file(im.filename)
#         all_face_encodings[os.path.basename(im.filename)] = face_recognition.face_encodings(image_to_dataset)[0]

# all_face_encodings.pop('1711501831.jpg', None)

# Now we "sync" our database
with open(dataset_file,'wb') as wfp:
    pickle.dump(all_face_encodings, wfp)

# print(all_face_encodings)

