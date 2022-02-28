import cv2
from cv2 import threshold
import imutils
import base64
import numpy as np
import pytesseract
import ocr_tesseract
from typing import Optional
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

origins = [
    "http://localhost.tiangolo.com",
    "https://localhost.tiangolo.com",
    "http://localhost",
    "http://localhost:8080",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.get("/")
def read_root():
    pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"

    with open('image.txt','r') as nm_file:
        thresh = nm_file.readlines()[0]
    # url = 'file-2021-12-31 06-25-08-cover.jpg'

    img = cv2.imread(thresh)
    # img = cv2.resize(img,(500,500))
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    blur = cv2.bilateralFilter(gray, 9, 75, 75)

    th = cv2.adaptiveThreshold(blur,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY,11,2)

    imgcnt = th.copy()

    cnt = cv2.findContours(imgcnt,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)
    cnt = imutils.grab_contours(cnt)
    cnt = sorted(cnt,key=cv2.contourArea,reverse = True)[:10]

    detected = None
    screencnt = None
    for c in cnt:
        
        peri = cv2.arcLength(c,True)
        approx = cv2.approxPolyDP(c,0.02*peri,True)
        #if there are four DP 
        if len(approx) == 4:
            screencnt = approx
                #detected == 1
            break
            
    #masking other part
    mask = np.zeros(gray.shape,np.uint8)


    # new_image = cv2.drawContours(mask,[screencnt],0,255,-1)
    # new_image = cv2.bitwise_and(img,img,mask=mask)
    # #cropping process
    # (x,y) = np.where(mask ==255)
    # (topx,topy) = (np.min(x),np.min(y))
    # (bottomx,bottomy) = (np.max(x),np.max(y))
    # cropped = gray[topx:bottomx+1, topy:bottomy+1]
    # blur = cv2.GaussianBlur(cropped,(5,5),0)
    # ret,th = cv2.threshold(blur,127,255,cv2.THRESH_BINARY_INV)
    
    text, th = ocr_tesseract.image_to_string(thresh, '--oem 3 --psm 8')
    
    retval, buffer = cv2.imencode('.jpg', th)
    jpg_as_text = base64.b64encode(buffer)
    # print(jpg_as_text)
    return [{"status": "Berhasil!", "text_plat": text, "base64_segmentation": jpg_as_text, "url" : thresh}]


