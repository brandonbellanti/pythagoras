from lxml import etree

parser = etree.XMLParser()
tree2 = etree.parse("../scores/JSB_BWV1047_1.xml",parser)
root2 = tree2.getroot()
print(root2.tag)
for e in root2.iter("measure"):
    print(e.keys(), e.values())
