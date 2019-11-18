from lxml import etree

xml_file = '../scores/JSB_BWV1047_2.xml'

tree = etree.parse(xml_file)
root = tree.getroot()



tags = []
for e in root.xpath('//*'):
    # print(e.tag, e.attrib)
    if e.tag not in tags:
        tags.append(e.tag)

for t in tags:
    print(t)
