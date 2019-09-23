import xml.etree.ElementTree as ET

tree = ET.parse('../scores/JSB_BWV1047_2.xml')
root = tree.getroot()


for child in root:
    print(child.tag, child.attrib)
