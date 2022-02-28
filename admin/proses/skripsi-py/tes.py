import cv2  

# Save image in set directory
# Read RGB image
img = cv2.imread("D:/PY/fastapi/skripsi-py/1.jpeg",1 )
  
# Output img with window name as 'image'
cv2.imshow('image', img) 
  
# Maintain output window utill
# user presses a key
cv2.waitKey(0)        
  
# Destroying present windows on screen
cv2.destroyAllWindows() 