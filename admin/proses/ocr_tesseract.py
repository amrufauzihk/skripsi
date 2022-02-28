import cv2
import pytesseract
pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"

def image_to_string(img, config):
    url = r"result/0" + img
    img = cv2.imread(url)
    thresh = resize_img(img)
    blur = cv2.GaussianBlur(thresh,(5,5),0)
    # ret,th= cv2.threshold(blur,127,255,cv2.THRESH_BINARY_INV)
    th= cv2.Canny(blur, 90, 120, 120)
    
    text = pytesseract.image_to_string(blur,config=config)

    return text, th

def resize_img(img):
    shape = img.shape[1]
    if shape < 1000 :
        scale_percent = 50
    elif shape < 1500 :
        scale_percent = 32
    elif shape < 2500 :
        scale_percent = 20
    elif shape < 3500 :
        scale_percent = 14
    elif shape > 3500 :
        scale_percent = 10
    width = int(img.shape[1] * scale_percent / 100)
    height = int(img.shape[0] * scale_percent / 100)
    dim = (width, height)

    img = cv2.resize(img, dim, interpolation = cv2.INTER_AREA)
    
    return img
