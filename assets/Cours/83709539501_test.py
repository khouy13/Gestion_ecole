x1 = range(1, 13)
x2 = range(1, 10)
z = []
vals = []
for i in x1:
    for j in x2:
        if ((2*i + j >= 16) and (i+j >= 15)):
            # print("x1 = "+str(i) + " and x2 = "+str(j))
            z.append(800000*i + 200000*j)
            vals.append({'x1': i, 'x2': j})
print(vals[z.index(min(z))])
